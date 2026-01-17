<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New GN Division') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-4">
                    <h4 class="text-secondary">Division Details</h4>
                    <p class="text-sm text-muted">Enter the official details from the Divisional Secretariat.</p>
                </div>

                <form action="{{ route('divisions.store') }}" method="POST">
                    @csrf <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="division_code" class="form-label font-bold">Division Code</label>
                            <input type="text" 
                                   name="division_code" 
                                   id="division_code"
                                   class="form-control @error('division_code') is-invalid @enderror" 
                                   placeholder="e.g. 602-C" 
                                   value="{{ old('division_code') }}" 
                                   required>
                            @error('division_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="division_name" class="form-label font-bold">Division Name</label>
                            <input type="text" 
                                   name="division_name" 
                                   id="division_name"
                                   class="form-control @error('division_name') is-invalid @enderror" 
                                   placeholder="e.g. Kottawa North" 
                                   value="{{ old('division_name') }}" 
                                   required>
                            @error('division_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label for="divisional_secretariat" class="form-label font-bold">Divisional Secretariat</label>
                            <input type="text" 
                                   name="divisional_secretariat" 
                                   id="divisional_secretariat"
                                   class="form-control @error('divisional_secretariat') is-invalid @enderror" 
                                   placeholder="e.g. Maharagama" 
                                   value="{{ old('divisional_secretariat') }}" 
                                   required>
                            @error('divisional_secretariat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('divisions.index') }}" class="btn btn-outline-secondary me-2">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary px-4" style="background-color: #003366; border: none;">
                            Save Division
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">