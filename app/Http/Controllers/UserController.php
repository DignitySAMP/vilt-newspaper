<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with(['roles', 'newsletter'])->select('id', 'name', 'email');

        if ($request->has('search') && !empty(trim($request->get('search')))) {
            $search = trim($request->get('search'));
            $query->where('email', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        }
        $users = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        return Inertia::render('users/Index', [
            'users' => $users,
            'search' => [
                'term' => $request->get('search'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('users/Create', [
            'roles' => Role::select(['id', 'name'])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|min:4|max:32',
            'email' => 'required|email|max:64|unique:users,email',
            'password' => 'nullable|min:6|max:64|confirmed',
            'roles' => 'nullable|array',
            'roles.*.name' => 'string|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password'])
        ]);

        $user->syncRoles($validate['roles'] ?? []);
        
        return redirect()->route('users.index')->with('message', 'User has been updated.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('roles');
        return Inertia::render('users/Edit', [
            'user' => $user,
            'roles' => Role::select(['id', 'name'])->get()
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
            'roles.*.name' => 'string|exists:roles,name',
        ]);

        $user->update([
            'name' => $validate['name'],
            'email' => $validate['email'],
        ]);

        $user->syncRoles($validate['roles'] ?? []);

        if (!empty($validate['password'])) {
            $user->password = Hash::make($validate['password']);
            $user->save();
        }
        
        return redirect()->route('users.index')->with('message', 'User has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        $validate = $request->validate(['email' => 'required|email']);
        if($validate['email'] != $user->email) {
            return back()->withErrors(['email' => 'Confirmation does not match the email.']);
        }

        $user->delete();

        return redirect()->route('users.index')->with('message', 'User has been deleted.');
    }
}
