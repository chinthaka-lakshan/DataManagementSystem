<x-admin-layout>
    <x-slot name="title">Certificate Management</x-slot>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Certificate Management</h2>
            <p class="text-sm text-gray-500 mt-1">Issue and manage official certificates for citizens</p>
        </div>
        <button onclick="alert('Issuance workflow under development')" class="inline-flex items-center justify-center px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl shadow-md shadow-brand-200 transition-all duration-200 gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Issue New Certificate
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-soft">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-brand-50 rounded-xl text-brand-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h4 class="font-bold text-gray-900">Total Issued</h4>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $certificates->count() }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-soft">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h4 class="font-bold text-gray-900">Pending Requests</h4>
            </div>
            <p class="text-3xl font-bold text-gray-900">0</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-soft">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-green-50 rounded-xl text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                </div>
                <h4 class="font-bold text-gray-900">Verified</h4>
            </div>
            <p class="text-3xl font-bold text-gray-900">0</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Reference No</th>
                        <th class="px-6 py-4">Citizen Name</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Issued Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($certificates as $cert)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-brand-600">
                                #{{ $cert->id }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $cert->citizen_name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold border border-blue-100">
                                    {{ $cert->certificate_type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                                {{ $cert->created_at->format('d M, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="p-2 text-gray-400 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition-all duration-200" title="Download">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    <p class="font-medium">No certificates issued yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
