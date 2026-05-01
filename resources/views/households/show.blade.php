<x-admin-layout>
    <x-slot name="title">Household Details: {{ $household->house_number }}</x-slot>

    <div class="max-w-6xl mx-auto pb-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Household Details</h2>
                <p class="text-sm text-gray-500 mt-1">Full profile and resident information for this household.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('households.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                    Back to List
                </a>
                <a href="{{ route('households.edit', $household) }}" class="px-5 py-2.5 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 shadow-md shadow-brand-200 transition-colors">
                    Edit Household
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Household Overview Card -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Household Profile</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">House Number</p>
                                <p class="text-xl font-bold text-gray-900">{{ $household->house_number }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Head of Household</p>
                                <p class="text-sm font-bold text-gray-900">{{ $household->head_of_household }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">NIC (Head)</p>
                                <p class="text-sm font-semibold text-gray-600">{{ $household->nic ?? 'N/A' }}</p>
                            </div>
                            <div class="pt-4 border-t border-gray-50">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">GN Division</p>
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-1 bg-brand-50 text-brand-600 text-[10px] font-extrabold rounded border border-brand-100 uppercase">{{ $household->division->division_code }}</span>
                                    <p class="text-sm font-bold text-gray-900">{{ $household->division->division_name }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Full Address</p>
                                <p class="text-sm font-medium text-gray-700 leading-relaxed">{{ $household->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Residents List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-8 py-5 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Household Residents</h3>
                            <p class="text-[10px] text-gray-500 font-medium mt-0.5">List of citizens registered at this address.</p>
                        </div>
                        <span class="px-3 py-1 bg-brand-50 text-brand-600 text-xs font-bold rounded-lg border border-brand-100">
                            {{ $household->citizens->count() }} TOTAL
                        </span>
                    </div>

                    @if($household->citizens->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">
                                    <tr>
                                        <th class="px-8 py-4">Resident Name</th>
                                        <th class="px-8 py-4">NIC</th>
                                        <th class="px-8 py-4">Gender</th>
                                        <th class="px-8 py-4">Relationship</th>
                                        <th class="px-8 py-4"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-sm">
                                    @foreach($household->citizens as $citizen)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-8 py-4 font-bold text-gray-900">{{ $citizen->full_name }}</td>
                                            <td class="px-8 py-4 text-gray-500 font-medium">{{ $citizen->nic ?? 'N/A' }}</td>
                                            <td class="px-8 py-4">
                                                <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold border {{ $citizen->gender == 'Male' ? 'bg-blue-50 text-blue-600 border-blue-100' : 'bg-pink-50 text-pink-600 border-pink-100' }}">
                                                    {{ strtoupper($citizen->gender) }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-4 text-gray-600 font-medium italic">
                                                {{ $citizen->full_name === $household->head_of_household ? 'Head of Household' : 'Resident Member' }}
                                            </td>
                                            <td class="px-8 py-4 text-right">
                                                <a href="{{ route('citizens.show', $citizen) }}" class="text-xs font-bold text-brand-600 hover:text-brand-700">View Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 mb-1">No Residents Found</h3>
                            <p class="text-xs text-gray-500 mb-6">No citizens have been assigned to this household yet.</p>
                            <a href="{{ route('citizens.create', ['household_id' => $household->id]) }}" class="inline-flex items-center px-4 py-2 bg-brand-600 text-white text-xs font-bold rounded-xl hover:bg-brand-700 transition-colors">
                                + Add Member
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
