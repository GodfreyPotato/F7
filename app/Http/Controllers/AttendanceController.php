<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $employees = User::where('role', 'employee')->get();
        return view('attendance.employee_attendance', compact('employees'));
    }

    public function show(User $user)
    {
        $employees = User::where('role', 'employee')->get();
        
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $attendance = Attendance::where('user_id', $user->id)
        ->whereMonth('date', $currentMonth)
        ->whereYear('date', $currentYear)
        ->get()
        ->keyBy('date');

    return view('attendance.employee_attendance', compact('employees', 'user', 'attendance'));
    }


    public function attendanceLogs(){
        return view('admin.attendanceLogs');
    }
}
