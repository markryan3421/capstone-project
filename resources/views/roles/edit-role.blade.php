<x-settings>
    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h1 class="text-2xl font-bold text-gray-900">Edit Role: <span class="text-indigo-600">{{ $role->name }}</span></h1>

                        <a href="/settings/roles" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            Back to Roles
                        </a>
                    </div>

                    <form action="/settings/roles/single-role/{{$role->id}}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Role Name Field -->
                        <div>
                            <x-input-label for="name" :value="__('Role Name')" class="block text-sm font-medium text-gray-700 mb-2" />
                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 bg-white"
                                :value="old('name', $role->name)"
                                required
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-600" />
                        </div>

                        <!-- Permissions Section -->
                        <div>
                            <x-input-label :value="__('Permissions')" class="block text-sm font-medium text-gray-700 mb-3" />
                            <div class="space-y-4 max-h-[400px] overflow-y-auto p-3 border border-gray-200 rounded-md bg-gray-50">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($permissions as $permission)
                                        <div class="relative flex items-start">
                                            <div class="flex items-center h-5">
                                                <input
                                                    type="checkbox"
                                                    name="permissions[]"
                                                    value="{{ $permission->name }}"
                                                    id="permission-{{ $permission->id }}"
                                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                                    {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}
                                                >
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="permission-{{ $permission->id }}" class="font-medium text-gray-700">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end pt-4">
                            <x-primary-button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                                {{ __('Update Role') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-settings>