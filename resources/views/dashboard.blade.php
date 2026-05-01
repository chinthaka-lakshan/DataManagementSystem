<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    @if(auth()->user()->role === 'admin')
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">System Administrator Dashboard</h2>
            <p class="text-sm text-gray-500 mt-1">Overview of system health and user access</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-soft">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-purple-50 rounded-xl text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <h4 class="font-bold text-gray-900">Total System Users</h4>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($totalUsers ?? 0) }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-soft">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-green-50 rounded-xl text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h4 class="font-bold text-gray-900">Active Accounts</h4>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($activeUsersCount ?? 0) }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-soft">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-orange-50 rounded-xl text-orange-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    </div>
                    <h4 class="font-bold text-gray-900">Registered GN Divisions</h4>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($totalDivisions ?? 0) }}</p>
            </div>
        </div>

        <!-- Active Users Table -->
        <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden mb-8">
            <div class="bg-gray-50 px-8 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Recently Active Users</h3>
                <span class="px-3 py-1 bg-green-50 text-green-600 text-xs font-bold rounded-lg border border-green-100">ACTIVE</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($activeUsers as $user)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-gray-500">
                                    <span class="px-2 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                                        Active
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">GN Administrative Dashboard</h2>
            <p class="text-sm text-gray-500 mt-1">Real-time statistics and management for your assigned divisions</p>
        </div>
        <form method="GET" action="{{ route('dashboard') }}" class="w-full md:w-auto">
            <select name="division_id" id="division_id" onchange="this.form.submit()" 
                class="block w-full md:w-64 px-4 py-2.5 border border-gray-200 rounded-xl bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 text-sm font-semibold transition-all">
                <option value="">All Divisions</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}" {{ $selectedDivisionId == $division->id ? 'selected' : '' }}>
                        {{ $division->division_code }} - {{ $division->division_name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-soft">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-brand-50 rounded-xl text-brand-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <h4 class="font-bold text-gray-900">Total Citizens</h4>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total']) }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-soft">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <h4 class="font-bold text-gray-900">Men</h4>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['men']) }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-soft">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-pink-50 rounded-xl text-pink-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <h4 class="font-bold text-gray-900">Women</h4>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['women']) }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-soft">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-orange-50 rounded-xl text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                </div>
                <h4 class="font-bold text-gray-900">Divisions</h4>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $divisions->count() }}</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-soft">
            <h4 class="text-lg font-bold text-gray-900 mb-6">Gender Distribution</h4>
            <div class="h-64">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-soft">
            <h4 class="text-lg font-bold text-gray-900 mb-6">Religion Distribution</h4>
            <div class="h-64">
                <canvas id="religionChart"></canvas>
            </div>
        </div>
    </div>

    @if($selectedDivisionId)
        <div class="space-y-8">
            <!-- Households Table -->
            <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-8 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Households in Division</h3>
                    <span class="px-3 py-1 bg-brand-50 text-brand-600 text-xs font-bold rounded-lg border border-brand-100">{{ $households->count() }} TOTAL</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4">House No</th>
                                <th class="px-6 py-4">Address</th>
                                <th class="px-6 py-4">Head of Household</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach($households as $household)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 font-bold text-brand-600">{{ $household->house_number }}</td>
                                    <td class="px-6 py-4 text-gray-700 font-medium">{{ $household->address }}</td>
                                    <td class="px-6 py-4 text-gray-900 font-semibold">{{ $household->head_of_household }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Citizens Table -->
            <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-8 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Registered Citizens</h3>
                    <span class="px-3 py-1 bg-brand-50 text-brand-600 text-xs font-bold rounded-lg border border-brand-100">{{ $citizens->count() }} TOTAL</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4">NIC</th>
                                <th class="px-6 py-4">Full Name</th>
                                <th class="px-6 py-4">Gender</th>
                                <th class="px-6 py-4">Household No</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach($citizens as $citizen)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-500">{{ $citizen->nic ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $citizen->full_name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-lg text-xs font-bold border {{ $citizen->gender == 'Male' ? 'bg-blue-50 text-blue-600 border-blue-100' : 'bg-pink-50 text-pink-600 border-pink-100' }}">
                                            {{ strtoupper($citizen->gender) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-brand-600">
                                        {{ $citizen->household->house_number ?? 'N/A' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="bg-brand-50 rounded-2xl p-12 text-center border-2 border-dashed border-brand-100">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-brand-600 mx-auto mb-4 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Division Selection Required</h3>
            <p class="text-gray-600 max-w-sm mx-auto">Please select a specific GN Division from the dropdown menu to view detailed analytics and citizen records.</p>
        </div>
        </div>
    @endif
    @endif
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartConfig = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { weight: '600' } } }
                }
            };

            // Gender Chart
            new Chart(document.getElementById('genderChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Men', 'Women'],
                    datasets: [{
                        data: [{{ $stats['men'] ?? 0 }}, {{ $stats['women'] ?? 0 }}],
                        backgroundColor: ['#3B82F6', '#EC4899'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    ...chartConfig,
                    cutout: '70%'
                }
            });

            // Religion Chart
            new Chart(document.getElementById('religionChart'), {
                type: 'bar',
                data: {
                    labels: ['Buddhism', 'Christianity'],
                    datasets: [{
                        label: 'Citizen Count',
                        data: [{{ $stats['buddhism'] ?? 0 }}, {{ $stats['christianity'] ?? 0 }}],
                        backgroundColor: '#DC2626',
                        borderRadius: 8,
                        barThickness: 40
                    }]
                },
                options: {
                    ...chartConfig,
                    scales: {
                        y: { beginAtZero: true, grid: { display: false } },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
    @endpush
</x-admin-layout>