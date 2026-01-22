<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Citizen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <form action="{{ route('citizens.store') }}" method="POST">
                    @csrf 

                    <div class="mb-6 border-b pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Administrative Assignment</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <x-input-label for="division_id" :value="__('GN Division')" />
                                <select name="division_id" id="division_id" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('division_id') border-red-500 @enderror" required>
                                    <option value="">-- Select Division --</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                            {{ $division->division_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('division_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <x-input-label for="household_id" :value="__('Household (Address)')" />
                                <select name="household_id" id="household_id" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('household_id') border-red-500 @enderror" required>
                                    <option value="">-- Select Household --</option>
                                    @foreach($households as $household)
                                        <option value="{{ $household->id }}" {{ old('household_id') == $household->id ? 'selected' : '' }}>
                                            {{ $household->house_number }} - {{ $household->address }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('household_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 border-b pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <x-input-label for="full_name" :value="__('Full Name')" />
                                <x-text-input id="full_name" name="full_name" type="text" placeholder="Enter full name" class="mt-1 block w-full" :value="old('full_name')" required />
                                @error('full_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <x-input-label for="nic" :value="__('NIC Number (Optional)')" />
                                <x-text-input id="nic" name="nic" type="text" placeholder="Enter NIC number" class="mt-1 block w-full" :value="old('nic')" />
                                @error('nic') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth')" required />
                                @error('date_of_birth') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <x-input-label for="gender" :value="__('Gender')" />
                                <select name="gender" class="block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div>
                                <x-input-label for="religion" :value="__('Religion')" />
                                <select name="religion" class="block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="Buddhism">Buddhism</option>
                                    <option value="Hinduism">Hinduism</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Christianity">Christianity</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div>
                                <x-input-label for="marital_status" :value="__('Marital Status')" />
                                <x-text-input id="marital_status" name="marital_status" type="text" class="mt-1 block w-full" :value="old('marital_status')" placeholder="e.g. Single/Married" required />
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Social & Financial Status</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <x-input-label for="occupation" :value="__('Occupation')" />
                                <x-text-input id="occupation" name="occupation" type="text" placeholder="Enter occupation" class="mt-1 block w-full" :value="old('occupation')" />
                            </div>

                            <div>
                                <x-input-label for="education_level" :value="__('Education Level')" />
                                <x-text-input id="education_level" name="education_level" type="text" placeholder="Enter education level" class="mt-1 block w-full" :value="old('education_level')" />
                            </div>

                            <div>
                                <x-input-label for="income_level" :value="__('Monthly Income')" />
                                <x-text-input id="income_level" name="income_level" type="number" step="0.01" placeholder="Enter monthly income" class="mt-1 block w-full" :value="old('income_level')" />
                            </div>

                            <div class="flex items-center mt-6">
                                <input id="samurdhi_status" name="samurdhi_status" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('samurdhi_status') ? 'checked' : '' }}>
                                <label for="samurdhi_status" class="ms-2 text-sm text-gray-600">{{ __('Samurdhi Recipient') }}</label>
                            </div>

                            <div class="col-md-12">
                                <x-input-label for="special_notes" :value="__('Special Notes')" />
                                <textarea id="special_notes" name="special_notes" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('special_notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-3">
                        <a href="{{ route('citizens.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <x-primary-button>{{ __('Register Citizen') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>