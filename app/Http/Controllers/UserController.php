<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class UserController extends Controller
{
    //guys dito po ilalagay ung mga function na Login, Logout, Register, forgot password

    // Registration
    public function showRegistrationForm()
    {
        return view('auth.registration');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);

        Users::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('auth.registrationForm')->with('success', 'Registration successful!');
    }

    // Login


    // Logout

    // Forgot Password

}
