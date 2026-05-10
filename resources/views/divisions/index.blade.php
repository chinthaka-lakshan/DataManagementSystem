<x-admin-layout>
    <x-slot name="title">GN Division Management</x-slot>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">GN Division Management</h2>
            <p class="text-sm text-gray-500 mt-1">Overview of Grama Niladhari divisions</p>
        </div>
        @if(auth()->user()->role === 'user')
            <a href="{{ route('divisions.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl shadow-md shadow-brand-200 transition-all duration-200 gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Add New Division
            </a>
        @endif
    </div>

    @if(auth()->user()->role === 'admin')
        <div class="bg-white p-6 rounded-2xl shadow-soft border border-gray-100 mb-8 flex items-center gap-4">
            <div class="flex-1">
                <label for="gn_user_id" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Filter by GN Officer</label>
                <form action="{{ route('divisions.index') }}" method="GET">
                    <select name="gn_user_id" id="gn_user_id" onchange="this.form.submit()" 
                        class="block w-full px-4 py-2.5 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm transition-all duration-200">
                        <option value="">-- All GN Officers --</option>
                        @foreach($gnUsers as $user)
                            <option value="{{ $user->id }}" {{ ($selectedGnUserId ?? '') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            @if($selectedGnUserId)
                <div class="pt-6">
                    <a href="{{ route('divisions.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">Clear Filter</a>
                </div>
            @endif
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($divisions as $division)
            <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden group hover:border-brand-100 transition-all duration-300">
                <div class="p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-14 h-14 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-lg text-[10px] font-extrabold uppercase tracking-widest border border-gray-200">{{ $division->division_code }}</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $division->division_name }}</h3>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed">{{ $division->divisional_secretariat }}</p>
                    
                    @if(auth()->user()->role === 'admin')
                        <div class="mt-4 pt-4 border-t border-gray-50">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">GN Officer</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $division->user->name ?? 'Unassigned' }}</p>
                        </div>
                    @endif

                    <div class="mt-6"></div>
                    
                    <div class="grid grid-cols-2 gap-4 py-4 border-y border-gray-50">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Households</p>
                            <p class="text-lg font-bold text-gray-900">{{ $division->households_count ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Citizens</p>
                            <p class="text-lg font-bold text-gray-900">{{ $division->citizens_count ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50/50 px-8 py-4 flex items-center justify-between">
                    @if(auth()->user()->role === 'user')
                        <a href="{{ route('dashboard', ['division_id' => $division->id]) }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 transition-colors">View Analytics →</a>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('divisions.edit', $division->id) }}" class="p-2 text-gray-400 hover:text-brand-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </a>
                        </div>
                    @else
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">View Only Mode</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-12 rounded-3xl border-2 border-dashed border-gray-100 text-center">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">No Divisions Found</h3>
                <p class="text-sm text-gray-500 mb-6">No Grama Niladhari divisions are currently registered or match your filters.</p>
                @if(auth()->user()->role === 'user')
                    <a href="{{ route('divisions.create') }}" class="inline-flex items-center px-6 py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition-colors">
                        + Add New Division
                    </a>
                @endif
<<<<<<< HEAD
=======

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Division Code</th>
                                <th>Division Name</th>
                                <th>Divisional Secretariat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($divisions as $division)
                                <tr>
                                    <td>{{ $division->division_code }}</td>
                                    <td>{{ $division->division_name }}</td>
                                    <td>{{ $division->divisional_secretariat }}</td>
                                    <td>
                                        <a href="{{ route('divisions.edit', $division->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No divisions found. Start by adding one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

>>>>>>> 45718a9 (occupation auto complete update)
            </div>
        @endforelse
    </div>
</x-admin-layout>