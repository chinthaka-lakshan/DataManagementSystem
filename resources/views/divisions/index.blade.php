<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('GN Division Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">All GN Divisions</h4>
                    <a href="{{ route('divisions.create') }}" class="btn btn-primary">
                        + Add New Division
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Division Code</th>
                                <th>Division Name</th>
                                <th>Divisional Secretariat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($divisions as $division)
                                <tr>
                                    <td>{{ $division->division_code }}</td>
                                    <td>{{ $division->division_name }}</td>
                                    <td>{{ $division->divisional_secretariat }}</td>
                                    <td>
                                        <a href="{{ route('divisions.edit', $division->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No divisions found. Start by adding one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">