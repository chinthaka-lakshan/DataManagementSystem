<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Citizen: ') }} {{ $citizen->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <form action="{{ route('citizens.update', $citizen) }}" method="POST">
                @csrf 
                @method('PUT')<div class="mb-6 border-b pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Administrative Assignment</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <x-input-label for="division_id" :value="__('GN Division')" />
                                <select name="division_id" id="division_id" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}" {{ old('division_id', $citizen->division_id) == $division->id ? 'selected' : '' }}>
                                            {{ $division->division_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="household_id" :value="__('Household (Address)')" />
                                <select name="household_id" id="household_id" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    @foreach($households as $household)
                                        <option value="{{ $household->id }}" {{ old('household_id', $citizen->household_id) == $household->id ? 'selected' : '' }}>
                                            {{ $household->house_number }} - {{ $household->address }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 border-b pb-4">
                        <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <x-input-label for="full_name" :value="__('Full Name')" />
                                <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name', $citizen->full_name)" required />
                            </div>

                            <div>
                                <x-input-label for="nic" :value="__('NIC Number')" />
                                <x-text-input id="nic" name="nic" type="text" class="mt-1 block w-full" :value="old('nic', $citizen->nic)" />
                            </div>

                            <div>
                                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth', $citizen->date_of_birth)" required />
                            </div>

                            <div>
                                <x-input-label for="gender" :value="__('Gender')" />
                                <select name="gender" class="block w-full border-gray-300 rounded-md shadow-sm">
                                    @foreach(['Male', 'Female', 'Other'] as $gender)
                                        <option value="{{ $gender }}" {{ old('gender', $citizen->gender) == $gender ? 'selected' : '' }}>{{ $gender }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="religion" :value="__('Religion')" />
                                <select name="religion" class="block w-full border-gray-300 rounded-md shadow-sm">
                                    @foreach(['Buddhism', 'Hinduism', 'Islam', 'Christianity', 'Other'] as $rel)
                                        <option value="{{ $rel }}" {{ old('religion', $citizen->religion) == $rel ? 'selected' : '' }}>{{ $rel }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="marital_status" :value="__('Marital Status')" />
                                <x-text-input id="marital_status" name="marital_status" type="text" class="mt-1 block w-full" :value="old('marital_status', $citizen->marital_status)" required />
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Social & Financial Status</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <x-input-label for="occupation" :value="__('Occupation')" />
                                <x-text-input id="occupation" name="occupation" type="text" class="mt-1 block w-full" :value="old('occupation', $citizen->occupation)" />
                            </div>

                            <div>
                                <x-input-label for="education_level" :value="__('Education Level')" />
                                <x-text-input id="education_level" name="education_level" type="text" class="mt-1 block w-full" :value="old('education_level', $citizen->education_level)" />
                            </div>

                            <div>
                                <x-input-label for="income_level" :value="__('Monthly Income')" />
                                <x-text-input id="income_level" name="income_level" type="number" step="0.01" class="mt-1 block w-full" :value="old('income_level', $citizen->income_level)" />
                            </div>

                            <div class="flex items-center mt-6">
                                <input id="samurdhi_status" name="samurdhi_status" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('samurdhi_status', $citizen->samurdhi_status) ? 'checked' : '' }}>
                                <label for="samurdhi_status" class="ms-2 text-sm text-gray-600">{{ __('Samurdhi Recipient') }}</label>
                            </div>

                            <div class="col-span-2">
                                <x-input-label for="special_notes" :value="__('Special Notes')" />
                                <textarea id="special_notes" name="special_notes" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('special_notes', $citizen->special_notes) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-3 pt-4 border-t">
                        <a href="{{ route('citizens.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <x-primary-button>{{ __('Update Citizen Record') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>