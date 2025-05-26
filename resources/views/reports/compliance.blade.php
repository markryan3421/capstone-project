<x-layout class="bg-gray-900 min-h-screen text-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Compliant Goals --}}
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <div class="w-8 h-8 rounded-full bg-green-900/50 flex items-center justify-center text-green-400 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-green-400">Compliant Goals (100%)</h3>
            </div>

            @if ($compliantGoals->count())
                <div class="overflow-x-auto rounded-lg border border-gray-700">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Goal Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project Manager</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Compliance</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach ($compliantGoals as $goal)
                                <tr class="hover:bg-gray-750 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $goal->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ ucfirst($goal->type) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        @if($goal->projectManager)
                                            <div class="flex items-center">
                                                <span class="w-6 h-6 rounded-full bg-gray-700 flex items-center justify-center text-white text-xs font-bold mr-2">
                                                    {{ substr($goal->projectManager->name, 0, 1) }}
                                                </span>
                                                {{ $goal->projectManager->name }}
                                            </div>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-400">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $goal->compliance_percentage }}%
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-gray-800 rounded-lg p-8 text-center border border-dashed border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-300">No compliant goals found</h3>
                    <p class="mt-1 text-sm text-gray-500">All goals that reach 100% compliance will appear here</p>
                </div>
            @endif
        </div>
    </div>
</x-layout>