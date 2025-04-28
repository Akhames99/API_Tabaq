<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as RoutingController;

class CategoryController extends RoutingController
{
    public function index(): JsonResponse
    {
        $categories = Category::all();
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function recipesInCategory(Category $category): JsonResponse
    {
        $recipes = $category->recipes()->with('cuisineType')->get();
        return response()->json([
            'success' => true,
            'data' => $recipes
        ]);
    }
}