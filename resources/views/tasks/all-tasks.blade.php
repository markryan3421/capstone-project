<x-layout class="bg-gray-900 min-h-screen text-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


      <div class="flex justify-between items-center mb-8">
          <h1 class="text-3xl font-bold text-white">All Tasks Grouped by Goals</h1>
      </div>
      <!-- Filter Section -->
      <div class="mb-8">
          <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
              <div class="flex flex-col gap-3">
                  <span class="text-sm font-medium text-gray-300">Filter Tasks:</span>
                  <div class="flex flex-wrap gap-2">
                      <button type="button" 
                              data-filter="all" 
                              class="task-filter-btn active px-3 py-2 text-sm font-medium rounded-md bg-blue-600 text-white transition-all duration-200 hover:bg-blue-700">
                          All
                      </button>
                      <button type="button" 
                              data-filter="approved" 
                              class="task-filter-btn px-3 py-2 text-sm font-medium rounded-md bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                          Approved
                      </button>
                      <button type="button" 
                              data-filter="rejected" 
                              class="task-filter-btn px-3 py-2 text-sm font-medium rounded-md bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                          Rejected
                      </button>
                      <button type="button" 
                              data-filter="pending" 
                              class="task-filter-btn px-3 py-2 text-sm font-medium rounded-md bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                          Pending
                      </button>
                      <button type="button" 
                              data-filter="resubmission_requested" 
                              class="task-filter-btn px-3 py-2 text-sm font-medium rounded-md bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                          Resubmission Requests
                      </button>
                      <button type="button" 
                              data-filter="approved_resubmission" 
                              class="task-filter-btn px-3 py-2 text-sm font-medium rounded-md bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                          Approved Resubmissions
                      </button>
                      <button type="button" 
                              data-filter="rejected_resubmission" 
                              class="task-filter-btn px-3 py-2 text-sm font-medium rounded-md bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                          Rejected Resubmissions
                      </button>
                      <button type="button" 
                              data-filter="completed_late" 
                              class="task-filter-btn px-3 py-2 text-sm font-medium rounded-md bg-gray-600 text-gray-300 hover:bg-gray-500 transition-all duration-200">
                          Late Completions
                      </button>
                  </div>
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

      @forelse ($goalsWithTasks as $goal)
          <div class="goal-section bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-6 border border-gray-700 hover:border-gray-600 transition-all duration-300 hover:shadow-xl">
              <!-- Goal Header - Clickable -->
              <div class="goal-header px-6 py-5 bg-gradient-to-r from-gray-750 to-gray-700 border-b border-gray-600 cursor-pointer transition-all duration-300 hover:from-gray-700 hover:to-gray-650"
                   onclick="toggleGoal('goal-{{ $goal->id }}')">
                  <div class="flex justify-between items-center">
                      <div class="flex items-center space-x-4">
                          <div class="transform transition-transform duration-300 goal-arrow">
                              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                              </svg>
                          </div>
                          <div>
                              <h2 class="text-xl font-semibold text-white flex items-center gap-2">
                                  {{ $goal->title }}
                                  <span class="text-sm font-medium px-2.5 py-0.5 rounded-full bg-purple-900/50 text-purple-300 border border-purple-700/30">
                                      {{ ucfirst($goal->type) }} Term
                                  </span>
                              </h2>
                              <p class="text-sm text-gray-400 mt-1">{{ $goal->description ? \Illuminate\Support\Str::limit($goal->description, 100) : 'No description' }}</p>
                          </div>
                      </div>
                      <div class="flex items-center space-x-4">
                          <div class="text-right">
                              <span class="text-xs text-gray-400 block">Progress</span>
                              <div class="w-24 bg-gray-600 rounded-full h-2 mt-1">
                                  <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" 
                                       style="width: {{ $goal->compliance_percentage ?? 0 }}%"></div>
                              </div>
                              <span class="text-xs text-gray-300 mt-1">{{ $goal->compliance_percentage ?? 0 }}%</span>
                          </div>
                          <div class="text-right">
                              <div class="text-sm font-medium text-white">{{ $goal->tasks->count() }} {{ Str::plural('task', $goal->tasks->count()) }}</div>
                              <div class="text-xs text-gray-400">
                                  {{ $goal->start_date ? \Carbon\Carbon::parse($goal->start_date)->format('M d, Y') : 'No start date' }}
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              
              <!-- Tasks Container - Collapsible -->
              <div id="goal-{{ $goal->id }}" class="goal-content divide-y divide-gray-700">
                  @if ($goal->tasks->count())
                      @foreach ($goal->tasks as $task)
                          <div class="task-item px-6 py-5 hover:bg-gray-750 transition-all duration-200 group" 
                               data-status="{{ 
                                 $task->status === 'completed' ? 'approved' : 
                                 ($task->status === 'completed_late' ? 'completed_late' : 
                                 $task->status) 
                               }}">
                              <div class="flex justify-between items-start">
                                  <div class="flex-1 min-w-0">
                                      <div class="flex items-start justify-between mb-3">
                                          <h3 class="text-lg font-semibold text-white group-hover:text-blue-300 transition-colors">{{ $task->title }}</h3>
                                          <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ 
                                              $task->status === 'pending' ? 'bg-yellow-900/50 text-yellow-400 border border-yellow-700/30' : 
                                              ($task->status === 'in-progress' ? 'bg-blue-900/50 text-blue-400 border border-blue-700/30' : 
                                              'bg-green-900/50 text-green-400 border border-green-700/30') 
                                          }} ml-3">
                                              {{ ucfirst($task->status) }}
                                          </span>
                                      </div>
                                      
                                      @if($task->description)
                                          <p class="text-sm text-gray-400 mb-4 leading-relaxed">{{ $task->description }}</p>
                                      @endif
                                      
                                      <div class="flex flex-wrap items-center gap-4 text-sm">
                                          @if($task->deadline)
                                              <div class="flex items-center text-gray-400">
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                  </svg>
                                                  <span>Due {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}</span>
                                              </div>
                                          @endif
                                          
                                          <div class="flex items-center text-gray-400">
                                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                              </svg>
                                              <span>Created {{ $task->created_at->diffForHumans() }}</span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="ml-6 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                      <a href="{{ route('goals.show', ['goal' => $task->goal->slug]) }}#task-{{ $task->slug }}" 
                                         class="p-2.5 bg-gray-700 hover:bg-blue-600 rounded-lg text-gray-400 hover:text-white transition-all duration-200 transform hover:scale-110"
                                         title="View Details">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                          </svg>
                                      </a>
                                      @hasanyrole(['admin', 'project-manager'])
                                        <a href="{{ route('goals.edit', ['goal' => $task->goal->slug]) }}" 
                                            class="p-2.5 bg-gray-700 hover:bg-yellow-600 rounded-lg text-gray-400 hover:text-white transition-all duration-200 transform hover:scale-110"
                                            title="Edit Task">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                      @endhasanyrole
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  @else
                      <div class="px-6 py-12 text-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                          </svg>
                          <h3 class="text-lg font-medium text-gray-300 mb-2">No tasks assigned to this goal</h3>
                          <p class="text-sm text-gray-500">Get started by adding tasks to this goal</p>
                      </div>
                  @endif
              </div>
          </div>
      @empty
          <div class="bg-gray-800 rounded-2xl shadow-sm p-12 text-center border-2 border-dashed border-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <h3 class="text-2xl font-bold text-white mb-3">No goals found</h3>
              <p class="text-gray-400 mb-8 max-w-md mx-auto">Create your first goal to start organizing and tracking your tasks efficiently</p>
              @hasanyrole(['admin', 'project-manager'])
                <div class="mt-6">
                    <a href="{{ route('goals.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 rounded-xl text-white font-semibold shadow-lg hover:shadow-blue-500/25 transition-all duration-200 transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Create New Goal
                    </a>
                </div>
              @endhasanyrole
          </div>
      @endforelse
  </div>

  <script>
    // Task Filter Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.task-filter-btn');
        const taskItems = document.querySelectorAll('.task-item');
        const goalSections = document.querySelectorAll('.goal-section');
        const filterNotice = document.getElementById('filter-notice');
        const filterNoticeTitle = document.getElementById('filter-notice-title');
        const filterNoticeMessage = document.getElementById('filter-notice-message');
        
        // Filter messages configuration
        const filterMessages = {
            'all': { title: 'No tasks found', message: 'There are no tasks in the system.' },
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
                
                // Filter tasks and manage goal sections
                let anyGoalHasVisibleTasks = false;
                
                goalSections.forEach(goalSection => {
                    const tasksInGoal = goalSection.querySelectorAll('.task-item');
                    let hasVisibleTasksInGoal = false;
                    
                    tasksInGoal.forEach(task => {
                        const taskStatus = task.getAttribute('data-status');
                        
                        if (filter === 'all' || taskStatus === filter) {
                            task.style.display = 'flex';
                            hasVisibleTasksInGoal = true;
                        } else {
                            task.style.display = 'none';
                        }
                    });
                    
                    // Show/hide goal section based on whether it has visible tasks
                    if (hasVisibleTasksInGoal) {
                        goalSection.style.display = 'block';
                        anyGoalHasVisibleTasks = true;
                    } else {
                        goalSection.style.display = 'none';
                    }
                });
                
                // Show/hide filter notice
                if (!anyGoalHasVisibleTasks && filter !== 'all') {
                    // Show custom message for the specific filter
                    const messageConfig = filterMessages[filter];
                    filterNoticeTitle.textContent = messageConfig.title;
                    filterNoticeMessage.textContent = messageConfig.message;
                    filterNotice.classList.remove('hidden');
                    
                    // Hide the empty goals state if it exists
                    const emptyState = document.querySelector('.bg-gray-800.rounded-2xl');
                    if (emptyState) {
                        emptyState.style.display = 'none';
                    }
                } else {
                    filterNotice.classList.add('hidden');
                    
                    // Show empty goals state if no goals exist at all
                    const emptyState = document.querySelector('.bg-gray-800.rounded-2xl');
                    if (emptyState && !anyGoalHasVisibleTasks && filter === 'all') {
                        emptyState.style.display = 'block';
                    } else if (emptyState) {
                        emptyState.style.display = 'none';
                    }
                }
            });
        });

        // Initialize all goals as collapsed
        goalSections.forEach(goalSection => {
            const goalContent = goalSection.querySelector('.goal-content');
            const goalHeader = goalSection.querySelector('.goal-header');
            const arrow = goalHeader.querySelector('.goal-arrow');
            
            goalContent.style.display = 'none';
        });
    });

    // Toggle Goal Expansion
    function toggleGoal(goalId) {
        const goalContent = document.getElementById(goalId);
        const goalHeader = goalContent.previousElementSibling;
        const arrow = goalHeader.querySelector('.goal-arrow');
        
        if (goalContent.style.display === 'none' || !goalContent.style.display) {
            // Expand
            goalContent.style.display = 'block';
            setTimeout(() => {
                goalContent.style.scaleY = '1';
                goalContent.style.opacity = '1';
                goalContent.style.height = 'auto';
            }, 10);
            arrow.style.transform = 'rotate(180deg)';
            goalHeader.classList.add('bg-gray-700');
        } else {
            // Collapse
            goalContent.style.scaleY = '0';
            goalContent.style.opacity = '0';
            goalContent.style.height = '0';
            setTimeout(() => {
                goalContent.style.display = 'none';
            }, 300);
            arrow.style.transform = 'rotate(0deg)';
            goalHeader.classList.remove('bg-gray-700');
        }
    }

    // Add keyboard accessibility
    document.addEventListener('DOMContentLoaded', function() {
        const goalHeaders = document.querySelectorAll('.goal-header');
        goalHeaders.forEach(header => {
            header.setAttribute('tabindex', '0');
            header.setAttribute('role', 'button');
            header.setAttribute('aria-expanded', 'false');
            
            header.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const goalId = this.parentElement.querySelector('.goal-content').id;
                    toggleGoal(goalId);
                }
            });
        });
    });
  </script>

  <style>
    .goal-content {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform-origin: top;
    }
    
    .goal-arrow {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .goal-header {
        user-select: none;
    }
    
    .task-item {
        border-left: 3px solid transparent;
        transition: all 0.2s ease-in-out;
    }
    
    .task-item:hover {
        border-left-color: #3b82f6;
        background: linear-gradient(90deg, rgba(59, 130, 246, 0.05) 0%, rgba(59, 130, 246, 0) 100%);
    }
  </style>
</x-layout>