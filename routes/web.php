<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/create', [RoomsController::class, 'createRoomForm'])->name('admin.createRoom');
Route::post('/admin/create', [RoomsController::class, 'createRoom']);
Route::get('/admin/home', [RoomsController::class, 'listrooms'])->name('admin.front');
Route::get('/admin/view/{id}', action: [RoomsController::class, 'viewRoom'])->name('admin.viewRoom');
Route::get('/admin/edit/{id}', action: [RoomsController::class, 'updateRoomForm'])->name('admin.updateRoom');
Route::post('/admin/edit/{id}', action: [RoomsController::class, 'updateRoom']);

Route::get('user/home', [RoomsController::class, 'showRooms'])->name('rooms.list');



require __DIR__.'/auth.php';
