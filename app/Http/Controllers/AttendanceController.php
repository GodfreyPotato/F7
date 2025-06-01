<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Log;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function attendanceLogs()
    {
        $logs = Log::join('users', 'logs.user_id', 'users.id')
            ->whereMonth('log_date', now()->month)
            ->whereYear('log_date', now()->year)
            ->get();

        return view('admin.attendanceLogs', compact('logs'));
    }


    public function filterDate(Request $request)
    {
        $logs = Log::join('users', 'logs.user_id', 'users.id')
            ->where('log_date', $request->filterDate)
            ->get();

        $result = "";

        foreach ($logs as $log) {
            $result .= '   <tr>
                                <td>
                                    ' . $log->firstname . ' ' . $log->lastname . '
                                </td>
                                <td> ' . Carbon::parse($log->log_date)->format('M d, Y') . '</td>
                                <td>' . ($log->am_in ? Carbon::parse($log->am_in)->format('g:i A') : "") . ' </td>
                                <td> ' . ($log->am_out ? Carbon::parse($log->am_out)->format('g:i A') : "") . '</td>
                                <td> ' . ($log->pm_in ? Carbon::parse($log->pm_in)->format('g:i A') : "") . '</td>
                                <td> ' . ($log->pm_out ? Carbon::parse($log->pm_out)->format('g:i A') : "") . '</td>
                                <td>' . ($log->status == "present" ? "Present" : ($log->status == "absent" ? "Absent" : "On Leave")) . '
                                </td>
                            </tr>';
        }

        return response($result);
    }
}
