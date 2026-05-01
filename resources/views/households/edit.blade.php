<x-admin-layout>
    <x-slot name="title">Edit Household: {{ $household->house_number }}</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Update Household Information</h2>
            <p class="text-sm text-gray-500 mt-1">Modify the official records for this household below.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
            <form action="{{ route('households.update', $household->id) }}" method="POST" class="p-8 space-y-6">
                @csrf 
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="division_id" class="block text-sm font-semibold text-gray-700 mb-2">Assigned GN Division <span class="text-brand-600">*</span></label>
                        <select name="division_id" id="division_id" required
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('division_id') border-brand-500 @enderror">
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}" 
                                    {{ old('division_id', $household->division_id) == $division->id ? 'selected' : '' }}>
                                    {{ $division->division_code }} - {{ $division->division_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('division_id')
                            <p class="text-xs text-brand-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="house_number" class="block text-sm font-semibold text-gray-700 mb-2">House Number <span class="text-brand-600">*</span></label>
                        <input type="text" name="house_number" id="house_number" required
                            value="{{ old('house_number', $household->house_number) }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('house_number') border-brand-500 @enderror">
                        @error('house_number')
                            <p class="text-xs text-brand-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Registered Address <span class="text-brand-600">*</span></label>
                        <input type="text" name="address" id="address" required
                            value="{{ old('address', $household->address) }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('address') border-brand-500 @enderror">
                        @error('address')
                            <p class="text-xs text-brand-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="head_of_household" class="block text-sm font-semibold text-gray-700 mb-2">Head of Household Name <span class="text-brand-600">*</span></label>
                        <input type="text" name="head_of_household" id="head_of_household" required
                            value="{{ old('head_of_household', $household->head_of_household) }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('head_of_household') border-brand-500 @enderror">
                        @error('head_of_household')
                            <p class="text-xs text-brand-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nic" class="block text-sm font-semibold text-gray-700 mb-2">NIC Number</label>
                        <input type="text" name="nic" id="nic"
                            value="{{ old('nic', $household->nic) }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('nic') border-brand-500 @enderror">
                        @error('nic')
                            <p class="text-xs text-brand-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('households.index') }}" class="px-6 py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-brand-600 text-white font-semibold rounded-xl hover:bg-brand-700 shadow-md shadow-brand-200 transition-colors">
                        Update Household
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>