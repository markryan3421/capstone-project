<x-layout class="bg-gray-900 min-h-screen text-gray-100">
  <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-gray-800 shadow-lg rounded-lg p-6">
      <h2 class="text-2xl font-bold text-white mb-6">Edit Task</h2>

      @if ($errors->any())
        <div class="bg-red-900/20 border-l-4 border-red-500 p-4 mb-6">
          <div class="flex">
            <div class="flex-shrink-0">
              <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
              </svg>
            </div>
            <div class="ml-3">
              <h3 class="text-sm font-medium text-red-400">There were {{ $errors->count() }} errors with your submission</h3>
              <div class="mt-2 text-sm text-red-300">
                <ul class="list-disc pl-5 space-y-1">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      @endif

      <form method="POST" action="{{ route('tasks.update', [$goal->slug, $task->slug]) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-4">
          <div>
            <label for="task-title" class="block text-sm font-medium text-gray-300 mb-2">Title</label>
            <input 
              type="text" 
              name="title" 
              id="task-title" 
              value="{{ old('title', $task->title) }}" 
              class="w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              required>
          </div>
          
          <div>
            <label for="task-description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
            <textarea 
              name="description" 
              id="task-description" 
              rows="4" 
              class="w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $task->description) }}</textarea>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="task-status" class="block text-sm font-medium text-gray-300 mb-2">Status</label>
              <select 
                name="status" 
                id="task-status" 
                class="w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in-progress" {{ old('status', $task->status) == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
              </select>
            </div>
            
            <div>
              <label for="task-due-date" class="block text-sm font-medium text-gray-300 mb-2">Due Date</label>
              <input 
                type="date" 
                name="deadline" 
                id="task-due-date" 
                min="{{ now()->format('Y-m-d') }}"
                value="{{ old('deadline', optional($task->deadline)->format('Y-m-d')) }}" 
                class="w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
          </div>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-700">
          <a href="/goals/show/{{ $goal->slug }}" class="inline-flex justify-center rounded-md border border-gray-600 bg-gray-700 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-colors">
            Cancel
          </a>
          <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-colors">
            Update Task
          </button>
        </div>
      </form>
    </div>
  </div>
</x-layout>