<x-layout class="bg-gray-900 min-h-screen text-gray-100">
  <!-- Alpine.js Data Scope -->
  <div x-data="{
      showTaskModal: false,
      showSubmitModal: false,
      currentTaskSlug: '',
      currentTaskTitle: '',
      
      openTaskModal() {
        this.showTaskModal = true;
      },
      
      closeTaskModal() {
        this.showTaskModal = false;
      },
      
      openSubmitModal(slug, title) {
        this.currentTaskSlug = slug;
        this.currentTaskTitle = title;
        this.showSubmitModal = true;
      },
      
      closeSubmitModal() {
        this.showSubmitModal = false;
      }
    }" class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    
    <!-- Single Column Layout -->
    <div class="space-y-8">
      <!-- Header Section -->
      <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
        <div class="space-y-2">
          <h1 class="text-3xl font-bold text-white">{{ $goal->title }}</h1>
          <div class="flex flex-wrap gap-2">
            <span class="px-3 py-1 rounded-full text-xs font-medium {{ 
              $goal->status === 'pending' ? 'bg-yellow-500' : 
              ($goal->status === 'in-progress' ? 'bg-blue-500' : 'bg-green-500') 
            }}">
              {{ ucfirst($goal->status) }}
            </span>
            <span class="px-3 py-1 rounded-full text-xs font-medium bg-purple-500">
              {{ ucfirst($goal->type) }} Term
            </span>
          </div>
        </div>
        <a href="/" class="flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors duration-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
          </svg>
          Back to List
        </a>
      </div>

      <!-- Main Content -->
      <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-white mb-4">Description</h2>
        <p class="text-gray-300 whitespace-pre-line">{{ $goal->description }}</p>
      </div>

      <!-- Details Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- SDG Card -->
        <div class="bg-gray-800 rounded-xl shadow-lg p-6">
          <h2 class="text-xl font-semibold text-white mb-4">SDG</h2>
          <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold mr-4">
              {{ $goal->sdg->id ?? '?' }}
            </div>
            <span class="text-gray-300">{{ $goal->sdg->name ?? 'Not assigned' }}</span>
          </div>
        </div>

        <!-- Project Manager Card -->
        <div class="bg-gray-800 rounded-xl shadow-lg p-6">
          <h2 class="text-xl font-semibold text-white mb-4">Project Manager</h2>
          <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center text-white font-bold mr-4">
              {{ substr($goal->projectManager->name ?? 'N/A', 0, 1) }}
            </div>
            <span class="text-gray-300">{{ $goal->projectManager->name ?? 'Not assigned' }}</span>
          </div>
        </div>

        <!-- Timeline Card -->
        <x-info-card title="Timeline" icon="calendar">
          <div class="space-y-3">
            <div class="text-gray-300">
              <p><strong>Start Date:</strong> {{ $goal->start_date }}</p>
              <p><strong>End Date:</strong> {{ $goal->end_date }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-400">Duration</p>
              <p class="text-gray-300">
                {{ \Carbon\Carbon::parse($goal->start_date)->diffInDays($goal->end_date) }} days
                @if($goal->end_date < now())
                  (Completed)
                @elseif($goal->start_date > now())
                  (Starts in {{ \Carbon\Carbon::parse($goal->start_date)->diffForHumans() }})
                @else
                  (Ends in {{ \Carbon\Carbon::parse($goal->end_date)->diffForHumans() }})
                @endif
              </p>
            </div>
          </div>
        </x-info-card>

        <!-- Progress Card -->
        <div class="bg-gray-800 rounded-xl shadow-lg p-6">
          <h2 class="text-xl font-semibold text-white mb-4">Progress</h2>
          <div class="mb-4">
            <div class="flex justify-between text-sm text-gray-400 mb-1">
              <span>Completion</span>
              <span>{{ $goal->compliance_percentage ?? 0 }}%</span>
            </div>
            <div class="w-full bg-gray-700 rounded-full h-2.5">
              <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $goal->compliance_percentage ?? 0 }}%"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Assigned Staff Section -->
      <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold text-white">Assigned Staff</h2>
          <span class="text-xs text-gray-400">{{ $goal->assignedUsers->count() }} member/s</span>
        </div>
        
        @if($goal->assignedUsers->count() > 0)
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach ($goal->assignedUsers as $user)
              <div class="flex items-center p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-colors duration-200">
                <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold mr-3">
                  {{ substr($user->name, 0, 1) }}
                </div>
                <div class="truncate">
                  <p class="text-white truncate">{{ $user->name }}</p>
                  <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <p class="text-gray-400 italic">No staff members assigned to this goal</p>
        @endif
      </div>

      <!-- Tasks/Phases Section - Now moved below -->
      <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-bold text-white">Tasks / Phases</h2>

          @hasanyrole('admin|project-manager')
          <button 
            @click="openTaskModal()" 
            class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Task
          </button>
          @endhasanyrole
        </div>
        
        @if($goal->tasks->count() > 0)
          <div class="space-y-4">
            @foreach ($goal->tasks as $task)
            <div class="bg-gray-750 rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-xl">
                <!-- Task Header -->
                <div class="bg-gray-700 px-5 py-3 flex justify-between items-center">
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-white truncate">{{ $task->title }}</h3>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ 
                                $task->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 
                                ($task->status === 'in-progress' ? 'bg-blue-500/20 text-blue-400' : 'bg-green-500/20 text-green-400') 
                            }}">
                                {{ ucfirst($task->status) }}
                            </span>

                            @if($task->approval_status == 'rejected')
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-red-500/20 text-red-400">Rejected</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex space-x-2 ml-4">
                        <a href="/tasks/{{ $task->slug }}/submit" 
                          class="flex items-center px-3 py-1.5 bg-gray-600 hover:bg-gray-700 rounded-md text-white text-sm transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Submit
                        </a>
                    </div>
                </div>

                <!-- Task Body -->
                <div class="p-5">
                    <p class="text-gray-300 text-sm mb-4">{{ $task->description }}</p>
                    
                    <!-- Task Details Row -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-gray-800 rounded-lg p-3">
                            <p class="text-xs text-gray-400 mb-1">Due Date</p>
                            <p class="text-gray-300">{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('M d, Y') : 'Not set' }}</p>
                        </div>
                        <div class="bg-gray-800 rounded-lg p-3">
                            <p class="text-xs text-gray-400 mb-1">Created</p>
                            <p class="text-gray-300">{{ $task->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="bg-gray-800 rounded-lg p-3">
                            <p class="text-xs text-gray-400 mb-1">Submissions</p>
                            <p class="text-gray-300">{{ $task->taskProductivities->count() }}</p>
                        </div>
                    </div>
                    
                    <!-- Submissions Section -->
                    <div class="mt-4 border-t border-gray-700 pt-4">
                        <h4 class="text-sm font-medium text-gray-400 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            SUBMISSIONS
                        </h4>

                        @if($task->taskProductivities->count()) 
                        <div x-data="{ openRejectModalId: null }" class="space-y-3">
                            @foreach ($task->taskProductivities as $submission)
                            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center mb-1">
                                            <div class="w-8 h-8 rounded-full bg-indigo-600/20 flex items-center justify-center text-indigo-400 text-xs font-bold mr-3">
                                                {{ substr($submission->user->name ?? 'U', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-white font-medium truncate">{{ $submission->user->name ?? 'Unknown User' }}</p>
                                                <p class="text-xs text-gray-400">{{ $submission->created_at->format('M d, Y h:i A') }}</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Status Display -->
                                        <div class="mt-2 pl-11">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                @if($submission->status === 'approved') bg-green-900/50 text-green-400
                                                @elseif($submission->status === 'rejected') bg-red-900/50 text-red-400
                                                @else bg-gray-700 text-gray-300 @endif">
                                                {{ ucfirst($submission->status ?? 'pending') }}
                                            </span>
                                            
                                            @if($submission->status === 'rejected' && $submission->remarks)
                                            <p class="text-xs text-red-400 mt-1">Remarks: {{ $submission->remarks }}</p>
                                            @endif
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="flex space-x-2 ml-4">
                                        <a href="{{ asset('storage/' . $submission->file_path) }}" 
                                          target="_blank"
                                          class="flex items-center px-2.5 py-1.5 bg-gray-700 hover:bg-gray-600 rounded-md text-white text-xs transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </a>
                                        
                                        @hasanyrole('admin|project-manager')
                                            @if($submission->status === 'approved')
                                                <span class="flex items-center px-2.5 py-1.5 bg-green-900/20 text-green-400 text-xs">
                                                    ✓ Approved
                                                </span>
                                            @elseif($submission->status === 'rejected')
                                                <span class="flex items-center px-2.5 py-1.5 bg-red-900/20 text-red-400 text-xs">
                                                    ✗ Rejected
                                                </span>
                                            @else
                                                <form action="{{ route('submissions.approve', $submission->id) }}" method="post" class="inline">
                                                    @csrf
                                                    <button type="submit" class="flex items-center px-2.5 py-1.5 bg-green-600/20 hover:bg-green-600/30 rounded-md text-green-400 text-xs transition-colors duration-200">
                                                        Approve
                                                    </button>
                                                </form>
                                                
                                                <button type="button" 
                                                        class="flex items-center px-2.5 py-1.5 bg-red-600/20 hover:bg-red-600/30 rounded-md text-red-400 text-xs transition-colors duration-200"
                                                        @click="openRejectModalId = {{ $submission->id }}">
                                                    Reject
                                                </button>
                                            @endif
                                        @endhasanyrole
                                        
                                        @if($submission->status === 'rejected')
                                            <a href="{{ route('submissions.resubmit', $submission->id) }}" 
                                              class="flex items-center px-2.5 py-1.5 bg-yellow-600/20 hover:bg-yellow-600/30 rounded-md text-yellow-400 text-xs transition-colors duration-200">
                                                Resubmit
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Rejection Modal -->
                            <div x-show="openRejectModalId === {{ $submission->id }}" 
                                x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="fixed inset-0 z-50 overflow-y-auto" 
                                x-cloak>
                                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <!-- Background overlay -->
                                    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="openRejectModalId = null"></div>

                                    <!-- Modal panel -->
                                    <div class="inline-block align-bottom bg-gray-800 rounded-xl shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                                        <div class="px-6 py-5 sm:p-6">
                                            <!-- Modal Header -->
                                            <div class="flex items-center justify-between mb-5">
                                                <h3 class="text-xl font-semibold text-white">Reject Submission</h3>
                                                <button @click="openRejectModalId = null" class="text-gray-400 hover:text-gray-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Modal Body -->
                                            <form method="POST" action="{{ route('submissions.reject', $submission->id) }}" class="space-y-4">
                                                @csrf
                                                <div>
                                                    <label for="remarks-{{ $submission->id }}" class="block text-sm font-medium text-gray-300 mb-2">Remarks *</label>
                                                    <textarea 
                                                        name="remarks" 
                                                        id="remarks-{{ $submission->id }}" 
                                                        rows="4" 
                                                        required
                                                        placeholder="Explain why this submission is being rejected..."
                                                        class="w-full bg-gray-700 border border-gray-600 text-white px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                                                    ></textarea>
                                                </div>

                                                <!-- Modal Footer -->
                                                <div class="flex justify-end space-x-3 pt-4">
                                                    <button 
                                                        type="button" 
                                                        @click="openRejectModalId = null" 
                                                        class="px-5 py-2.5 bg-gray-700 hover:bg-gray-600 rounded-lg text-white transition-colors duration-200"
                                                    >
                                                        Cancel
                                                    </button>
                                                    <button 
                                                        type="submit" 
                                                        class="px-5 py-2.5 bg-red-600 hover:bg-red-700 rounded-lg text-white transition-colors duration-200 flex items-center"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Reject Task
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="bg-gray-800 rounded-lg p-4 text-center border border-dashed border-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <p class="text-gray-400 text-sm mt-2">No submissions yet</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
          </div>
        @else
          <div class="bg-gray-800 rounded-lg p-8 text-center border border-dashed border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-300">No tasks yet</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating your first task</p>
            @hasanyrole('admin|project-manager')
            <div class="mt-6">
              <button 
                @click="openTaskModal()" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white transition-colors duration-200"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add Task
              </button>
            </div>
            @endhasanyrole
          </div>
        @endif
      </div>
    </div>

    <!-- Task Creation Modal -->
    <div 
      x-show="showTaskModal" 
      x-transition:enter="ease-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="ease-in duration-200"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 z-50 overflow-y-auto" 
      x-cloak
    >
      <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="closeTaskModal()"></div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <h3 class="text-lg leading-6 font-medium text-white mb-4">Create New Task</h3>
            <form method="POST" action="{{ route('tasks.store', $goal->slug) }}" class="space-y-4">
              @csrf
              <div class="space-y-4">
                <div>
                  <label for="task-title" class="block text-sm font-medium text-gray-300 mb-1">Title</label>
                  <input type="text" name="title" id="task-title" required class="w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                  <label for="task-description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                  <textarea name="description" id="task-description" rows="3" class="w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label for="task-due-date" class="block text-sm font-medium text-gray-300 mb-1">Due Date</label>
                    <input 
                      type="date" 
                      name="deadline" 
                      id="task-due-date" 
                      required
                      class="w-full bg-gray-700 border border-gray-600 rounded-md px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                      min="{{ now()->format('Y-m-d') }}"  
                    >
                  </div>
                </div>
              </div>
              <div class="mt-6 flex justify-end space-x-3">
                <button 
                  type="button" 
                  @click="closeTaskModal()" 
                  class="px-4 py-2 bg-gray-600 hover:bg-gray-500 rounded-md text-white transition-colors duration-200"
                >
                  Cancel
                </button>
                <button 
                  type="submit" 
                  class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md text-white transition-colors duration-200"
                >
                  Create Task
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>