<x-layout class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen text-gray-100">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
            <div class="mb-4 lg:mb-0">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-400 to-indigo-500 bg-clip-text text-transparent">Create New Task</h1>
                <p class="text-gray-400 mt-2">Add a new task to your goal</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <div class="text-sm text-gray-400">Goal</div>
                    <div class="text-lg font-semibold text-blue-400 truncate max-w-xs">{{ $goal->title ?? 'Your Goal' }}</div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Goal Info Card -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-2xl border border-gray-700/50 shadow-lg mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500/20 to-indigo-600/20 flex items-center justify-center mr-4 border border-blue-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Goal Timeline</h3>
                        <p class="text-sm text-gray-400">Deadline: {{ $goal->end_date->format('F j, Y') }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-400">Days Remaining</div>
                    <div class="text-lg font-bold text-blue-400">
                        {{ round(\Carbon\Carbon::now()->diffInDays($goal->end_date, false)) }} days
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Creation Form -->
        <div class="bg-gradient-to-br from-gray-800/40 to-gray-900/60 backdrop-blur-sm rounded-2xl border border-gray-700/50 shadow-2xl p-8">
            <form method="POST" action="{{ route('tasks.store', $goal->slug) }}" class="space-y-8">
                @csrf
                
                <!-- Title Field -->
                <div>
                    <label for="task-title" class="block text-sm font-semibold text-gray-300 mb-3 flex items-center">
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
                        placeholder="Enter a clear and specific task title..."
                        class="w-full bg-gray-700/30 border border-gray-600/50 rounded-xl px-4 py-3.5 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder-gray-500 hover:border-gray-500/50"
                    >
                </div>

                <!-- Description Field -->
                <div>
                    <label for="task-description" class="block text-sm font-semibold text-gray-300 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Description
                    </label>
                    <textarea 
                        name="description" 
                        id="task-description" 
                        rows="5" 
                        placeholder="Provide detailed description about what needs to be done, including any specific requirements or objectives..."
                        class="w-full bg-gray-700/30 border border-gray-600/50 rounded-xl px-4 py-3.5 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 resize-none placeholder-gray-500 hover:border-gray-500/50"
                    ></textarea>
                </div>

                <!-- Due Date Field -->
                <div class="bg-gradient-to-r from-gray-800/50 to-gray-700/30 p-6 rounded-2xl border border-gray-600/30">
                    <h3 class="text-lg font-semibold text-gray-200 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Timeline & Deadline
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="task-due-date" class="block text-sm font-medium text-gray-300 mb-2">
                                Due Date
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="deadline" 
                                    id="task-due-date" 
                                    required
                                    placeholder="Select task due date"
                                    class="flatpickr-input w-full bg-gray-700/50 border border-gray-600 rounded-xl pl-4 pr-10 py-3.5 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 hover:border-gray-500/50"
                                >
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm-2 8a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2 text-sm text-gray-400 bg-gray-700/30 p-3 rounded-lg border border-gray-600/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Must be completed before goal deadline: <strong class="text-blue-300">{{ $goal->end_date->format('F j, Y') }}</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t border-gray-700/50">
                    <a 
                        href="{{ route('goals.show', [$goal->slug]) }}" 
                        class="inline-flex items-center justify-center px-8 py-3.5 text-sm font-medium text-gray-300 bg-gray-800/50 border border-gray-700 rounded-xl hover:bg-gray-700/50 transition-all duration-200 order-2 sm:order-1"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="group inline-flex items-center justify-center px-8 py-3.5 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg shadow-blue-600/20 hover:shadow-xl hover:shadow-blue-600/30 transform hover:-translate-y-0.5 order-1 sm:order-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Create Task
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Tips Section -->
        <div class="mt-8 bg-gradient-to-br from-gray-800/40 to-gray-900/60 backdrop-blur-sm rounded-2xl border border-gray-700/30 p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0 mt-1">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-blue-500/20 to-indigo-600/20 flex items-center justify-center border border-blue-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-white">Creating Effective Tasks</h3>
                    <div class="mt-2 text-sm text-gray-400 space-y-2">
                        <p class="flex items-start gap-2">
                            <span class="text-blue-400 mt-0.5">•</span>
                            Make tasks specific and actionable with clear objectives
                        </p>
                        <p class="flex items-start gap-2">
                            <span class="text-blue-400 mt-0.5">•</span>
                            Set realistic deadlines that align with your goal timeline
                        </p>
                        <p class="flex items-start gap-2">
                            <span class="text-blue-400 mt-0.5">•</span>
                            Include measurable outcomes to track progress effectively
                        </p>
                        <p class="flex items-start gap-2">
                            <span class="text-blue-400 mt-0.5">•</span>
                            Prioritize tasks based on importance and dependencies
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flatpickr Assets & Init -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Enhanced Flatpickr theme matching the design system */
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
            const goalEnd = "{{ \Carbon\Carbon::parse($goal->end_date)->format('Y-m-d') }}";

            const picker = flatpickr('#task-due-date', {
                dateFormat: 'Y-m-d',
                minDate: today,
                maxDate: goalEnd || null,
                disableMobile: true,
                allowInput: true,
            });

            if (picker.selectedDates[0]) {
                picker.set('minDate', picker.selectedDates[0]);
            }
        });
    </script>
</x-layout>