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
                        <h2>Booking</h2>

                        <form action="{{ route('passenger.dashboard') }}" method="GET">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="driverName">Search by Driver Name:</label>
                                    <input type="text" class="form-control" id="driverName" name="driverName"
                                        value="{{ request('driverName') }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="departCity">Filter by Departure City:</label>
                                    <select class="form-control" id="departCity" name="departCity">
                                        <option value="">All Cities</option>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ request('departCity') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="arriveCity">Filter by Arrival City:</label>
                                    <select class="form-control" id="arriveCity" name="arriveCity">
                                        <option value="">All Cities</option>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ request('arriveCity') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                        </form>


                        @if(count($routes) > 0)
                        <table class="table table-bordered mt-4">
                            <thead class="thead-light">
                                <tr>
                                    <th>Driver</th>
                                    <th>Departure City</th>
                                    <th>Arrival City</th>
                                    <th>Travel Hour</th>
                                    <th>Travel Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($routes as $route)
                                    <tr>
                                        <td>{{ $route->driver->name }}</td>
                                        <td>{{ $route->departureCity->name }}</td>
                                        <td>{{ $route->arrivalCity->name }}</td>
                                        <td>{{ $route->travelHour }}</td>
                                        <td>{{ $route->travelDate }}</td>
                                        <td>
                                            <form action="{{ route('passenger.reserveRoute', $route->id) }}" method="POST">
                                                @csrf
                                                @php
                                                    $disableReserve = count($route->driver->reservations) >= $route->driver->taxiSets;
                                                @endphp
                                                <button type="submit" class="btn btn-success btn-sm" {{ $disableReserve ? 'disabled' : '' }}>Reserve</button>
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No routes available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @else
                        <p class="mt-4">No routes available.</p>
                    @endif


                        @if(count($reservations) > 0)
                        <h2>Reservations</h2>
                        <table class="table table-bordered mt-4">
                            <thead class="thead-light">
                                <tr>
                                    <th>Driver</th>
                                    <th>Departure City</th>
                                    <th>Arrival City</th>
                                    <th>Travel Hour</th>
                                    <th>Travel Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->driver->name }}</td>
                                        <td>{{ $reservation->route->departureCity->name }}</td>
                                        <td>{{ $reservation->route->arrivalCity->name }}</td>
                                        <td>{{ $reservation->route->travelHour }}</td>
                                        <td>{{ $reservation->resDate }}</td>
                                        <td>
                                            <form action="{{ route('passenger.softDeleteReservation', $reservation->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @php
                                                    $currentTime = now();
                                                    $reservationTime = \Carbon\Carbon::parse($reservation->resDate);
                                                    $disableCancel = $reservationTime->diffInMinutes($currentTime) >= 60;
                                                @endphp
                                                <button type="submit" class="btn btn-danger btn-sm" {{ $disableCancel ? 'disabled' : '' }}>Cancel</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="mt-4">No reservations found.</p>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
