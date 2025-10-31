<x-layout class="bg-gray-900 min-h-screen text-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex justify-between items-center mb-8">
          <h1 class="text-3xl font-bold text-white">All Tasks Grouped by Goals</h1>
      </div>

      @forelse ($goalsWithTasks as $goal)
          <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-6 border border-gray-700 hover:border-gray-600 transition-colors">
              <div class="px-6 py-4 bg-gray-700 border-b border-gray-600">
                  <div class="flex justify-between items-center">
                      <h2 class="text-xl font-semibold text-white">
                          {{ $goal->title }}
                          <span class="text-sm font-medium ml-2 px-2.5 py-0.5 rounded-full bg-purple-900/50 text-purple-300">
                              {{ ucfirst($goal->type) }} Term
                          </span>
                      </h2>
                      <span class="text-xs text-gray-400">
                          {{ $goal->tasks->count() }} {{ Str::plural('task', $goal->tasks->count()) }}
                      </span>
                  </div>
              </div>
              
              <div class="divide-y divide-gray-700">
                  @if ($goal->tasks->count())
                      @foreach ($goal->tasks as $task)
                          <div class="px-6 py-4 hover:bg-gray-750 transition-colors">
                              <div class="flex justify-between items-start">
                                  <div class="flex-1 min-w-0">
                                      <h3 class="text-lg font-medium text-white mb-1">{{ $task->title }}</h3>
                                      @if($task->description)
                                          <p class="text-sm text-gray-400">{{ $task->description }}</p>
                                      @endif
                                      
                                      <div class="mt-2 flex flex-wrap gap-2">
                                          <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ 
                                              $task->status === 'pending' ? 'bg-yellow-900/50 text-yellow-400' : 
                                              ($task->status === 'in-progress' ? 'bg-blue-900/50 text-blue-400' : 'bg-green-900/50 text-green-400') 
                                          }}">
                                              {{ ucfirst($task->status) }}
                                          </span>
                                          
                                          @if($task->deadline)
                                              <span class="inline-flex items-center text-xs text-gray-500">
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                  </svg>
                                                  Due {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                                              </span>
                                          @endif
                                      </div>
                                  </div>
                                  <div class="ml-4 flex space-x-2">
                                      <a href="{{ route('goals.show', ['goal' => $task->goal->slug]) }}#task-{{ $task->slug }}" class="p-1.5 text-gray-400 hover:text-blue-400 transition-colors" title="View">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                          </svg>
                                      </a>
                                      <a href="#" class="p-1.5 text-gray-400 hover:text-yellow-400 transition-colors" title="Edit">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                          </svg>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  @else
                      <div class="px-6 py-8 text-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                          </svg>
                          <h3 class="mt-4 text-sm font-medium text-gray-400">No tasks assigned to this goal</h3>
                      </div>
                  @endif
              </div>
          </div>
      @empty
          <div class="bg-gray-800 rounded-xl shadow-sm p-8 text-center border border-dashed border-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <h3 class="mt-4 text-lg font-medium text-white">No goals found</h3>
              <p class="mt-1 text-sm text-gray-400">Create a goal to start organizing tasks</p>
              <div class="mt-6">
                  <a href="{{ route('goals.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md text-white shadow-lg hover:shadow-blue-500/20">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                      </svg>
                      New Goal
                  </a>
              </div>
          </div>
      @endforelse
  </div>
</x-layout>