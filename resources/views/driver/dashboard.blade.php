
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6">
                <h1>Driver Dashboard</h1>
            </div>
            <div class="col-md-6 text-right">
                <h2>Availability</h2>
                <p>Your current availability:
                    <span class="badge badge-{{ $availability ? 'success' : 'danger' }}">
                        {{ $availability ? 'Available' : 'Not Available' }}
                    </span>
                </p>
                <form action="{{ route('driver.toggleAvailability') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Toggle Availability</button>
                </form>
            </div>
        </div>

        <hr>

        <div class="mt-4">
            <h2>Reservations</h2>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Passenger</th>
                        <th>Route</th>
                        <th>Seats</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->passenger->name }}</td>
                            <td>{{ $reservation->route->id }}</td>
                            <td>{{ $reservation->seats }}</td>
                            <td>{{ $reservation->resDate }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No reservations available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <!-- Button to view driver ratings -->
            <a href="{{ route('driver.ratings', ['driverId' => auth()->id()]) }}" class="btn btn-info">View Ratings</a>
        </div>
    </div>
@endsection
