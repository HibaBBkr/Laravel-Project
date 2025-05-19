<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\hallController;

// Homepage
Route::get('/', function () {
    return view('Home'); // Or your home view
})->name('Home');

// Owner specific routes
Route::middleware(['auth'])->prefix('owner')->name('owner.')->group(function () { // Assuming these are for authenticated users
    Route::get('/calendar', [OwnerController::class, 'showCalendar'])->name('calendar'); // Route name: owner.calendar
    Route::get('/reviews', [OwnerController::class, 'showReviews'])->name('reviews');    // Route name: owner.reviews
    Route::get('/add-a-hall', [OwnerController::class, 'showAddHallForm'])->name('addHall'); // Route name: owner.addHall

    // If you have a POST route for submitting the form:
    // Route::post('/add-hall', [OwnerController::class, 'storeHall'])->name('storeHall');
});


// Authentication Routes
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Good to have a POST route for logout

// Profile Route (Protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('halls/create', [hallController::class, 'create'])->name('halls.create');
