<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Route;
use App\Models\City;

class PassengerDashboardController extends Controller
{

    public function index(Request $request)
    {

        $passengerId = auth()->id();
        $reservations = Reservation::where('passengerId', $passengerId)->get();


        $routes = Route::query();


        if ($request->filled('departCity')) {
            $routes->where('departCity', $request->input('departCity'));
        }

        if ($request->filled('arriveCity')) {
            $routes->where('arriveCity', $request->input('arriveCity'));
        }

        if ($request->filled('driverName')) {
            $routes->whereHas('driver', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('driverName') . '%');
            });
        }

        $routes = $routes->get();


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

    public function addReservationView()
    {

        $routes = Route::all();

        return view('passenger.add-reservation', [
            'routes' => $routes,
        ]);
    }

    public function reserveRoute(Route $route)
    {


        Reservation::create([
            'passengerId' => auth()->id(),
            'routeId' => $route->id,
        ]);

        return redirect()->route('passenger.dashboard')->with('success', 'Route reserved successfully.');
    }



}
