<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;

class RecommendedController extends Controller
{
    public function recommend($category_id) {
        $category = Category::where('id', $category_id)->firstOrFail();
        
        auth()->user()->recommendations()->create([
            'category_id' => $category->id,
        ]);

        return back()->with("message", "Sledujete kategoriu [meno]!");
    }

    public function show(User $user) {
        if ($user->id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }
        $userId = Auth::id();
    
        $categories = Category::all();

        $selectedCategories = Recommendation::where('user_id', $userId)->pluck('category_id');
    
        return view("listings.setup", [
            "categories" => $categories,
            "selectedCategories" => $selectedCategories,
            "user" => $user
        ]);
    }
    

    public function store(Request $request, User $user)
    {
        $request->validate([
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            "lat" => "nullable|numeric",
            "lng" => "nullable|numeric",
        ]);

        $userId = Auth::id();
        $categories = $request->input('categories');

        $user = User::find($userId);
        if($request->hasFile("photo")) {
            $user->photo = $request->file("photo")->store("profilepictures", "public");
        }
        if ($request->has('phone')) {
            $user->phone = $request->input('phone');
        }
        if ($request->has('description')) {
            $user->description = $request->input('description');
        }
        if ($request->has('lat')) {
            $user->lat = $request->input('lat');
        }
        if ($request->has('lng')) {
            $user->lng = $request->input('lng');
        }
        $user->save();

        if (!empty($categories)) {
            foreach ($categories as $categoryId) {
                Recommendation::updateOrCreate(
                    ['user_id' => $userId, 'category_id' => $categoryId]
                );
            }
        }

        return redirect("/")->with('message', 'Profil bol úspešne nastavený.');
    }

    public function updateSelection(Request $request) {
        $user = auth()->user();
        $categoryId = $request->category_id;
        $isSelected = $request->selected;
    
        if ($isSelected) {
            $user->recommendationsMtm()->syncWithoutDetaching([$categoryId]); // pridat bez odstranenia uz oznacenych
        } else {
            $user->recommendationsMtm()->detach($categoryId); // odstranit ak odznacene
        }
    
        return response()->json(["success" => true]);
    }
}
