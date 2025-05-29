<x-settings>
    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Edit User Info') }}
            </h2>
            <!-- User Info Form -->
            <div class="p-6 bg-gray-800 shadow sm:rounded-lg">
                <form action="/settings/users/{{$user->user_slug}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-white">User Information</h3>
                        
                        <!-- Name Input -->
                        <div>
                            <label for="user_name" class="block text-sm font-medium text-gray-200 mb-1">Name</label>
                            <input type="text" 
                                name="name" 
                                value="{{$user->name}}"
                                id="user_name"
                                class="text-gray-200 block w-full px-4 py-2 border border-gray-600 rounded-md shadow-sm bg-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Enter user name"
                                required
                            >
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label for="user_email" class="block text-sm font-medium text-gray-200 mb-1">Email</label>
                            <input type="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}"
                                id="user_email"
                                class="text-gray-200 block w-full px-4 py-2 border border-gray-600 rounded-md shadow-sm bg-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Enter email address"
                                required
                            >
                        </div>

                        <!-- Sdg -->
                                  
                            <div>
                            <div>
                                Sustainable Development Goals:    
                            </div>

                            @foreach($sdgs as $sdg)
                                <div class="flex items-center">
                                    <input 
                                        type="checkbox" 
                                        name="sdgs[]" 
                                        value="{{ $sdg->id }}"
                                        id="sdg-{{ $sdg->id }}"
                                        class="h-4 w-4 text-indigo-600 bg-gray-700 border-gray-600 focus:ring-indigo-500"
                                        {{ in_array($sdg->id, $user->sdgs->pluck('id')->toArray()) ? 'checked' : '' }}
                                    >
                                    <label for="sdg-{{ $sdg->id }}" class="ml-2 text-sm text-gray-200">
                                       {{ $sdg->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit" 
                                class="px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Role Assignment Form -->
            <div class="p-6 bg-gray-800 shadow sm:rounded-lg">
                <form action="/settings/users/{{$user->user_slug}}/assign-role" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-white">Role Management</h3>
                        
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-200 mb-1">Assign Role</label>
                            <select name="role" 
                                class="text-gray-200 block w-full pl-3 pr-10 py-2 border border-gray-600 rounded-md shadow-sm bg-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end pt-2 gap-4">
                            <a href="/settings/users" class="inline-flex items-center px-3 py-2 border border-gray-600 text-sm font-medium rounded-lg shadow-sm text-gray-200 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                Assign Role
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-settings>