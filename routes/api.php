<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersModelController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CuisineTypeController;
use App\Http\Controllers\API\RecipeController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Correcting the route capitalization
Route::apiResource('users', UserController::class);

Route::post('/register', [Authcontroller::class, 'register']);
Route::post('/login', [Authcontroller::class, 'login']);
Route::post('/logout', [Authcontroller::class, 'logout'])->middleware('auth:sanctum');

// Categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/categories/{category}/recipes', [CategoryController::class, 'recipesInCategory']);

// Cuisine Types
Route::get('/cuisine_types', [CuisineTypeController::class, 'index']);
Route::get('/cuisine_types/{cuisineType}', [CuisineTypeController::class, 'show']);
// Correct method name
Route::get('/cuisine_types/{cuisineType}/recipes', [CuisineTypeController::class, 'recipesInCuisineType']);

// Recipes
Route::get('/recipes', [RecipeController::class, 'index']);
Route::get('/recipes/filter', [RecipeController::class, 'filterByCategoryAndCuisine']);
Route::get('/recipes/{recipe}', [RecipeController::class, 'show']);