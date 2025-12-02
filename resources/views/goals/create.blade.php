<x-layout class="min-h-screen text-white bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
  <div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
      <div>
        <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">Create New Goal</h2>
        <p class="text-gray-400 mt-2">Define objectives and assign team members for sustainable development</p>
      </div>
      <a href="/" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-300 bg-gray-800/50 border border-gray-700 rounded-lg hover:bg-gray-700/50 transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back
      </a>
    </div>    

    <form action="/goals/create" method="POST" class="space-y-8 p-8 bg-gray-800/40 backdrop-blur-sm rounded-2xl border border-gray-700/50 shadow-2xl">
        @csrf

        <!-- Creator & SDG Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
              <label class="block text-sm font-semibold mb-3 text-gray-300 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Created By
              </label>
              <div class="flex items-center px-4 py-3 bg-gray-700/30 border border-gray-600/50 rounded-xl transition-all duration-200 hover:border-gray-500/50">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-sm font-bold text-white mr-3 shadow-lg">
                  {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                  <span class="text-gray-200 font-medium">{{ auth()->user()->name }}</span>
                  <p class="text-gray-400 text-sm">Project Manager</p>
                </div>
              </div>
              <input type="hidden" name="project_manager_id" value="{{ $sdg->id }}">
          </div>

          <!-- SDG Name -->
          <div>
              <label class="block text-sm font-semibold mb-3 text-gray-300 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Sustainable Development Goal
              </label>
              <div class="px-4 py-3 bg-gray-700/30 border border-gray-600/50 rounded-xl text-gray-200 font-medium transition-all duration-200 hover:border-gray-500/50">
                {{ $sdg->name }}
              </div>
              <input type="hidden" name="sdg_id" value="{{ $sdg->id }}">
          </div>
        </div>

        <!-- Goal Name -->
        <div>
            <label for="goalName" class="block text-sm font-semibold mb-3 text-gray-300 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
              Goal Name
            </label>
            <input type="text" name="title" id="goalName"
                    value="{{ old('title') }}"
                   class="w-full px-4 py-3.5 bg-gray-700/30 border border-gray-600/50 rounded-xl text-gray-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-500 transition-all duration-200 hover:border-gray-500/50"
                   placeholder="Enter a clear and descriptive goal name"
                   required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-semibold mb-3 text-gray-300 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
              </svg>
              Description
            </label>
            <textarea name="description" id="description" rows="5"
                      class="w-full px-4 py-3.5 bg-gray-700/30 border border-gray-600/50 rounded-xl text-gray-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 placeholder-gray-500 transition-all duration-200 resize-none hover:border-gray-500/50"
                      placeholder="Describe the goal objectives, expected outcomes, and key success metrics..."></textarea>
        </div>

        <!-- Timeline Section -->
        <div class="bg-gradient-to-r from-gray-800/50 to-gray-700/30 p-6 rounded-2xl border border-gray-600/30">
          <h3 class="text-lg font-semibold text-gray-200 mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Timeline
          </h3>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                  <label for="start_date" class="block text-sm font-medium mb-2 text-gray-300">Start Date</label>
                  <div class="relative">
                      <input type="text" name="start_date" id="start_date"
                             class="flatpickr-input w-full pl-4 pr-10 py-3.5 bg-gray-700/50 border border-gray-600 rounded-xl text-gray-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all duration-200 hover:border-gray-500/50"
                             placeholder="Select start date"
                             required>
                      <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm-2 8a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z" clip-rule="evenodd" />
                          </svg>
                      </span>
                  </div>
              </div>

              <div>
                  <label for="end_date" class="block text-sm font-medium mb-2 text-gray-300">End Date</label>
                  <div class="relative">
                      <input type="text" name="end_date" id="end_date"
                             class="flatpickr-input w-full pl-4 pr-10 py-3.5 bg-gray-700/50 border border-gray-600 rounded-xl text-gray-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all duration-200 hover:border-gray-500/50"
                             placeholder="Select end date"
                             required>
                      <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm-2 8a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z" clip-rule="evenodd" />
                          </svg>
                      </span>
                  </div>
              </div>
          </div>
        </div>

        <!-- Flatpickr Assets & Init -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <style>
            /* Enhanced Flatpickr theme */
            .flatpickr-calendar { 
                background: #1e2939; 
                border: 1px solid #374151; 
                border-radius: 12px; 
                overflow: hidden; 
                box-shadow: 0 20px 40px rgba(0,0,0,0.3); 
                backdrop-filter: blur(16px);
            }
            .flatpickr-months, .flatpickr-innerContainer, .flatpickr-days, .dayContainer { background: #1e2939; }
            .flatpickr-months .flatpickr-month { height: 40px; background: transparent; }
            .flatpickr-current-month .flatpickr-monthDropdown-months, 
            .flatpickr-current-month input.cur-year { 
                color: #ffffff; 
                font-weight: 600; 
                font-size: 0.95rem;
                background: transparent;
            }
            .flatpickr-weekdays { background: transparent; border-bottom: 1px solid #4b5563; }
            .flatpickr-weekday { color: #d1d5db; font-weight: 600; font-size: 0.8rem; line-height: 32px; }
            span.flatpickr-weekday, .flatpickr-weekday span { color: #d1d5db !important; }
            .flatpickr-day { 
                color: #e5e7eb; 
                background: transparent; 
                border-radius: 8px; 
                height: 36px; 
                line-height: 36px; 
                width: 36px; 
                margin: 2px; 
                border: 1px solid transparent; 
                font-size: 0.9rem; 
                transition: all 0.2s ease;
            }
            .flatpickr-day.prevMonthDay, .flatpickr-day.nextMonthDay, .flatpickr-day.notCurrentMonth { 
                color: rgba(229, 231, 235, 0.4); 
            }
            .flatpickr-day.prevMonthDay:hover, .flatpickr-day.nextMonthDay:hover, .flatpickr-day.notCurrentMonth:hover {
                color: rgba(229, 231, 235, 0.4) !important;
                background: transparent !important;
                border-color: rgba(229, 231, 235, 0.2) !important;
            }
            .flatpickr-day.flatpickr-disabled, .flatpickr-day.flatpickr-disabled:hover { 
                color: rgba(229, 231, 235, 0.2) !important; 
                border-color: transparent !important; 
                cursor: not-allowed; 
            }
            .flatpickr-day:hover { 
                border-color: rgba(99, 102, 241, 0.5); 
                background: rgba(99, 102, 241, 0.1); 
            }
            .flatpickr-day.today { 
                border-color: rgba(99, 102, 241, 0.6); 
                background: rgba(99, 102, 241, 0.15);
            }
            .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected:hover { 
                background: rgba(99, 102, 241, 0.8); 
                border-color: rgba(99, 102, 241, 0.9); 
                color: #ffffff; 
                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            }
            .flatpickr-prev-month, .flatpickr-next-month { color: #d1d5db; fill: #d1d5db; }
            .flatpickr-prev-month:hover, .flatpickr-next-month:hover { color: #ffffff; fill: #ffffff; }
            .flatpickr-monthDropdown-months,
            .flatpickr-monthDropdown-months option {
                background: #1e2939 !important;
                color: #e5e7eb !important;
                border-color: transparent !important;
            }
            .flatpickr-monthDropdown-months option:hover {
                background: rgba(99, 102, 241, 0.3) !important;
                color: #ffffff !important;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const today = new Date();
                const oldStart = "{{ old('start_date') }}";
                const oldEnd = "{{ old('end_date') }}";

                const endPicker = flatpickr('#end_date', {
                    dateFormat: 'Y-m-d',
                    minDate: oldStart || today,
                    defaultDate: oldEnd || null,
                    disableMobile: true,
                    allowInput: true,
                });

                const startPicker = flatpickr('#start_date', {
                    dateFormat: 'Y-m-d',
                    minDate: today,
                    defaultDate: oldStart || null,
                    disableMobile: true,
                    allowInput: true,
                    onChange: function(selectedDates) {
                        if (selectedDates[0]) {
                            endPicker.set('minDate', selectedDates[0]);
                            if (endPicker.selectedDates[0] && endPicker.selectedDates[0] < selectedDates[0]) {
                                endPicker.clear();
                            }
                        } else {
                            endPicker.set('minDate', today);
                        }
                    }
                });

                if (startPicker.selectedDates[0]) {
                    endPicker.set('minDate', startPicker.selectedDates[0]);
                }
            });
        </script>

        <!-- Goal Configuration -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="type" class="block text-sm font-semibold mb-3 text-gray-300 flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                  </svg>
                  Goal Type
                </label>
                <div class="relative">
                    <select name="type" id="type"
                            class="w-full px-4 py-3.5 bg-gray-700/30 border border-gray-600/50 rounded-xl text-gray-200 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 appearance-none transition-all duration-200 pr-10 hover:border-gray-500/50"
                            required>
                        <option value="short" class="bg-gray-800">Short Term (0-6 months)</option>
                        <option value="long" class="bg-gray-800">Long Term (6+ months)</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Assignment Section -->
        <div class="bg-gradient-to-r from-gray-800/50 to-gray-700/30 p-6 rounded-2xl border border-gray-600/30">
          <h3 class="text-lg font-semibold text-gray-200 mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Team Assignment
          </h3>

          @if ($staffUsers->isEmpty())
            <div class="bg-gray-700/30 p-4 rounded-xl text-sm text-gray-400 border border-gray-600/50 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                  <p class="font-medium">No team members available</p>
                  <p class="text-xs mt-1">Add staff members to your organization to assign goals</p>
                </div>
            </div>
          @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($staffUsers as $person)
                    <label class="flex items-center space-x-3 p-4 bg-gray-700/20 hover:bg-gray-700/40 rounded-xl border border-gray-600/30 transition-all duration-200 cursor-pointer group hover:border-indigo-500/30">
                        <input type="checkbox" name="assigned_users[]" value="{{ $person->id }}"
                               class="form-checkbox h-5 w-5 text-indigo-500 rounded border-gray-600 focus:ring-indigo-500 bg-gray-700 transition-all duration-200 group-hover:scale-110">
                        <div class="flex items-center flex-1">
                          <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-sm font-bold text-white mr-3 shadow-lg">
                            {{ strtoupper(substr($person->name, 0, 1)) }}
                          </div>
                          <div>
                            <span class="text-gray-200 font-medium block">{{ $person->name }}</span>
                            <span class="text-gray-400 text-xs">Team Member</span>
                          </div>
                        </div>
                    </label>
                @endforeach
            </div>
          @endif
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end pt-6">
           <button type="submit"
                    class="group inline-flex items-center px-8 py-4 border border-transparent text-base font-semibold rounded-xl shadow-lg text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:-translate-y-1 hover:shadow-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create Sustainable Goal
            </button>
        </div>
    </form>
  </div>
</x-layout>