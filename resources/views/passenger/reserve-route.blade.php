@extends('layouts.app') {{-- Assuming you have a common layout file --}}

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reserve Route</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('passenger.storeReservation') }}">
                            @csrf
                            <input type="hidden" name="route_id" value="{{ $route->id }}">

                            <div class="form-group">
                                <label for="seats">Number of Seats:</label>
                                <input type="number" name="seats" class="form-control" value="1" required readonly>
                            </div>

                            <div class="form-group">
                                <label for="res_date">Reservation Date:</label>
                                <input type="datetime-local" name="res_date" class="form-control" required
                                       value="{{ now()->format('Y-m-d\TH:i') }}" readonly>
                                {{-- 'Y-m-d\TH:i' format represents 'YYYY-MM-DDTHH:mm' --}}
                            </div>

                            <button type="submit" class="btn btn-primary">Reserve</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
