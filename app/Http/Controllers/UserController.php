<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('users/Index', [
            'users' => User::with(['roles'])->select('id', 'name', 'email')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('users/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('roles');
        return Inertia::render('users/Edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'name' => 'required|string|min:4|max:32',
            'email' => [
                'required',
                'email',
                'max:64',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|min:6|max:64|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $user->update([
            'name' => $validate['name'],
            'email' => $validate['email'],
        ]);

        if (!empty($validate['password'])) {
            $user->password = Hash::make($validate['password']);
        }

        if (!empty($validate['roles'])) {
            $user->syncRoles($validate['roles']);
        }

        $user->save();
        
        return redirect()->route('users.index')->with('message', 'User has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
