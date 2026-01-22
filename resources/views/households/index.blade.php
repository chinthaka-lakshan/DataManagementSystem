<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Household Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">All Households</h4>
                    <a href="{{ route('households.create') }}" class="btn btn-primary">
                        + Add New Household
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Household Number</th>
                                <th>Address</th>
                                <th>Head of Household</th>
                                <th>Division</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($households as $household)
                                <tr>
                                    <td>{{ $household->house_number }}</td>
                                    <td>{{ $household->address }}</td>
                                    <td>{{ $household->head_of_household }}</td>
                                    <td>{{ $household->division->division_name }}</td>
                                    <td>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('households.edit', $household->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                                        <form action="{{ route('households.destroy', $household->id) }}" method="POST" 
                                            onsubmit="return confirm('Are you sure you want to delete this household?');">
                                            @csrf
                                            @method('DELETE') <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No households found. Start by adding one.</td>
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