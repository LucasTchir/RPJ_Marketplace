<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id, Request $request) {
        $category = Category::where("id", $id)->firstOrFail();
        $searchQuery = $request->query("search");

        $listings = Listing::where("category_id", $category->id)
        ->filter($request->only("search", "min", "max", "order"))
        ->paginate(18);

        $listingsInCategoryCount = Listing::where("category_id", $category->id)->count();

        $locations = $listings->map(function ($listing) {
            return [
                "lat" => $listing->lat,
                "lng" => $listing->lng,
                "item_name" => $listing->item_name,
                "id" => $listing->id,
                "price" => $listing->price,
                "main_image" => $listing->main_image,
            ];
        });

        return view("categories.category", [
            "categories" => Category::all(), 
            "category" => $category, 
            "listings" => $listings,
            "searchQuery" => $searchQuery,
            "locations" => $locations,
            "listingsInCategoryCount" => $listingsInCategoryCount,
        ]);
    }

    public function create() {
        return view("categories.create", [
            "categories" => Category::all()
        ]);
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            "category_name" => "required",
            "icon" => "required",
        ]);

        Category::create($formFields);

        return redirect("/dashboard")->with("message", "Kategória úspešne vytvorená!");
    }

    public function destroy(Category $category) 
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            $user->delete();

            return redirect("/dashboard")->with("message", "Kategória úspešne odstránená!");
        } else {
            abort(403, "Unauthorized Action");
        }
    }
    
}
