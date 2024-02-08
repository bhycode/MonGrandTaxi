<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonGrandTaxi - Reservation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .top-section {
            position: relative;
            height: 300px; /* Adjust the height as needed */
            overflow: hidden;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.5; /* Adjust the opacity as needed */
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3); /* Adjust the overlay color and opacity as needed */
        }

        .centered-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }
    </style>
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

<!-- Top Section with Background Image and Overlay -->
<div class="top-section">
    <img class="background-image" src="https://images.unsplash.com/photo-1516733968668-dbdce39c4651?q=80&w=500&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Background Image">
    <div class="overlay"></div>
    <div class="centered-content">
        <h2>Discover the Comfort of MonGrandTaxi</h2>
        <p>Your preferred choice for seamless taxi reservations.</p>
    </div>
</div>

<div class="container mt-4">
    <h1>Taxi Reservation</h1>
    <div class="container">
        <!-- Your reservation form and content go here -->
        <form>
            <!-- Form fields go here -->
            <button type="submit" class="btn btn-primary mt-3">Reserve Now</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
