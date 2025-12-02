<x-settings>
    <div class="py-8">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
                <div class="mb-4 lg:mb-0">
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">Create New User</h1>
                    <p class="text-gray-400 mt-2">Add a new team member to your organization</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <div class="text-2xl font-bold text-white">{{ $roles->count() }}</div>
                        <div class="text-sm text-gray-400">Available Roles</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- User Creation Form -->
            <div class="bg-gradient-to-br from-gray-800/40 to-gray-900/60 backdrop-blur-sm rounded-2xl border border-gray-700/50 shadow-2xl overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="/settings/users/create-user" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <!-- Avatar Upload Section -->
                        <div class="bg-gradient-to-r from-gray-800/50 to-gray-700/30 p-6 rounded-2xl border border-gray-600/30">
                            <h3 class="text-lg font-semibold text-gray-200 mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Profile Avatar
                            </h3>
                            
                            <div class="flex items-center gap-6">
                                <!-- Avatar Preview -->
                                <div class="relative">
                                    <img class="w-20 h-20 rounded-full ring-2 ring-gray-600/50 object-cover" 
                                         src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                                         alt="Avatar preview"
                                         id="avatar-preview">
                                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-indigo-500/20 to-purple-600/20 flex items-center justify-center text-white font-bold text-xl hidden"
                                         id="avatar-fallback">
                                        ?
                                    </div>
                                </div>

                                <!-- File Input -->
                                <div class="flex-1">
                                    <label for="avatar" class="block text-sm font-medium text-gray-300 mb-3">
                                        Upload Profile Picture
                                    </label>
                                    <input type="file" 
                                           name="avatar" 
                                           id="avatar" 
                                           accept="image/*"
                                           class="block w-full text-sm text-gray-400
                                                  file:mr-4 file:py-3 file:px-4
                                                  file:rounded-xl file:border-0
                                                  file:text-sm file:font-semibold
                                                  file:bg-gradient-to-r file:from-indigo-500 file:to-purple-600
                                                  file:text-white
                                                  hover:file:from-indigo-600 hover:file:to-purple-700
                                                  transition-all duration-200
                                                  cursor-pointer
                                                  bg-gray-700/50 border border-gray-600/50 rounded-xl
                                                  focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500"
                                    >
                                    <p class="mt-2 text-xs text-gray-400">JPG, PNG or GIF. Max 2MB.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Information Section -->
                        <div class="bg-gradient-to-r from-gray-800/50 to-gray-700/30 p-6 rounded-2xl border border-gray-600/30">
                            <h3 class="text-lg font-semibold text-gray-200 mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </h3>

                            <div class="grid grid-cols-1 gap-6">
                                <!-- Name Input -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-300 mb-3 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Username
                                    </label>
                                    <input type="text" 
                                        name="name" 
                                        id="name"
                                        value="{{ old('name') }}"
                                        class="w-full px-4 py-3.5 bg-gray-700/30 border border-gray-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-500 transition-all duration-200 hover:border-gray-500/50"
                                        placeholder="Enter full name"
                                        required
                                        autofocus
                                    >
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-400 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Email Input -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-300 mb-3 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Email Address
                                    </label>
                                    <input type="email" 
                                        name="email" 
                                        id="email"
                                        value="{{ old('email') }}"
                                        class="w-full px-4 py-3.5 bg-gray-700/30 border border-gray-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-500 transition-all duration-200 hover:border-gray-500/50"
                                        placeholder="Enter email address"
                                        required
                                    >
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-400 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Security Section -->
                        <div class="bg-gradient-to-r from-gray-800/50 to-gray-700/30 p-6 rounded-2xl border border-gray-600/30">
                            <h3 class="text-lg font-semibold text-gray-200 mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Security Settings
                            </h3>

                            <div class="grid grid-cols-1 gap-6">
                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-gray-300 mb-3 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Password
                                    </label>
                                    <input id="password" 
                                        class="w-full px-4 py-3.5 bg-gray-700/30 border border-gray-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-500 transition-all duration-200 hover:border-gray-500/50"
                                        type="password"
                                        name="password"
                                        placeholder="Enter secure password"
                                        required 
                                        autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-300 mb-3 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Confirm Password
                                    </label>
                                    <input id="password_confirmation" 
                                        class="w-full px-4 py-3.5 bg-gray-700/30 border border-gray-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-500 transition-all duration-200 hover:border-gray-500/50"
                                        type="password"
                                        name="password_confirmation" 
                                        placeholder="Confirm your password"
                                        required 
                                        autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Role & Permissions Section -->
                        <div class="bg-gradient-to-r from-gray-800/50 to-gray-700/30 p-6 rounded-2xl border border-gray-600/30">
                            <h3 class="text-lg font-semibold text-gray-200 mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Role & Permissions
                            </h3>

                            <div class="space-y-6">
                                <!-- Role Selection -->
                                <div>
                                    <label for="role" class="block text-sm font-semibold text-gray-300 mb-3">
                                        Assign Role
                                    </label>
                                    <div class="relative">
                                        <select name="role" 
                                            id="role"
                                            class="w-full px-4 py-3.5 bg-gray-700/30 border border-gray-600/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 appearance-none transition-all duration-200 hover:border-gray-500/50 pr-10"
                                            required
                                        >
                                            <option value="" class="bg-gray-800">Select a role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }} class="bg-gray-800">
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('role')
                                        <p class="mt-2 text-sm text-red-400 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- SDG Assignment -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-300 mb-3">
                                        Assign Sustainable Development Goals
                                    </label>
                                    <p class="mb-4 text-sm text-gray-400">Select one or more SDGs for this user</p>
                                    
                                    <div class="max-h-60 overflow-y-auto p-4 border border-gray-600/50 rounded-xl bg-gray-700/30">
                                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                            @foreach($sdgs as $sdg)
                                                <label class="flex items-center p-3 bg-gray-700/50 hover:bg-gray-700/70 rounded-lg border border-gray-600/30 transition-all duration-200 cursor-pointer group">
                                                    <input
                                                        type="checkbox"
                                                        name="sdgs[]"
                                                        value="{{ $sdg->id }}"
                                                        id="sdg-{{ $sdg->id }}"
                                                        class="w-4 h-4 text-indigo-500 bg-gray-600 border-gray-500 rounded focus:ring-indigo-500 focus:ring-2 transition-all duration-200 group-hover:scale-110"
                                                        {{ is_array(old('sdgs')) && in_array($sdg->id, old('sdgs')) ? 'checked' : '' }}
                                                    >
                                                    <span class="ml-3 text-sm text-gray-200 group-hover:text-white transition-colors duration-200">
                                                        SDG {{ $sdg->id }}: {{ $sdg->name }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    @error('sdgs')
                                        <p class="mt-2 text-sm text-red-400 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t border-gray-700/50">
                            <a href="/settings/users" 
                               class="inline-flex items-center justify-center px-8 py-3.5 text-sm font-medium text-gray-300 bg-gray-800/50 border border-gray-700 rounded-xl hover:bg-gray-700/50 transition-all duration-200 order-2 sm:order-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" 
                                class="group inline-flex items-center justify-center px-8 py-3.5 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg shadow-indigo-600/20 hover:shadow-xl hover:shadow-indigo-600/30 transform hover:-translate-y-0.5 order-1 sm:order-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Avatar preview functionality
        document.getElementById('avatar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('avatar-preview');
            const fallback = document.getElementById('avatar-fallback');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    fallback.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-settings>