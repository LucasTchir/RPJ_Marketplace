<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow($name) {
        $user = User::where('name', $name)->firstOrFail();
        
        auth()->user()->following()->create([
            'followed_id' => $user->id,
        ]);

        Notification::create([
            'user_id' => auth()->id(),
            'description' => 'vás začal sledovať.'
        ]);

        return back()->with("message", "Sledujete použivateľa!");
    }

    public function unfollow($name) {
        $user = User::where('name', $name)->firstOrFail();

        auth()->user()->following()->where('followed_id', $user->id)->delete();

        return back()->with("message", "Prestali ste sledovať použivateľa!");
    }
}
