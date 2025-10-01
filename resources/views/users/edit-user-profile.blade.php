<x-layout>
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Back Button -->
    <div>
        <a href="/profile/{{ $user->user_slug }}" class="underline-offset-4 hover:underline inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                <path fill-rule="evenodd" d="M7.793 2.232a.75.75 0 0 1-.025 1.06L3.622 7.25h10.003a5.375 5.375 0 0 1 0 10.75H10.75a.75.75 0 0 1 0-1.5h2.875a3.875 3.875 0 0 0 0-7.75H3.622l4.146 3.957a.75.75 0 0 1-1.036 1.085l-5.5-5.25a.75.75 0 0 1 0-1.085l5.5-5.25a.75.75 0 0 1 1.06.025Z" clip-rule="evenodd" />
            </svg>
            &nbsp;Back
        </a>
    </div>
    <!-- Grid -->
    <div class="grid md:grid-cols-5 gap-10">
      <!-- Left Column -->
      <div class="md:col-span-2">
        <div class="max-w-xs">
          <h2 class="text-3xl font-bold md:text-4xl md:leading-tight text-gray-900 dark:text-white">Profile Settings</h2>
          <p class="mt-3 text-gray-600 dark:text-neutral-400">Manage your personal information and account preferences.</p>
        </div>
      </div>
      <!-- End Left Column -->

      <!-- Right Column -->
      <div class="md:col-span-3">
        <form action="/profile/{{ $user->user_slug }}/update" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          
          <!-- Card Container -->
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-6">
            
            <!-- Avatar Section -->
            <div class="flex items-center gap-6 pb-6 border-b border-gray-200 dark:border-gray-700">
              <div class="relative group">
                <img class="inline-block size-20 rounded-full ring-2 ring-white dark:ring-gray-800 shadow-lg" 
                     src="{{ $user->avatar ? asset('storage/avatars/' . $user->avatar) : strtoupper(substr(Auth::user()->name, 0, 1)) }}" 
                     alt="Profile picture">
                <div class="absolute inset-0 bg-black bg-opacity-30 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
              </div>
              
              <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Profile Picture</label>
                <div class="flex flex-col sm:flex-row gap-3">
                  <input type="file" 
                         name="avatar" 
                         id="avatar" 
                         class="file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300 dark:hover:file:bg-blue-800 transition-colors cursor-pointer w-full">
                  <button type="button" class="px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                    Remove
                  </button>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">JPG, GIF or PNG. Max size of 2MB.</p>
              </div>
            </div>

            <!-- Form Fields -->
            <div class="space-y-5">
              <!-- Email Input -->
              <div>
                <label for="user_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Email Address
                  <span class="text-red-500 ml-1">*</span>
                </label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}"
                       id="user_email"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       placeholder="Enter your email address"
                       required>
                @if ($errors->has('email'))
                  <span class="text-sm text-red-600 dark:text-red-400 mt-1">
                    {{ $errors->first('email') }}
                  </span>
                @endif
              </div>

              <!-- Name Input -->
              <div>
                <label for="user_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Full Name
                  <span class="text-red-500 ml-1">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $user->name) }}"
                       id="user_name"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       placeholder="Enter your full name"
                       required>
                @if ($errors->has('name'))
                  <span class="text-sm text-red-600 dark:text-red-400 mt-1">
                    {{ $errors->first('name') }}
                  </span>
                @endif
              </div>

              <!-- Password Input -->
              <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  New Password
                </label>
                <div class="relative">
                  <input type="password" 
                         name="password" 
                         value="{{ $user->password ? old('password') : '' }}"
                         id="password"
                         class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 pr-10"
                         placeholder="Enter new password">
                  <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" onclick="togglePassword('password')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </button>
                </div>
                @if ($errors->has('password'))
                  <span class="text-sm text-red-600 dark:text-red-400 mt-1">
                    {{ $errors->first('password') }}
                  </span>
                @endif
                <!-- <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Leave blank to keep current password</p> -->
              </div>

              <!-- Confirm Password -->
              <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Confirm New Password
                </label>
                <div class="relative">
                  <input type="password" 
                         name="password_confirmation" 
                         id="password_confirmation"
                         class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 pr-10"
                         placeholder="Confirm your new password">
                  <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" onclick="togglePassword('password_confirmation')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </button>
                </div>
                @if ($errors->has('password_confirmation'))
                  <span class="text-sm text-red-600 dark:text-red-400 mt-1">
                    {{ $errors->first('password_confirmation') }}
                  </span>
                @endif
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
              <button type="submit" 
                      class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 shadow-lg hover:shadow-blue-500/25">
                Update Profile
              </button>
              <button type="button" 
                      class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                Cancel
              </button>
            </div>
          </div>
          <!-- End Card Container -->
        </form>
      </div>
      <!-- End Right Column -->
    </div>
    <!-- End Grid -->
  </div>
</x-layout>

<script>
function togglePassword(fieldId) {
  const field = document.getElementById(fieldId);
  const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
  field.setAttribute('type', type);
}
</script>