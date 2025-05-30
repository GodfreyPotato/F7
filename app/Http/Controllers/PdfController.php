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

  public function filterPDF(Request $request)
{
    $month = $request->query('month', now()->month);
    $year = $request->query('year', now()->year);

    $ni = User::where('role',  'ni')
        ->whereHas('logs', function ($query) {
            $query->where('undertime', '>', 0);
        })
         ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
        ->with(['logs', 'leaves.letter', 'services'])
        ->get();

    $ins = User::where('role', 'ins')
        ->whereHas('logs', function ($query) {
            $query->where('undertime', '>', 0);
        })  
        ->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->with(['logs', 'leaves.letter', 'services'])
        ->get();

    $html = view('partials.table_rows', compact('ni', 'ins', 'month', 'year'))->render();

    return response()->json(['html' => $html]);
}
}
