<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Blood Donor Management') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #dc3545;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
        }
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        .btn-primary:hover {
            background-color: #bd2130;
            border-color: #b21f2d;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('{{ asset('images/hero-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .stats-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .donor-card {
            border: 1px solid #eee;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .donor-card:hover {
            transform: translateY(-5px);
        }
        .blood-badge {
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .blood-A-plus { background: #ffebee; color: #c62828; }
        .blood-A-minus { background: #ffebee; color: #c62828; }
        .blood-B-plus { background: #e8f5e9; color: #2e7d32; }
        .blood-B-minus { background: #e8f5e9; color: #2e7d32; }
        .blood-AB-plus { background: #e3f2fd; color: #1565c0; }
        .blood-AB-minus { background: #e3f2fd; color: #1565c0; }
        .blood-O-plus { background: #fff3e0; color: #ef6c00; }
        .blood-O-minus { background: #fff3e0; color: #ef6c00; }
        .footer-bg {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">BloodHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                         <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link {{ request()->is('search*') ? 'active' : '' }}" href="{{ route('search') }}">Search Donors</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link {{ request()->is('donors*') ? 'active' : '' }}" href="{{ route('donors.list') }}">Donor List</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link {{ request()->is('about*') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer-bg py-5 mt-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-3">
                    <h5>About BloodHub</h5>
                    <p>We are dedicated to saving lives by connecting blood donors with those in need.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('search') }}">Search Donors</a></li>
                        <li><a href="{{ route('donors.list') }}">Donor List</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Contact Us</h5>
                    <p><i class="fas fa-phone"></i> +123 456 7890</p>
                    <p><i class="fas fa-envelope"></i> info@bloodhub.org</p>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Blood Donation Street, City</p>
                </div>
            </div>
            <div class="text-center mt-4 pt-3 border-top">
                <p>&copy; {{ now()->year }} BloodHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.js" defer></script>
</body>
</html>