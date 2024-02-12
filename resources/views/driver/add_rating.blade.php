
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Add Rating for Driver</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('driver.storeRating', $driverId) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="rateValue">Rating:</label>
                                <input type="range" class="form-control-range" id="rateValue" name="rateValue" min="1" max="10" step="1" required>
                                <output id="rateOutput" class="mt-2 d-block text-center">6</output>
                            </div>

                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Submit Rating</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('rateValue').addEventListener('input', function() {
            document.getElementById('rateOutput').innerText = this.value;
        });
    </script>
@endsection
