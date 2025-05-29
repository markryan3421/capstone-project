<x-layout class=" min-h-screen text-white">
  <div class="max-w-4xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Create Goal</h2>

    <form action="/goals/create" method="POST" class="space-y-6 p-6 text-gray-900 p-6 rounded-lg border border-gray-700">
        @csrf

        <!-- Creator (disabled) -->
        <div>
            <label class="block text-xs font-medium mb-1 uppercase tracking-wider">Created By</label>
            <input type="text" 
                   class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-md text-gray-300" 
                   value="{{ auth()->user()->name }}" disabled>
            <input type="hidden" name="project_manager_id" value="{{ $sdg->id }}">
        </div>

        <!-- SDG Name -->
        <div>
            <label class="block text-xs font-medium mb-1 uppercase tracking-wider">SDG</label>
            <input type="text" 
                    class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-md text-gray-300" 
                    value="{{ $sdg->name }}" 
                    disabled
            >
            <input type="hidden" name="sdg_id" value="{{ $sdg->id }}">
        </div>

        <!-- Goal Name -->
        <div>
            <label for="goalName" class="block text-xs font-medium mb-1 uppercase tracking-wider">Goal Name</label>
            <input type="text" name="title" id="goalName" 
                    value="{{ old('title') }}"
                   class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-md text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                   required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-xs font-medium mb-1 uppercase tracking-wider">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-md text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        <!-- Start and End Dates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="start_date" class="block text-xs font-medium mb-1 uppercase tracking-wider">Start Date</label>
                <input type="date" name="start_date" id="start_date"
                       class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-md text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       min="{{ now()->format('Y-m-d') }}"  
                       required>
            </div>

            <div>
                <label for="end_date" class="block text-xs font-medium mb-1 uppercase tracking-wider">End Date</label>
                <input type="date" name="end_date" id="end_date"
                       class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-md text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       min="{{ now()->format('Y-m-d') }}"  
                       required>
            </div>
        </div>

        <!-- Status and Type -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="status" class="block text-xs font-medium mb-1 uppercase tracking-wider">Status</label>
                <select name="status" id="status"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-md text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                        required>
                    <option value="pending">Pending</option>
                    <option value="in-progress">In-Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div>
                <label for="type" class="block text-xs font-medium mb-1 uppercase tracking-wider">Type</label>
                <select name="type" id="type"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-md text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                        required>
                    <option value="short">Short Term</option>
                    <option value="long">Long Term</option>
                </select>
            </div>
        </div>

        <!-- Assigned Staffs -->
        @if ($staffUsers->isEmpty())
          <div class="bg-gray-800 p-4 rounded-md text-sm text-gray-400">
              No staff available to assign.
          </div>
        @else
          <div>
            <label class="block text-xs font-medium mb-1 uppercase tracking-wider">Assign to Staff</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @foreach ($staffUsers as $person)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="assigned_users[]" value="{{ $person->id }}" class="form-checkbox text-indigo-500">
                        <span class="text-gray-300">{{ $person->name }}</span>
                    </label>
                @endforeach
            </div>
          </div>
        @endif

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit" 
                    class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                Create Goal
            </button>
        </div>
    </form>
  </div>
</x-layout>
