<x-settings>
      <div class="py-10">
          <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
              <div class="p-6 bg-white shadow rounded-xl">
                  <div class="p-8">
  
                      <!-- Back and Edit Buttons -->
                      <div class="flex justify-between items-center mb-5">
                        <a href="/settings/users" class="flex items-center text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                          </svg>
                          Back to Users
                        </a>

                        <h2 class="font-semibold text-2xl text-black leading-tight">
                            {{ __('User Profile') }}
                        </h2>
                          
                        <a href="/settings/users/{{$user->user_slug}}/edit"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-semibold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
                            Edit Profile
                        </a>
                      </div>
  
                      <!-- Profile Card -->
                      <div class="bg-gray-50 rounded-lg p-8 shadow mb-10">
                          <div class="flex items-center space-x-6 mb-6">
                              <div class="flex-shrink-0">
                                  <div class="h-20 w-20 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-3xl font-bold">
                                      {{ substr($user->name, 0, 1) }}
                                  </div>
                              </div>
                              <div>
                                  <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                                  <p class="text-gray-500 text-sm">{{ $user->email }}</p>
                              </div>
                          </div>
  
                          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                              <!-- Basic Info -->
                              <div class="bg-white p-6 rounded-lg border">
                                  <h3 class="text-lg font-semibold text-gray-700 mb-4">Basic Information</h3>
                                  <div class="space-y-4 text-sm text-gray-700">
                                      <div>
                                          <p class="text-gray-500">Username</p>
                                          <p class="font-medium">{{ $user->name ?? 'N/A' }}</p>
                                      </div>
                                      <div>
                                          <p class="text-gray-500">Email</p>
                                          <p class="font-medium">{{ $user->email }}</p>
                                      </div>
                                      <div>
                                          <p class="text-gray-500">Account Created</p>
                                          <p class="font-medium">{{ $user->created_at->format('M d, Y') }}</p>
                                      </div>
                                  </div>
                              </div>
  
                              <!-- Roles & Permissions -->
                              <div class="bg-white p-6 rounded-lg border">
                                  <h3 class="text-lg font-semibold text-gray-700 mb-4">Roles & Permissions</h3>
                                  <div class="mb-4">
                                      <p class="text-gray-500 text-sm mb-1">Assigned Roles</p>
                                      <div class="flex flex-wrap gap-2">
                                          @forelse($user->roles as $role)
                                              <span class="px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                  {{ $role->name }}
                                              </span>
                                          @empty
                                              <span class="text-gray-400 text-sm">No roles assigned</span>
                                          @endforelse
                                      </div>
                                  </div>
  
                                  <div>
                                      <p class="text-gray-500 text-sm mb-1">Permissions</p>
                                      <div class="flex flex-wrap gap-2">
                                          @forelse($user->getAllPermissions() as $permission)
                                              <span class="px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                                  {{ $permission->name }}
                                              </span>
                                          @empty
                                              <span class="text-gray-400 text-sm">No permissions assigned</span>
                                          @endforelse
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- End Profile Card -->
                  </div>
              </div>
          </div>
      </div>
  
</x-settings>