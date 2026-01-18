<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('GN Administrative Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="GET" action="{{ route('dashboard') }}" class="flex items-end gap-4">
                        <div class="flex-grow">
                            <x-input-label for="division_id" :value="__('Select GN Division to View Stats')" />
                            <select name="division_id" id="division_id" onchange="this.form.submit()" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Select Division --</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}" {{ $selectedDivisionId == $division->id ? 'selected' : '' }}>
                                        {{ $division->division_code }} - {{ $division->division_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            @if($selectedDivisionId)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <div class="bg-white overflow-hidden shadow sm:rounded-lg border-l-4 border-indigo-500">
                        <div class="p-6">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Citizens</p>
                            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow sm:rounded-lg border-l-4 border-blue-400">
                        <div class="p-6">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Gender Distribution</p>
                            <div class="mt-2 flex justify-between">
                                <div><span class="text-xs text-gray-400">Men</span> <p class="text-xl font-bold">{{ $stats['men'] }}</p></div>
                                <div><span class="text-xs text-gray-400">Women</span> <p class="text-xl font-bold">{{ $stats['women'] }}</p></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow sm:rounded-lg border-l-4 border-orange-400">
                        <div class="p-6">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Religion Distribution</p>
                            <div class="mt-2 flex justify-between">
                                <div><span class="text-xs text-gray-400">Buddhist</span> <p class="text-xl font-bold">{{ $stats['buddhist'] }}</p></div>
                                <div><span class="text-xs text-gray-400">Catholic</span> <p class="text-xl font-bold">{{ $stats['catholic'] }}</p></div>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="bg-blue-50 p-6 rounded-lg text-center text-blue-700">
                    <p>Please select a GN Division above to view statistics.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>