<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\FavoriteCollection;
use App\Models\Favorite;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as RoutingController;

class FavoriteController extends RoutingController
{
    /**
     * Get all favorites for the authenticated user.
     */
    public function index(): JsonResponse
    {
        $favorites = Favorite::with(['recipe'])
            ->where('user_id', Auth::id())
            ->paginate(10);
            
        return response()->json([
            'success' => true,
            'data' => new FavoriteCollection($favorites),
        ]);
    }

    /**
     * Store a newly created favorite in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
        ]);

        // Check if favorite already exists
        $existingFavorite = Favorite::where('user_id', Auth::id())
            ->where('recipe_id', $request->recipe_id)
            ->first();

        if ($existingFavorite) {
            return response()->json([
                'success' => false,
                'message' => 'Recipe already in favorites',
            ], 422);
        }

        $favorite = Favorite::create([
            'user_id' => Auth::id(),
            'recipe_id' => $request->recipe_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Recipe added to favorites',
            'data' => new FavoriteResource($favorite),
        ], 201);
    }

    /**
     * Check if a recipe is favorited by the authenticated user.
     */
    public function check($recipeId): JsonResponse
    {
        $isFavorited = Favorite::where('user_id', Auth::id())
            ->where('recipe_id', $recipeId)
            ->exists();

        return response()->json([
            'success' => true,
            'is_favorited' => $isFavorited,
        ]);
    }

    /**
     * Remove the specified favorite from storage.
     */
    public function destroy($recipeId): JsonResponse
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('recipe_id', $recipeId)
            ->first();

        if (!$favorite) {
            return response()->json([
                'success' => false,
                'message' => 'Favorite not found',
            ], 404);
        }

        $favorite->delete();

        return response()->json([
            'success' => true,
            'message' => 'Recipe removed from favorites',
        ]);
    }
}