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
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/generateAllUndertime/lock', [AdminController::class, 'computeAllUndertime'])->name('generateAllUndertime');
Route::middleware('auth')->group(function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::middleware('role:admin')->group(function () {
        Route::get('searchLeave/{word?}', [LetterController::class, 'search'])->name('searchLeave');

        Route::get('searchEmployee/{word?}', [UserController::class, 'search'])->name('searchEmployee');
        Route::resource('admin', AdminController::class);
        Route::resource('leave', LeaveController::class);

        Route::resource('letter', LetterController::class)->only(['show', 'create']);
        Route::get('/userListing', [UserController::class, 'index'])->name('staffListing');
        //add edit for stafflisting
        Route::post('/approveLetter/{letter}', [LetterController::class, 'approve'])->name('approveLetter');
        Route::post('/reject/{letter}', [LetterController::class, 'reject'])->name('rejectLetter');
        Route::resource('pdf', PdfController::class);
        Route::get('/pdfDownload/{footer?}', [PdfController::class, 'download'])->name('pdfDownload');
        Route::post('/addSaturdayService', [ServiceController::class, "store"])->name('addSaturday');
        Route::get('/attendanceLogs', [AttendanceController::class, 'attendanceLogs'])->name('attendanceLogs');
        Route::get('/filterPDF/{month?}/{year?}', [PdfController::class, "filterPDF"]);
        Route::get('/filterDate', [AttendanceController::class, "filterDate"]);
        Route::post('/editStaff/{user}', [AdminController::class, "editStaff"])->name('editStaff');
    });


    Route::middleware('role:ins,ni')->group(function () {
        Route::resource('staff', StaffController::class);
        Route::get('/users', [StaffController::class, 'logs'])->name('showLogs');

        //time in / out
        Route::post('/timeInAm', [LogController::class, 'timeInAm'])->name('timeInAm');
        Route::post('/timeOutAm', [LogController::class, 'timeOutAm'])->name('timeOutAm');
        Route::post('/timeInPm', [LogController::class, 'timeInPm'])->name('timeInPm');
        Route::post('/timeOutPm', [LogController::class, 'timeOutPm'])->name('timeOutPm');
        Route::get('/users', [LogController::class, 'logs'])->name('showLogs');

        Route::put('/editProfile/{id}', [StaffController::class, 'update'])->name('editProfile');

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

    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::resource('/registration', RegistrationController::class);
    Route::get('/login', [LoginController::class, "index"])->name('login');
});
