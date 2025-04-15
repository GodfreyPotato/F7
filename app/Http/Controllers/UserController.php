<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserRegistration;

class UserController extends Controller
{
    //guys dito po ilalagay ung mga function na Login, Logout, Register, forgot password

    // Registration
    public function showRegistrationForm(){
        return view('auth.registration');
    }

    public function register(Request $request){
        $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|unique:user_registrations,email',
        'password'  => 'required|min:6|confirmed',
        ]);

        UserRegistration::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('auth.registrationForm')->with('success', 'Registration successful!');
    }

    // Login


    // Logout

    // Forgot Password

}
