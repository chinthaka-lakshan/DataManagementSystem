<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Grama Niladhari Division Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            font-family: 'Figtree', sans-serif;
        }
        .auth-card {
            border-radius: 16px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.1);
        }
        .system-title {
            font-weight: 600;
            letter-spacing: 0.4px;
        }
        .system-badge {
            background: #800000;
            color: #fff;
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 justify-content-center">
            <div class="col-md-7 col-lg-5">

                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="system-badge">
                        Government Administration System
                    </div>
                    <h3 class="system-title mt-2">
                        Grama Niladhari Division<br>
                        Management System
                    </h3>
                    <p class="text-muted small mt-2">
                        Digital management of citizen, household, and division records
                    </p>
                </div>

                <!-- Auth Card -->
                <div class="card auth-card">
                    <div class="card-body p-4">
                        {{ $slot }}
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center mt-3 text-muted small">
                    © {{ date('Y') }} Grama Niladhari Department – Sri Lanka <br>
                    Developed by <strong>DeepNix Software Solutions</strong>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
