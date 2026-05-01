<x-admin-layout>
    <x-slot name="title">Edit GN Division</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Edit GN Division</h2>
            <p class="text-sm text-gray-500 mt-1">Update official records for this Grama Niladhari division.</p>
        </div>

        <form action="{{ route('divisions.update', $division->id) }}" method="POST" class="space-y-6">
            @csrf 
            @method('PUT')
            <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-8 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Division Details</h3>
                </div>
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="division_code" class="block text-sm font-semibold text-gray-700 mb-2">Division Code <span class="text-brand-600">*</span></label>
                            <input type="text" name="division_code" id="division_code" required value="{{ old('division_code', $division->division_code) }}"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                            @error('division_code')
                                <p class="mt-2 text-xs text-brand-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="division_name" class="block text-sm font-semibold text-gray-700 mb-2">Division Name <span class="text-brand-600">*</span></label>
                            <input type="text" name="division_name" id="division_name" required value="{{ old('division_name', $division->division_name) }}"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                            @error('division_name')
                                <p class="mt-2 text-xs text-brand-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="divisional_secretariat" class="block text-sm font-semibold text-gray-700 mb-2">Divisional Secretariat <span class="text-brand-600">*</span></label>
                        <input type="text" name="divisional_secretariat" id="divisional_secretariat" required value="{{ old('divisional_secretariat', $division->divisional_secretariat) }}"
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                        @error('divisional_secretariat')
                            <p class="mt-2 text-xs text-brand-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6">
                <a href="{{ route('divisions.index') }}" class="px-8 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 shadow-md shadow-brand-200 transition-colors">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>