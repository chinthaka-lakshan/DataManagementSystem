<x-admin-layout>
    <x-slot name="title">User Management</x-slot>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8" x-data="{ openModal: false }">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">User Management</h2>
            <p class="text-sm text-gray-500 mt-1">Manage system access, roles, and user statuses</p>
        </div>
        <button @click="$dispatch('open-modal', 'add-user')" class="inline-flex items-center justify-center px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl shadow-md shadow-brand-200 transition-all duration-200 gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
            Create New User
        </button>
    </div>

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl text-brand-600 text-sm font-semibold flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-xl text-green-700 text-sm font-semibold flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden" x-data="{ selectedUser: null }">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Created Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center font-bold">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500 font-medium">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->role === 'admin')
                                    <span class="px-2.5 py-1 bg-purple-50 text-purple-600 rounded-lg text-xs font-bold border border-purple-200 uppercase tracking-wider">Admin</span>
                                @else
                                    <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold border border-blue-200 uppercase tracking-wider">User (GN)</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($user->is_active)
                                    <span class="px-2.5 py-1 bg-green-50 text-green-600 rounded-lg text-xs font-bold border border-green-200 uppercase tracking-wider">Active</span>
                                @else
                                    <span class="px-2.5 py-1 bg-red-50 text-red-600 rounded-lg text-xs font-bold border border-red-200 uppercase tracking-wider">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                                {{ $user->created_at->format('d M, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button @click="selectedUser = {{ $user->toJson() }}; $dispatch('open-modal', 'edit-user')" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200" title="Edit Role/Status">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </button>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition-all duration-200" title="Delete User">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs font-bold text-brand-600 bg-brand-50 px-2 py-1 rounded-md">YOU</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Edit User Modal (inside the x-data scope so it can access selectedUser) -->
        <x-modal name="edit-user" focusable>
            <form method="POST" :action="`/users/${selectedUser?.id}`" class="p-8">
                @csrf
                @method('PUT')
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Edit User Access</h2>
                <p class="text-sm text-gray-500 mb-8" x-text="`Update role and status for ${selectedUser?.name}.`"></p>

                <div class="space-y-6">
                    <div>
                        <label for="edit_role" class="block text-sm font-semibold text-gray-700 mb-2">User Role</label>
                        <select name="role" id="edit_role" required class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                            <option value="user" :selected="selectedUser?.role === 'user'">User (Grama Niladhari)</option>
                            <option value="admin" :selected="selectedUser?.role === 'admin'">Administrator</option>
                        </select>
                    </div>

                    <div>
                        <label for="edit_status" class="block text-sm font-semibold text-gray-700 mb-2">Account Status</label>
                        <select name="is_active" id="edit_status" required class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                            <option value="1" :selected="selectedUser?.is_active == true">Active (Can Login)</option>
                            <option value="0" :selected="selectedUser?.is_active == false">Inactive (Cannot Login)</option>
                        </select>
                    </div>
                </div>

                <div class="mt-10 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-md shadow-blue-200 transition-colors">
                        Save Changes
                    </button>
                </div>
            </form>
        </x-modal>
    </div>

    <!-- Add User Modal -->
    <x-modal name="add-user" focusable>
        <form method="POST" action="{{ route('users.store') }}" class="p-8">
            @csrf
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Add New User</h2>
            <p class="text-sm text-gray-500 mb-8">Fill in the details below to create a new user account.</p>

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" id="name" required class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" required class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                </div>

                <div>
                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">User Role</label>
                    <select name="role" id="role" required class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                        <option value="user">User (Grama Niladhari)</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Initial Password</label>
                    <input type="password" name="password" id="password" required class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm">
                </div>
            </div>

            <div class="mt-10 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 shadow-md shadow-brand-200 transition-colors">
                    Create Account
                </button>
            </div>
        </form>
    </x-modal>
</x-admin-layout>
