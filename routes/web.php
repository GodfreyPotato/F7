<?php

use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('auth.registrationForm');
Route::post('/register', [UserController::class, 'register'])->name('auth.register');


//testing 
Route::get('pdfPreview', [PdfController::class, 'index'])->name('pdfPreview');
Route::get('pdfDownload', [PdfController::class, 'download'])->name('pdfDownload');
