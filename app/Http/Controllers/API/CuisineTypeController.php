<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller as APIController;
use App\Http\Controllers\Controller;
use App\Models\Cuisine_Type;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as RoutingController;

class CuisineTypeController extends RoutingController
{
    public function index(): JsonResponse
    {
        $cuisineTypes = Cuisine_Type::all();
        return response()->json([
            'success' => true,
            'data' => $cuisineTypes
        ]);
    }

    public function show(Cuisine_Type $cuisineType): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $cuisineType
        ]);
    }

    public function recipesInCuisineType(Cuisine_Type $cuisineType): JsonResponse
    {
        $recipes = $cuisineType->recipes()->with('categories')->get();
        return response()->json([
            'success' => true,
            'data' => $recipes
        ]);
    }
}