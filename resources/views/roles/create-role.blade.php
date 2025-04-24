<x-settings>
  <div class="my-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h1 class="text-3xl font-bold">Create New Role</h1>

          <form action="/settings/roles/add-role" method="POST" class="space-y-6">
            @csrf

            <!-- Role Name Field -->
            <div>
              <x-input-label for="name" :value="__('Role Name')" />
              <x-text-input
                id="name"
                name="name"
                type="text"
                class="block w-full mt-1"
                :value="old('name')"
                required
                autofocus
              />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Permissions Section (Now Scrollable) -->
            <div>
              <x-input-label for="permissions" :value="__('Assign Permissions')" />
              <div class="grid gap-4 mt-3 md:grid-cols-3 max-h-[400px] overflow-y-auto"> <!-- Added max-height and overflow -->
                @foreach($permissions as $permission)
                  <div class="flex items-center">
                    <input
                      type="checkbox"
                      name="permissions[]"
                      value="{{ $permission->id }}"
                      id="permission{{ $permission->id }}"
                      class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                    >
                    <label for="permission{{ $permission->id }}" class="ml-2 text-sm text-gray-700">
                      {{ $permission->name }}
                    </label>
                  </div>
                @endforeach
              </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-4">
              <x-primary-button class="ml-3">
                {{ __('Create Role') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-settings>