@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100 bg-light">
        <div class="card p-4 shadow" style="width: 400px;">
            <h1 class="text-center mb-4">Add Route</h1>

            <form action="{{ route('driver.routes.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="departureCity">Departure City</label>
                    <select class="form-control" id="departureCity" name="departureCity">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="arrivalCity">Arrival City</label>
                    <select class="form-control" id="arrivalCity" name="arrivalCity">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="travelHour">Travel Hour</label>
                    <input type="number" class="form-control" id="travelHour" name="travelHour" placeholder="Enter travel hour" min="0">
                </div>

                <div class="form-group">
                    <label for="travelDate">Travel Date</label>
                    <input type="text" class="form-control datepicker" id="travelDate" name="travelDate" placeholder="Select travel date">
                </div>

                <!-- Add more form fields as needed -->

                <button type="submit" class="btn btn-primary btn-block">Add Route</button>
            </form>
        </div>
    </div>

    <!-- Include your date picker library script here -->
    <!-- For example, if using Bootstrap Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        // Initialize the date picker
        $(document).ready(function(){
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });
    </script>
@endsection
