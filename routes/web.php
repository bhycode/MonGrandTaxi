<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DriverDashboardController;
use App\Http\Controllers\DriverRatingController;
use App\Http\Controllers\PassengerDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');


Route::get('/home', function () {
    return view('home');
});



Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/driver/{id}/soft-delete', [AdminDashboardController::class, 'softDeleteDriver'])->name('admin.softDeleteDriver');
});

Route::middleware(['auth'])->group(function () {

    Route::delete('/admin/passenger/{id}/soft-delete', [AdminDashboardController::class, 'softDeletePassenger'])->name('admin.softDeletePassenger');
});


// Route::middleware(['auth'])->group(function () {
//     // ... other routes ...

//     // Reservations management route
//     Route::get('/admin/reservations', [AdminDashboardController::class, 'reservationsManagement'])->name('admin.reservations');
// });


Route::middleware(['auth'])->group(function () {

    Route::get('/admin/reservations', [AdminDashboardController::class, 'index'])->name('admin.reservations');
    Route::delete('/admin/reservations/{id}', [AdminDashboardController::class, 'softDeleteReservation'])->name('admin.softDeleteReservation');
});




Route::middleware(['auth', 'driver'])->group(function () {
    Route::get('/driver/dashboard', [DriverDashboardController::class, 'index'])->name('driver.dashboard');
    Route::post('/driver/toggle-availability', [DriverDashboardController::class, 'toggleAvailability'])->name('driver.toggleAvailability');
});



// Route::get('/driver/{driverId}/ratings', [DriverRatingController::class, 'index'])->name('driver.ratings');

// Show the form to add a rating
Route::get('/driver/{driverId}/add-rating', [DriverRatingController::class, 'create'])->name('driver.addRating');

// Store the submitted rating
Route::post('/driver/{driverId}/add-rating', [DriverRatingController::class, 'store'])->name('driver.storeRating');

// Show all ratings for a driver
Route::get('/driver/{driverId}/ratings', [DriverRatingController::class, 'index'])->name('driver.ratings');



Route::middleware(['auth', 'passenger'])->group(function () {
    Route::get('/passenger/dashboard', [PassengerDashboardController::class, 'index'])->name('passenger.dashboard');
    Route::post('/passenger/reservations', [PassengerDashboardController::class, 'storeReservation'])->name('passenger.storeReservation');
    Route::delete('/passenger/reservations/{id}', [PassengerDashboardController::class, 'softDeleteReservation'])->name('passenger.softDeleteReservation');
    Route::get('/passenger/add-reservation', [PassengerDashboardController::class, 'addReservationView'])->name('passenger.addReservationView');

});
