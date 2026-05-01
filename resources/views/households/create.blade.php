<x-admin-layout>
    <x-slot name="title">Register New Household</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Household Information</h2>
            <p class="text-sm text-gray-500 mt-1">Assign a unique household number and registered address to a GN Division.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
            <form action="{{ route('households.store') }}" method="POST" class="p-8 space-y-6">
                @csrf 
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="division_id" class="block text-sm font-semibold text-gray-700 mb-2">Assigned GN Division <span class="text-brand-600">*</span></label>
                        <select name="division_id" id="division_id" required
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('division_id') border-brand-500 @enderror">
                            <option value="">-- Select Division --</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
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
                            value="{{ old('house_number') }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('house_number') border-brand-500 @enderror"
                            placeholder="e.g. KOT/102/2026">
                        @error('house_number')
                            <p class="text-xs text-brand-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Registered Address <span class="text-brand-600">*</span></label>
                        <input type="text" name="address" id="address" required
                            value="{{ old('address') }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('address') border-brand-500 @enderror"
                            placeholder="House No, Street Name, Town">
                        @error('address')
                            <p class="text-xs text-brand-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="head_of_household" class="block text-sm font-semibold text-gray-700 mb-2">Head of Household Name <span class="text-brand-600">*</span></label>
                        <input type="text" name="head_of_household" id="head_of_household" required
                            value="{{ old('head_of_household') }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('head_of_household') border-brand-500 @enderror"
                            placeholder="Full Name">
                        @error('head_of_household')
                            <p class="text-xs text-brand-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nic" class="block text-sm font-semibold text-gray-700 mb-2">NIC Number</label>
                        <input type="text" name="nic" id="nic"
                            value="{{ old('nic') }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('nic') border-brand-500 @enderror"
                            placeholder="e.g. 199012345678 or 901234567V">
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
                        Save Household
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>