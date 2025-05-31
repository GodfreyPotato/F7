<?php

namespace App\Http\Controllers;

//needed for loadView

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $preview = 1;
        $ni = User::where('role',  'ni')
            ->whereHas('logs', function ($q) {
                $q->where(function ($u) {
                    $u->where('undertime', '>', '0')
                        ->orWhere('status', 'absent');
                })
                    ->whereMonth('log_date', today()->month)
                    ->whereYear('log_date', today()->year);
            })
            ->orWhereHas('leaves.letter', function ($q) {
                $q->whereMonth('start_date', today()->month)
                    ->whereYear('start_date', today()->year);
            })
            ->with(['logs', 'leaves.letter'])->get();

        $ins = User::where('role',  'ins')
            ->whereHas('logs', function ($q) {
                $q->where(function ($u) {
                    $u->where('undertime', '>', '0')
                        ->orWhere('status', 'absent');
                })
                    ->whereMonth('log_date', today()->month)
                    ->whereYear('log_date', today()->year);
            })
            ->orWhereHas('leaves.letter', function ($q) {
                $q->whereMonth('start_date', today()->month)
                    ->whereYear('start_date', today()->year);
            })
            ->with(['logs', 'leaves.letter'])->get();


        return view('pdf.pdf', compact('ni', 'ins', 'preview'));
    }

    //shows the pdf file
    public function download()
    {
        $preview = 0;
        $ni = User::where('role',  'ni')
            ->whereHas('logs', function ($q) {
                $q->where(function ($u) {
                    $u->where('undertime', '>', '0')
                        ->orWhere('status', 'absent');
                })
                    ->whereMonth('log_date', today()->month)
                    ->whereYear('log_date', today()->year);
            })
            ->orWhereHas('leaves.letter', function ($q) {
                $q->whereMonth('start_date', today()->month)
                    ->whereYear('start_date', today()->year);
            })
            ->with(['logs', 'leaves.letter'])->get();

        $ins = User::where('role',  'ins')
            ->whereHas('logs', function ($q) {
                $q->where(function ($u) {
                    $u->where('undertime', '>', '0')
                        ->orWhere('status', 'absent');
                })
                    ->whereMonth('log_date', today()->month)
                    ->whereYear('log_date', today()->year);
            })
            ->orWhereHas('leaves.letter', function ($q) {
                $q->whereMonth('start_date', today()->month)
                    ->whereYear('start_date', today()->year);
            })
            ->with(['logs', 'leaves.letter'])->get();
        $pdf = Pdf::loadView('pdf.pdf', compact('ins', 'ni', 'preview'));

        return $pdf->stream('document.pdf');
    }

    public function filterPDF(?int $month, ?int $year)
    {
        $month = $month ?? Carbon::now()->month;
        $year = $year ?? Carbon::now()->year;
        function convertMinutesToHoursMins($minutes)
        {
            $hours = floor($minutes / 60);
            $mins = $minutes % 60;

            $result = '';
            if ($hours > 0) {
                $result .= $hours . ' hr' . ($hours > 1 ? 's' : '');
            }

            if ($mins > 0) {
                if ($result != '') {
                    $result .= ' and ';
                }
                $result .= $mins . ' min' . ($mins > 1 ? 's' : '');
            }

            return $result;
        }


        // $request->month = $request->query('month', now()->month);
        // $request->year = $request->query('year', now()->year);


        $ni = User::where('role',  'ni')
            ->whereHas('logs', function ($q) use ($month, $year) {
                $q->where(function ($u) {
                    $u->where('undertime', '>', '0')
                        ->orWhere('status', 'absent');
                })
                    ->whereMonth('log_date', $month)
                    ->whereYear('log_date', $year);
            })
            ->orWhereHas('leaves.letter', function ($q) use ($month, $year) {
                $q->whereMonth('start_date', $month)
                    ->whereYear('start_date', $year);
            })
            ->with(['logs', 'leaves.letter'])->get();

        $ins = User::where('role',  'ins')
            ->whereHas('logs', function ($q) use ($month, $year) {
                $q->where(function ($u) {
                    $u->where('undertime', '>', '0')
                        ->orWhere('status', 'absent');
                })
                    ->whereMonth('log_date', $month)
                    ->whereYear('log_date', $year);
            })
            ->orWhereHas('leaves.letter', function ($q) use ($month, $year) {
                $q->whereMonth('start_date', $month)
                    ->whereYear('start_date', $year);
            })
            ->with(['logs', 'leaves.letter'])->get();

        $html = "";


        $ctr = 1;

        foreach ($ni as $user) {
            $name = $user->lastname . ', ' . $user->firstname;
            $undertime =  convertMinutesToHoursMins($user->logs->whereBetween('created_at', [
                now()->setMonth($month)->startOfMonth(),
                now()->setMonth($month)->endOfMonth()
            ])->sum('undertime'));


            $leaveDates = [];
            foreach ($user->leaves as $leave) {
                if ($leave->letter) { //Check if letter is not null

                    $start = Carbon::parse($leave->letter->start_date);
                    $end = Carbon::parse($leave->letter->end_date);

                    if ($start->isSameMonth(Carbon::create($year, $month))) {
                        if ($start->equalTo($end)) {
                            $leaveDates[] = $start->format('j');
                        } else {
                            $leaveDates[] = $start->format('j') . '–' . $end->format('j');
                        }
                    }
                }
            }

            //updating
            foreach ($user->logs as $log) {
                if ($log->status == "absent") {
                    $start = Carbon::parse($log->log_date);
                    $end = Carbon::parse($log->log_date);

                    if ($start->isSameMonth(Carbon::create($year, $month))) {
                        if ($start->equalTo($end)) {
                            $leaveDates[] = $start->format('j');
                        } else {
                            $leaveDates[] = $start->format('j') . '–' . $end->format('j');
                        }
                    }
                }
            }
            sort($leaveDates);
            $formattedLeaveString = implode(';', $leaveDates);

            $actionTaken = [];

            foreach ($user->leaves as $leave) {
                if (
                    Carbon::parse($leave->letter->start_date)->month == $month &&
                    Carbon::parse($leave->letter->start_date)->year == $year
                ) {
                    $actionTaken[] = $leave->action_taken;
                }
            }

            $cause = [];
            foreach ($user->leaves as $leave) {
                if (
                    Carbon::parse($leave->letter->start_date)->month == $month &&
                    Carbon::parse($leave->letter->start_date)->year == $year
                ) {
                    $cause[] = $leave->cause_by_admin;
                }
            }

            $withF6 = [];
            foreach ($user->leaves as $leave) {
                if (
                    Carbon::parse($leave->letter->start_date)->month == $month &&
                    Carbon::parse($leave->letter->start_date)->year == $year
                ) {
                    $withF6[] = $leave->with_f6 ? 'w/ F6' : 'w/o F6';
                }
            }

            $html .=
                '<tr>
                <td style="padding: 10px;">' . $ctr . '</td>
                <td style="text-align: start;">' . $name . '</td>
                <td style="text-align: start;">
                ' . $undertime . '
                </td>
                <td style="text-align: start;">
                ' . ($formattedLeaveString ? Carbon::create($year, $month)->format('M') . " " . $formattedLeaveString . ', ' . Carbon::create($year, $month)->year : '') . '
                </td>
                <td>
                    ' . implode('/', $actionTaken) . '
                </td>
                <td>
                ' . implode('/', $cause) . '
                </td>
                <td>
                
                </td>
                <td>
                        ' . implode(',', $withF6) . '
                </td>

            </tr>';
            $ctr++;
        }




        $html .=      '        <tr>
            <td colspan="9" style="padding: 20px; text-align: start;"><b>INSTRUCTIONAL STAFF</b></td>
        </tr>
';
        foreach ($ins as $user) {
            $name = $user->lastname . ', ' . $user->firstname;
            $undertime =  convertMinutesToHoursMins($user->logs->whereBetween('created_at', [
                now()->setMonth($month)->startOfMonth(),
                now()->setMonth($month)->endOfMonth()
            ])->sum('undertime'));


            $leaveDates = [];
            foreach ($user->leaves as $leave) {
                if ($leave->letter) { //Check if letter is not null

                    $start = Carbon::parse($leave->letter->start_date);
                    $end = Carbon::parse($leave->letter->end_date);

                    if ($start->isSameMonth(Carbon::create($year, $month))) {
                        if ($start->equalTo($end)) {
                            $leaveDates[] = $start->format('j');
                        } else {
                            $leaveDates[] = $start->format('j') . '–' . $end->format('j');
                        }
                    }
                }
            }

            //updating
            foreach ($user->logs as $log) {
                if ($log->status == "absent") {
                    $start = Carbon::parse($log->log_date);
                    $end = Carbon::parse($log->log_date);

                    if ($start->isSameMonth(Carbon::create($year, $month))) {
                        if ($start->equalTo($end)) {
                            $leaveDates[] = $start->format('j');
                        } else {
                            $leaveDates[] = $start->format('j') . '–' . $end->format('j');
                        }
                    }
                }
            }
            sort($leaveDates);
            $formattedLeaveString = implode(';', $leaveDates);

            $actionTaken = [];

            foreach ($user->leaves as $leave) {
                if (
                    Carbon::parse($leave->letter->start_date)->month == $month &&
                    Carbon::parse($leave->letter->start_date)->year == $year
                ) {
                    $actionTaken[] = $leave->action_taken;
                }
            }

            $cause = [];
            foreach ($user->leaves as $leave) {
                if (
                    Carbon::parse($leave->letter->start_date)->month == $month &&
                    Carbon::parse($leave->letter->start_date)->year == $year
                ) {
                    $cause[] = $leave->cause_by_admin;
                }
            }

            $withF6 = [];
            foreach ($user->leaves as $leave) {
                if (
                    Carbon::parse($leave->letter->start_date)->month == $month &&
                    Carbon::parse($leave->letter->start_date)->year == $year
                ) {
                    $withF6[] = $leave->with_f6 ? 'w/ F6' : 'w/o F6';
                }
            }

            $html .=
                '<tr>
                <td style="padding: 10px;">' . $ctr . '</td>
                <td style="text-align: start;">' . $name . '</td>
                <td style="text-align: start;">
                ' . $undertime . '
                </td>
                <td style="text-align: start;">
                ' . ($formattedLeaveString ? Carbon::create($year, $month)->format('M') . " " . $formattedLeaveString . ', ' . Carbon::create($year, $month)->year : '') . '
                </td>
                <td>
                    ' . implode('/', $actionTaken) . '
                </td>
                <td>
                ' . implode('/', $cause) . '
                </td>
                <td>
                
                </td>
                <td>
                        ' . implode(',', $withF6) . '
                </td>

            </tr>';
            $ctr++;
        }


        return response($html);
    }
}
