<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Household') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <div class="mb-6 border-b pb-4">
                    <h2 class="text-lg font-medium text-gray-900">Household Information</h2>
                    <p class="mt-1 text-sm text-gray-600">Assign a unique household number and registered address to a GN Division.</p>
                </div>

                <form action="{{ route('households.store') }}" method="POST">
                    @csrf 
                    
                    <div class="row g-4">
                        <div class="col-md-12 mb-3">
                            <label for="division_id" class="block font-medium text-sm text-gray-700 mb-2">Assigned GN Division <span class="text-danger">*</span></label>
                            <select name="division_id" 
                                    id="division_id" 
                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('division_id') border-red-500 @enderror" 
                                    required>
                                <option value="">-- Select Division --</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                        {{ $division->division_code }} - {{ $division->division_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('division_id')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="household_number" class="block font-medium text-sm text-gray-700 mb-2">House Number <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="house_number" 
                                   id="house_number"
                                   class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('house_number') border-red-500 @enderror" 
                                   placeholder="e.g. KOT/102/2026" 
                                   value="{{ old('house_number') }}" 
                                   required>
                            @error('house_number')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="address" class="block font-medium text-sm text-gray-700 mb-2">Registered Address <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="address" 
                                   id="address"
                                   class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('address') border-red-500 @enderror" 
                                   placeholder="House No, Street Name, Town" 
                                   value="{{ old('address') }}" 
                                   required>
                            @error('address')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3"> <label for="head_of_household" class="block font-medium text-sm text-gray-700 mb-2">
                            Head of Household Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                            name="head_of_household" 
                            id="head_of_household"
                            class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm @error('head_of_household') border-red-500 @enderror" 
                            placeholder="Full Name of the head of the family" 
                            value="{{ old('head_of_household') }}" 
                            required>
                        @error('head_of_household')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 pt-4 border-t gap-3">
                        <a href="{{ route('households.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Save Household
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">