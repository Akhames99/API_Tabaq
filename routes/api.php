<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersModelController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

route::apiResource('users', UserController::class);

route::post('/register', [Authcontroller::class, 'register']);
route::post('/login', [Authcontroller::class, 'login']);
route::post('/logout', [Authcontroller::class, 'logout'])->middleware('auth:sanctum');