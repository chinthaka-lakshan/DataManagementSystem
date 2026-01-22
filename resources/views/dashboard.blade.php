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
                                <div><span class="text-xs text-gray-400">Buddhis</span> <p class="text-xl font-bold">{{ $stats['buddhism'] }}</p></div>
                                <div><span class="text-xs text-gray-400">Christianity</span> <p class="text-xl font-bold">{{ $stats['christianity'] }}</p></div>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="bg-blue-50 p-6 rounded-lg text-center text-blue-700">
                    <p>Please select a GN Division above to view statistics.</p>
                </div>
            @endif

            @if($selectedDivisionId)
    <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 mt-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Households in this Division</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th class="px-4 py-2">House No</th>
                        <th class="px-4 py-2">Address</th>
                        <th class="px-4 py-2">Head of Household</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($households as $household)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 font-bold">{{ $household->house_number }}</td>
                            <td class="px-4 py-2">{{ $household->address }}</td>
                            <td class="px-4 py-2">{{ $household->head_of_household }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6 mt-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Registered Citizens</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th class="px-4 py-2">NIC</th>
                        <th class="px-4 py-2">Full Name</th>
                        <th class="px-4 py-2">Gender</th>
                        <th class="px-4 py-2">Household No</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citizens as $citizen)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 font-medium">{{ $citizen->nic }}</td>
                            <td class="px-4 py-2">{{ $citizen->full_name }}</td>
                            <td class="px-4 py-2">{{ $citizen->gender }}</td>
                            <td class="px-4 py-2 text-indigo-600 font-bold">
                                {{ $citizen->household->house_number ?? 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

        </div>
    </div>
</x-app-layout>