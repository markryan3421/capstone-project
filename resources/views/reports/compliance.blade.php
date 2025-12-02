<x-layout class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen text-gray-100 overflow-x-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
            <div class="mb-4 lg:mb-0">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-green-400 to-emerald-500 bg-clip-text text-transparent">Compliance Excellence</h1>
                <p class="text-gray-400 mt-2">Celebrating goals that have achieved perfect compliance</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <div class="text-2xl font-bold text-white">{{ $compliantGoals->count() }}</div>
                    <div class="text-sm text-gray-400">Perfect Goals</div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Achievement Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-2xl border border-gray-700/50 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 bg-green-500/10 rounded-xl mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-400">Perfect Compliance</p>
                        <p class="text-2xl font-bold text-white">{{ $compliantGoals->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-2xl border border-gray-700/50 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 bg-emerald-500/10 rounded-xl mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-400">Success Rate</p>
                        <p class="text-2xl font-bold text-white">100%</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-2xl border border-gray-700/50 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-500/10 rounded-xl mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-400">Leading Managers</p>
                        <p class="text-2xl font-bold text-white">
                            {{ $compliantGoals->unique('project_manager_id')->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Compliant Goals Section --}}
        <div class="bg-gradient-to-br from-gray-800/40 to-gray-900/60 backdrop-blur-sm rounded-2xl border border-gray-700/50 shadow-2xl overflow-hidden">
            <!-- Section Header -->
            <div class="px-6 py-5 border-b border-gray-700/50 bg-gradient-to-r from-green-900/20 to-emerald-900/10">
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-green-400">Compliant Goals (100%)</h3>
                            <p class="text-sm text-gray-400 mt-1 hidden sm:block">Goals that have achieved perfect compliance standards</p>
                        </div>
                    </div>
                    <div class="sm:ml-auto">
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-500/20 text-green-300 border border-green-500/30">
                            {{ $compliantGoals->count() }} achievements
                        </span>
                    </div>
                </div>
            </div>

            @if ($compliantGoals->count())
                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <table class="min-w-full divide-y divide-gray-700/50">
                            <thead class="bg-gray-750">
                                <tr>
                                    <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Goal Details</th>
                                    <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Type</th>
                                    <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Manager</th>
                                    <th scope="col" class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700/30 bg-gray-800/30">
                                @foreach ($compliantGoals as $goal)
                                    <tr class="group hover:bg-gray-750/30 transition-all duration-200">
                                        <td class="px-4 py-5">
                                            <div class="flex items-center min-w-0">
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500/20 to-emerald-600/20 flex items-center justify-center mr-4 border border-green-500/20 flex-shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    </svg>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <a href="{{ route('goals.show', $goal) }}" 
                                                       class="text-sm font-semibold text-white hover:text-green-400 transition-colors duration-200 block truncate">
                                                        {{ $goal->title }}
                                                    </a>
                                                    <p class="text-xs text-gray-400 mt-1 truncate">
                                                        {{ Str::limit($goal->description, 50) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-5">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-500/20 text-purple-300 border border-purple-500/30">
                                                {{ ucfirst($goal->type) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-5">
                                            @if($goal->projectManager)
                                                <div class="flex items-center min-w-0">
                                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white text-xs font-bold mr-3 shadow flex-shrink-0">
                                                        {{ substr($goal->projectManager->name, 0, 1) }}
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <span class="text-sm font-medium text-gray-200 block truncate">{{ $goal->projectManager->name }}</span>
                                                        <p class="text-xs text-gray-400 truncate">Project Manager</p>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-gray-500 text-sm">Not Assigned</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-5">
                                            <div class="flex items-center">
                                                <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div>
                                                <span class="text-sm font-semibold text-green-400">
                                                    {{ $goal->compliance_percentage }}%
                                                </span>
                                            </div>
                                            <p class="text-xs text-gray-400 mt-1">Perfect</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Celebration Footer -->
                <div class="px-6 py-4 border-t border-gray-700/50 bg-gradient-to-r from-green-900/10 to-emerald-900/5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div class="flex items-center space-x-2">
                            <span class="text-green-400 text-sm">🎉</span>
                            <span class="text-sm text-gray-400">Celebrating {{ $compliantGoals->count() }} perfect achievements</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            Last updated: {{ now()->format('M j, Y \\a\\t g:i A') }}
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16 px-6">
                    <div class="max-w-md mx-auto">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-gray-700 to-gray-800 rounded-2xl flex items-center justify-center shadow-lg mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-300 mb-3">No Compliant Goals Yet</h3>
                        <p class="text-gray-400 mb-6 leading-relaxed">
                            Goals that reach 100% compliance will appear here. Keep working towards excellence!
                        </p>
                        <div class="space-y-4">
                            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gray-700/50 text-gray-400 border border-gray-600/50">
                                📊 Working Towards Excellence
                            </div>
                            <div class="text-xs text-gray-500 mt-4">
                                Monitor your goals' progress to achieve perfect compliance
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        {{-- @if ($compliantGoals->count())
            <div class="mt-6 flex flex-col sm:flex-row gap-4 justify-end">
                <button class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-300 bg-gray-800/50 border border-gray-700 rounded-xl hover:bg-gray-700/50 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export Achievements
                </button>
                <button class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    Share Success
                </button>
            </div>
        @endif --}}

        <!-- Motivational Quote -->
        <div class="mt-8 text-center">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-green-500/10 to-emerald-500/10 border border-green-500/20">
                <span class="text-green-400 text-sm mr-2">💫</span>
                <span class="text-sm text-gray-400">"Excellence is not a skill, it's an attitude."</span>
            </div>
        </div>
    </div>
</x-layout>