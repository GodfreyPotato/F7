<?php

namespace App\Http\Controllers;

use App\Models\IsUndertimeGenerated;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $isGenerated = IsUndertimeGenerated::where('generated_date', Carbon::today())
            ->first();

        if (!$isGenerated) {
            $isGenerated = new IsUndertimeGenerated;
            $isGenerated->generated_date = Carbon::today();
            $isGenerated->save();
        }

        return view('admin.home', compact('isGenerated'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editStaff(Request $request, User $user)
    {
        //
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user->firstname = $request->firstname;

        $user->middlename = $request->middlename;

        $user->lastname = $request->lastname;
        $user->save();
        return redirect()->route('staffListing');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function computeAllUndertime()
    {
        $isGenerated = IsUndertimeGenerated::where('generated_date', today())
            ->first();

        if (!$isGenerated) {
            $isGenerated = new IsUndertimeGenerated;
        }

        if ($isGenerated->isGenerated == 0) {
            $isGenerated->generated_date = now();
            $isGenerated->isGenerated = 1;
            $isGenerated->save();

            $users = User::where('role', '!=', 'admin')->get();

            foreach ($users as $user) {
                $userLog = Log::where('log_date', today())
                    ->where('user_id', $user->id)->first();

                //if user timed in umaga or hapon
                if ($userLog) {
                    if ($userLog->status == "present") {
                        if ($userLog->am_in == null && $userLog->am_out == null) {
                            $userLog->undertime += 240;
                        }

                        if ($userLog->pm_in == null && $userLog->pm_out == null) {
                            $userLog->undertime += 240;
                        }
                        $userLog->save();
                    }
                } else {
                    //if user is absent
                    $log = new Log;
                    $log->user_id = $user->id;
                    $log->log_date = now();
                    $log->save();
                }
            }
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('admin.index');
        }
    }
}
