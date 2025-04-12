<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\RatingController;

class RatingController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'rated_user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Rating::updateOrCreate(
            ['user_id' => auth()->id(), 'rated_user_id' => $request->rated_user_id],
            ['rating' => $request->rating]
        );

        return back()->with('success', 'Rating submitted successfully!');
    }
}
