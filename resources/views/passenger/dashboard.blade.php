@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Passenger Dashboard</h1>

        <div class="mt-4">
            <h2>Reservations</h2>

            <a href="{{ route('passenger.addReservationView') }}" class="btn btn-primary mb-3">Add Reservation</a>

            <table class="table table-bordered mt-4">
                <thead class="thead-light">
                    <tr>
                        <th>Route</th>
                        <th>Seats</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->route->name }}</td>
                            <td>{{ $reservation->seats }}</td>
                            <td>{{ $reservation->resDate }}</td>
                            <td>
                                <form action="{{ route('passenger.softDeleteReservation', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No reservations available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
