<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Grama Niladhari Division Management System</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
    <a class="navbar-brand fw-bold text-danger" href="/">
        GN Management System
    </a>

    <div class="ms-auto d-flex gap-2">
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-dark">Login</a>
            <a href="{{ route('register') }}" class="btn btn-danger">Register</a>
        @endauth
    </div>
</nav>

<!-- HERO SECTION -->
<section class="container my-5">
    <div class="row align-items-center g-5">

        <!-- TEXT CONTENT -->
        <div class="col-lg-6 text-center text-lg-start">
            <span class="badge bg-danger mb-3">Official Government Portal</span>
            <h1 class="display-5 fw-bold mb-3">
                Grama Niladhari<br>Division Management System
            </h1>
            <p class="lead text-muted mb-4">
                A modern digital platform to manage citizen records, households, GN divisions, and official certificates efficiently.
            </p>

            <div class="d-flex flex-column flex-sm-row gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-dark btn-lg">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-dark btn-lg">Officer Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-danger btn-lg">Register Officer</a>
                @endauth
            </div>
        </div>

        <!-- IMAGE / CARD -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-lg-5">
                    <h4 class="fw-semibold mb-3">System Features</h4>
                    <ul class="list-unstyled">
                        <li class="d-flex align-items-center mb-3">
                            <span class="badge bg-success me-3">✓</span>
                            Citizen & Household Registry
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary me-3">✓</span>
                            GN Division-wise Data Management
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <span class="badge bg-warning text-dark me-3">✓</span>
                            Certificate Generation (Income, Residence, Character)
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="badge bg-danger me-3">✓</span>
                            Secure Login & Role-based Access
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="mt-auto bg-white border-top py-3 text-center text-muted small">
    © {{ date('Y') }} Grama Niladhari Management System – Sri Lanka
</footer>

</body>
</html>