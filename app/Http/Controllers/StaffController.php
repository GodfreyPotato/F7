<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $letters = Letter::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->where('letter_status', 'pending')->paginate(4);
        $log = Log::where('user_id', Auth::id())->whereDay('log_date', now())->orderBy('updated_at', 'desc')->first();
        $reviewedLetters = Letter::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->where('letter_status', '!=', 'pending')->get();

        return view('staff.home', compact('log', 'letters', 'reviewedLetters'));
    }

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);

        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/profile_images');
            $image->move($destinationPath, $filename);

            $user->image_path = 'uploads/profile_images/' . $filename;
        }

        $user->save();

        return redirect()->route('staff.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
