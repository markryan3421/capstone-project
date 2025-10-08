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
                        </div>
                    </div>
                    @if($task->status === 'pending')
                      @if(now()->timezone(config('app.timezone'))->lt($task->deadline))
                        <!-- Submit Button (Before Deadline) -->
                        <div class="flex items-center ml-4">
                          <div class="flex items-center space-x-2">
                            <a href="/tasks/{{ $task->slug }}/submit" 
                              class="flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-white text-xs font-medium transition-all duration-200 shadow hover:shadow-indigo-500/25">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                              Submit Task
                            </a>
                            <span class="text-xs text-gray-300 bg-gray-800/30 px-2 py-0.5 rounded">
                              ⏰ Before {{ $task->deadline->format('M j, g:i A') }}
                            </span>
                          </div>
                        </div>
                      @else
                        <!-- Resubmission Button (After Deadline) -->
                        <div class="space-y-2">
                          <div class="flex items-center text-red-300 text-xs bg-red-900/20 px-2 py-1 rounded border border-red-800/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Deadline passed
                          </div>
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
                            <form action="/tasks/{{ $task->slug }}/approve-resubmission" method="post">
                              @csrf
                              <button type="submit" class="flex items-center px-2.5 py-1 bg-green-700 hover:bg-green-600 rounded text-white text-xs transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Approve
                              </button>
                            </form>

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
                      <div class="space-y-2 ">
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
                    @else
                      <!-- Task Completed -->
                      <div class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-800/30 border border-gray-700/30 text-green-300 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Task completed
                      </div>
                    @endif
                </div>

                <!-- Task Body -->
                <div class="p-6">
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
                                  $daysLeft = floor(\Carbon\Carbon::parse($task->created_at)->diffInDays($task->deadline)); 
                                  $startTime = Carbon\Carbon::parse($task->created_at);
                                  $endTime = Carbon\Carbon::parse($task->deadline);
                                  $remainingHours = $startTime->diffInHours($endTime);
                              @endphp
                              
                              <p class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                  {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                              </p>
                              
                              <div class="flex items-center justify-between mb-2">
                                  <span class="text-sm font-medium {{ $daysLeft >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                      @if($daysLeft > 0)
                                        <!-- If more than 1 day left, show the remaining days -->
                                        {{ round($daysLeft) }} day{{ abs($daysLeft) !== 1 ? 's' : '' }} {{ $daysLeft >= 0 ? 'remaining' : 'overdue' }}
                                      @else
                                        <!-- If less than a day left, show the remaining hours -->
                                        {{ round($remainingHours) }} hour{{ abs($remainingHours) !== 1 ? 's' : '' }} {{ $remainingHours >= 0 ? 'remaining' : 'overdue' }}
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
                  
                  <!-- Enhanced Submissions Section -->
                  <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                      <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                          </svg>
                          Submissions
                      </h4>

                      @if($task->taskProductivities->count()) 
                      <div x-data="{ openRejectModalId: null }" class="space-y-4">
                          @foreach ($task->taskProductivities as $submission)
                          <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
                              <div class="flex items-start justify-between">
                                  <div class="flex-1 min-w-0">
                                      <div class="flex items-center mb-3">
                                          <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold mr-3 shadow-lg">
                                              {{ strtoupper(substr($submission->user->name ?? 'U', 0, 1)) }}
                                          </div>
                                          <div>
                                              <p class="text-gray-900 dark:text-white font-semibold truncate">{{ $submission->user->name ?? 'Unknown User' }}</p>
                                              <p class="text-sm text-gray-500 dark:text-gray-400">{{ $submission->created_at->format('M d, Y \\a\\t h:i A') }}</p>
                                          </div>
                                      </div>
                                      
                                      <!-- Status Display -->
                                      <div class="mt-3 pl-13">
                                          @if($submission->status === 'rejected' && $submission->remarks)
                                          <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-3">
                                              <p class="text-sm text-red-700 dark:text-red-300 font-medium mb-1 flex items-center">
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                  </svg>
                                                  Rejection Remarks
                                              </p>
                                              <p class="text-red-600 dark:text-red-400 text-sm">{{ $submission->remarks }}</p>
                                          </div>
                                          @endif
                                      </div>
                                  </div>
                                  
                                  <div class="flex flex-col sm:flex-row gap-2 ml-4">
                                      <a href="{{ asset('storage/' . $submission->file_path) }}" 
                                        target="_blank"
                                        class="inline-flex items-center px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-gray-700 dark:text-gray-300 text-sm font-medium transition-all duration-200 transform hover:-translate-y-0.5">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                          </svg>
                                          View File
                                      </a>
                                      
                                      @hasanyrole('admin|project-manager')
                                          @if($submission->status === 'approved')
                                              <span class="inline-flex items-center px-3 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-sm font-medium rounded-lg border border-green-200 dark:border-green-800">
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                  </svg>
                                                  Approved
                                              </span>
                                          @elseif($submission->status === 'rejected')
                                              <span class="inline-flex items-center px-3 py-2 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-sm font-medium rounded-lg border border-red-200 dark:border-red-800">
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                  </svg>
                                                  Rejected
                                              </span>
                                          @else
                                              <form action="{{ route('submissions.approve', $submission->id) }}" method="post" class="inline">
                                                  @csrf
                                                  <button type="submit" class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg hover:shadow-green-500/25">
                                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                      </svg>
                                                      Approve
                                                  </button>
                                              </form>
                                              
                                              <button type="button" 
                                                      class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg hover:shadow-red-500/25"
                                                      @click="openRejectModalId = {{ $submission->id }}">
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                  </svg>
                                                  Reject
                                              </button>
                                          @endif
                                      @endhasanyrole
                                      
                                      @if($submission->status === 'rejected')
                                          <a href="{{ route('submissions.resubmit', $submission->id) }}" 
                                            class="inline-flex items-center px-3 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg hover:shadow-yellow-500/25">
                                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                              </svg>
                                              Resubmit
                                          </a>
                                      @endif
                                  </div>
                              </div>
                          </div>

                          <!-- Enhanced Rejection Modal -->
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
                                  <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-gray-200 dark:border-gray-700">
                                      <div class="px-6 py-5 sm:p-6">
                                          <!-- Modal Header -->
                                          <div class="flex items-center justify-between mb-5">
                                              <h3 class="text-xl font-bold text-gray-900 dark:text-white">Reject Submission</h3>
                                              <button @click="openRejectModalId = null" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                  </svg>
                                              </button>
                                          </div>

                                          <!-- Modal Body -->
                                          <form method="POST" action="{{ route('submissions.reject', $submission->id) }}" class="space-y-4">
                                              @csrf
                                              <div>
                                                  <label for="remarks-{{ $submission->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Rejection Remarks *</label>
                                                  <textarea 
                                                      name="remarks" 
                                                      id="remarks-{{ $submission->id }}" 
                                                      rows="4" 
                                                      required
                                                      placeholder="Please provide specific feedback on why this submission is being rejected and what improvements are needed..."
                                                      class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white px-4 py-3 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition resize-none"
                                                  ></textarea>
                                              </div>

                                              <!-- Modal Footer -->
                                              <div class="flex justify-end space-x-3 pt-4">
                                                  <button 
                                                      type="button" 
                                                      @click="openRejectModalId = null" 
                                                      class="px-5 py-2.5 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg text-gray-700 dark:text-gray-300 transition-all duration-200 font-medium"
                                                  >
                                                      Cancel
                                                  </button>
                                                  <button 
                                                      type="submit" 
                                                      class="px-5 py-2.5 bg-red-600 hover:bg-red-700 rounded-lg text-white transition-all duration-200 font-medium flex items-center shadow-lg hover:shadow-red-500/25 transform hover:-translate-y-0.5"
                                                  >
                                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                      </svg>
                                                      Reject Submission
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
                      <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 text-center border-2 border-dashed border-gray-300 dark:border-gray-600">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                          </svg>
                          <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Submissions Yet</h4>
                          <p class="text-gray-500 dark:text-gray-400 text-sm max-w-sm mx-auto">Be the first to submit your work for this task. Click the submit button above to get started.</p>
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