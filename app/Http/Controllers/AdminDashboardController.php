<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;


class AdminDashboardController extends Controller
{
    public function index()
    {

        if (auth()->check() && auth()->user()->role == 1) {

            $drivers = User::where('role', 2)->get();
            $passengers = User::where('role', 3)->get();
            $reservations = Reservation::all();

            return view('admin.dashboard', [
                'drivers' => $drivers,
                'passengers' => $passengers,
                'reservations' => $reservations,
            ]);
        } else {

            return redirect()->route('login')->with('error', 'You do not have permission to access the admin dashboard.');
        }
    }


    public function softDeleteDriver($id)
    {

        User::find($id)->delete();


        return redirect()->route('admin.dashboard')->with('success', 'Driver deleted successfully.');
    }

    public function softDeletePassenger($id)
    {

        User::find($id)->delete();


        return redirect()->route('admin.dashboard')->with('success', 'Passenger deleted successfully.');
    }


    public function softDeleteReservation($id)
    {

        Reservation::find($id)->delete();


        return redirect()->route('admin.reservations')->with('success', 'Reservation deleted successfully.');
    }


}
