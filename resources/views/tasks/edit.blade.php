<x-layout class="bg-gray-900 min-h-screen text-gray-100">
   <!-- Background Elements -->
   <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-40 -right-32 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute -bottom-40 -left-32 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-cyan-500/5 rounded-full blur-3xl animate-float" style="animation-delay: 4s;"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold bg-gradient-to-r from-indigo-400 via-purple-400 to-cyan-400 bg-clip-text text-transparent mb-4">
                Edit Task
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">
                Refine your task details and maintain momentum towards your goals
            </p>
        </div>

        <!-- Main Card - Made Larger -->
        <div class="gradient-border p-2 rounded-2xl mb-10">
            <div class="glass-card rounded-2xl p-10">
                <!-- Goal Info Section -->
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between mb-10 pb-8 border-b border-gray-700/50">
                    <div class="flex-1 mb-6 lg:mb-0">
                        <h2 class="text-2xl font-bold text-white flex items-center mb-3">
                            <i class="fas fa-bullseye mr-4 text-indigo-400 text-2xl"></i>
                            {{ $goal->title }}
                        </h2>
                        <p class="text-gray-400 text-base">Parent Goal • Created {{ $goal->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="text-center lg:text-right">
                        <div class="status-badge status-{{ $task->status }} text-lg px-4 py-2">
                            <i class="fas fa-circle text-xs mr-2"></i>
                            {{ ucfirst($task->status) }}
                        </div>
                        <p class="text-gray-400 text-base mt-2">Current Status</p>
                    </div>
                </div>

                @if ($errors->any())
                <div class="mb-10 p-6 rounded-2xl bg-red-900/25 border border-red-500/40 backdrop-blur-sm">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-red-300 mb-3">
                                There were {{ $errors->count() }} errors with your submission
                            </h3>
                            <div class="text-red-200 space-y-2">
                                <ul class="list-disc pl-5 space-y-2">
                                    @foreach ($errors->all() as $error)
                                    <li class="text-base">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('tasks.update', [$goal->slug, $task->slug]) }}" class="space-y-10">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">
                        <!-- Title Field -->
                        <div class="input-container">
                            <label for="task-title" class="floating-label">
                                <i class="fas fa-heading mr-2"></i>Task Title
                            </label>
                            <input 
                                type="text" 
                                name="title" 
                                id="task-title" 
                                value="{{ old('title', $task->title) }}" 
                                class="input-field w-full rounded-2xl px-6 py-4 text-white placeholder-gray-500 focus:outline-none focus:ring-0 text-lg"
                                placeholder="Enter a clear and concise task title"
                                required>
                        </div>
                        
                        <!-- Description Field -->
                        <div class="input-container">
                            <label for="task-description" class="floating-label">
                                <i class="fas fa-align-left mr-2"></i>Description
                            </label>
                            <textarea 
                                name="description" 
                                id="task-description" 
                                rows="6" 
                                class="input-field w-full rounded-2xl px-6 py-4 text-white placeholder-gray-500 focus:outline-none focus:ring-0 resize-vertical text-lg"
                                placeholder="Provide detailed information about this task, including any specific requirements or notes...">{{ old('description', $task->description) }}</textarea>
                        </div>
                        
                        <!-- Status and Due Date -->
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                            <!-- Status Field -->
                            <div class="input-container">
                                <label for="task-status" class="floating-label">
                                    <i class="fas fa-tasks mr-2"></i>Status
                                </label>
                                <div class="relative">
                                    <select 
                                        name="status" 
                                        id="task-status" 
                                        class="input-field w-full rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-0 appearance-none text-lg pr-12"
                                        required>
                                        <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>🟡 Pending</option>
                                        <option value="in-progress" {{ old('status', $task->status) == 'in-progress' ? 'selected' : '' }}>🔵 In Progress</option>
                                        <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>🟢 Completed</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-lg"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Due Date Field -->
                            <div class="input-container">
                                <label for="task-due-date" class="floating-label">
                                    <i class="fas fa-calendar-day mr-2"></i>Due Date
                                </label>
                                <div class="relative">
                                    <input 
                                        type="date" 
                                        name="deadline" 
                                        id="task-due-date" 
                                        min="{{ now()->format('Y-m-d') }}"
                                        value="{{ old('deadline', optional($task->deadline)->format('Y-m-d')) }}" 
                                        class="input-field w-full rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-0 text-lg pr-12">
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <i class="fas fa-calendar text-gray-400 text-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col lg:flex-row justify-end gap-4 pt-10 border-t border-gray-700/50">
                        <a href="/goals/show/{{ $goal->slug }}" class="btn-secondary inline-flex items-center justify-center rounded-2xl py-4 px-10 text-lg font-semibold transition-all duration-300 order-2 lg:order-1 flex-1 lg:flex-none">
                            <i class="fas fa-arrow-left mr-3"></i>
                            Back to Goal
                        </a>
                        <button type="submit" class="btn-primary inline-flex items-center justify-center rounded-2xl py-4 px-10 text-lg font-semibold text-white shadow-xl order-1 lg:order-2 flex-1 lg:flex-none pulse-glow">
                            <i class="fas fa-save mr-3"></i>
                            Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Info Card -->
        <div class="glass-card rounded-2xl p-8 border-l-4 border-indigo-500">
            <div class="flex items-start">
                <div class="flex-shrink-0 mt-1">
                    <i class="fas fa-lightbulb text-indigo-400 text-2xl"></i>
                </div>
                <div class="ml-5">
                    <h3 class="text-xl font-bold text-white mb-4">Pro Tips for Effective Task Management</h3>
                    <ul class="text-gray-300 space-y-3 text-base">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-400 mt-1 mr-3 text-base"></i>
                            <span class="flex-1"><strong>Set realistic deadlines</strong> - Break larger goals into manageable tasks with clear timelines</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-400 mt-1 mr-3 text-base"></i>
                            <span class="flex-1"><strong>Update status regularly</strong> - Keep your progress visible to maintain motivation and track accomplishments</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-400 mt-1 mr-3 text-base"></i>
                            <span class="flex-1"><strong>Provide clear descriptions</strong> - Detailed task information reduces ambiguity and improves execution</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-400 mt-1 mr-3 text-base"></i>
                            <span class="flex-1"><strong>Review and adjust</strong> - Regularly revisit tasks to ensure they still align with your overall objectives</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Improved focus effects for form inputs
            const inputs = document.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-indigo-500/40', 'scale-[1.02]');
                    this.parentElement.style.transition = 'all 0.3s ease';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-indigo-500/40', 'scale-[1.02]');
                });
            });
            
            // Enhanced status badge color update
            const statusSelect = document.getElementById('task-status');
            if (statusSelect) {
                statusSelect.addEventListener('change', function() {
                    const statusBadge = document.querySelector('.status-badge');
                    if (statusBadge) {
                        // Remove all status classes
                        statusBadge.classList.remove('status-pending', 'status-in-progress', 'status-completed');
                        // Add the new status class
                        statusBadge.classList.add(`status-${this.value}`);
                        // Update the text
                        statusBadge.innerHTML = `<i class="fas fa-circle text-xs mr-2"></i>${this.options[this.selectedIndex].text.replace(/[🔵🟡🟢]/g, '').trim()}`;
                    }
                });
            }

            // Add character counter for description
            const descriptionTextarea = document.getElementById('task-description');
            if (descriptionTextarea) {
                const charCounter = document.createElement('div');
                charCounter.className = 'text-right text-sm text-gray-500 mt-2';
                descriptionTextarea.parentNode.appendChild(charCounter);
                
                function updateCharCount() {
                    const count = descriptionTextarea.value.length;
                    charCounter.textContent = `${count} characters`;
                    if (count > 500) {
                        charCounter.classList.add('text-yellow-400');
                    } else {
                        charCounter.classList.remove('text-yellow-400');
                    }
                }
                
                descriptionTextarea.addEventListener('input', updateCharCount);
                updateCharCount(); // Initial count
            }
        });
    </script>
</x-layout>