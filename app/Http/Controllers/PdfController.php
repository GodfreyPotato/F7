<?php

namespace App\Http\Controllers;

//needed for loadView

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
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
            ->whereHas('logs', function ($query) {
                $query->where('undertime', '>', 0);
            })
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->with(['logs', 'leaves.letter', 'services'])
            ->get();
        $ins = User::where('role', 'ins')
            ->whereHas('logs', function ($query) {
                $query->where('undertime', '>', 0);
            })
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->with(['logs', 'leaves.letter', 'services'])
            ->get();
        return view('pdf.pdf', compact('ni', 'ins','preview'));
    }

    //shows the pdf file
    public function download()
    {
        $preview = 0;
               $ni = User::where('role',  'ni')
            ->whereHas('logs', function ($query) {
                $query->where('undertime', '>', 0);
            })
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->with(['logs', 'leaves.letter', 'services'])
            ->get();
        $ins = User::where('role', 'ins')
            ->whereHas('logs', function ($query) {
                $query->where('undertime', '>', 0);
            })
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->with(['logs', 'leaves.letter', 'services'])
            ->get();
        $pdf = Pdf::loadView('pdf.pdf', compact('ins','ni', 'preview'));

        return $pdf->stream('document.pdf');
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
    public function show(pdf $pdf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pdf $pdf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pdf $pdf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pdf $pdf)
    {
        //
    }
}
