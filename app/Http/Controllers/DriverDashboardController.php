<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Route;
use App\Models\City;
use Illuminate\Validation\Rule;

class DriverDashboardController extends Controller
{


    public function index()
    {
        $driverId = auth()->id();
        $reservations = Reservation::where('driverId', $driverId)->get();
        $driver = User::find($driverId);
        $availability = $driver->isAvailable;
        $paymentMethod = $driver->paymentMethod;
        $taxiSets = $driver->taxiSets;

        $driverRoutes = Route::where('driverId', $driverId)->get();

        return view('driver.dashboard', [
            'reservations' => $reservations,
            'availability' => $availability,
            'paymentMethod' => $paymentMethod,
            'taxiSets' => $taxiSets,
            'driverRoutes' => $driverRoutes,
        ]);
    }



    public function toggleAvailability()
    {

        $driver = User::find(auth()->id());
        $driver->update(['isAvailable' => !$driver->isAvailable]);

        return redirect()->route('driver.dashboard')->with('success', 'Availability updated successfully.');
    }

    public function togglePaymentMethod(Request $request)
    {
        $driver = User::find(auth()->id());
        $driver->update(['paymentMethod' => $request->input('paymentMethod')]);

        return redirect()->route('driver.dashboard')->with('success', 'Payment method updated successfully.');
    }


    public function create()
    {
        $cities = City::all();

        return view('driver.add_route', ['cities' => $cities]);
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'departureCity' => ['required', 'exists:cities,id', Rule::notIn([$request->input('arrivalCity')])],
            'arrivalCity' => ['required', 'exists:cities,id', Rule::notIn([$request->input('departureCity')])],
            'travelHour' => ['required', 'numeric', 'min:0'],
            'travelDate' => ['required'],
        ]);


        $driverId = auth()->id();


        Route::create([
            'departCity' => $validatedData['departureCity'],
            'arriveCity' => $validatedData['arrivalCity'],
            'travelHour' => $validatedData['travelHour'],
            'travelDate' => $validatedData['travelDate'],
            'driverId' => $driverId,

        ]);

        return redirect()->route('driver.dashboard')->with('success', 'Route added successfully.');
    }


    public function deleteRoute($routeId)
    {
        $route = Route::find($routeId);

        if (!$route || $route->driverId !== auth()->id()) {
            return redirect()->route('driver.dashboard')->with('error', 'Invalid route or unauthorized access.');
        }

        $route->delete();

        return redirect()->route('driver.dashboard')->with('success', 'Route deleted successfully.');
    }


    public function updateTaxiSets(Request $request)
    {
        $driver = User::find(auth()->id());

        $request->validate([
            'taxiSets' => 'required|integer|min:1',
        ]);

        $driver->update(['taxiSets' => $request->input('taxiSets')]);

        return redirect()->route('driver.dashboard')->with('success', 'Taxi Sets updated successfully.');
    }


}
