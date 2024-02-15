<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DriverDashboardController;
use App\Http\Controllers\DriverRatingController;
use App\Http\Controllers\PassengerDashboardController;
use App\Http\Controllers\DriverRoutesController;

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


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/reservations', [AdminDashboardController::class, 'index'])->name('admin.reservations');
    Route::delete('/admin/reservations/{id}', [AdminDashboardController::class, 'softDeleteReservation'])->name('admin.softDeleteReservation');
});




Route::middleware(['auth', 'driver'])->group(function () {
    Route::get('/driver/dashboard', [DriverDashboardController::class, 'index'])->name('driver.dashboard');
    Route::post('/driver/toggle-availability', [DriverDashboardController::class, 'toggleAvailability'])->name('driver.toggleAvailability');

    Route::get('/driver/routes/create', [DriverDashboardController::class, 'create'])->name('driver.routes.create');
    Route::post('/driver/routes', [DriverDashboardController::class, 'store'])->name('driver.routes.store');
    Route::delete('/driver/routes/{routeId}', [DriverDashboardController::class, 'deleteRoute'])->name('driver.routes.delete');

    Route::delete('/driver/reservations/delete-all', [DriverDashboardController::class, 'deleteAllReservations'])->name('driver.reservations.deleteAll');

});



Route::get('/driver/{driverId}/add-rating', [DriverRatingController::class, 'create'])->name('driver.addRating');

Route::post('/driver/{driverId}/add-rating', [DriverRatingController::class, 'store'])->name('driver.storeRating');

Route::get('/driver/{driverId}/ratings', [DriverRatingController::class, 'index'])->name('driver.ratings');
Route::post('/driver/toggle-payment-method', [DriverDashboardController::class, 'togglePaymentMethod'])
    ->name('driver.togglePaymentMethod');

Route::post('/driver/updateTaxiSets', [DriverDashboardController::class, 'updateTaxiSets'])
    ->name('driver.updateTaxiSets');

Route::middleware(['auth', 'passenger'])->group(function () {
    Route::get('/passenger/dashboard', [PassengerDashboardController::class, 'index'])->name('passenger.dashboard');
    Route::post('/passenger/reservations', [PassengerDashboardController::class, 'storeReservation'])->name('passenger.storeReservation');
    Route::delete('/passenger/reservations/{id}', [PassengerDashboardController::class, 'softDeleteReservation'])->name('passenger.softDeleteReservation');
    // Route::get('/passenger/add-reservation', [PassengerDashboardController::class, 'addReservationView'])->name('passenger.addReservationView');

    Route::get('/passenger/reserve-route/{route}', [PassengerDashboardController::class, 'reserveRoute'])->name('passenger.reserveRoute');
    Route::post('/passenger/reserve-route/{route}', [PassengerDashboardController::class, 'reserveRoute'])->name('passenger.reserveRoute');
});




