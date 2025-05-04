<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show() {
        return view('dashboard.dashboard', [
            "categories" => Category::all()
        ]);
    }

    public function show_listings() {
        return view('dashboard.manage-listings', [
            "categories" => Category::all(),
            "listings" => Listing::paginate(20)
        ]);
    }

    public function show_users() {
        return view('dashboard.manage-users', [
            "categories" => Category::all(),
            "users" => User::paginate(30)
        ]);
    }

    public function show_categories() {
        return view('dashboard.manage-categories', [
            "categories" => Category::all(),
        ]);
    }

    public function destroy_listing(Listing $listing) {
        if (auth()->check() && auth()->user()->isAdmin()) {
            $listing->delete();
        } else {
            abort(403, "Unauthorized Action");
        }

        return redirect("/dashboard/listings")->with("message", "Post deleted successfully!");
    }
    
    public function destroy_user(User $user) {
        if (auth()->check() && auth()->user()->isAdmin()) {
            $user->delete();
        } else {
            abort(403, "Unauthorized Action");
        }

        return redirect("/dashboard/users")->with("message", "User deleted successfully!");
    }

    public function destroy_category(Category $category) {
        if (auth()->check() && auth()->user()->isAdmin()) {
            $category->delete();
        } else {
            abort(403, "Unauthorized Action");
        }

        return redirect("/dashboard/listings")->with("message", "Post deleted successfully!");
    }

    public function edit_listing(Listing $listing) {
        return view("dashboard.edit", [
            "categories" => Category::all(),
            "listing" => $listing
        ]);
    } 

    public function edit_user(User $user) {
        return view("dashboard.edit-user", [
            "user" => $user
        ]);
    }

    public function update(Request $request, User $user) {
        if(!auth()->user()->isAdmin()) {
            abort(403, "Unauthorized Action");
        }

        $formFields = $request->validate([
            "name" => "required",
            "email" => "nullable|email",
            "description" => "nullable",
        ]);

        if($request->hasFile("photo")) {
            $formFields["photo"] = $request->file("photo")->store("profilepictures", "public");
        }

        $user->update($formFields);

        return back()->with("message", "User updated successfully!");
    }
}

