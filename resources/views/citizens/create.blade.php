<x-admin-layout>
    <x-slot name="title">Register New Citizen</x-slot>

    <div class="max-w-5xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Register New Citizen</h2>
            <p class="text-sm text-gray-500 mt-1">Add a new individual to the official database and assign them to a household.</p>
        </div>

        <form action="{{ route('citizens.store') }}" method="POST" class="space-y-6 pb-12">
            @csrf 

            <!-- Administrative Assignment -->
            <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-8 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Administrative Assignment</h3>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="division_id" class="block text-sm font-semibold text-gray-700 mb-2">GN Division <span class="text-brand-600">*</span></label>
                        <select name="division_id" id="division_id" required
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('division_id') border-brand-500 @enderror">
                            <option value="">-- Select Division --</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                    {{ $division->division_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('division_id') <p class="text-xs text-brand-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="household_id" class="block text-sm font-semibold text-gray-700 mb-2">Household (Address) <span class="text-brand-600">*</span></label>
                        <select name="household_id" id="household_id" required
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm @error('household_id') border-brand-500 @enderror">
                            <option value="">-- Select Household --</option>
                            @foreach($households as $household)
                                <option value="{{ $household->id }}" {{ old('household_id') == $household->id ? 'selected' : '' }}>
                                    {{ $household->house_number }} - {{ $household->address }}
                                </option>
                            @endforeach
                        </select>
                        @error('household_id') <p class="text-xs text-brand-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-8 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Personal Information</h3>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <label for="full_name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name <span class="text-brand-600">*</span></label>
                        <input type="text" name="full_name" id="full_name" required value="{{ old('full_name') }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
                            placeholder="Enter full name">
                        @error('full_name') <p class="text-xs text-brand-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="nic" class="block text-sm font-semibold text-gray-700 mb-2">NIC Number</label>
                        <input type="text" name="nic" id="nic" value="{{ old('nic') }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
                            placeholder="e.g. 19XXXXXXXXXX">
                        @error('nic') <p class="text-xs text-brand-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="date_of_birth" class="block text-sm font-semibold text-gray-700 mb-2">Date of Birth <span class="text-brand-600">*</span></label>
                        <input type="date" name="date_of_birth" id="date_of_birth" required value="{{ old('date_of_birth') }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">Gender <span class="text-brand-600">*</span></label>
                        <select name="gender" id="gender" required
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="religion" class="block text-sm font-semibold text-gray-700 mb-2">Religion <span class="text-brand-600">*</span></label>
                        <select name="religion" id="religion" required
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                            <option value="Buddhism">Buddhism</option>
                            <option value="Hinduism">Hinduism</option>
                            <option value="Islam">Islam</option>
                            <option value="Christianity">Christianity</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="marital_status" class="block text-sm font-semibold text-gray-700 mb-2">Marital Status <span class="text-brand-600">*</span></label>
                        <input type="text" name="marital_status" id="marital_status" required value="{{ old('marital_status') }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
                            placeholder="Single / Married">
                    </div>
                </div>
            </div>

            <!-- Status & Notes -->
            <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-8 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Social & Financial Status</h3>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="occupation" class="block text-sm font-semibold text-gray-700 mb-2">Occupation</label>
                        <input type="text" name="occupation" id="occupation" value="{{ old('occupation') }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
                            placeholder="Enter occupation">
                    </div>

                    <div>
                        <label for="education_level" class="block text-sm font-semibold text-gray-700 mb-2">Education Level</label>
                        <input type="text" name="education_level" id="education_level" value="{{ old('education_level') }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
                            placeholder="Highest qualification">
                    </div>

                    <div>
                        <label for="income_level" class="block text-sm font-semibold text-gray-700 mb-2">Monthly Income (LKR)</label>
                        <input type="number" name="income_level" id="income_level" step="0.01" value="{{ old('income_level') }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
                            placeholder="0.00">
                    </div>

                    <div class="flex items-center pt-8">
                        <label class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" name="samurdhi_status" value="1" {{ old('samurdhi_status') ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600"></div>
                            </div>
                            <span class="ms-3 text-sm font-semibold text-gray-700">Samurdhi Recipient</span>
                        </label>
                    </div>

                    <div class="md:col-span-2">
                        <label for="special_notes" class="block text-sm font-semibold text-gray-700 mb-2">Special Notes</label>
                        <textarea name="special_notes" id="special_notes" rows="3"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm"
                            placeholder="Any additional information...">{{ old('special_notes') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6">
                <a href="{{ route('citizens.index') }}" class="px-8 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 shadow-md shadow-brand-200 transition-colors">
                    Register Citizen
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>