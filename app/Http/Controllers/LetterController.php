<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('staff.applyLeave');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $letters = Letter::join('users', 'users.id', 'letters.user_id')
            ->select('*', 'letters.updated_at as date', 'letters.id as id', 'users.id as user_id')
            ->where('letter_status', '=', 'pending')
            ->get();
        return view('admin.leaveRequests', compact('letters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'cause' => 'required|string',
            'file_path' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $letter = new Letter;
        $letter->user_id = Auth::id();
        $letter->start_date = $request->start_date;
        $letter->end_date = $request->end_date;
        $letter->cause = $request->cause;

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filepath = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('form6'), $filepath);
            $letter->file_path = $filepath;
        }

        $letter->save();

        return redirect()->route('staff.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Letter $letter)
    {
        //
        $letter = Letter::join('users', 'users.id', 'letters.user_id')
            ->where('letters.id', $letter->id)
            ->select('*', 'letters.updated_at as date', 'letters.id as id')
            ->first();
        return view('admin.reviewRequest', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Letter $letter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Letter $letter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Letter $letter)
    {
        //
    }


    public function reject(Letter $letter)
    {
        $letter->letter_status = "rejected";
        $letter->save();
        return redirect()->route('letter.create');
    }

    public function approve(Request $request, Letter $letter)
    {
        $validator = Validator::make($request->all(), [
            'action_taken' => 'required',
            'cause_by_admin' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $letter->letter_status = "approved";

        $letter->save();

        $leave = new Leave;
        $leave->user_id = $letter->user_id;
        $leave->letter_id = $letter->id;
        $leave->action_taken = $request->action_taken;
        $leave->cause_by_admin = $request->cause_by_admin;
        $leave->with_f6 = $letter->file_path;
        $leave->save();
        return redirect()->route('letter.create');
    }
}
