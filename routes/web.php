<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsApprover;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingApprovalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DriverController;


Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
});


Route::middleware(['auth', IsApprover::class])->group(function () {
    Route::get('/approvals', [BookingApprovalController::class, 'index'])->name('approvals.index');
    Route::get('/approvals/history', [BookingApprovalController::class, 'history'])->name('booking-approvals.history');
    Route::post('/booking-approvals/{approval}/approve', [BookingApprovalController::class, 'approve'])->name('booking-approvals.approve');
    Route::post('/booking-approvals/{approval}/reject', [BookingApprovalController::class, 'reject'])->name('booking-approvals.reject');
});




Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::resource('bookings', BookingController::class);
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::resource('vehicles', VehicleController::class);
    Route::resource('drivers', DriverController::class);

    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
});



Route::middleware('auth')->group(function () {
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
