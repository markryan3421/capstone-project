<x-settings>
  <div class="my-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-200">
          <h1 class="text-3xl font-bold text-white mb-6">Create New Role</h1>

          <form action="/settings/roles/add-role" method="POST" class="space-y-6">
            @csrf

            <!-- Role Name Field -->
            <div>
              <x-input-label for="name" :value="__('Role Name')" class="text-gray-200" />
              <x-text-input
                id="name"
                name="name"
                type="text"
                class="block w-full mt-1 px-4 py-2 text-gray-200 bg-gray-700 border border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                :value="old('name')"
                required
                autofocus
              />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Permissions Section -->
            <div>
              <x-input-label for="permissions" :value="__('Assign Permissions')" class="text-gray-200" />
              <div class="grid gap-4 mt-3 md:grid-cols-3 max-h-[400px] overflow-y-auto p-4 bg-gray-700 border border-gray-600 rounded-lg">
                @foreach($permissions as $permission)
                  <div class="flex items-center">
                    <input
                      type="checkbox"
                      name="permissions[]"
                      value="{{ $permission->id }}"
                      id="permission{{ $permission->id }}"
                      class="w-4 h-4 text-indigo-600 bg-gray-600 border-gray-500 rounded focus:ring-indigo-500"
                    >
                    <label for="permission{{ $permission->id }}" class="ml-2 text-sm text-gray-200">
                      {{ $permission->name }}
                    </label>
                  </div>
                @endforeach
              </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-4 space-x-4">
              <a href="/settings/roles" class="px-4 py-2 text-sm font-medium text-gray-200 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
              </a>
              <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                {{ __('Create Role') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-settings>