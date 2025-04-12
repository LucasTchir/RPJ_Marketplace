<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\Message;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    public function index(Request $request) {
        $searchQuery = $request->query('search');
        $categories = Category::all();
        $categoryListings = [];
        $nearListings = collect();
        $categoriesWithListings = [];
        $userId = Auth::id();

        $recommendedCategoriesIDs = Recommendation::where('user_id', $userId)->pluck('category_id');
        $recommendedListings = Listing::whereIn('category_id', $recommendedCategoriesIDs)->get();

        if (Auth::check()) {
            $lat = auth()->user()->lat;
            $lng = auth()->user()->lng; 
            
            $nearListings = Listing::whereBetween('lat', [$lat - 1.5, $lat + 1.5]) 
                ->whereBetween('lng', [$lng - 1.5, $lng + 1.5])
                ->take(12)->get();
            
            $recommendedCategories = Category::with('listings')
                ->whereIn('id', $recommendedCategoriesIDs)
                ->get();

            $filteredCategories = $recommendedCategories
                ->filter(function ($category) {
                    return $category->listings->count() >= 1;
                })
                ->pluck('id')
                ->toArray(); 

            $randomCategories = collect($filteredCategories)->shuffle()->take(3);

            foreach ($randomCategories as $category) {
                $categoryName = Category::find($category)->category_name;

                $categoriesWithListings[] = [
                    'category' => $categoryName,
                    'listings' => Listing::where('category_id', $category)->inRandomOrder()->take(2)->get(),
                ];
            }
        }

        foreach ($categories as $category) {
            $categoryListings[$category->id] = Listing::where('category_id', $category->id)
                ->latest()
                ->filter($request->only('search'))
                ->take(7)
                ->get();
        }

        return view("listings.index", [ 
            "listings" => Listing::latest()->filter($request->only('search'))->take(12)->get(),
            'categories' => $categories,
            'categoryListings' => $categoryListings,
            'searchQuery' => $searchQuery,
            "recommendedListings" => $recommendedListings->take(6),
            "categoriesWithListings" => $categoriesWithListings,
            "nearListings" => $nearListings
        ]);
    }

    public function create() {
        return view("listings.create", [
            "categories" => Category::all()
        ]);
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            "item_name" => "required",
            "price" => "required|numeric|min:0|max:999999.99",
            "category_id" => 'required|exists:categories,id',
            "condition" => "nullable",
            "quantity" => "nullable",
            "description" => "nullable|max:1200",
            "main_image" => "required|image|mimes:jpg,jpeg,png,webp|max:2048",
            "image" => "nullable|array|max:7",
            "image.*" => 'nullable|image|mimes:jpg,jpeg,png,webp|max:7168',
            "lat" => "required|numeric",
            "lng" => "required|numeric",
        ]);

        $randomLat = (rand(-24, 24) / 1000);
        $randomLng = (rand(-24, 24) / 1000);
        $formFields["lat"] += $randomLat;
        $formFields["lng"] += $randomLng;

        $imagePaths = [];

        $formFields["price"] = number_format($request->price, 2, ".", "");

        if($request->hasFile("main_image")) {
            $formFields["main_image"] = $request->file("main_image")->store("postimages", "public");
        }

        if ($request->hasFile("image")) {
            foreach ($request->file("image") as $image) {
                $imagePaths[] = $image->store("postimages", "public");
            }
        }

        $formFields["image"] = json_encode($imagePaths);
        
        $formFields["user_id"] = auth()->id();
        
        Listing::create($formFields);

        $user = Auth::user();
        $user->listings_count = Listing::where('user_id', $user->id)->count();
        $user->save();

        Notification::create([
            'user_id' => auth()->id(),
            'description' => 'pridal inzerát.'
        ]);

        return redirect("/")->with("message", "Inzerát úspešne pridaný!");
    }

    public function show($id) {
        $listing = Listing::where('id', $id)->firstOrFail();
        $listings = Listing::where('category_id', $listing->category_id)
                       ->where('id', '!=', $listing->id)
                       ->latest()
                       ->take(12)
                       ->get();

        $user = $listing->user;
        $userId = $user->id;
        if (Auth::check()) {
            $isFollowing = auth()->user()->isFollowing($userId);
        }

        return view('listings.show-listing', [
            "listing" => $listing,
            "listings" => $listings,
            "categories" => Category::all(),
            "user" => $user,
            "userId" => $userId,
            "isFollowing" => Auth::check() ? $isFollowing : null,
        ]);
    }

    public function manage() {
        return view('listings.manage', [
            "categories" => Category::all(),
            "listings" => auth()->user()->listings()->get()
        ]);
    }

    public function destroy(Listing $listing) 
    {
        /* if (auth()->check() && auth()->user()->isAdmin()) {
            $user->delete();

            return redirect("/dashboard/users")->with("message", "User deleted successfully!");
        } */

        if($listing->user_id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }

        $listing->delete();

        return redirect("/profile/manage")->with("message", "Inzerát úspešne odstránený!");
    }
    public function update(Request $request, Listing $listing) {
        $formFields = $request->validate([
            "item_name" => "required",
            "price" => "required|numeric|min:0|max:999999.99",
            "category_id" => 'required|exists:categories,id',
            "condition" => "nullable",
            "quantity" => "nullable",
            "description" => "nullable|max:1200",
            "main_image" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
            "image" => "nullable|array|max:7",
            "image.*" => 'nullable|image|mimes:jpg,jpeg,png,webp|max:7168',
            "lat" => "required|numeric",
            "lng" => "required|numeric",
            "delete_images" => "nullable|array",
        ]);
    
        $formFields["price"] = number_format($request->price, 2, ".", "");
        
        if($request->hasFile("main_image")) {
            if ($listing->main_image) {
                Storage::delete("public/" . $listing->main_image);
            }
            $formFields["main_image"] = $request->file("main_image")->store("postimages", "public");
        } else {
            $formFields["main_image"] = $listing->main_image;
        }
    
        $existingImages = $listing->image ? json_decode($listing->image, true) : [];
        $imagePaths = $existingImages;
    
        if ($request->has("delete_images")) {
            foreach ($request->input("delete_images") as $index) {
                if (isset($imagePaths[$index])) {
                    Storage::delete("public/" . $imagePaths[$index]);
                    unset($imagePaths[$index]);
                }
            }
            $imagePaths = array_values($imagePaths);
        }
    
        if ($request->hasFile("image")) {
            foreach ($request->file("image") as $image) {
                $imagePaths[] = $image->store("postimages", "public");
            }
        }
    
        $formFields["image"] = json_encode($imagePaths);
    
        $listing->update($formFields);
    
        return redirect("/listings/$listing->id")->with('message', 'Inzerát úspešne aktualizovaný.');

    }
    
    public function edit(Listing $listing) {
        $user = $listing->user;

        if($user->id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }

        return view("listings.edit", [
            "categories" => Category::all(),
            "listing" => $listing
        ]);
    }

    public function showSellers() {
        return view("listings.show-sellers", [
            "categories" => Category::all(),
            "users" => User::all()
        ]);
    }

    public function show_search(Request $request) {
        $categories = Category::all();
        $searchQuery = $request->query('search');

        if (empty($searchQuery)) {
            return redirect('/');
        }

        return view("listings.show-search", [
            "categories" => Category::all(),
            "users" => User::all(),
            "listings" => Listing::latest()->filter($request->only('search'))->paginate(24),
            "searchQuery" => $searchQuery
        ]);
    }

    public function showByCategory($category) {
        if ($category == "nearby") {
            $listings = Listing::where("location", "nearby")->get();
        } elseif ($category == "recent") {
            $listings = Listing::orderBy("created_at", "desc")->get();
        } else {
            $listings = Listing::where("category", $category)->get();
        }

        return view("listings.index", compact("listings", "category"));
    }
}
