<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StaffController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::middleware('auth')->group(function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::middleware('role:admin')->group(function () {
        Route::resource('admin', AdminController::class);
        Route::get('/generateAllUndertime', [AdminController::class, 'computeAllUndertime'])->name('generateAllUndertime');
        Route::resource('leave', LeaveController::class);

        Route::resource('letter', LetterController::class)->only(['show', 'create']);
        Route::get('/userListing', [UserController::class, 'index'])->name('staffListing');
        Route::post('/approveLetter/{letter}', [LetterController::class, 'approve'])->name('approveLetter');
        Route::post('/reject/{letter}', [LetterController::class, 'reject'])->name('rejectLetter');
    });


    Route::middleware('role:ins,ni')->group(function () {
        //testing 
        // Route::get('/pdfPreview', [PdfController::class, 'index'])->name('pdfPreview');
        // Route::get('/pdfDownload', [PdfController::class, 'download'])->name('pdfDownload');
        // Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');

        // Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::resource('staff', StaffController::class);
        Route::get('/users', [StaffController::class, 'logs'])->name('showLogs');

        //time in / out
        Route::post('/timeInAm', [LogController::class, 'timeInAm'])->name('timeInAm');
        Route::post('/timeOutAm', [LogController::class, 'timeOutAm'])->name('timeOutAm');
        Route::post('/timeInPm', [LogController::class, 'timeInPm'])->name('timeInPm');
        Route::post('/timeOutPm', [LogController::class, 'timeOutPm'])->name('timeOutPm');
        Route::get('/users', [LogController::class, 'logs'])->name('showLogs');


        // Attendance routes
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('/attendance/{user}', [AttendanceController::class, 'show'])->name('attendance.show');

        Route::resource('letter', LetterController::class)->only(['store', 'index']);
    });
});
// Add these routes with the existing ones




Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])
        ->name('password.request');

    Route::post('/forgot-password', [UserController::class, 'forgotPassword'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [UserController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [UserController::class, 'resetPassword'])
        ->name('password.update');


    Route::resource('/login', LoginController::class);
    Route::resource('/registration', RegistrationController::class);
});
