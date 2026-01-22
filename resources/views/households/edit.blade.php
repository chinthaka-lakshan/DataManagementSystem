<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Household: ') }} {{ $household->house_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <div class="mb-6 border-b pb-4">
                    <h2 class="text-lg font-medium text-gray-900">Update Household Information</h2>
                    <p class="mt-1 text-sm text-gray-600">Modify the official records for this household below.</p>
                </div>

                <form action="{{ route('households.update', $household->id) }}" method="POST">
                    @csrf 
                    @method('PUT') <div class="row g-4">
                        <div class="col-md-12 mb-3">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Assigned GN Division</label>
                            <select name="division_id" class="block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}" 
                                        {{ old('division_id', $household->division_id) == $division->id ? 'selected' : '' }}>
                                        {{ $division->division_code }} - {{ $division->division_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="block font-medium text-sm text-gray-700 mb-2">House Number</label>
                            <input type="text" name="house_number" 
                                   value="{{ old('house_number', $household->house_number) }}" 
                                   class="block w-full border-gray-300 rounded-md shadow-sm @error('house_number') border-red-500 @enderror">
                            @error('house_number') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Registered Address</label>
                            <input type="text" name="address" 
                                   value="{{ old('address', $household->address) }}" 
                                   class="block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Head of Household Name</label>
                            <input type="text" name="head_of_household" 
                                   value="{{ old('head_of_household', $household->head_of_household) }}" 
                                   class="block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 pt-4 border-t gap-3">
                        <a href="{{ route('households.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary" style="background-color: #003366; border: none;">
                            Update Household
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>