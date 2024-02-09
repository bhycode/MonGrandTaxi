<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class DriverRatingController extends Controller
{
    public function index($driverId)
    {
         $ratings = Rating::where('driverId', $driverId)->get();

        return view('driver.ratings', compact('ratings'));
    }

    public function create($driverId)
    {
        return view('driver.add_rating', compact('driverId'));
    }

    public function store(Request $request, $driverId)
    {
        // Validate the request
        $request->validate([
            'rateValue' => 'required|integer|min:1|max:10',
            'comment' => 'nullable|string',
        ]);

        // Store the rating in the database
        Rating::create([
            'rateValue' => $request->input('rateValue'),
            'driverId' => $driverId,
            'passengerId' => auth()->id(), // Assuming the logged-in user is the passenger
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('driver.ratings', $driverId)->with('success', 'Rating added successfully.');
    }


}
