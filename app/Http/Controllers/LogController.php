<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Log $log)
    {
        //
    }

    //TIME IN / OUT
    public function timeInAm()
    {

        $log = new Log;
        $log->user_id = Auth::id();
        $log->log_date = now();
        $log->status = "present";
        $log->am_in = now();
        $log->save();
        return redirect()->route('staff.index');
    }
    public function timeOutAm()
    {
        $log =  Log::where('user_id', Auth::id())
            ->where('log_date', today())
            ->first();

        //protect the button 
        if ($log == null || $log->am_in == null) {
            return back();
        }

        $log->am_out = now();
        $log->save();
        return redirect()->route('staff.index');
    }

    //PM logs
    public function timeInPm()
    {
        $log = Log::where('user_id', Auth::id())
            ->where('log_date', today())
            ->first();

        if ($log) {
            $log->pm_in = now();
            $log->save();
            return redirect()->route('staff.index');
        }

        //if absent morning
        $log = new Log;
        $log->status = "present";
        $log->log_date = now();
        $log->user_id = Auth::id();
        $log->pm_in = now();
        $log->save();
        return redirect()->route('staff.index');
    }

    public function timeOutPm()
    {
        $log = Log::where('user_id', Auth::id())
            ->where('log_date', today())
            ->first();

        //protect the button 
        if ($log == null || $log->pm_in == null) {
            return back();
        }


        $log->pm_out = now();
        $log->save();


        //if pumasok earlier than 8 am
        if (Carbon::parse($log->am_in)->hour < 8) {
        }

        return redirect()->route('staff.index');
    }
}
