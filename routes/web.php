    <?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\HomeController;
use App\Models\Rooms;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes were previously partially opened inside this group —
    // admin-owned routes are all re-grouped and protected below with both
    // the `auth` and `admin` middleware so regular users cannot reach them.

    Route::get('user/home', [RoomsController::class, 'showRooms'])->name('rooms.list');
    Route::get('/user/rooms/{id}', [RoomsController::class, 'view'])->name('rooms.view');

    Route::get('/user/history', [BookingController::class, 'userHistory'])->name('bookings.history');

    // Booking routes
    Route::get('/book', [BookingController::class, 'showForm'])->name('bookings.form');
    Route::post('/book', [BookingController::class, 'createBooking'])->name('bookings.create');
});

// Admin-only routes - protected by both auth and admin middleware.
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/home', [RoomsController::class, 'listRooms'])->name('admin.front');

    Route::get('/create', [RoomsController::class, 'createRoomForm'])->name('admin.createRoom');
    Route::post('/create', [RoomsController::class, 'createRoom']);

    Route::get('/view/{id}', [RoomsController::class, 'viewRoom'])->name('admin.viewRoom');
    Route::get('/edit/{id}', [RoomsController::class, 'updateRoomForm'])->name('admin.updateRoom');
    Route::post('/edit/{id}', [RoomsController::class, 'updateRoom']);
    Route::post('/delete/{id}', [RoomsController::class, 'deleteRoom'])->name('admin.deleteRoom');
    Route::post('/viewUser/{id}', [UsersController::class, 'deleteUser'])->name('admin.deleteRoom');

    Route::get('/viewUser', [UsersController::class, 'view'])->name('admin.viewUsers');
    Route::get('/updateUser/{id}', [UsersController::class, 'updateUserForm'])->name('admin.updateUser');
    Route::post('/updateUser/{id}', [UsersController::class, 'updateUser']);

    Route::get('/viewbookings', [BookingController::class, 'viewBookings'])->name('admin.viewBookings');

    Route::get('/history', [BookingController::class, 'adminHistory'])->name('admin.history');
    Route::post('/history/{id}/updateStatus', [BookingController::class, 'updateBookingStatus'])->name('admin.updateBookingStatus');

    Route::get('/viewtransactions', [TransactionsController::class, 'viewTransactions'])->name('admin.viewTransactions');

    Route::post('/add-balance', [UsersController::class, 'addBalance'])->name('admin.addBalance');
});

Route::get('/user/reviews/create', [ReviewsController::class, 'showReviewForm'])
    ->name('reviews.createReview')
    ->middleware('auth');
Route::post('/user/reviews/store', [ReviewsController::class, 'storeReview'])
    ->name('reviews.store')
    ->middleware('auth');
// Show reviews for a room. The identifier may be an id or a room name (optional).
Route::get('user/reviews/view/{room_identifier?}', [ReviewsController::class, 'view'])
    ->name('reviews.viewReviews');


require __DIR__.'/auth.php';

