<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Route;

class PassengerDashboardController extends Controller
{
    public function index()
    {
        // Fetch passenger's reservations
        $passengerId = auth()->id();
        $reservations = Reservation::where('passengerId', $passengerId)->get();

        // Fetch available routes for reservation
        $routes = Route::all();

        return view('passenger.dashboard', [
            'reservations' => $reservations,
            'routes' => $routes,
        ]);
    }

    public function storeReservation(Request $request)
    {
        // Validate the reservation request
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'seats' => 'required|integer|min:1',
            'res_date' => 'required|date',
        ]);

        // Create a new reservation
        Reservation::create([
            'passengerId' => auth()->id(),
            'routeId' => $request->input('route_id'),
            'seats' => $request->input('seats'),
            'resDate' => $request->input('res_date'),
        ]);

        return redirect()->route('passenger.dashboard')->with('success', 'Reservation added successfully.');
    }

    public function softDeleteReservation($id)
    {
        // Soft delete the reservation with the given ID
        Reservation::find($id)->delete();

        return redirect()->route('passenger.dashboard')->with('success', 'Reservation deleted successfully.');
    }

    public function addReservationView()
    {
        // Fetch available routes for reservation
        $routes = Route::all();

        return view('passenger.add-reservation', [
            'routes' => $routes,
        ]);
    }
}
