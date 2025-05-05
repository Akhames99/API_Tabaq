<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'phone_number' => 'required|string|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'phone_number' => $fields['phone_number'],
            'password_hash' => bcrypt($fields['password'])
        ]);

        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        // Check if authenticated user is viewing their own profile
        if ($request->user()->id !== $user->id) {
            return response()->json([
                'message' => 'Unauthorized to view this user'
            ], 403);
        }

        // Create a new token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $fields = $request->validate([
            'name' => 'sometimes|max:255',
            'phone_number' => 'sometimes|string|unique:users,phone_number,' . $user->id,
        ]);

        // Update the user with validated fields
        $user->update($fields);

        // Handle password update separately if provided
        if ($request->has('password') && $request->filled('password')) {
            $request->validate([
                'password' => 'required|confirmed'
            ]);

            $user->password_hash = bcrypt($request->password);
            $user->save();
        }

        return [
            'message' => 'User updated successfully',
            'user' => $user
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete user's tokens first to avoid foreign key constraint issues
        $user->tokens()->delete();

        // Then delete the user
        $user->delete();

        return ['message' => 'User deleted successfully'];
    }
}
