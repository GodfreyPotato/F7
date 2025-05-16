<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    //guys dito po ilalagay ung mga function na Login, Logout, Register, forgot password

    


    public function login(Request $request)
    {
   
    }

    // Logout


    // Forgot Password

    public function showForgotPasswordForm()
    {
        return view('auth.forgotPassword');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ?
            back()->with('status', __($status)) :
            back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm($token)
    {
        return view('auth.resetPassword', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET ? redirect()->route('auth.login')->with('status', __($status)) :
            back()->withErrors(['email' => __($status)]);
    }
}
