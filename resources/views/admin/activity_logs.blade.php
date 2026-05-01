<x-admin-layout>
    <x-slot name="title">System Activity Logs</x-slot>

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Activity Audit Trail</h2>
        <p class="text-sm text-gray-500 mt-1">Monitor all administrative actions and system changes</p>
    </div>

    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Timestamp</th>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Action</th>
                        <th class="px-6 py-4">Resource</th>
                        <th class="px-6 py-4 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @php
                        $logs = [
                            ['time' => '2 mins ago', 'user' => 'Admin User', 'action' => 'CREATE', 'resource' => 'Citizen: John Doe', 'status' => 'Success'],
                            ['time' => '1 hour ago', 'user' => 'Admin User', 'action' => 'UPDATE', 'resource' => 'Household: #102', 'status' => 'Success'],
                            ['time' => '3 hours ago', 'user' => 'System', 'action' => 'BACKUP', 'resource' => 'Database', 'status' => 'Success'],
                            ['time' => '5 hours ago', 'user' => 'Admin User', 'action' => 'DELETE', 'resource' => 'Division: Western', 'status' => 'Success'],
                        ];
                    @endphp

                    @foreach($logs as $log)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                                {{ $log['time'] }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-gray-100 text-gray-600 flex items-center justify-center text-[10px] font-bold">
                                        {{ substr($log['user'], 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">{{ $log['user'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-brand-50 text-brand-600 rounded-lg text-[10px] font-extrabold uppercase tracking-widest border border-brand-100">
                                    {{ $log['action'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                                {{ $log['resource'] }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 text-[10px] font-extrabold rounded-lg border border-green-100">
                                    <span class="w-1 h-1 bg-green-500 rounded-full"></span>
                                    {{ strtoupper($log['status']) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
