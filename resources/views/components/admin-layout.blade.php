<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Dashboard' }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased" x-data="{ sidebarOpen: true }">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside 
            class="bg-white border-r border-gray-100 w-72 flex-shrink-0 transition-all duration-300 fixed inset-y-0 z-50 lg:relative"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0 lg:w-20'">
            
            <div class="h-full flex flex-col">
                <!-- Sidebar Header -->
                <div class="h-20 flex items-center px-6 border-b border-gray-50 overflow-hidden">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-brand-200">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="font-extrabold text-xl tracking-tight text-gray-900 transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0'">
                            DMS <span class="text-brand-600">PRO</span>
                        </span>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
                    <x-nav-item href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" label="Dashboard" />
                    
                    <div class="pt-4 pb-2 px-3">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest" :class="sidebarOpen ? '' : 'hidden'">Management</p>
                        <div class="h-px bg-gray-50 my-2" :class="sidebarOpen ? 'hidden' : ''"></div>
                    </div>

                    @if(auth()->user()->role === 'admin')
                        <x-nav-item href="{{ route('users.index') }}" :active="request()->routeIs('users.*')" icon="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" label="User Management" />
                    @endif
                    <x-nav-item href="{{ route('divisions.index') }}" :active="request()->routeIs('divisions.*')" icon="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" label="GN Divisions" />
                    <x-nav-item href="{{ route('households.index') }}" :active="request()->routeIs('households.*')" icon="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14c0 4.418-7.163 8-16 8S8 28.418 8 24" label="Households" />
                    <x-nav-item href="{{ route('citizens.index') }}" :active="request()->routeIs('citizens.*')" icon="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" label="Citizens Registry" />
                    <x-nav-item href="{{ route('certificates.index') }}" :active="request()->routeIs('certificates.*')" icon="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" label="Certificates" />
                    
                    @if(auth()->user()->role === 'admin')
                        <div class="pt-4 pb-2 px-3">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest" :class="sidebarOpen ? '' : 'hidden'">Security</p>
                            <div class="h-px bg-gray-50 my-2" :class="sidebarOpen ? 'hidden' : ''"></div>
                        </div>
                        
                        <x-nav-item href="{{ route('activity-logs') }}" :active="request()->routeIs('activity-logs')" icon="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" label="Activity Logs" />
                    @endif
                </nav>

                <!-- Sidebar Footer -->
                <div class="p-4 border-t border-gray-50 bg-gray-50/50">
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-center gap-3 overflow-hidden">
                        <div class="w-10 h-10 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center font-bold flex-shrink-0">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 invisible w-0'">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Header -->
            <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-8 z-40">
                <div class="flex items-center gap-4">
                    <button 
                        @click="sidebarOpen = !sidebarOpen"
                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-50 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-lg font-bold text-gray-900 hidden md:block">{{ $title ?? 'Dashboard' }}</h1>
                </div>

                <div class="flex items-center gap-4">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 p-2 hover:bg-gray-50 rounded-xl transition-colors">
                            <span class="text-sm font-semibold text-gray-700">{{ auth()->user()->name }}</span>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div 
                            x-show="open" 
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-brand-600 font-semibold hover:bg-brand-50">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto p-8 bg-gray-50/50">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
