<x-settings>
    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-200">
                    <h1 class="mb-8 text-2xl font-bold text-white">Create New User</h1>

                    <form method="POST" action="/settings/users/create-user" enctype="multipart/form-data" class="dropzone space-y-6" id="image-upload">
                        @csrf

                        <!-- Avatar Input -->
                        <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                            <div class="sm:col-span-9">
                                <div class="flex items-center gap-5">
                                    <img class="inline-block size-16 rounded-full ring-2 ring-white dark:ring-neutral-900" src="https://preline.co/assets/img/160x160/img1.jpg" alt="Avatar">
                                    <div class="flex gap-x-2">
                                        <input type="file" name="avatar" id="avatar" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Name Input -->
                        <div class="mb-6">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-200">Username</label>
                            <input type="text" 
                                name="name" 
                                id="name"
                                value="{{ old('name') }}"
                                class="block w-full px-4 py-3 text-white bg-gray-700 border border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Enter username"
                                required
                                autofocus
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <!-- Email Input -->
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-200">Email Address</label>
                            <input type="email" 
                                name="email" 
                                id="email"
                                value="{{ old('email') }}"
                                class="block w-full px-4 py-3 text-white bg-gray-700 border border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Enter email"
                                required
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" class="block mb-2 text-sm font-medium text-gray-200" />
                            <x-text-input id="password" 
                                class="block w-full px-4 py-3 text-white bg-gray-700 border border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                type="password"
                                name="password"
                                required 
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block mb-2 text-sm font-medium text-gray-200" />
                            <x-text-input id="password_confirmation" 
                                class="block w-full px-4 py-3 text-white bg-gray-700 border border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                type="password"
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    
                        <!-- Role Selection -->
                        <div class="mb-6">
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-200">Assign Role</label>
                            <select name="role" 
                                id="role"
                                class="block w-full px-4 py-3 text-white bg-gray-700 border border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required
                            >
                                <option value="">Select a role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SDG Assignment Section -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-200">Assign SDG(s)</label>
                            <p class="mb-2 text-xs text-gray-400">Select one or more SDGs</p>
                            
                            <div class="max-h-60 overflow-y-auto p-3 border border-gray-600 rounded-lg bg-gray-700">
                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                    @foreach($sdgs as $sdg)
                                        <div class="flex items-center">
                                            <input
                                                type="checkbox"
                                                name="sdgs[]"
                                                value="{{ $sdg->id }}"
                                                id="sdg-{{ $sdg->id }}"
                                                class="w-4 h-4 text-indigo-600 bg-gray-600 border-gray-500 rounded focus:ring-indigo-500"
                                                {{ is_array(old('sdgs')) && in_array($sdg->id, old('sdgs')) ? 'checked' : '' }}
                                            >
                                            <label for="sdg-{{ $sdg->id }}" class="ml-2 text-sm text-gray-200">
                                                SDG {{ $sdg->id }}: {{ $sdg->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('sdgs')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <div class="flex justify-end space-x-4 pt-6">
                            <a href="/settings/users" class="me-2 inline-flex items-center px-3 py-2 border border-gray-600 text-sm font-medium rounded-lg shadow-sm text-gray-200 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit" 
                                class="ms-2 inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Dropzone -->
   <script type="text/javascript">
    let dropzone = new Dropzone('#image-upload', {
      thumbnailWidth: 200,
      maxFilesize: 1,
      acceptedFiles: ".jpeg,.jpg,.png",
    })
   </script>
</x-settings>
