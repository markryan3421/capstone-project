<x-layout class="min-h-screen text-white">
  <div class="max-w-4xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
      <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">Create New Goal</h2>
    </div>

    <form action="/goals/create" method="POST" class="space-y-6 p-8 bg-gray-800/80 backdrop-blur-sm rounded-xl border border-gray-700 shadow-lg">
        @csrf

        <!-- Creator (disabled) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
              <label class="block text-sm font-medium mb-2 text-gray-300">Created By</label>
              <div class="flex items-center px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg">
                <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center text-sm font-bold mr-3">
                  {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span class="text-gray-200">{{ auth()->user()->name }}</span> (You)
              </div>
              <input type="hidden" name="project_manager_id" value="{{ $sdg->id }}">
          </div>

          <!-- SDG Name -->
          <div>
              <label class="block text-sm font-medium mb-2 text-gray-300">SDG</label>
              <div class="px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-gray-200">
                {{ $sdg->name }}
              </div>
              <input type="hidden" name="sdg_id" value="{{ $sdg->id }}">
          </div>
        </div>

        <!-- Goal Name -->
        <div>
            <label for="goalName" class="block text-sm font-medium mb-2 text-gray-300">Goal Name</label>
            <input type="text" name="title" id="goalName" 
                    value="{{ old('title') }}"
                   class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-500 transition duration-200" 
                   placeholder="Enter goal name"
                   required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium mb-2 text-gray-300">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder-gray-500 transition duration-200"
                      placeholder="Describe the goal and its objectives"></textarea>
        </div>

        <!-- Start and End Dates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="start_date" class="block text-sm font-medium mb-2 text-gray-300">Start Date</label>
                <input type="date" name="start_date" id="start_date"
                       class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                       min="{{ now()->format('Y-m-d') }}"  
                       required>
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium mb-2 text-gray-300">End Date</label>
                <input type="date" name="end_date" id="end_date"
                       class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                       min="{{ now()->format('Y-m-d') }}"  
                       required>
            </div>
        </div>

        <!-- Status and Type -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="type" class="block text-sm font-medium mb-2 text-gray-300">Goal Type</label>
                <div class="relative">
                    <select name="type" id="type"
                            class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent appearance-none transition duration-200 pr-10" 
                            required>
                        <option value="short" class="bg-gray-800">Short Term</option>
                        <option value="long" class="bg-gray-800">Long Term</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assigned Staffs -->
        @if ($staffUsers->isEmpty())
          <div class="bg-gray-700/50 p-4 rounded-lg text-sm text-gray-400 border border-gray-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
              No staff members available to assign
          </div>
        @else
          <div>
            <label class="block text-sm font-medium mb-2 text-gray-300">Assign to Team Members</label>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($staffUsers as $person)
                    <label class="flex items-center space-x-3 p-3 bg-gray-700/30 hover:bg-gray-700/50 rounded-lg border border-gray-600 transition-colors duration-200 cursor-pointer">
                        <input type="checkbox" name="assigned_users[]" value="{{ $person->id }}" 
                               class="form-checkbox h-5 w-5 text-indigo-500 rounded border-gray-600 focus:ring-indigo-500 bg-gray-700">
                        <div class="flex items-center">
                          <div class="w-8 h-8 bg-purple-500/20 rounded-full flex items-center justify-center text-sm font-bold mr-3">
                            {{ strtoupper(substr($person->name, 0, 1)) }}
                          </div>
                          <span class="text-gray-200">{{ $person->name }}</span>
                        </div>
                    </label>
                @endforeach
            </div>
          </div>
        @endif

        <!-- Submit -->
        <div class="flex justify-end pt-4">
           <button type="submit" 
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md !important">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create Goal
            </button>
        </div>
    </form>
  </div>
</x-layout>