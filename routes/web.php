<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

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
    // ... other routes ...

    // Reservations management route
    Route::get('/admin/reservations', [AdminDashboardController::class, 'index'])->name('admin.reservations');
    Route::delete('/admin/reservations/{id}', [AdminDashboardController::class, 'softDeleteReservation'])->name('admin.softDeleteReservation');
});

