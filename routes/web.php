<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('rooms', RoomController::class);
    Route::resource('students', StudentController::class);
    Route::resource('payments', PaymentController::class);

    Route::get('/reports/students', [ReportController::class, 'students'])->name('reports.students');
    Route::get('/reports/students/pdf', [ReportController::class, 'studentsPdf'])->name('reports.students.pdf');
    Route::get('/reports/payments', [ReportController::class, 'payments'])->name('reports.payments');
    Route::get('/reports/payments/pdf', [ReportController::class, 'paymentsPdf'])->name('reports.payments.pdf');
    Route::get('/reports/occupancy', [ReportController::class, 'occupancy'])->name('reports.occupancy');


    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});

require __DIR__.'/auth.php';
