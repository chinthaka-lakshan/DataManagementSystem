<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Citizen Profile: ') }} {{ $citizen->full_name }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('citizens.edit', $citizen->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                    Edit Profile
                </a>
                <a href="{{ route('citizens.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Personal & Identification Details</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Full Name</p>
                        <p class="font-semibold text-gray-900">{{ $citizen->full_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">NIC Number</p>
                        <p class="font-semibold text-gray-900">{{ $citizen->nic ?? 'Not Provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Date of Birth</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($citizen->date_of_birth)->format('d M, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Gender</p>
                        <p class="font-semibold text-gray-900">{{ $citizen->gender }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Religion</p>
                        <p class="font-semibold text-gray-900">{{ $citizen->religion }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Marital Status</p>
                        <p class="font-semibold text-gray-900">{{ $citizen->marital_status }}</p>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Residential & Administrative Information</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">GN Division</p>
                        <p class="font-semibold text-gray-900">{{ $citizen->division->division_name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Household Number</p>
                        <p class="font-semibold text-gray-900">{{ $citizen->household->house_number ?? 'N/A' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500">Registered Address</p>
                        <p class="font-semibold text-gray-900">{{ $citizen->household->address ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Socio-Economic & Financial Status</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Occupation</p>
                        <p class="font-semibold text-gray-900">{{ $citizen->occupation ?? 'Unemployed/Not Stated' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Education Level</p>
                        <p class="font-semibold text-gray-900">{{ $citizen->education_level ?? 'Not Stated' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Monthly Income</p>
                        <p class="font-semibold text-gray-900">Rs. {{ number_format($citizen->income_level, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Samurdhi Status</p>
                        <span class="px-2 py-1 rounded text-xs {{ $citizen->samurdhi_status ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $citizen->samurdhi_status ? 'Recipient' : 'Non-Recipient' }}
                        </span>
                    </div>
                </div>
                @if($citizen->special_notes)
                    <div class="mt-6 p-4 bg-gray-50 rounded-md">
                        <p class="text-sm text-gray-500 mb-1">Special Notes</p>
                        <p class="text-gray-700 italic">{{ $citizen->special_notes }}</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>