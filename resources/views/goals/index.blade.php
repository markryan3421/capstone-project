<x-layout class="bg-gray-900 text-white min-h-screen">
    <!-- SDG Dropdown Header -->
    <div class="bg-gray-800 p-6 rounded-2xl shadow-lg relative" x-data="{ open: false }">
        <button 
            @click="open = !open" 
            class="flex items-center justify-between w-full text-left group"
        >
            <div>
                <h1 class="text-2xl font-bold text-white">SDG #{{ Auth::user()->sdg->id }} - {{ Auth::user()->sdg->name }}</h1>
                <p class="text-gray-400 mt-1">Click to switch SDGs</p>
            </div>
            <svg 
                xmlns="http://www.w3.org/2000/svg" 
                class="h-6 w-6 text-gray-400 transition-transform duration-200 group-hover:text-white" 
                :class="{ 'transform rotate-180': open }"
                fill="none" 
                viewBox="0 0 24 24" 
                stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        
        <!-- Dropdown Menu -->
        <div 
            x-show="open"
            @click.away="open = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-10 mt-2 w-full bg-gray-700 rounded-lg shadow-xl overflow-hidden"
        >
            <div class="divide-y divide-gray-600">
                @if(Auth::user()->sdgs()->count() > 1)
                    @foreach(Auth::user()->sdgs as $sdg)
                        <a 
                            href="{{ route('sdgs.change', $sdg->id) }}"
                            class="flex items-center px-4 py-3 hover:bg-gray-600 transition-colors duration-150"
                            :class="{ 'bg-gray-600': {{ Auth::user()->current_sdg_id == $sdg->id ? 'true' : 'false' }} }"
                        >
                            <span class="{{ Auth::user()->current_sdg_id == $sdg->id ? 'font-bold text-blue-400' : 'text-white' }}">
                                SDG #{{ $sdg->id }} - {{ $sdg->name }}
                            </span>
                            @if(Auth::user()->current_sdg_id == $sdg->id)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </a>
                    @endforeach
                @endif
                <form action="/logout" method="POST" class="block">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-3 text-red-400 hover:bg-gray-600 transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                        </svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-2xl shadow-lg p-6 flex justify-between items-center">
            <div>
                <div class="text-3xl font-bold text-white">{{ $goals->where('type', 'short')->count() }}</div>
                <div class="text-sm text-blue-200">Total Short Term Goals</div>
            </div>
            <div class="p-3 rounded-full bg-blue-700 bg-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-900 to-purple-800 rounded-2xl shadow-lg p-6 flex justify-between items-center">
            <div>
                <div class="text-3xl font-bold text-white">{{ $goals->where('type', 'long')->count() }}</div>
                <div class="text-sm text-purple-200">Total Long Term Goals</div>
            </div>
            <div class="p-3 rounded-full bg-purple-700 bg-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mt-6">
        <!-- Compliance Chart - 75% width -->
        <div class="bg-gray-800 p-6 rounded-2xl shadow-lg lg:col-span-3" width="500px" height="100%">
            <div class="flex justify-between items-center mb-6"> <!-- Increased mb-4 to mb-6 -->
                <h3 class="text-xl font-semibold text-white">Compliance Overview</h3>
                <div class="flex space-x-4">
                    <span class="flex items-center text-sm text-gray-400">
                        <span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span> Total
                    </span>
                    <span class="flex items-center text-sm text-gray-400">
                        <span class="w-3 h-3 rounded-full bg-green-500 mr-2"></span> Compliant
                    </span>
                    <span class="flex items-center text-sm text-gray-400">
                        <span class="w-3 h-3 rounded-full bg-red-500 mr-2"></span> Non-Compliant
                    </span>
                </div>
            </div>
            <div> <!-- Increased height from h-80 to h-[400px] -->
                <canvas id="complianceChart" width="400" height="100"></canvas>
            </div>
        </div>

        <!-- Goals Distribution Chart - 25% width -->
        <div class="bg-gray-800 p-6 rounded-2xl shadow-lg lg:col-span-1">
            <h3 class="text-xl font-semibold text-white mb-8">Goals Distribution</h3> <!-- Increased mb-6 to mb-8 -->
            <div width="400" height="500"> <!-- Increased height from h-80 to h-[400px] -->
                <canvas id="distributionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Goals Table -->
    <div class="bg-gray-800 p-6 rounded-2xl shadow-lg mt-6 overflow-x-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-white">Goals Management</h2>
            <a href="{{ route('goals.create') }}" class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Create New Goal
            </a>
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-700">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project Manager</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Assigned Staffs</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @if($goals->isEmpty())
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-400">No goals found.</td>
                        </tr>
                    @else
                        @foreach($goals as $goal)
                        <tr class="hover:bg-gray-750 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="/goals/show/{{ $goal->slug }}" class="text-blue-400 hover:underline font-medium">{{ $goal->title }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                {{ $goal->projectManager->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-500',
                                        'in-progress' => 'bg-blue-500',
                                        'completed' => 'bg-green-500'
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$goal->status] ?? 'bg-gray-500' }} text-white">
                                    {{ ucfirst(str_replace('-', ' ', $goal->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($goal->assignedUsers as $user)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-700 text-gray-300">
                                        {{ $user->name }}
                                    </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="/goals/show/{{ $goal->slug }}" class="text-gray-400 hover:text-blue-400 transition-colors duration-200" title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="/goals/edit/{{ $goal->slug }}" class="text-gray-400 hover:text-yellow-400 transition-colors duration-200" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="/goals/delete/{{ $goal->slug }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-400 transition-colors duration-200" title="Delete" onclick="return confirm('Are you sure you want to delete this goal?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Compliance Chart with adjusted spacing
        const complianceCtx = document.getElementById('complianceChart').getContext('2d');
        const complianceChart = new Chart(complianceCtx, {
            type: 'bar',
            data: {
                labels: ['Total Goals', 'Compliant', 'Non-Compliant'],
                datasets: [{
                    label: 'Count',
                    data: [{{ $totalGoals }}, {{ $compliantGoals }}, {{ $nonCompliantGoals }}],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(239, 68, 68, 0.7)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 1,
                    barPercentage: 0.6, // Makes bars wider
                    categoryPercentage: 0.8 // Adds more space between categories
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 20,
                        right: 20,
                        bottom: 20,
                        left: 20
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(31, 41, 55, 0.9)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 14 },
                        titleColor: 'rgb(209, 213, 219)',
                        bodyColor: 'rgb(209, 213, 219)',
                        borderColor: 'rgba(75, 85, 99, 1)',
                        borderWidth: 1,
                        padding: 16,
                        usePointStyle: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(75, 85, 99, 0.5)',
                            drawBorder: false
                        },
                        ticks: {
                            color: 'rgb(156, 163, 175)',
                            font: { size: 12 },
                            padding: 10 // Added y-axis tick padding
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: 'rgb(156, 163, 175)',
                            font: { size: 12 },
                            padding: 10 // Added x-axis tick padding
                        }
                    }
                }
            }
        });

        // Distribution Chart with adjusted spacing
        const distributionCtx = document.getElementById('distributionChart').getContext('2d');
        const distributionChart = new Chart(distributionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Short Term', 'Long Term'],
                datasets: [{
                    data: [{{ $goals->where('type', 'short')->count() }}, {{ $goals->where('type', 'long')->count() }}],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(139, 92, 246, 0.7)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(139, 92, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 20,
                        right: 20,
                        bottom: 20,
                        left: 20
                    }
                },
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: 'rgb(209, 213, 219)',
                            font: { size: 12 },
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(31, 41, 55, 0.9)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 14 },
                        titleColor: 'rgb(209, 213, 219)',
                        bodyColor: 'rgb(209, 213, 219)',
                        borderColor: 'rgba(75, 85, 99, 1)',
                        borderWidth: 1,
                        padding: 16,
                        usePointStyle: true
                    }
                },
                cutout: '60%', // Reduced from 65% to make pie thicker
                spacing: 10 // Added spacing between elements
            }
        });
    </script>
</x-layout>