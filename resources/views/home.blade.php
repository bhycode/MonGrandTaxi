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
            height: 300px;
            overflow: hidden;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.5;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
        }

        .centered-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .card-section {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
        }

        .card {
            width: 300px;
            margin: 20px;
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
    <img class="background-image" src="https://images.unsplash.com/photo-1556122071-e404eaedb77f?q=80&w=2034&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Background Image">
    <div class="overlay"></div>
    <div class="centered-content">
        <h2>Discover the Comfort of MonGrandTaxi</h2>
        <p>Your preferred choice for seamless taxi reservations.</p>
    </div>
</div>

<!-- Pricing, Customers, and Drivers Cards -->
<div class="container">
    <div class="card-section">
        <!-- Pricing Card -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pricing</h5>
                <p class="card-text">Affordable and flexible pricing plans to suit your needs.</p>
                <a href="#" class="btn btn-primary">View Plans</a>
            </div>
        </div>

        <!-- Customers Card -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Our Customers</h5>
                <p class="card-text">Join our community of over 95,000 satisfied customers.</p>
                <a href="#" class="btn btn-primary">Read Testimonials</a>
            </div>
        </div>

        <!-- Drivers Card -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Our Drivers</h5>
                <p class="card-text">Become one of our 2,500 professional and dedicated drivers.</p>
                <a href="#" class="btn btn-primary">Join Our Team</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
