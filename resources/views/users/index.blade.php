<x-settings>
    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col items-start justify-between mb-8 space-y-4 sm:flex-row sm:items-center sm:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold text-white sm:text-3xl">Users Management</h1>
                    <p class="mt-1 text-sm text-gray-400">Manage your team members and their permissions</p>
                </div>
                <a href="/settings/users/create-user" 
                   class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white transition-all duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800 shadow-md hover:shadow-indigo-500/50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Create New User
                </a>
            </div>

            <!-- Team Section -->
            <div class="overflow-hidden bg-gray-800 border border-gray-700 rounded-xl shadow-lg">
                <div class="px-6 py-8">
                    <div class="max-w-3xl mx-auto text-center mb-12">
                        <h2 class="text-2xl font-bold text-white sm:text-3xl">Team Members</h2>
                        <p class="mt-2 text-gray-400">Your organization's staff and their roles</p>
                    </div>

                    <!-- Grid Layout -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($staffUsers as $user)
                            <div class="overflow-hidden transition-all duration-200 bg-gray-700 rounded-xl hover:bg-gray-600 group border border-gray-600 hover:border-gray-500">
                                <div class="p-6">
                                    <!-- Avatar -->
                                    <div class="relative mx-auto w-32 h-32 rounded-full bg-gray-600 flex items-center justify-center mb-4 overflow-hidden">
                                        @if($user->avatar)
                                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="avatar" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-4xl font-bold text-white">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </span>
                                        @endif
                                        @if($user->is_online)
                                            <span class="absolute bottom-2 right-2 block h-3 w-3 rounded-full bg-green-400 ring-2 ring-gray-700"></span>
                                        @endif
                                    </div>

                                    <!-- User Info -->
                                    <div class="text-center">
                                        <a href="/settings/users/{{$user->user_slug}}" 
                                           class="text-lg font-medium text-white hover:text-indigo-400 transition-colors">
                                            {{ $user->name }}
                                        </a>
                                        <p class="mt-1 text-sm text-gray-300">
                                            {{ $user->email }}
                                        </p>

                                        <!-- Roles -->
                                        <div class="mt-3">
                                            @if($user->roles->isNotEmpty())
                                                <div class="flex flex-wrap justify-center gap-2">
                                                    @foreach($user->roles as $role)
                                                        <span @class([
                                                            'px-3 py-1 text-xs font-medium rounded-full',
                                                            'bg-purple-900/30 text-purple-300 border border-purple-500' => $role->name === 'admin',
                                                            'bg-blue-900/30 text-blue-300 border border-blue-500' => $role->name === 'project-manager',
                                                            'bg-green-900/30 text-green-300 border border-green-500' => $role->name === 'staff',
                                                            'bg-gray-600 text-gray-300 border border-gray-500' => !in_array($role->name, ['admin', 'project-manager', 'staff'])
                                                        ])>
                                                            {{ ucfirst(str_replace('-', ' ', $role->name)) }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-400 italic">No role assigned</span>
                                            @endif
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="mt-4 flex justify-center space-x-3">
                                            @hasanyrole(['admin', 'project-manager'])
                                            <a href="/settings/users/{{$user->user_slug}}/edit" 
                                               class="inline-flex items-center px-3.5 py-1.5 border border-transparent text-xs font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200 hover:shadow-indigo-500/30">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <form method="POST" action="/settings/users/{{$user->user_slug}}/delete" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3.5 py-1.5 border border-transparent text-xs font-medium rounded-lg shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-200 hover:shadow-red-500/30">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                            @endhasanyrole
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-12 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-300">No team members found</h3>
                                <p class="mt-1 text-sm text-gray-500">Add new members to get started</p>
                                <div class="mt-6">
                                    <a href="/settings/users/create-user" 
                                       class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white transition-all duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow-md hover:shadow-indigo-500/50">
                                        Create First User
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-settings>