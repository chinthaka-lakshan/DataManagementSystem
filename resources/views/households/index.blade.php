<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Household Management') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-5 p-4 bg-light rounded border shadow-sm">
    <form action="{{ route('households.index') }}" method="GET" class="row g-3 align-items-end">
        
        <div class="col-md-5">
            <label for="search" class="form-label fw-bold text-secondary small uppercase">Search Household</label>
            <input type="text" name="search" id="search" class="form-control border-primary" 
                   placeholder="Search by Address, No, or Head Name..." 
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <label for="division_id" class="form-label fw-bold text-secondary small uppercase">GN Division</label>
            <select name="division_id" id="division_id" class="form-select border-primary" onchange="this.form.submit()">
                <option value="">-- All Divisions --</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}" {{ $selectedDivision == $division->id ? 'selected' : '' }}>
                        {{ $division->division_code }} - {{ $division->division_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100 shadow-sm">Search</button>
                <a href="{{ route('households.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </div>
    </form>
</div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0 text-dark fw-bold">Household Records</h4>
                    <a href="{{ route('households.create') }}" class="btn btn-primary px-4 shadow">
                        + Add New Household
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 15%">House No</th>
                                <th>Address</th>
                                <th>Head of Household</th>
                                <th>GN Division</th>
                                <th style="width: 20%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($households as $household)
                                <tr>
                                    <td class="fw-bold text-primary">{{ $household->house_number }}</td>
                                    <td>{{ $household->address }}</td>
                                    <td>{{ $household->head_of_household }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ $household->division->division_name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('households.edit', $household->id) }}" class="btn btn-sm btn-primary">
                                                Edit
                                            </a>

                                            <form action="{{ route('households.destroy', $household->id) }}" method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this household? This may affect registered citizens.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                        <div class="py-4">
                                            <p class="mb-0">No households found for this selection.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>