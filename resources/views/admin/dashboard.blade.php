<!-- admin/dashboard.blade.php -->

@extends('layouts.app') <!-- Assuming you have a default layout -->

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Admin Dashboard</h1>

        <div class="card mb-4">
            <div class="card-header">
                <h2>Drivers Management</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivers as $driver)
                                <tr>
                                    <td>{{ $driver->name }}</td>
                                    <td>{{ $driver->phoneNumber }}</td>
                                    <td>
                                        <form action="{{ route('admin.softDeleteDriver', $driver->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Passengers Management</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($passengers as $passenger)
                                <tr>
                                    <td>{{ $passenger->name }}</td>
                                    <td>{{ $passenger->phoneNumber }}</td>
                                    <td>
                                        <form action="{{ route('admin.softDeletePassenger', $passenger->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h2>Passengers Management</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($passengers as $passenger)
                                <tr>
                                    <td>{{ $passenger->name }}</td>
                                    <td>{{ $passenger->phoneNumber }}</td>
                                    <td>
                                        <form action="{{ route('admin.softDeletePassenger', $passenger->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="card">
            <!-- Reservations Management Section -->
            <div class="card-header">
                <h2>Reservations Management</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Driver</th>
                                <th>Passenger</th>
                                <th>Route</th>
                                <th>Seats</th>
                                <th>Reservation Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->driver->name }}</td>
                                    <td>{{ $reservation->passenger->name }}</td>
                                    <td>{{ $reservation->route->id }}</td>
                                    <td>{{ $reservation->seats }}</td>
                                    <td>{{ $reservation->resDate }}</td>
                                    <td>
                                        <form action="{{ route('admin.softDeleteReservation', $reservation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection
