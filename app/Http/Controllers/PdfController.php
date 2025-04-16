<?php

namespace App\Http\Controllers;

//needed for loadView
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('pdf.pdf');
    }

    public function download()
    {
        $pdf = Pdf::loadView('pdf.pdf');
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
