<x-layout>
    <!-- Header Section -->
    <div class="mb-8 text-center">
      <h1 class="text-3xl font-bold text-white mb-2">Create New Task</h1>
      <p class="text-gray-400">Add a new task to your goal: <span class="text-blue-400 font-medium">{{ $goal->title ?? 'Your Goal' }}</span></p>
    </div>

    <!-- Task Creation Form -->
    <div class="bg-gray-800/70 backdrop-blur-sm rounded-xl shadow-2xl border border-gray-700/50 p-6">
      <form method="POST" action="{{ route('tasks.store', $goal->slug) }}" class="space-y-6">
        @csrf
        
        <!-- Title Field -->
        <div>
          <label for="task-title" class="block text-sm font-medium text-gray-300 mb-2 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Task Title
          </label>
          <input 
            type="text" 
            name="title" 
            id="task-title" 
            required 
            placeholder="Title here..."
            class="w-full bg-gray-700/80 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
          >
        </div>

        <!-- Description Field -->
        <div>
          <label for="task-description" class="block text-sm font-medium text-gray-300 mb-2 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
            Description
          </label>
          <textarea 
            name="description" 
            id="task-description" 
            rows="4" 
            placeholder="Provide details about what needs to be done..."
            class="w-full bg-gray-700/80 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
          ></textarea>
        </div>

        <!-- Due Date Field -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="task-due-date" class="block text-sm font-medium text-gray-300 mb-2 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              Due Date - <span class="text-xs ">must not surpass the goal's deadline</span>&nbsp;<span class="text-xs italic text-blue-600/50 dark:text-sky-400/50"> ({{ $goal->end_date }})</span>
            </label>
            <input 
              type="date" 
              name="deadline" 
              id="task-due-date" 
              required
              min="{{ now()->format('Y-m-d') }}"
              class="w-full bg-gray-700/80 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
            >
          </div>          
        </div>

        <!-- Form Actions -->
        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-700/50">
          <a 
            href="{{ route('goals.show', [$goal->slug]) }}" 
            class="px-6 py-3 bg-gray-700 hover:bg-gray-600 rounded-lg text-white transition-all duration-200 flex items-center justify-center order-2 sm:order-1"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Cancel
          </a>
          <button 
            type="submit" 
            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-lg text-white font-medium transition-all duration-200 shadow-lg shadow-blue-600/20 flex items-center justify-center order-1 sm:order-2"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Create Task
          </button>
        </div>
      </form>
    </div>
    
    <!-- Additional Info Section -->
    <div class="mt-8 bg-gray-800/40 backdrop-blur-sm rounded-xl border border-gray-700/30 p-5">
      <div class="flex items-start">
        <div class="flex-shrink-0 mt-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-white">Creating effective tasks</h3>
          <div class="mt-1 text-sm text-gray-400">
            <p>Make your tasks actionable and specific. Set realistic deadlines and prioritize based on importance to your goal.</p>
          </div>
        </div>
      </div>
    </div>
</x-layout>