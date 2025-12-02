<x-settings>
    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col gap-6 mb-8 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <a href="/settings/roles" class="p-2 text-gray-400 transition-all duration-200 rounded-lg hover:bg-gray-800 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                        <h1 class="text-3xl font-bold text-white">Role Details</h1>
                    </div>
                    <p class="text-gray-400">Manage and view details for the <span class="font-semibold text-indigo-400">{{ $role->name }}</span> role</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="/settings/roles/single-role/{{$role->id}}/edit" class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white transition-all duration-200 bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-500 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path fill-rule="evenodd" d="M2 16V6h4V2H2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-4h-4v4H2z" clip-rule="evenodd" />
                        </svg>
                        Edit Role
                    </a>
                    <a href="/settings/roles" class="inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-gray-300 transition-all duration-200 bg-gray-800 border border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white hover:border-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Roles
                    </a>
                </div>
            </div>

            <!-- Role Overview Card -->
            <div class="p-6 mb-8 bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl border border-gray-700">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">{{ $role->name }}</h2>
                        <p class="text-gray-400">{{ $role->description ?? 'No description provided' }}</p>
                    </div>
                </div>
                
                <div class="grid gap-6 md:grid-cols-3">
                    <div class="p-4 bg-gray-800/50 rounded-xl border border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-indigo-500/10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-400">Total Permissions</p>
                                <p class="text-xl font-bold text-white">{{ $role->permissions->count() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 bg-gray-800/50 rounded-xl border border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-green-500/10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-400">Assigned Users</p>
                                <p class="text-xl font-bold text-white">{{ $users->total() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 bg-gray-800/50 rounded-xl border border-gray-700">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-500/10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-400">Created</p>
                                <p class="text-sm font-medium text-white">{{ $role->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-8 lg:grid-cols-2">
                <!-- Permissions Section -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl border border-gray-700">
                    <div class="px-6 py-5 border-b border-gray-700">
                        <h2 class="text-lg font-semibold text-white">Role Permissions</h2>
                        <p class="mt-1 text-sm text-gray-400">All permissions assigned to this role</p>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-3">
                            @forelse($role->permissions as $permission)
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 transition-all duration-200 hover:bg-indigo-500/30 hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    {{ $permission->name }}
                                </span>
                            @empty
                                <div class="flex flex-col items-center justify-center w-full py-8 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <p class="text-gray-400 font-medium">No permissions assigned</p>
                                    <p class="text-sm text-gray-500 mt-1">Edit the role to add permissions</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Users Section -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl border border-gray-700">
                    <div class="px-6 py-5 border-b border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-white">Assigned Users</h2>
                                <p class="mt-1 text-sm text-gray-400">Users with this role assigned</p>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium bg-indigo-500/20 text-indigo-300 rounded-full border border-indigo-500/30">
                                {{ $users->total() }} users
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($users as $user)
                                <div class="flex items-center gap-4 p-4 transition-all duration-200 bg-gray-800/50 rounded-xl border border-gray-700 hover:bg-gray-750 hover:border-gray-600">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-white truncate">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-400 truncate">{{ $user->email }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500/20 text-green-400 border border-green-500/30">
                                            Active
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="flex flex-col items-center justify-center py-8 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <p class="text-gray-400 font-medium">No users assigned</p>
                                    <p class="text-sm text-gray-500 mt-1">This role is not assigned to any users</p>
                                </div>
                            @endforelse
                        </div>
                        
                        <!-- Pagination -->
                        @if($users->hasPages())
                            <div class="mt-6 border-t border-gray-700 pt-6">
                                {{ $users->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-settings>