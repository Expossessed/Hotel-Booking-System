<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/home', [RoomsController::class, 'listrooms'])->name('admin.front');
    });

    Route::get('user/home', [RoomsController::class, 'showRooms'])->name('rooms.list');

    // Booking routes
    Route::get('/book', [BookingController::class, 'showForm'])->name('bookings.form');
    Route::post('/book', [BookingController::class, 'createBooking'])->name('bookings.create');
});

require __DIR__.'/auth.php';
