<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DMS PRO - Authentication</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-50 selection:bg-brand-100 selection:text-brand-900">
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Orbs -->
        <div class="absolute top-0 -left-4 w-72 h-72 bg-brand-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

        <div class="relative w-full max-w-lg px-6">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-brand-600 rounded-3xl shadow-xl shadow-brand-100 mb-6 transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">DMS <span class="text-brand-600">PRO</span></h1>
                <p class="text-gray-500 font-medium">Citizen & Household Management Portal</p>
            </div>

            <div class="bg-white/80 backdrop-blur-xl p-10 rounded-[2.5rem] shadow-2xl shadow-gray-200/50 border border-white/50">
                {{ $slot }}
            </div>

            <p class="text-center mt-10 text-sm font-bold text-gray-400 uppercase tracking-[0.2em]">
                Secure Administrative Access Only
            </p>
        </div>
    </div>
</body>
</html>
