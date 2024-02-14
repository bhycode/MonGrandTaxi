<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Route;
use App\Models\City;
use App\Models\User;

class PassengerDashboardController extends Controller
{

    public function index(Request $request)
    {
        $passengerId = auth()->id();
        $reservations = Reservation::where('passengerId', $passengerId)->get();

        $query = Route::with(['driver', 'departureCity', 'arrivalCity']);

        if ($request->filled('driverName')) {
            $query->whereHas('driver', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('driverName') . '%');
            });
        }

        if ($request->filled('departCity')) {
            $query->where('departCity', $request->input('departCity'));
        }

        if ($request->filled('arriveCity')) {
            $query->where('arriveCity', $request->input('arriveCity'));
        }

        $routes = $query->get();

        $cities = City::all();

        return view('passenger.dashboard', [
            'reservations' => $reservations,
            'routes' => $routes,
            'cities' => $cities,
        ]);
    }



    public function storeReservation(Request $request)
    {

        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'seats' => 'required|integer|min:1',
            'res_date' => 'required|date',
        ]);


        Reservation::create([
            'passengerId' => auth()->id(),
            'driverId' => Route::findOrFail($request->input('route_id'))->driverId,
            'routeId' => $request->input('route_id'),
            'seats' => $request->input('seats'),
            'resDate' => $request->input('res_date'),
        ]);

        return redirect()->route('passenger.dashboard')->with('success', 'Reservation added successfully.');
    }

    public function softDeleteReservation($id)
    {

        Reservation::find($id)->delete();

        return redirect()->route('passenger.dashboard')->with('success', 'Reservation deleted successfully.');
    }



    public function reserveRoute($routeId)
    {
        // Retrieve the route details, assuming you have a Route model
        $route = Route::findOrFail($routeId);

        return view('passenger.reserve-route', ['route' => $route]);
    }






}
