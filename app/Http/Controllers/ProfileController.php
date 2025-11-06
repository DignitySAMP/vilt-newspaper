<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index() {
        return Inertia::render( 'profile/Index', [
            'mfa_enabled' => Auth::user()->two_factor_confirmed_at !== null
        ]);
    }

    public function edit_details(Request $request) {
        $user = Auth::user();

        $validate = $request->validate([
            'name' => 'required|string|min:4|max:32',
            'email' => [
                'required',
                'email',
                'max:64',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update([
            'name' => $validate['name'],
            'email' => $validate['email']
        ]);

        return redirect()->back()->with('message', 'You have successfully updated your details.');
    }

    public function edit_password(Request $request) {
        $validate = $request->validate([
            'password' => 'required|min:6|max:64|confirmed'
        ]);

        Auth::user()->update([
            'password' => Hash::make($validate['password'])
        ]);


        return redirect()->back()->with('message', 'You have successfully updated your password.');
    }
}
