<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $letters = Letter::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get();
        $log = Log::where('user_id', Auth::id())
            ->whereDay('log_date', today())
            ->orderBy('updated_at', 'desc')
            ->first();
        return view('staff.home', compact('log', 'letters'));
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
    public function edit(string $id)
    {
        //
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
}
