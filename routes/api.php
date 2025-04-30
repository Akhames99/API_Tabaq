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
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PaymentController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Correcting the route capitalization
Route::apiResource('users', UserController::class);

//Registration,Login and Logout
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
Route::get('/cuisine_types/{cuisineType}/recipes', [CuisineTypeController::class, 'recipesInCuisineType']);

// Recipes
Route::get('/recipes', [RecipeController::class, 'index']);
Route::get('/recipes/filter', [RecipeController::class, 'filterByCategoryAndCuisine']);
Route::get('/recipes/{recipe}', [RecipeController::class, 'show']);

Route::get('/recipes/{recipe}/ingredients', [RecipeController::class, 'getIngredients']);
Route::post('/recipes/{recipe}/ingredients', [RecipeController::class, 'attachIngredients']);
Route::put('/recipes/{recipe}/ingredients/{ingredient}', [RecipeController::class, 'updateIngredient']);
Route::delete('/recipes/{recipe}/ingredients/{ingredient}', [RecipeController::class, 'detachIngredient']);

//Reviews
Route::post('/recipes/{recipe}/reviews', [ReviewController::class, 'store'])->middleware('auth:sanctum');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/recipes/{recipe}/average_rating', [ReviewController::class, 'averageRating']);

// Orders
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth:sanctum');
Route::post('/orders', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware('auth:sanctum');
Route::put('/orders/{order}', [OrderController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->middleware('auth:sanctum');

// Payments
Route::get('/payments', [PaymentController::class, 'index'])->middleware('auth:sanctum');
Route::post('/payments', [PaymentController::class, 'store'])->middleware('auth:sanctum');
Route::get('/payments/{payment}', [PaymentController::class, 'show'])->middleware('auth:sanctum');
Route::put('/payments/{payment}', [PaymentController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/payments/users/{user}', [PaymentController::class, 'getPaymentsByUser'])->middleware('auth:sanctum');