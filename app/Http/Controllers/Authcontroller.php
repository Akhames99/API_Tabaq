<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController; // Make sure this import is here

class Authcontroller extends BaseController
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'phone_number' => 'required|string|unique:users',
            'password' => 'required|confirmed'
        ]);
    
        $user = User::create([
            'name' => $fields['name'],
            'phone_number' => $fields['phone_number'],
            'password_hash' => bcrypt($fields['password']) // <<-- Hash here
        ]);
    
        $token = $user->createToken($request->name);
    
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }
    

    
    public function login(Request $request) {

        $request -> validate([
            'phone_number' => 'required|string|exists:users',
            'password' => 'required'
        ]);


        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user || !Hash::check($request->password , $user->password_hash)) {
            return [
                'message' => 'the user is not found.'
            ];
        }

        $token = $user->createToken($user->name);

        return[
            'user' => $user,
            'token' => $token->plainTextToken
        ];

    }
    

    public function logout(Request $request) {

        $request->user()->tokens()->delete();

        return [
            'message' => 'you are logged out'
        ];

    }
}