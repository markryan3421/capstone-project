<x-settings>
      <div class="py-12">
          <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
              <div class="flex items-center justify-between mb-6">
                  <h1 class="text-3xl font-bold text-white">Users Management</h1>
                      <a href="/settings/users/create-user" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                          Create New User
                      </a>
              </div>
  
              <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg">
                  <div class="p-6 text-gray-900">
                      @if(session('success'))
                          <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                              {{ session('success') }}
                          </div>
                      @endif
  
                      @if(session('error'))
                          <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                              {{ session('error') }}
                          </div>
                      @endif

                        <div class="overflow-x-auto rounded-lg border border-gray-700">
                            <table class="min-w-full divide-y bg-gray-700 divide-gray-600 divide-[1px]">
                                <caption class="sr-only">Users List</caption>
                                <thead class="white bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Role</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-800 text-gray-100 divide-y divide-gray-600 divide-[1px]">
                                    @foreach($users as $user)
                                    <tr class="hover:bg-gray-900 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium">
                                                <a href="/settings/users/{{$user->user_slug}}" class="text-white hover:text-indigo-400">
                                                    {{ $user->name }}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($user->roles->isNotEmpty())
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                {{ $user->roles->pluck('name')->implode(', ') }}
                                            </span>
                                            @else
                                            <span class="text-sm text-gray-500 italic">No role assigned</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-3">
                                                
                                                @can ('update users', App\Models\User::class) 
                                                    <a href="/settings/users/{{$user->user_slug}}/edit" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="/settings/users/{{$user->user_slug}}/delete" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class=" inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 [&>div]:text-white [&>p]:text-white">
                            {{ $users->links() }}
                        </div>
                  </div>
              </div>
          </div>
      </div>
</x-settings>