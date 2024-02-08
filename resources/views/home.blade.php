<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonGrandTaxi</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">MonGrandTaxi</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Reservation</a>
            </li>
        </ul>
        <div class="navbar-nav ml-2">

            @auth
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger mx-2">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary mx-2">Login</a>
                <a href="{{ route('signup') }}" class="btn btn-primary mx-2">Signup</a>
            @endauth

        </div>
    </div>
</nav>


<div class="container mt-4">
    <h1>Welcome to Your App!</h1>
    <div class="container">
        <section id="welcome-section">
            <h1>Welcome, {{ Auth::user()->name }}</h1>
        </section>

        <section id="user-info-section">
            <h2>User Information</h2>
            <p>Your ID: {{ Auth::user()->id }}</p>
            <p>Your Role: {{ Auth::user()->role }}</p>

        </section>

        <section id="dashboard-content-section">
            <h2>Dashboard Content</h2>

        </section>
    </div>
    <!-- Your home content goes here -->
</div>

<!-- Include Bootstrap JS and jQuery (you may need to adjust the versions) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
