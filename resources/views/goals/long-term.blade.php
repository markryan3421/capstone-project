<x-layout class="bg-gray-900 min-h-screen text-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
          <h1 class="text-3xl font-bold text-white">Long-Term Goals</h1>
          
          <!-- Filter Section -->
          <div class="flex flex-wrap gap-2">
              <button class="filter-btn active px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 bg-blue-600 text-white shadow-lg" data-filter="all">
                  All
              </button>
              <button class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 bg-gray-700 text-gray-300 hover:bg-gray-600" data-filter="pending">
                  Pending
              </button>
              <button class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 bg-gray-700 text-gray-300 hover:bg-gray-600" data-filter="in-progress">
                  In Progress
              </button>
              <button class="filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 bg-gray-700 text-gray-300 hover:bg-gray-600" data-filter="completed">
                  Completed
              </button>
          </div>
      </div>

      <!-- Filter Message (Hidden by default) -->
      <div id="filter-message" class="hidden mb-6">
          <div class="bg-gray-800 rounded-xl p-6 text-center border border-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <h3 class="text-xl font-semibold text-white mb-2" id="filter-message-title">No goals found</h3>
              <p class="text-gray-400" id="filter-message-text">There are no goals matching the selected filter.</p>
          </div>
      </div>

      <!-- 2x2 Grid Layout -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="goals-container">
          @forelse ($longTermGoals as $goal)
              <div class="goal-card bg-gray-800 rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-xl hover:-translate-y-1 border border-gray-700 hover:border-gray-600" 
                   data-status="{{ $goal->status }}" 
                   data-compliance="{{ $goal->compliance_percentage }}">
                  <div class="p-5">
                      <!-- Header with title and status -->
                      <div class="flex justify-between items-start mb-4">
                          <h2 class="text-lg font-semibold text-white truncate">{{ $goal->title }}</h2>
                          <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium status-badge {{ 
                              $goal->status === 'pending' ? 'bg-yellow-900/50 text-yellow-400' : 
                              ($goal->status === 'in-progress' ? 'bg-blue-900/50 text-blue-400' : 'bg-green-900/50 text-green-400') 
                          }}">
                              &nbsp;{{ ucfirst($goal->status) }}
                          </span>
                      </div>
                      
                      <!-- Description -->
                      <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $goal->description }}</p>
                      
                      <!-- Compact 2x2 grid for key information -->
                      <div class="grid grid-cols-2 gap-4 mb-4">
                          <!-- Type and SDG -->
                          <div class="space-y-3">
                              <div>
                                  <h3 class="text-xs font-medium text-gray-400">Type</h3>
                                  <p class="mt-1 text-sm text-white">{{ ucfirst($goal->type) }}</p>
                              </div>
                              
                              <div>
                                  <h3 class="text-xs font-medium text-gray-400">SDG</h3>
                                  <div class="mt-1 flex items-center">
                                      @if($goal->sdg)
                                          <span class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold mr-2">
                                              {{ $goal->sdg->id }}
                                          </span>
                                          <span class="text-xs text-white truncate">{{ $goal->sdg->name }}</span>
                                      @else
                                          <span class="text-xs text-gray-500">N/A</span>
                                      @endif
                                  </div>
                              </div>
                          </div>

                          <!-- Project Manager and Compliance -->
                          <div class="space-y-3">
                              <div>
                                  <h3 class="text-xs font-medium text-gray-400">Project Manager</h3>
                                  <div class="mt-1 flex items-center">
                                      @if($goal->projectManager)
                                          <span class="w-6 h-6 rounded-full bg-gray-700 flex items-center justify-center text-white text-xs font-bold mr-2">
                                              {{ substr($goal->projectManager->name, 0, 1) }}
                                          </span>
                                          <span class="text-xs text-white truncate">{{ $goal->projectManager->name }}</span>
                                      @else
                                          <span class="text-xs text-gray-500">Not assigned</span>
                                      @endif
                                  </div>
                              </div>
                              
                              <div>
                                  <h3 class="text-xs font-medium text-gray-400">Progress</h3>
                                  <div class="mt-1">
                                      <div class="flex items-center justify-between text-xs mb-1">
                                          <span class="text-gray-300">{{ $goal->compliance_percentage }}%</span>
                                      </div>
                                      <div class="w-full bg-gray-700 rounded-full h-1.5">
                                          <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $goal->compliance_percentage }}%"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- Assigned Users -->
                      <div class="mb-4">
                          <h3 class="text-xs font-medium text-gray-400 mb-2">Team</h3>
                          <div class="flex flex-wrap gap-1.5">
                              @foreach ($goal->assignedUsers as $user)
                                  <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-900/30 text-indigo-300">
                                      <span class="w-3 h-3 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs mr-1">
                                          {{ substr($user->name, 0, 1) }}
                                      </span>
                                      {{ $user->name }}
                                  </span>
                              @endforeach
                              @if($goal->assignedUsers->count() === 0)
                                  <span class="text-xs text-gray-500">No team assigned</span>
                              @endif
                          </div>
                      </div>

                      <!-- Action Buttons -->
                      <div class="flex justify-end space-x-2">
                          <a href="{{ route('goals.show', $goal) }}" class="inline-flex items-center px-2.5 py-1.5 border border-gray-600 rounded text-xs font-medium text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none transition-colors">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                              </svg>
                              View
                          </a>
                          @hasanyrole(['admin', 'project-manager'])
                            <a href="{{ route('goals.edit', $goal) }}" class="inline-flex items-center px-2.5 py-1.5 border border-gray-600 rounded text-xs font-medium text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                          @endhasanyrole
                      </div>
                  </div>
              </div>
          @empty
              <div class="col-span-2 bg-gray-800 rounded-xl shadow-sm p-8 text-center border border-dashed border-gray-700" id="empty-state">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                  <h3 class="mt-4 text-lg font-medium text-white">No long-term goals found</h3>
                  <p class="mt-1 text-sm text-gray-400">Get started by creating a new long-term goal</p>
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
  </div>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const filterButtons = document.querySelectorAll('.filter-btn');
          const goalCards = document.querySelectorAll('.goal-card');
          const filterMessage = document.getElementById('filter-message');
          const filterMessageTitle = document.getElementById('filter-message-title');
          const filterMessageText = document.getElementById('filter-message-text');
          const emptyState = document.getElementById('empty-state');
          
          // Filter messages configuration
          const filterMessages = {
              'all': { title: 'No goals found', text: 'There are no goals in the system.' },
              'pending': { title: 'No pending goals', text: 'There are no goals currently pending.' },
              'in-progress': { title: 'No goals in progress', text: 'There are no goals currently in progress.' },
              'completed': { title: 'No completed goals', text: 'There are no goals that have been completed.' }
          };
          
          filterButtons.forEach(button => {
              button.addEventListener('click', function() {
                  // Remove active class from all buttons
                  filterButtons.forEach(btn => {
                      btn.classList.remove('active', 'bg-blue-600', 'text-white', 'shadow-lg');
                      btn.classList.add('bg-gray-700', 'text-gray-300');
                  });
                  
                  // Add active class to clicked button
                  this.classList.add('active', 'bg-blue-600', 'text-white', 'shadow-lg');
                  this.classList.remove('bg-gray-700', 'text-gray-300');
                  
                  const filter = this.getAttribute('data-filter');
                  
                  let visibleCount = 0;
                  
                  goalCards.forEach(card => {
                      const status = card.getAttribute('data-status');
                      const compliance = parseInt(card.getAttribute('data-compliance'));
                      
                      // Determine actual status based on compliance percentage
                      let actualStatus = status;
                      if (( compliance < 100 && compliance > 0 )) {
                          actualStatus = 'in-progress';
                      } else if (compliance === 100) {
                          actualStatus = 'completed';
                      } else if (compliance === 0 ){
                        actualStatus = 'pending';
                      }

                      if (filter === 'all' || actualStatus === filter) {
                          card.style.display = 'block';
                          visibleCount++;
                      } else {
                          card.style.display = 'none';
                      }
                  });
                  
                  // Show/hide filter message and empty state
                  if (visibleCount === 0) {
                      // Show custom filter message
                      const message = filterMessages[filter];
                      filterMessageTitle.textContent = message.title;
                      filterMessageText.textContent = message.text;
                      filterMessage.classList.remove('hidden');
                      
                      // Hide the general empty state
                      if (emptyState) {
                          emptyState.style.display = 'none';
                      }
                  } else {
                      // Hide filter message
                      filterMessage.classList.add('hidden');
                      
                      // Show empty state if no goals at all
                      if (emptyState && filter === 'all' && visibleCount === 0) {
                          emptyState.style.display = 'block';
                      } else if (emptyState) {
                          emptyState.style.display = 'none';
                      }
                  }
              });
          });
      });
  </script>

  <style>
      .filter-btn {
          transition: all 0.2s ease-in-out;
      }
      
      .filter-btn:hover {
          transform: translateY(-1px);
      }
      
      .goal-card {
          transition: all 0.3s ease;
      }
      
      .line-clamp-2 {
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;
          overflow: hidden;
      }
  </style>
</x-layout>