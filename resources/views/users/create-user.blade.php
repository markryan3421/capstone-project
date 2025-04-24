<x-settings>
      <div class="py-12">
          <div class="mx-auto max-w-2xl sm:px-6 lg:px-8"> <!-- Reduced max width -->
              <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                  <div class="p-6 text-gray-900"> <!-- Increased padding -->
                      <h1 class="mb-8 text-2xl font-bold text-gray-800">Create New User</h1> <!-- Adjusted heading -->
  
                      <form method="POST" action="/settings/users/create-user" class="space-y-6"> <!-- Added vertical spacing -->
                          @csrf
                          <!-- Name Input -->
                          <div class="mb-6"> <!-- Added bottom margin -->
                              <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Username</label>
                              <input type="text" 
                                  name="name" 
                                  id="name"
                                  value="{{ old('name') }}"
                                  class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                  placeholder="Enter username"
                                  required
                                  autofocus
                              >
                              @error('name')
                                  <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                          </div>
                      
                          <!-- Email Input -->
                          <div class="mb-6">
                              <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                              <input type="email" 
                                  name="email" 
                                  id="email"
                                  value="{{ old('email') }}"
                                  class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                  placeholder="Enter email"
                                  required
                              >
                              @error('email')
                                  <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                          </div>
                      
                          <!-- Password -->
                          <div class="mt-4">
                              <x-input-label for="password" :value="__('Password')" />
  
                              <x-text-input id="password" class="block mt-1 w-full"
                                              type="password"
                                              name="password"
                                              required autocomplete="new-password" />
  
                              <x-input-error :messages="$errors->get('password')" class="mt-2" />
                          </div>
  
                          <!-- Confirm Password -->
                          <div class="mt-4">
                              <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
  
                              <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                              type="password"
                                              name="password_confirmation" required autocomplete="new-password" />
  
                              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                          </div>
                      
                          <!-- Role Selection -->
                          <div class="mb-8"> <!-- Extra margin before buttons -->
                              <label for="role" class="block mb-2 text-sm font-medium text-gray-700">Assign Role</label>
                              <select name="role" 
                                  id="role"
                                  class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
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
                                  <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                              @enderror
                          </div>
                      
                          <div class="flex justify-end space-x-4 pt-6"> <!-- Increased spacing -->
                              <a href="/users" class="me-2 inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
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
</x-settings>