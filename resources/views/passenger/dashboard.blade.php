@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Passenger Dashboard</h1>
                    </div>
                    <div class="card-body">
                        <div class="mt-4">
                            <h2>Reservations</h2>

                            <a href="{{ route('passenger.addReservationView') }}" class="btn btn-primary mb-3">Add Reservation</a>

                            @if(count($reservations) > 0)
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
                            @else
                                <p class="mt-4">No reservations available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
