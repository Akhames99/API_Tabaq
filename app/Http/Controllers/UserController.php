<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $fields = $request -> validate([
            'user_id' => 'required',
            'email' => 'required',
            'password_hash' => 'required',
            'name' => 'required'
        ]);

        $user = User::create($fields);
        return $user;

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $fields = $request -> validate([
            'user_id' => 'required',
            'email' => 'required',
            'password_hash' => 'required',
            'name' => 'required'
        ]);

        $user-> update($fields);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user -> delete();

        return ['message' => 'the user is deleted.'];
    }
}
