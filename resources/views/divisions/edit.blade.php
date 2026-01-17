<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('GN Division Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Division Information') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Update this division's official code, name, and administrative secretariat.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('divisions.update', $division->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <label for="division_code" class="block font-medium text-sm text-gray-700">{{ __('Division Code') }}</label>
                                <input id="division_code" name="division_code" type="text" 
                                       class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                       value="{{ old('division_code', $division->division_code) }}" required autofocus />
                                @error('division_code')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="division_name" class="block font-medium text-sm text-gray-700">{{ __('Division Name') }}</label>
                                <input id="division_name" name="division_name" type="text" 
                                       class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                       value="{{ old('division_name', $division->division_name) }}" required />
                                @error('division_name')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="divisional_secretariat" class="block font-medium text-sm text-gray-700">{{ __('Divisional Secretariat') }}</label>
                                <input id="divisional_secretariat" name="divisional_secretariat" type="text" 
                                       class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                       value="{{ old('divisional_secretariat', $division->divisional_secretariat) }}" required />
                                @error('divisional_secretariat')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Save Changes') }}
                                </button>

                                @if (session('status') === 'division-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>