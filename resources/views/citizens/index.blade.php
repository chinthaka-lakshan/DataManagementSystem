<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Citizen Registry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <form action="{{ route('citizens.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                        
                        <div class="flex-grow w-full">
                            <x-input-label for="search" :value="__('Search Citizen')" class="mb-1" />
                            <x-text-input name="search" id="search" placeholder="Search by NIC or Name..." class="w-full" value="{{ request('search') }}" />
                        </div>

                        <div class="w-full md:w-1/3">
                            <x-input-label for="division_id" :value="__('Filter by GN Division')" class="mb-1" />
                            <select name="division_id" id="division_id" onchange="this.form.submit()" 
                                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- All Divisions --</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                        {{ $division->division_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex gap-2">
                            <x-primary-button>Search</x-primary-button>
                            <a href="{{ route('citizens.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <div class="flex justify-end mb-6">
                    <a href="{{ route('citizens.create') }}" class="btn btn-primary px-4 py-2 rounded shadow text-white" style="background-color: #003366;">
                        + Register Citizen
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">NIC Number</th>
                                <th class="px-6 py-3">Full Name</th>
                                <th class="px-6 py-3">Household</th>
                                <th class="px-6 py-3">Division</th>
                                <th class="px-6 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white border-b">
                            @forelse($citizens as $citizen)
                                <tr class="hover:bg-gray-50 border-b">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $citizen->nic }}</td>
                                    <td class="px-6 py-4">{{ $citizen->full_name }}</td>
                                    <td class="px-6 py-4">{{ $citizen->household->house_number ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">{{ $citizen->division->division_name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center items-center gap-2">
                                            <a href="{{ route('citizens.show', $citizen->id) }}" 
                                               class="inline-flex items-center px-3 py-1.5 bg-green-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 transition">
                                                View
                                            </a>

                                            <a href="{{ route('citizens.edit', $citizen->id) }}" 
                                               class="inline-flex items-center px-3 py-1.5 bg-blue-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 transition">
                                                Edit
                                            </a>

                                            <form action="{{ route('citizens.destroy', $citizen->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 font-medium">
                                        No citizens found. Please register a new citizen or check your search criteria.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $citizens->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>