<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use App\Models\Rating;
use App\Models\Listing;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function login() {
        return view("users.login");
    }

    public function create() {
        return view("users.register");
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            "name" => ["required", "min:4", "max:25"],
            "username" => ["required", "min:5", "max:25", Rule::unique("users", "username"), "regex:/^[a-z0-9_]+$/",],
            "email" => ["required", "email", Rule::unique("users", "email")],
            "description" => "nullable|max:255",
            "phone" => "nullable",
            "password" => "required|confirmed|min:5|regex:/^(?=.*[A-Z])(?=.*\d).+$/",
            "lat" => "nullable|numeric",
            "lng" => "nullable|numeric",
        ]);

        if($request->hasFile("photo")) {
            $formFields["photo"] = $request->file("photo")->store("profilepictures", "public");
        }

        $formFields["password"] = bcrypt($formFields["password"]);

        $user = User::create($formFields);

        auth()->login($user);

        event(new Registered($user));

        return redirect("/setup/{$user->id}")->with("messasge", "Úspešne zaregistrovaný.");
    }

    public function authenticate(Request $request) {
        $formFields = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect("/")->with("message", "Úspešne prihlásený!");
        }

        return back()->withErrors(["username" => "Nesprávne prihlasovacie meno!"])->onlyInput("username");
    }

    public function logout(request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/")->with("message", "Boli ste odhlásený.");
    }

    public function show($username) {
        $user = User::where('username', $username)->firstOrFail();
        $listings = Listing::where('user_id', $user->id)->latest()->paginate(18);
        $userId = $user->id;
        $listings_count = $user->listings_count;
        $followers_count = $user->followers_count;

        if ($listings_count == null) {
            $user->listings_count = 0;
        }
        if ($followers_count == null) {
            $user->followers_count = 0;
        }

        $user->followers_count = Follow::where('followed_id', $user->id)->count();
        $user->save();
        
        if (Auth::check()) {
            $isFollowing = auth()->user()->isFollowing($userId);
        }

        $ratingsCount = Rating::where("rated_user_id", $userId)->get()->count();

        return view('users.show-user', [
            "user" => $user,
            "listings" => $listings,
            "categories" => Category::all(),
            "userId" => $userId,
            "isFollowing" => Auth::check() ? $isFollowing : null,
            "ratingsCount" => $ratingsCount 
        ]);
    }

    public function edit($username) {
        $user = User::where('username', $username)->firstOrFail();
        if($user->id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }

        return view("users.edit", [
            "user" => $user
        ]);
    }

    public function update(Request $request, User $user) {
        if($user->id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }

        $formFields = $request->validate([
            "name" => "required",
            "email" => "nullable|email",
            "description" => "nullable|max:350",
            "phone" => "nullable",
            "lat" => "nullable|numeric",
            "lng" => "nullable|numeric",
        ]);

        if($request->hasFile("photo")) {
            $formFields["photo"] = $request->file("photo")->store("profilepictures", "public");
        }
        
        $user->update($formFields);

        return back()->with("message", "Profil úspešne aktualizovaný");
    }

    public function destroy($id, User $user) {
        if($id != auth()->id()) {
            abort(403, "Unauthorized Action");
        }

        $user = User::where('id', $id)->first();

        $user->delete();

        return redirect("/")->with("message", "Profil bol úspešne odstranený.");
    }

    public function changePassword(Request $request) {
        return view('users.change-password');
    }

    public function changePasswordSave(Request $request) {
        $request->validate([
            'password' => 'required|string',
            'new_password' => 'required|confirmed|min:5|string'
        ]);

        $auth = Auth::user();

        if (!Hash::check($request->get('password'), $auth->password)) {
            return back()->with('error', "Nesprávne heslo.");
        }

        if (strcmp($request->get('password'), $request->new_password) == 0) {
            return redirect()->back()->with("error", "Nové heslo nemôže byť rovnaké ako vaše aktuálne heslo.");
        }

        $user = User::find($auth->id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', "Heslo bolo úspešne zmenené");
    }
}
