<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as RoutingController;

class RecipeController extends RoutingController
{

    public function index(): JsonResponse
    {
        $recipes = Recipe::with(['categories', 'cuisineType'])->get();
        return response()->json([
            'success' => true,
            'data' => $recipes
        ]);
    }


    public function show(Recipe $recipe): JsonResponse
    {
        $recipe->load(['categories', 'cuisineType']);
        return response()->json([
            'success' => true,
            'data' => $recipe
        ]);
    }



    public function filterByCategoryAndCuisine(Request $request): JsonResponse
    {
        $query = Recipe::query();

        if ($request->has('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        if ($request->has('cuisine_type_id')) {
            $query->where('cuisine_type_id', $request->cuisine_type_id);
        }

        $recipes = $query->with(['categories', 'cuisineType'])->get();

        if ($recipes->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No recipes found with the given filters.',
                'suggestion' => 'Check if the category_id and cuisine_type_id exist.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $recipes
        ]);

    }
}