<x-admin-layout>
    <x-slot name="title">Citizen Profile: {{ $citizen->full_name }}</x-slot>

    <div class="max-w-5xl mx-auto">
        <!-- Profile Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
            <div class="flex items-center gap-5">
                <div class="w-20 h-20 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 border border-brand-100 shadow-sm shadow-brand-50">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ $citizen->full_name }}</h2>
                    <div class="flex flex-wrap items-center gap-3 mt-1">
                        <span class="px-2.5 py-0.5 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold border border-gray-200 uppercase tracking-wider">{{ $citizen->nic ?? 'NO NIC' }}</span>
                        <span class="text-gray-300">•</span>
                        <span class="text-sm text-gray-500 font-medium">{{ $citizen->division->division_name ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('citizens.edit', $citizen->id) }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    Edit Profile
                </a>
                <a href="{{ route('citizens.index') }}" class="px-5 py-2.5 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Back to List
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar Info -->
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-soft border border-gray-100">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Residential Status</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Household No</label>
                            <div class="flex items-center gap-2 font-bold text-gray-900">
                                <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                {{ $citizen->household->house_number ?? 'N/A' }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Registered Address</label>
                            <p class="text-sm font-medium text-gray-700 leading-relaxed">{{ $citizen->household->address ?? 'N/A' }}</p>
                        </div>
                        <div class="pt-4 border-t border-gray-50">
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Samurdhi Status</label>
                            @if($citizen->samurdhi_status)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 text-xs font-bold rounded-lg border border-green-100">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                    RECIPIENT
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-50 text-gray-500 text-xs font-bold rounded-lg border border-gray-200">
                                    NON-RECIPIENT
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-brand-600 p-6 rounded-2xl shadow-lg shadow-brand-100 text-white relative overflow-hidden">
                    <svg class="absolute -right-4 -bottom-4 w-24 h-24 text-brand-500 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/></svg>
                    <h4 class="text-brand-100 text-xs font-bold uppercase tracking-widest mb-1">Financial Data</h4>
                    <p class="text-2xl font-bold">Rs. {{ number_format($citizen->income_level, 2) }}</p>
                    <p class="text-brand-200 text-xs mt-1">Average Monthly Income</p>
                </div>
            </div>

            <!-- Main Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Identification & Personal -->
                <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-8 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Personal & Identification</h3>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                    </div>
                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-gray-400 uppercase">Date of Birth</label>
                            <p class="font-semibold text-gray-900 text-lg">{{ \Carbon\Carbon::parse($citizen->date_of_birth)->format('d M, Y') }}</p>
                            <p class="text-xs text-gray-500 font-medium">{{ \Carbon\Carbon::parse($citizen->date_of_birth)->age }} Years Old</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-gray-400 uppercase">Gender</label>
                            <p class="font-semibold text-gray-900 text-lg">{{ $citizen->gender }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-gray-400 uppercase">Religion</label>
                            <p class="font-semibold text-gray-900 text-lg">{{ $citizen->religion }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-gray-400 uppercase">Marital Status</label>
                            <p class="font-semibold text-gray-900 text-lg">{{ $citizen->marital_status }}</p>
                        </div>
                    </div>
                </div>

                <!-- Socio-Economic -->
                <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-8 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Socio-Economic Background</h3>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-gray-400 uppercase">Current Occupation</label>
                                <p class="font-semibold text-gray-900 text-lg">{{ $citizen->occupation ?? 'Unemployed / Not Stated' }}</p>
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-gray-400 uppercase">Education Level</label>
                                <p class="font-semibold text-gray-900 text-lg">{{ $citizen->education_level ?? 'Not Provided' }}</p>
                            </div>
                        </div>
                        @if($citizen->special_notes)
                            <div class="pt-6 border-t border-gray-50">
                                <label class="text-xs font-bold text-gray-400 uppercase block mb-3">Special Administrative Notes</label>
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 text-gray-700 text-sm italic leading-relaxed">
                                    "{{ $citizen->special_notes }}"
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>