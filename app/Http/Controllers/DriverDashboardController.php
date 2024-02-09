<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;

class DriverDashboardController extends Controller
{
    public function index()
    {
        // Fetch driver's reservations
        $driverId = auth()->id();
        $reservations = Reservation::where('driverId', $driverId)->get();

        // Get driver's availability
        $driver = User::find($driverId);
        $availability = $driver->isAvailable;

        return view('driver.dashboard', [
            'reservations' => $reservations,
            'availability' => $availability,
        ]);
    }

    public function toggleAvailability()
    {
        // Toggle driver's availability
        $driver = User::find(auth()->id());
        $driver->update(['isAvailable' => !$driver->isAvailable]);

        return redirect()->route('driver.dashboard')->with('success', 'Availability updated successfully.');
    }
}
