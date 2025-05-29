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

    public function index()
    {
        $users = User::where('role', '!=', 'admin')
            ->orderBy('lastname')
            ->simplePaginate(8);
        return view('admin.staffListing', compact('users'));
    }
    public function search(String $word = '')
    {
        $users = [];
        if (strlen($word) > 0) {
            $users = User::where('role', '!=', 'admin')
                ->orderBy('lastname')
                ->whereLike('lastname', "%{$word}%")
                ->orWhereLike('firstname', "%{$word}%")
                ->orWhereLike('middlename', "%{$word}%")
                ->orWhereLike('department', "%{$word}%")
                ->simplePaginate(8);
        } else {
            $users = User::where('role', '!=', 'admin')
                ->orderBy('lastname')
                ->simplePaginate(8);
        }
        $result = "";
        foreach ($users as $user) {
            $name = ucfirst($user->lastname) . ', ' . ucfirst($user->firstname) . ' ' . ucfirst(substr($user->middlename, 0, 1)) . '.';
            $email = $user->email;

            // Department name switch
            $code = $user->department;
            switch ($code) {
                case 'BSIT':
                    $dept = 'BS Information Technology';
                    break;
                case 'BSMATH':
                    $dept = 'BS Mathematics';
                    break;
                case 'BSCE':
                    $dept = 'BS Civil Engineering';
                    break;
                case 'BSED':
                case 'BSE':
                    $dept = 'BS Education';
                    break;
                case 'BSCoE':
                    $dept = 'BS Computer Engineering';
                    break;
                case 'BSME':
                    $dept = 'BS Mechanical Engineering';
                    break;
                case 'BSA':
                    $dept = 'BS Architecture';
                    break;
                case 'BSECE':
                    $dept = 'BS Early Childhood Education';
                    break;
                case 'ABEL':
                    $dept = 'AB English Language';
                    break;
                case 'NI':
                    $dept = 'Non Instructional';
                    break;
                case 'BSEE':
                    $dept = 'BS Electrical Engineering';
                    break;
                default:
                    $dept = 'Unknown Course Code';
                    break;
            }

            $role = $user->role === "ins" ? "Instructional" : "Non Instructional";
            $editIcon = asset('images/edit.png'); // Only works if called from Blade view, otherwise hardcode or use full URL

            $result .= '
        <tr>
            <td>' . $name . '</td>
            <td>' . $email . '</td>
            <td>' . $dept . '</td>
            <td>' . $role . '</td>
            <td class="d-flex justify-content-center">
                <a href="" class="me-3">
                    <img src="' . $editIcon . '" alt="View Schedule">
                </a>
            </td>
        </tr>';
        }



        return response($result);
    }

    public function login(Request $request) {}

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

    //add edit functionality
}
