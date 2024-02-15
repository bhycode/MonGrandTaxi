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
                    <input type="text" class="form-control flatpickr" id="travelDate" name="travelDate" placeholder="Select travel date and time">
                </div>


                <button type="submit" class="btn btn-primary btn-block">Add Route</button>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        flatpickr('.flatpickr', {
            enableTime: true,
            dateFormat: 'Y-m-d H:i:S',
            minDate: tomorrow,
        });
    </script>
@endsection
