<x-layout class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen text-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
            <div class="mb-4 lg:mb-0">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-red-400 to-orange-500 bg-clip-text text-transparent">Non-Compliance Dashboard</h1>
                <p class="text-gray-400 mt-2">Monitor and track goal compliance across your organization</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <div class="text-2xl font-bold text-white">{{ $nonCompliantGoals->count() }}</div>
                    <div class="text-sm text-gray-400">Non-Compliant Goals</div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-orange-600 flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-2xl border border-gray-700/50 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 bg-red-500/10 rounded-xl mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-400">Critical Issues</p>
                        <p class="text-2xl font-bold text-white">{{ $nonCompliantGoals->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-2xl border border-gray-700/50 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-500/10 rounded-xl mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-400">Avg. Compliance</p>
                        <p class="text-2xl font-bold text-white">
                            {{ number_format($nonCompliantGoals->avg('compliance_percentage') ?? 0, 1) }}%
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-2xl border border-gray-700/50 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-500/10 rounded-xl mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-400">Managers Involved</p>
                        <p class="text-2xl font-bold text-white">
                            {{ $nonCompliantGoals->unique('project_manager_id')->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Non-Compliant Goals Section --}}
        <div class="bg-gradient-to-br from-gray-800/40 to-gray-900/60 backdrop-blur-sm rounded-2xl border border-gray-700/50 shadow-2xl overflow-hidden">
            <!-- Section Header -->
            <div class="px-6 py-5 border-b border-gray-700/50 bg-gradient-to-r from-red-900/20 to-orange-900/10">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-500 to-orange-600 flex items-center justify-center shadow-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-red-400">Non-Compliant Goals</h3>
                        <p class="text-sm text-gray-400 mt-1">Goals requiring immediate attention and action</p>
                    </div>
                    <div class="ml-auto">
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-500/20 text-red-300 border border-red-500/30">
                            {{ $nonCompliantGoals->count() }} items
                        </span>
                    </div>
                </div>
            </div>

            @if ($nonCompliantGoals->count())
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-700/50">
                        <thead class="bg-gray-750">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Goal Details</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Manager</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Progress</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700/30 bg-gray-800/30">
                            @foreach ($nonCompliantGoals as $goal)
                                <tr class="group hover:bg-gray-750/50 transition-all duration-200">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center mr-4 border border-gray-600/50">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <a href="{{ route('goals.show', $goal) }}" 
                                                   class="text-sm font-semibold text-white hover:text-blue-400 transition-colors duration-200 block group-hover:translate-x-1">
                                                    {{ $goal->title }}
                                                </a>
                                                <p class="text-xs text-gray-400 mt-1 truncate max-w-xs">
                                                    {{ Str::limit($goal->description, 60) }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-500/20 text-purple-300 border border-purple-500/30">
                                            {{ ucfirst($goal->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        @if($goal->projectManager)
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white text-xs font-bold mr-3 shadow">
                                                    {{ substr($goal->projectManager->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <span class="text-sm font-medium text-gray-200">{{ $goal->projectManager->name }}</span>
                                                    <p class="text-xs text-gray-400">Project Manager</p>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-gray-500 text-sm">Not Assigned</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 rounded-full bg-red-500 mr-2 animate-pulse"></div>
                                            <span class="text-sm font-semibold text-red-400">
                                                {{ $goal->compliance_percentage }}%
                                            </span>
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1">Non-Compliant</p>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-1">
                                                <div class="w-full bg-gray-700 rounded-full h-2.5">
                                                    <div class="bg-gradient-to-r from-red-500 to-orange-500 h-2.5 rounded-full transition-all duration-500" 
                                                         style="width: {{ $goal->compliance_percentage ?? 0 }}%">
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-xs text-gray-400 w-10 text-right">
                                                {{ $goal->compliance_percentage }}%
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16 px-6">
                    <div class="max-w-md mx-auto">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-green-400 mb-3">All Goals Are Compliant!</h3>
                        <p class="text-gray-400 mb-6 leading-relaxed">
                            Outstanding achievement! Your organization has successfully maintained 100% compliance across all sustainable development goals.
                        </p>
                        <div class="space-y-4">
                            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-500/20 text-green-300 border border-green-500/30 animate-pulse">
                                🎉 Excellence in Compliance
                            </div>
                            <div class="text-xs text-gray-500 mt-4">
                                Last updated: {{ now()->format('M j, Y \\a\\t g:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        {{-- @if ($nonCompliantGoals->count())
            <div class="mt-6 flex flex-col sm:flex-row gap-4 justify-end">
                <button class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-300 bg-gray-800/50 border border-gray-700 rounded-xl hover:bg-gray-700/50 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export Report
                </button>
                <button class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-orange-500 rounded-xl hover:from-red-600 hover:to-orange-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Take Action
                </button>
            </div>
        @endif --}}
    </div>
</x-layout>