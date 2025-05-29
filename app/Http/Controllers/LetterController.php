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

        $letters = Letter::join('users', 'users.id', 'letters.user_id')
            ->select('*', 'letters.updated_at as date', 'letters.id as id', 'users.id as user_id')
            ->where('letter_status', '=', 'pending')
            ->simplePaginate(4);

        return view('admin.leaveRequests', compact('letters'));
    }
    public function search(String $word = '')
    {
        $letters = [];
        if (strlen($word) > 0) {
            $letters = Letter::join('users', 'users.id', 'letters.user_id')
                ->select('*', 'letters.updated_at as date', 'letters.id as id', 'users.id as user_id')
                ->where('letter_status', '=', 'pending')
                ->where(function ($query) use ($word) {
                    $query->where('cause', 'like', "%{$word}%")
                        ->orWhere('firstname', 'like', "%{$word}%")
                        ->orWhere('lastname', 'like', "%{$word}%")
                        ->orWhere('middlename', 'like', "%{$word}%");
                })
                ->simplePaginate(4);
        } else {
            $letters = Letter::join('users', 'users.id', 'letters.user_id')
                ->select('*', 'letters.updated_at as date', 'letters.id as id', 'users.id as user_id')
                ->where('letter_status', '=', 'pending')
                ->simplePaginate(4);
        }

        $result = "";
        foreach ($letters as $letter) {
            $name = ucfirst($letter->firstname) . ' ' . strtoupper(substr($letter->middlename, 0, 1)) . '. ' . ucfirst($letter->lastname);
            $date = \Carbon\Carbon::parse($letter->date)->format('M d, Y');
            $time = \Carbon\Carbon::parse($letter->date)->format('g:i A');
            $url = route('letter.show', ['letter' => $letter->id]);

            $result .= '
            <div class="p-4 d-flex justify-content-between align-items-center mt-3"
                style="box-shadow: 0px 0px 4.2px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <div class="d-flex flex-column">
                    <p class="fw-bold mb-0" style="font-size: 18px;">' . $name . '</p>
                    <p class="fw-semibold mb-0" style="font-size: 16px; color: #7B7878;">' . $date . '
                        <span class="ms-2" style="font-size: 16px; color: #7B7878;">' . $time . '</span>
                    </p>
                </div>
                <a href="' . $url . '" class="btn d-flex justify-content-center align-items-center"
                    style="background-color: #1D4ED8; color: white; width: 10vw;">
                    Review
                </a>
            </div>';
        }

        return response($result);
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
