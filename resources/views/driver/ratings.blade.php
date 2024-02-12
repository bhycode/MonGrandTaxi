
@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5">
        <h1>Driver Ratings</h1>

        @if(count($ratings) > 0)
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Passenger</th>
                            <th>Rating</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ratings as $rating)
                            <tr>
                                <td>{{ $rating->passenger->name }}</td>
                                <td>{{ $rating->rateValue }}</td>
                                <td>{{ $rating->comment }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="mt-4">No ratings available for this driver.</p>
        @endif
    </div>
@endsection
