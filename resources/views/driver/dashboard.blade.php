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


        <div class="mt-4">
            <h2>Taxi Sets</h2>
            <p>Your current taxi sets: <span class="badge badge-primary">{{ $taxiSets }}</span></p>

            <form action="{{ route('driver.updateTaxiSets') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="taxiSets">Set Taxi Sets:</label>
                    <input type="number" name="taxiSets" class="form-control" value="{{ $taxiSets }}" required min = "1" max="7">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Update Taxi Sets</button>
            </form>
        </div>


        <div class="mt-4">
            <h2>Payment Method</h2>
            <p>Your current payment method:
                <span class="badge badge-primary">
                    @if($paymentMethod == 1)
                        Cash
                    @elseif($paymentMethod == 2)
                        Credit Card
                    @elseif($paymentMethod == 3)
                        PayPal
                    @else
                        Unknown
                    @endif
                </span>
            </p>
            <form action="{{ route('driver.togglePaymentMethod') }}" method="POST">
                @csrf
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="cash" value="1" {{ $paymentMethod == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="cash">Cash</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" value="2" {{ $paymentMethod == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="creditCard">Credit Card</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="paypal" value="3" {{ $paymentMethod == 3 ? 'checked' : '' }}>
                    <label class="form-check-label" for="paypal">PayPal</label>
                </div>
                <!-- Add more options if needed -->

                <button type="submit" class="btn btn-primary mt-2">Change Payment Method</button>
            </form>
        </div>

        <hr>


        <div class="mt-4">
            <form action="{{ route('driver.reservations.deleteAll') }}" method="POST" id="deleteAllForm">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteAll()">Delete All Reservations</button>
            </form>
            <table class="table table-bordered">



            </table>
        </div>

        <script>
            function confirmDeleteAll() {
                if (confirm('Are you sure you want to delete all reservations?')) {
                    document.getElementById('deleteAllForm').submit();
                }
            }
        </script>



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
            <a href="{{ route('driver.ratings', ['driverId' => auth()->id()]) }}" class="btn btn-info">View Ratings</a>
        </div>

        <div class="mt-4">
            <h2>Routes Management</h2>
            <a href="{{ route('driver.routes.create') }}" class="btn btn-success mb-3">Add Route</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Departure City</th>
                        <th>Arrival City</th>
                        <th>Travel Hour</th>
                        <th>Travel Date</th>
                        <!-- Add more columns as needed -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($driverRoutes as $route)
                        <tr>
                            <td>{{ $route->departureCity->name }}</td>
                            <td>{{ $route->arrivalCity->name }}</td>
                            <td>{{ $route->travelHour }}</td>
                            <td>{{ $route->travelDate }}</td>
                            <!-- Add more columns as needed -->
                            <td>
                                <form action="{{ route('driver.routes.delete', ['routeId' => $route->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this route?')">Delete</button>
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
        </div>
    </div>
@endsection
