<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UsersController;
use App\Models\Rooms;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $rooms = Rooms::where('is_available', 1)
        ->orderBy('room_price', 'asc')
        ->take(3)
        ->get();

    return view('welcome', ['rooms' => $rooms]);
})->name('home');

// Public hotel pages
Route::view('/about', 'pages.about')->name('about');
Route::view('/gallery', 'pages.gallery')->name('gallery');
Route::view('/offers', 'pages.offers')->name('offers');
Route::view('/events', 'pages.events')->name('events');
Route::view('/restaurant', 'pages.restaurant')->name('restaurant');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/privacy', 'pages.privacy')->name('privacy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/home', [RoomsController::class, 'listRooms'])->name('admin.front');
        Route::get('/admin/history', [BookingController::class, 'adminHistory'])->name('admin.history');
    });

    Route::get('user/home', [RoomsController::class, 'showRooms'])->name('rooms.list');
    Route::get('/user/rooms/{id}', [RoomsController::class, 'view'])->name('rooms.view');

    Route::get('/user/history', [BookingController::class, 'userHistory'])->name('bookings.history');

    // Booking routes
    Route::get('/book', [BookingController::class, 'showForm'])->name('bookings.form');
    Route::post('/book', [BookingController::class, 'createBooking'])->name('bookings.create');
});

Route::get('/admin/create', [RoomsController::class, 'createRoomForm'])->name('admin.createRoom');
Route::post('/admin/create', [RoomsController::class, 'createRoom']);
Route::get('/admin/home', [RoomsController::class, 'listrooms'])->name('admin.front');
Route::get('/admin/view/{id}', [RoomsController::class, 'viewRoom'])->name('admin.viewRoom');
Route::get('/admin/edit/{id}',  [RoomsController::class, 'updateRoomForm'])->name('admin.updateRoom');
Route::post('/admin/edit/{id}',  [RoomsController::class, 'updateRoom']);
Route::post('/admin/delete/{id}', [RoomsController::class, 'deleteRoom'])->name('admin.deleteRoom');
Route::post('/admin/viewUser/{id}', [UsersController::class, 'deleteUser'])->name('admin.deleteRoom');

Route::get('user/home', [RoomsController::class, 'showRooms'])->name('rooms.list');
Route::get('/admin/viewUser', [UsersController::class, 'view'])->name('admin.viewUsers');
Route::get('/admin/updateUser/{id}', [UsersController::class, 'updateUserForm'])->name('admin.updateUser');
Route::post('/admin/updateUser/{id}', [UsersController::class, 'updateUser']);
Route::get('/admin/viewbookings', [BookingController::class, 'viewBookings'])->name('admin.viewBookings');



require __DIR__.'/auth.php';
