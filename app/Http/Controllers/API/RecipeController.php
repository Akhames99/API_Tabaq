<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller;
use App\Models\Recipe;
use App\Models\Ingredient;
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
            'data' => $recipe->load('ingredients')
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

    // Get ingredients for a specific recipe
    public function getIngredients(Recipe $recipe)
    {
        return response()->json($recipe->ingredients);
    }

    // Add ingredients to a recipe
    public function attachIngredients(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric',
        ]);

        $ingredients = collect($validated['ingredients'])->mapWithKeys(function ($item) {
            return [$item['id'] => ['quantity' => $item['quantity']]];
        });

        $recipe->ingredients()->sync($ingredients);
        return response()->json($recipe->load('ingredients'));
    }

    public function updateIngredient(Request $request, Recipe $recipe, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'quantity' => 'required|numeric',
        ]);

        $recipe->ingredients()->updateExistingPivot($ingredient->id, $validated);
        return response()->json($recipe->ingredients()->where('ingredients.id', $ingredient->id)->first());
    }


    public function detachIngredient(Recipe $recipe, Ingredient $ingredient)
    {
        $recipe->ingredients()->detach($ingredient);
        return response()->json(null, 204);
    }

}