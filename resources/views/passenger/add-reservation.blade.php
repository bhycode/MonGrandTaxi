<!-- resources/views/passenger/add_reservation.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Reservation</h1>

        <form action="{{ route('passenger.storeReservation') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="route_id">Select Route:</label>
                <select class="form-control" id="route_id" name="route_id" required>
                    @foreach($routes as $route)
                        <option value="{{ $route->id }}">{{ $route->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="seats">Number of Seats:</label>
                <input type="number" class="form-control" id="seats" name="seats" min="1" required>
            </div>

            <div class="form-group">
                <label for="res_date">Reservation Date:</label>
                <input type="date" class="form-control" id="res_date" name="res_date" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Reservation</button>
        </form>
    </div>
@endsection
