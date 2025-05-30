<x-layout class="bg-gray-900 min-h-screen text-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex justify-between items-center mb-8">
          <h1 class="text-3xl font-bold text-white">Long-Term Goals</h1>
          
      </div>

      @forelse ($longTermGoals as $goal)
          <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-6 transition-all hover:shadow-xl hover:-translate-y-1 border border-gray-700 hover:border-gray-600">
              <div class="p-6">
                  <div class="flex justify-between items-start">
                      <div>
                          <h2 class="text-xl font-semibold text-white mb-2">{{ $goal->title }}</h2>
                          <p class="text-gray-400 mb-4">{{ $goal->description }}</p>
                      </div>
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ 
                          $goal->status === 'pending' ? 'bg-yellow-900/50 text-yellow-400' : 
                          ($goal->status === 'in-progress' ? 'bg-blue-900/50 text-blue-400' : 'bg-green-900/50 text-green-400') 
                      }}">
                          {{ ucfirst($goal->status) }}
                      </span>
                  </div>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                      <!-- Left Column -->
                      <div class="space-y-4">
                          <div>
                              <h3 class="text-sm font-medium text-gray-400">Type</h3>
                              <p class="mt-1 text-sm text-white">{{ ucfirst($goal->type) }}</p>
                          </div>
                          
                          <div>
                              <h3 class="text-sm font-medium text-gray-400">SDG</h3>
                              <div class="mt-1 flex items-center">
                                  @if($goal->sdg)
                                      <span class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold mr-3">
                                          {{ $goal->sdg->id }}
                                      </span>
                                      <span class="text-sm text-white">{{ $goal->sdg->name }}</span>
                                  @else
                                      <span class="text-sm text-gray-500">N/A</span>
                                  @endif
                              </div>
                          </div>
                      </div>

                      <!-- Right Column -->
                      <div class="space-y-4">
                          <div>
                              <h3 class="text-sm font-medium text-gray-400">Project Manager</h3>
                              <div class="mt-1 flex items-center">
                                  @if($goal->projectManager)
                                      <span class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-white font-bold mr-3">
                                          {{ substr($goal->projectManager->name, 0, 1) }}
                                      </span>
                                      <span class="text-sm text-white">{{ $goal->projectManager->name }}</span>
                                  @else
                                      <span class="text-sm text-gray-500">Not assigned</span>
                                  @endif
                              </div>
                          </div>
                          
                          <div>
                              <h3 class="text-sm font-medium text-gray-400">Compliance</h3>
                              <div class="mt-1">
                                  <div class="flex items-center justify-between text-sm mb-1">
                                      <span class="text-gray-300">{{ $goal->compliance_percentage }}%</span>
                                      <span class="text-gray-500">{{ $goal->start_date }} to {{ $goal->end_date }}</span>
                                  </div>
                                  <div class="w-full bg-gray-700 rounded-full h-2">
                                      <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $goal->compliance_percentage }}%"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Assigned Users -->
                  <div class="mt-6">
                      <h3 class="text-sm font-medium text-gray-400 mb-2">Assigned Team</h3>
                      <div class="flex flex-wrap gap-2">
                          @foreach ($goal->assignedUsers as $user)
                              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-900/30 text-indigo-300">
                                  <span class="w-4 h-4 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs mr-1">
                                      {{ substr($user->name, 0, 1) }}
                                  </span>
                                  {{ $user->name }}
                              </span>
                          @endforeach
                          @if($goal->assignedUsers->count() === 0)
                              <span class="text-sm text-gray-500">No team members assigned</span>
                          @endif
                      </div>
                  </div>

                  <!-- Action Buttons -->
                  <div class="mt-6 flex justify-end space-x-3">
                      <a href="{{ route('goals.show', $goal) }}" class="inline-flex items-center px-3 py-2 border border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none transition-colors">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                          </svg>
                          View
                      </a>
                      <a href="{{ route('goals.edit', $goal) }}" class="inline-flex items-center px-3 py-2 border border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none transition-colors">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                          </svg>
                          Edit
                      </a>
                  </div>
              </div>
          </div>
      @empty
          <div class="bg-gray-800 rounded-xl shadow-sm p-8 text-center border border-dashed border-gray-700">
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
</x-layout>