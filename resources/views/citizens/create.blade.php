<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Member Information</h2>
                        <p class="mt-1 text-sm text-gray-600">Enter personal details to register a new member to a household.</p>
                    </header>

                    <form method="post" action="{{ route('citizens.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="nic" :value="__('NIC Number')" />
                            <x-text-input id="nic" name="nic" type="text" class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="full_name" :value="__('Full Name')" />
                            <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="household_id" :value="__('Assign to Household')" />
                            <select name="household_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach($households as $household)
                                    <option value="{{ $household->id }}">{{ $household->house_number }} - {{ $household->head_of_household }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Register Member') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>