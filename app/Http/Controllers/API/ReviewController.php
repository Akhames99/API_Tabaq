<?php

namespace App\Http\Controllers\API;

use App\Models\Review;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Auth;

class ReviewController extends RoutingController
{
    public function index()
    {
        return Review::all();
    }

    public function store(Request $request, $recipeId)
{
    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $user = Auth::user();

    $review = Review::updateOrCreate(
        ['user_id' => $user->id, 'recipe_id' => $recipeId],
        ['rating' => $validated['rating']]
    );

    return response()->json($review, 201);
}

    public function show($id)
    {
        return Review::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->update($request->only('rating'));
        return response()->json($review);
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return response()->json(['message' => 'Review deleted']);
    }

    public function averageRating($id)
    {
        $recipe = Recipe::findOrFail($id);
        $avg = $recipe->reviews()->avg('rating');
        return response()->json(['average_rating' => round($avg, 2)]);
    }
}
