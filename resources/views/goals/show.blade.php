<x-layout class="bg-gray-900 min-h-screen text-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">

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
              <p><strong>Start Date:</strong> {{ $goal->start_date->format('F j, Y, g:i a') }}</p>
              <p><strong>End Date:</strong> {{ $goal->end_date->format('F j, Y, g:i a') }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-400">Duration</p>
              <p class="text-gray-300">
                {{ floor(\Carbon\Carbon::parse($goal->start_date)->diffInDays($goal->end_date)) }} days
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
          <h2 class="text-xl font-semibold text-white">Assigned Committee/s</h2>
          <span class="text-xs text-gray-400">{{ $goal->assignedUsers->count() }} member/s</span>
        </div>

        @if($goal->assignedUsers->count() > 0)
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach ($goal->assignedUsers as $user)
              <div class="flex items-center p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-colors duration-200">
                <br><br>
                @if($user->avatar)
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-2xl font-bold text-white mb-3 shadow-md overflow-hidden">
                        <img src="{{ asset("storage/avatars/$user->avatar") }}" alt="avatar" class="w-full h-full object-cover">
                    </div>
                    &nbsp;
                @else
                    <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold mr-3">
                        {{ substr($user->name ?? 'N/A', 0, 1) }}
                    </div>
                @endif
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

     

      <!-- Tasks/Phases Section -->
      <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
          <div class="flex items-center gap-4">
            <h2 class="text-2xl font-bold text-white">Tasks</h2>
            
            <!-- Filter Section - Compact -->
            <div class="bg-gray-750 rounded-lg p-2 border border-gray-600">
              <div class="flex items-center gap-2">
                <span class="text-xs font-medium text-gray-300 whitespace-nowrap">Filter:</span>
                <div class="flex flex-wrap gap-1">
                  <button type="button" 
                          data-filter="all" 
                          class="task-filter-btn active px-2 py-1 text-xs font-medium rounded bg-blue-600 text-white transition-all duration-200 hover:bg-blue-700">
                    All
                  </button>
                  <button type="button" 
                          data-filter="approved" 
                          class="task-filter-btn px-2 py-1 text-xs font-medium rounded bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                    Approved
                  </button>
                  <button type="button" 
                          data-filter="rejected" 
                          class="task-filter-btn px-2 py-1 text-xs font-medium rounded bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                    Rejected
                  </button>
                  <button type="button" 
                          data-filter="pending" 
                          class="task-filter-btn px-2 py-1 text-xs font-medium rounded bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                    Pending
                  </button>
                  <button type="button" 
                          data-filter="resubmission_requested" 
                          class="task-filter-btn px-2 py-1 text-xs font-medium rounded bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                    Resubmission Requests
                  </button>
                   <button type="button" 
                          data-filter="approved_resubmission" 
                          class="task-filter-btn px-2 py-1 text-xs font-medium rounded bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                    Approved Resubmissions
                  </button>
                  <button type="button" 
                          data-filter="rejected_resubmission" 
                          class="task-filter-btn px-2 py-1 text-xs font-medium rounded bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                    Rejected Resubmissions
                  </button>
                  <button type="button" 
                          data-filter="completed_late" 
                          class="task-filter-btn px-2 py-1 text-xs font-medium rounded bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                    Late Completions
                  </button>
                </div>
              </div>
            </div>
          </div>

          

          @hasanyrole('admin|project-manager')
          <a
            href="{{ route('tasks.add-task', [$goal->slug]) }}"
            class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Task
          </a>
          @endhasanyrole
        </div>

        @if($goal->tasks->count() > 0)
          <div class="space-y-4" id="tasks-container">
            @foreach ($goal->tasks as $task)
            <!-- Task Box -->
            <div id="task-{{$task->slug}}" class="task-item bg-gray-750 rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-xl" 
                 data-status="{{ 
                   $task->status === 'completed' ? 'approved' : 
                   ($task->status === 'completed_late' ? 'completed_late' : 
                   $task->status) 
                 }}">
                <!-- Task Header -->
                <div class="bg-gray-700 px-5 py-3 flex justify-between items-center cursor-pointer" onclick="toggleTaskDetails('{{$task->slug}}')">
                    <div class="flex-1 min-w-0 flex items-center">
                        <svg id="icon-{{$task->slug}}" class="h-4 w-4 mr-2 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <div class="min-w-0">
                          <h3 class="text-lg font-semibold text-white truncate">{{ $task->title }}</h3>
                          <!-- Small Task Info Preview -->
                          <div class="flex items-center gap-3 mt-1 text-xs text-gray-400">
                            <span class="flex items-center">
                              <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                              </svg>
                              {{ $task->deadline ? $task->deadline->format('M d') : 'No deadline' }}
                            </span>
                            <span class="flex items-center">
                              <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                              </svg>
                              {{ $task->taskProductivities->count() }} submission{{ $task->taskProductivities->count() !== 1 ? 's' : '' }}
                            </span>
                            @if($task->deadline)
                              @php
                                $today = \Carbon\Carbon::now();
                                $deadline = \Carbon\Carbon::parse($task->deadline);
                                $daysLeft = $today->diffInDays($deadline, false);
                              @endphp
                              <span class="flex items-center {{ $daysLeft < 0 ? 'text-red-400' : ($daysLeft <= 3 ? 'text-yellow-400' : 'text-green-400') }}">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                @if($daysLeft > 0)
                                  {{ round($daysLeft) }}d left
                                @elseif($daysLeft == 0)
                                  Due today
                                @else
                                  Overdue
                                @endif
                              </span>
                            @endif
                          </div>
                        </div>
                    </div>

                    <!-- Status and Action Buttons -->
                    <div class="flex items-center gap-3 ml-4">
                      @if($task->status === 'pending')
                        @if(now()->timezone(config('app.timezone'))->lt($task->deadline))
                          <!-- Submit Button (Before Deadline) -->
                          <div class="flex items-center">
                            <div class="flex items-center space-x-2">
                              <a href="/tasks/{{ $task->slug }}/submit"
                                class="flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-white text-xs font-medium transition-all duration-200 shadow hover:shadow-indigo-500/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Submit Task
                              </a>
                            </div>
                          </div>
                        @else
                          <!-- Resubmission Button (After Deadline) -->
                          <div class="space-y-2">
                            <form action="/request-resubmission/{{ $task->slug }}" method="post">
                              @csrf
                              <button type="submit"
                                      class="flex items-center px-3 py-1.5 bg-amber-600 hover:bg-amber-500 rounded-lg text-white text-xs font-medium transition-all duration-200 shadow hover:shadow-amber-500/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Request Resubmission
                              </button>
                            </form>
                          </div>
                        @endif
                      @elseif($task->status === 'resubmission_requested')
                        @if(Auth::user()->hasAnyRole(['admin', 'project-manager']))
                          <!-- Admin/Manager View -->
                          <div class="space-y-2 p-3 bg-blue-900/20 rounded-lg border border-blue-800/30">
                            <div class="flex items-center text-blue-300 text-xs">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                              Resubmission Request
                            </div>
                            <p class="text-xs text-gray-300">Staff requested resubmission</p>

                            <div class="flex space-x-2">
                              <!-- Approve resubmission -->
                              <button command="show-modal" commandfor="dialog" class="flex items-center px-2.5 py-1 bg-green-700 hover:bg-green-600 rounded text-white text-xs transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Approve
                              </button>
                              <el-dialog>
                                <dialog id="dialog" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
                                    <el-dialog-backdrop class="fixed inset-0 bg-gray-900/50 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>
                                    <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
                                      <el-dialog-panel class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-2xl border border-gray-200 dark:border-gray-700 transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-md data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                                          <!-- Header -->
                                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <h3 id="dialog-title" class="text-xl font-bold text-gray-900 dark:text-white">Extend Task Deadline</h3>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Grant additional time for task completion</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="px-6 py-5 space-y-5">
                                            <!-- Task Information -->
                                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 border border-gray-200 dark:border-gray-600">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex-1">
                                                        <h4 class="font-semibold text-gray-900 dark:text-white text-sm mb-1">Task Deadline Extension</h4>
                                                        <div class="flex items-center space-x-4 text-xs text-gray-600 dark:text-gray-400">
                                                            <span class="flex items-center">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                                </svg>
                                                                {{ $task->deadline->format('M d, Y') }}
                                                            </span>
                                                            <span class="flex items-center">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                </svg>
                                                                {{ floor(\Carbon\Carbon::parse($task->deadline)->diffInDays(now())) }}
                                                                days overdue
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Extension Form -->
                                            <form class="space-y-4" action="/tasks/{{ $task->slug }}/approve-resubmission" method="post">
                                                @csrf
                                                @method('PUT')
                                                <!-- New Deadline Date -->
                                                <div>
                                                    <label for="new-deadline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                        New Deadline Date *
                                                    </label>
                                                    <div class="relative">
                                                        <input type="date"
                                                              id="new-deadline"
                                                              name="deadline"
                                                              required
                                                              class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors pr-10">
                                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 flex items-center">
                                                        <svg class="w-3 h-3 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        Select a future date to extend the deadline
                                                    </p>
                                                </div>
                                              </div>

                                              <!-- Footer -->
                                              <div class="bg-gray-50 dark:bg-gray-700/25 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                                                  <div class="flex flex-col sm:flex-row gap-3 sm:justify-between sm:items-center">
                                                      <p class="text-xs text-gray-500 dark:text-gray-400 text-center sm:text-left">
                                                          <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                          </svg>
                                                          This action will update the task timeline
                                                      </p>
                                                      <div class="flex flex-col sm:flex-row gap-3">
                                                          <button type="button"
                                                                  command="close"
                                                                  commandfor="dialog"
                                                                  class="inline-flex justify-center items-center px-4 py-2.5 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200 order-2 sm:order-1">
                                                              Cancel
                                                          </button>
                                                          <button type="submit"
                                                                  class="inline-flex justify-center items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 shadow-sm hover:shadow-md order-1 sm:order-2">
                                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                                  </svg>
                                                              Approve & Extend Deadline
                                                          </button>
                                                      </div>
                                                  </div>
                                              </div>
                                            </form>
                                      </el-dialog-panel>
                                    </div>
                                </dialog>
                            </el-dialog>

                              <!-- Reject resubmission -->
                              <form action="/tasks/{{ $task->slug }}/reject-resubmission" method="post">
                                @csrf
                                <button type="submit" class="flex items-center px-2.5 py-1 bg-red-700 hover:bg-red-600 rounded text-white text-xs transition-colors">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                                  Reject
                                </button>
                              </form>
                            </div>
                          </div>
                        @else
                          <!-- User View - Request Sent -->
                          <div class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-900/30 border border-blue-700/30 text-blue-300 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Request pending approval
                          </div>
                        @endif
                      @elseif($task->status === 'approved_resubmission')
                        <!-- Approved Resubmission -->
                        <div class="space-y-2">
                          <div class="flex items-center text-green-300 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Resubmission Approved
                          </div>
                          <a href="/tasks/{{ $task->slug }}/resubmit"
                            class="inline-flex items-center px-3 py-1.5 bg-emerald-600 hover:bg-emerald-500 rounded-lg text-white text-xs font-medium transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Submit Now
                          </a>
                        </div>
                      @elseif($task->status === 'rejected_resubmission')
                        <!-- Rejected Resubmission -->
                        <div class="inline-flex items-center text-red-400 text-xs">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                          Resubmission rejected. You can no longer submit task compliance.
                        </div>
                      @elseif($task->status === 'completed_late')
                        <div class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-500/30 border border-gray-700/30 text-green-100 text-xs">
                          Completed (Late)
                        </div>
                      @else
                        <!-- Task Completed -->
                        <div class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-800/30 border border-gray-700/30 text-green-300 text-xs">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                          Task completed
                        </div>
                      @endif

                      @hasanyrole(['admin', 'project-manager'])
                      <!-- More Dropdown -->
                        <div class="hs-dropdown [--strategy:absolute] relative inline-flex">
                          <button id="hs-pro-ainmd" type="button" class="flex justify-center items-center gap-x-3 size-9 text-sm text-gray-600 hover:bg-gray-100 rounded-lg disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:hover:text-neutral-200 dark:focus:text-neutral-200">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>
                          </button>

                          <!-- More Dropdown -->
                          <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-32 transition-[opacity,margin] duration opacity-0 hidden z-11 bg-white border border-gray-200 rounded-xl shadow-lg before:absolute before:-top-4 before:start-0 before:w-full before:h-5 dark:bg-neutral-950 dark:border-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-pro-ainmd">
                            <div class="p-1 space-y-0.5">
                              <a href="{{ route('tasks.edit', [$goal->slug, $task->slug]) }}" class="w-full flex items-center gap-x-3 py-1.5 px-2 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                Edit
                              </a>


                              <form action="{{  route('tasks.delete', [$goal->slug, $task->slug]) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="w-full flex items-center gap-x-3 py-1.5 px-2 rounded-lg text-sm text-red-600 hover:bg-red-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-red-50 dark:text-red-500 dark:hover:bg-red-500/20 dark:focus:bg-red-500/20">
                                  <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                  Delete
                                </button>
                              </form>
                            </div>
                          </div>
                          <!-- End More Dropdown -->
                        </div>
                      <!-- End More Dropdown -->
                      @endhasanyrole
                  </div>
                </div>

                <!-- Task Body - Collapsible -->
                <div id="details-{{$task->slug}}" class="p-6 hidden">
                  <!-- Task Description -->
                  <p class="text-gray-700 dark:text-gray-300 text-sm mb-6 leading-relaxed">{{ $task->description }}</p>

                  <!-- Enhanced Task Details Row -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                      <!-- Due Date Card -->
                      <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-4 shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                          <div class="flex items-center justify-between mb-2">
                              <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Due Date</p>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 dark:text-gray-500 group-hover:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                              </svg>
                          </div>

                          @if($task->deadline)
                            @php
                                $today = \Carbon\Carbon::now();
                                $deadline = \Carbon\Carbon::parse($task->deadline);

                                // Calculate time differences correctly
                                $daysLeft = $today->diffInDays($deadline, false); // false = don't return absolute value
                                $hoursLeft = $today->diffInHours($deadline, false);
                                $totalHoursLeft = $today->diffInHours($deadline, false);
                            @endphp

                            <p class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                {{ $deadline->format('M d, Y') }}
                            </p>

                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium
                                    @if($daysLeft > 0) text-green-600 dark:text-green-400
                                    @elseif($daysLeft == 0 && $hoursLeft > 0) text-yellow-600 dark:text-yellow-400
                                    @elseif($daysLeft == 0 && $hoursLeft == 0) text-orange-600 dark:text-orange-400
                                    @else text-red-600 dark:text-red-400 @endif">

                                    @if($daysLeft > 1)
                                        <!-- More than 1 day remaining -->
                                        {{ round($daysLeft) }} days remaining
                                    @elseif($daysLeft == 1)
                                        <!-- Exactly 1 day remaining -->
                                        1 day remaining
                                    @elseif($daysLeft == 0 && $hoursLeft > 12)
                                        <!-- Less than 1 day but more than 12 hours -->
                                        {{ $hoursLeft }} hours remaining
                                    @elseif($daysLeft == 0 && $hoursLeft > 1)
                                        <!-- Less than 12 hours but more than 1 hour -->
                                        {{ $hoursLeft }} hours remaining
                                    @elseif($daysLeft == 0 && $hoursLeft == 1)
                                        <!-- Exactly 1 hour remaining -->
                                        1 hour remaining
                                    @elseif($daysLeft == 0 && $hoursLeft == 0)
                                        <!-- Exactly at deadline -->
                                        Due now
                                    @elseif($daysLeft == 0 && $hoursLeft < 0 && $hoursLeft > -24)
                                        <!-- Less than 24 hours overdue -->
                                        {{ abs($hoursLeft) }} hours overdue
                                    @elseif($daysLeft < 0)
                                        <!-- More than 24 hours overdue -->
                                        Deadline passed
                                    @else
                                        <!-- Fallback -->
                                        Deadline passed
                                    @endif
                                </span>
                            </div>
                          @else
                            <p class="text-lg font-bold text-gray-400 dark:text-gray-500 mb-2">Not set</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 italic">No deadline specified</p>
                          @endif
                      </div>

                      <!-- Created Date Card -->
                      <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-4 shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                          <div class="flex items-center justify-between mb-2">
                              <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Created</p>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                          </div>

                          <p class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                              {{ $task->created_at->format('M d, Y') }}
                          </p>

                          <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                              {{ $task->created_at->diffForHumans() }}
                          </div>
                      </div>

                      <!-- Submissions Card -->
                      <div class="group relative bg-white dark:bg-gray-800 rounded-xl p-4 shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                          <div class="flex items-center justify-between mb-2">
                              <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Submissions</p>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 dark:text-gray-500 group-hover:text-emerald-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                              </svg>
                          </div>

                          <div class="flex items-end justify-between">
                              <div>
                                  <p class="text-3xl font-bold text-gray-900 dark:text-white mb-1">
                                      {{ $task->taskProductivities->count() }}
                                  </p>
                                  <p class="text-sm text-gray-600 dark:text-gray-400">
                                      submission{{ $task->taskProductivities->count() !== 1 ? 's' : '' }} total
                                  </p>
                              </div>

                              @if($task->taskProductivities->count() > 0)
                                  @php
                                      $approvedCount = $task->taskProductivities->where('status', 'approved')->count();
                                      $approvalRate = ($approvedCount / $task->taskProductivities->count()) * 100;
                                  @endphp

                                  <div class="text-right">
                                      <div class="flex items-center justify-end mb-1">
                                          <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400 mr-1">
                                              {{ $approvedCount }}
                                          </span>
                                          <span class="text-xs text-gray-500 dark:text-gray-400">approved</span>
                                      </div>
                                      <div class="w-16 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                          <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $approvalRate }}%"></div>
                                      </div>
                                      <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($approvalRate, 0) }}% rate</p>
                                  </div>
                              @endif
                          </div>
                      </div>
                  </div>

                  <!-- Submissions Section -->
                  <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="h-5 w-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Submissions
                    </h4>

                    @if($task->taskProductivities->count())
                    <div class="space-y-4">
                        @foreach ($task->taskProductivities as $submission)
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center mb-4">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold mr-3 shadow-lg">
                                            {{ strtoupper(substr($submission->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-gray-900 dark:text-white font-semibold truncate">{{ $submission->user->name ?? 'Unknown User' }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $submission->created_at->format('M d, Y \\a\\t h:i A') }}</p>
                                        </div>
                                    </div>

                                    <!-- Files Display -->
                                    @if($submission->taskProductivityFiles->count())
                                    <div class="mt-4 pl-13">
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Submitted Files
                                        </p>
                                        <div class="grid gap-2 max-w-2xl">
                                            @foreach($submission->taskProductivityFiles as $file)
                                            <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 border border-gray-200 dark:border-gray-600 hover:bg-white dark:hover:bg-gray-700 transition-colors duration-200">
                                                <div class="flex items-center min-w-0 flex-1">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <span class="text-sm text-gray-700 dark:text-gray-300 truncate">{{ $file->file_name }}</span>
                                                </div>
                                                <a href="{{ asset('storage/'.$file->file_path) }}"
                                                  target="_self"
                                                  class="inline-flex items-center px-2.5 py-1.5 bg-transparent hover:bg-blue-50 dark:hover:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-xs font-medium rounded-md border border-blue-200 dark:border-blue-800 transition-colors duration-200 ml-2 flex-shrink-0">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    Open
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Status Display -->
                                    @if($submission->status === 'rejected' && $submission->remarks)
                                    <div class="mt-4 pl-13">
                                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-3">
                                            <p class="text-sm text-red-700 dark:text-red-300 font-medium mb-1 flex items-center">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Rejection Remarks
                                            </p>
                                            <p class="text-red-600 dark:text-red-400 text-sm">{{ $submission->remarks }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row gap-2 ml-4 flex-shrink-0">
                                    @hasanyrole('admin|project-manager')
                                        @if($submission->status === 'approved')
                                            <span class="inline-flex items-center px-3 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-sm font-medium rounded-lg border border-green-200 dark:border-green-800">
                                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Approved
                                            </span>
                                        @elseif($submission->status === 'rejected')
                                            <span class="inline-flex items-center px-3 py-2 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-sm font-medium rounded-lg border border-red-200 dark:border-red-800">
                                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Rejected
                                            </span>
                                        @else
                                            <form action="{{ route('submissions.approve', $submission->id) }}" method="post" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-green-500/25">
                                                    <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Approve
                                                </button>
                                            </form>

                                            <a href="{{ route('submissions.reject-form', $submission->id) }}"
                                                class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-red-500/25"
                                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Reject
                                            </a>
                                        @endif
                                    @endhasanyrole

                                    @if($submission->status === 'rejected')
                                        <a href="{{ route('submissions.resubmit-form', [$task->slug, $submission->id]) }}"
                                          class="inline-flex items-center px-3 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-yellow-500/25">
                                            <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Resubmit
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 text-center border-2 border-dashed border-gray-300 dark:border-gray-600">
                        <svg class="h-16 w-16 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Submissions Yet</h4>
                        <p class="text-gray-500 dark:text-gray-400 text-sm max-w-sm mx-auto">Be the first to submit your work for this task.</p>
                    </div>
                    @endif
                </div>
              </div>
            </div>
             <!-- Filter Notice Container -->
      <div id="filter-notice" class="hidden mb-6">
          <div class="bg-gray-800 rounded-xl border border-gray-700 p-6 text-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <h3 class="text-xl font-semibold text-white mb-2" id="filter-notice-title">No tasks found</h3>
              <p class="text-gray-400" id="filter-notice-message">There are no tasks matching the current filter.</p>
          </div>
      </div>
            <!-- End Task Box -->
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
              <a href="{{ route('tasks.add-task', [$goal->slug]) }}"
                type="button"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white transition-colors duration-200"
                data-hs-overlay="#hs-task-creation-modal"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add Task
              </a>
              
            </div>
            
            @endhasanyrole
          </div>
        @endif
      </div>
    </div>
  </div>

  <script>
    function toggleTaskDetails(taskSlug) {
      const details = document.getElementById(`details-${taskSlug}`);
      const icon = document.getElementById(`icon-${taskSlug}`);
      
      if (details.classList.contains('hidden')) {
        details.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
      } else {
        details.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
      }
    }

    // Task Filter Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.task-filter-btn');
        const taskItems = document.querySelectorAll('.task-item');
        const filterNotice = document.getElementById('filter-notice');
        const filterNoticeTitle = document.getElementById('filter-notice-title');
        const filterNoticeMessage = document.getElementById('filter-notice-message');
        
        // Filter messages configuration
        const filterMessages = {
            'all': { title: 'No tasks found', message: 'There are no tasks in this goal.' },
            'approved': { title: 'No approved tasks', message: 'There are no tasks that have been approved yet.' },
            'rejected': { title: 'No rejected tasks', message: 'There are no tasks that have been rejected.' },
            'pending': { title: 'No pending tasks', message: 'There are no tasks currently pending review.' },
            'resubmission_requested': { title: 'No resubmission requests', message: 'There are no tasks that require resubmission.' },
            'approved_resubmission': { title: 'No approved resubmissions', message: 'There are no resubmitted tasks that have been approved.' },
            'rejected_resubmission': { title: 'No rejected resubmissions', message: 'There are no resubmitted tasks that have been rejected.' },
            'completed_late': { title: 'No late completions', message: 'There are no tasks that were completed late.' }
        };

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Update active button
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-600', 'text-gray-300', 'hover:bg-gray-500');
                });
                this.classList.remove('bg-gray-600', 'text-gray-300', 'hover:bg-gray-500');
                this.classList.add('active', 'bg-blue-600', 'text-white');
                
                // Filter tasks
                let visibleTaskCount = 0;
                
                taskItems.forEach(task => {
                    const taskStatus = task.getAttribute('data-status');
                    
                    if (filter === 'all' || taskStatus === filter) {
                        task.style.display = 'block';
                        visibleTaskCount++;
                    } else {
                        task.style.display = 'none';
                    }
                });
                
                // Show/hide filter notice
                if (visibleTaskCount === 0) {
                    const messageConfig = filterMessages[filter];
                    filterNoticeTitle.textContent = messageConfig.title;
                    filterNoticeMessage.textContent = messageConfig.message;
                    filterNotice.classList.remove('hidden');
                } else {
                    filterNotice.classList.add('hidden');
                }
            });
        });
    });
  </script>
</x-layout>