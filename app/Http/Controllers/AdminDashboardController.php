<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;


class AdminDashboardController extends Controller
{
    public function index()
    {
        // Check if the user is logged in and is an admin
        if (auth()->check() && auth()->user()->role == 1) {
            // If the user is an admin, load the admin dashboard
            $drivers = User::where('role', 2)->get(); // Fetch all drivers
            $passengers = User::where('role', 3)->get(); // Fetch all passengers
            $reservations = Reservation::all(); // Fetch all reservations

            return view('admin.dashboard', [
                'drivers' => $drivers,
                'passengers' => $passengers,
                'reservations' => $reservations,
            ]);
        } else {
            // If the user is not an admin, redirect to the home page or show an error message
            return redirect()->route('login')->with('error', 'You do not have permission to access the admin dashboard.');
        }
    }


    public function softDeleteDriver($id)
    {
        // Soft delete the driver with the given ID
        User::find($id)->delete();

        // Redirect back to the admin dashboard with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Driver deleted successfully.');
    }

    public function softDeletePassenger($id)
    {
        // Soft delete the passenger with the given ID
        User::find($id)->delete();

        // Redirect back to the admin dashboard with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Passenger deleted successfully.');
    }


    public function softDeleteReservation($id)
    {
        // Soft delete the reservation with the given ID
        Reservation::find($id)->delete();

        // Redirect back to the admin dashboard with a success message
        return redirect()->route('admin.reservations')->with('success', 'Reservation deleted successfully.');
    }

    
}
