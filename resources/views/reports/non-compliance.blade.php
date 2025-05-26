<x-layout class="bg-gray-900 min-h-screen text-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Non-Compliant Goals --}}
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <div class="w-8 h-8 rounded-full bg-red-900/50 flex items-center justify-center text-red-400 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-red-400">Non-Compliant Goals</h3>
            </div>

            @if ($nonCompliantGoals->count())
                <div class="overflow-x-auto rounded-lg border border-gray-700">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Goal Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project Manager</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Compliance</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Progress</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach ($nonCompliantGoals as $goal)
                                <tr class="hover:bg-gray-750 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                        <a href="{{ route('goals.show', $goal) }}" class="hover:text-blue-400 transition-colors">
                                            {{ $goal->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-900/30 text-purple-300">
                                            {{ ucfirst($goal->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        @if($goal->projectManager)
                                            <div class="flex items-center">
                                                <span class="w-6 h-6 rounded-full bg-gray-700 flex items-center justify-center text-white text-xs font-bold mr-2">
                                                    {{ substr($goal->projectManager->name, 0, 1) }}
                                                </span>
                                                {{ $goal->projectManager->name }}
                                            </div>
                                        @else
                                            <span class="text-gray-500">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-red-400">
                                        {{ $goal->compliance_percentage }}%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="w-full bg-gray-700 rounded-full h-2">
                                          <div class="w-full bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-orange-600 h-2.5 rounded-full" style="width: {{ $goal->compliance_percentage ?? 0 }}%"></div>
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-gray-800 rounded-lg p-8 text-center border border-dashed border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-green-400">All goals are compliant!</h3>
                    <p class="mt-1 text-sm text-gray-400">Great work! All goals have reached 100% compliance</p>
                    <div class="mt-4 flex justify-center">
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-900/30 text-green-300 animate-pulse">
                            🎉 Achievement Unlocked
                        </span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>