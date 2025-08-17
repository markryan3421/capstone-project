<x-layout class="bg-gray-900 text-white min-h-screen">
    <!-- Back Button and Notification Bell -->
    <div class="container mx-auto px-4 py-6 flex justify-between items-center">
        <!-- Back Button -->
        <div>
            <a href="/sdgs" class="underline-offset-4 hover:underline inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M7.793 2.232a.75.75 0 0 1-.025 1.06L3.622 7.25h10.003a5.375 5.375 0 0 1 0 10.75H10.75a.75.75 0 0 1 0-1.5h2.875a3.875 3.875 0 0 0 0-7.75H3.622l4.146 3.957a.75.75 0 0 1-1.036 1.085l-5.5-5.25a.75.75 0 0 1 0-1.085l5.5-5.25a.75.75 0 0 1 1.06.025Z" clip-rule="evenodd" />
                </svg>
                &nbsp;Back to SDGs
            </a>
        </div>

        <!-- Notification Bell -->
        <div class="relative" x-data="{ open: false }">
            <button 
                @click="open = !open; loadNotificationList()"
                class="relative p-2 text-gray-400 hover:text-white transition-colors duration-200 focus:outline-none"
            >
                <!-- Bell Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                
                <!-- Notification Counter -->
                <span 
                    id="notification-count"
                    class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full"
                    style="display: none;"
                >0</span>
            </button>

            <!-- Dropdown Menu - now properly aligned to the right -->
            <div 
                x-show="open"
                @click.away="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 mt-2 w-80 bg-gray-800 rounded-lg shadow-xl border border-gray-700 z-50 overflow-hidden"
                style="display: none;"
            >
                <div class="px-4 py-3 border-b border-gray-700 flex justify-between items-center">
                    <h3 class="text-sm font-semibold text-white">Notifications</h3>
                    <button @click="open = false" class="text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="divide-y divide-gray-700 max-h-96 overflow-y-auto" id="notification-list">
                    <!-- Loading state -->
                    <div class="px-4 py-6 text-center">
                        <div class="animate-pulse flex justify-center">
                            <div class="h-8 w-8 bg-gray-700 rounded-full"></div>
                        </div>
                        <p class="mt-2 text-sm text-gray-400">Loading notifications...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="notifications" class="fixed top-4 right-4 z-[9999] w-80 max-w-[90vw] space-y-3"></div>

    <!-- SDG Dropdown Header -->
    <div class="bg-gray-800 p-6 rounded-2xl shadow-lg relative" x-data="{ open: false }">
        <button 
            @click="open = !open" 
            class="flex items-center justify-between w-full text-left group"
        >
            <div>
                <h1 class="text-2xl font-bold text-white"> {{ Auth::user()->sdg->name }}</h1>
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
                                {{ $sdg->id }} - {{ $sdg->name }}
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

    <button id="enable-sounds" class="sound-toggle-btn" aria-label="Toggle notification sounds">
        <span class="sound-icon">🔔</span>
        <span class="sound-text">Enable Sounds</span>
    </button>

    <audio id="notification-sound" preload="auto" 
        src="{{ asset('sounds/notification.mp3') }}">
    </audio>

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
            @hasanyrole(['admin', 'project-manager'])
                <a href="{{ route('goals.create') }}" class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Create New Goal
                </a>
            @endhasanyrole
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-700">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Progress</th>
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
                                {{  strtoupper($goal->type) }}
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
                                    <span>{{ $goal->compliance_percentage ?? 0 }}%</span>
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $goal->compliance_percentage ?? 0 }}%"></div>
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

                                    @hasanyrole(['admin', 'project-manager'])
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
                                    @endhasanyrole
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

    <script>
        let notificationSound;
        let soundToggle;
        // Initialize notification system
        document.addEventListener('DOMContentLoaded', function() {
            initPrivateNotification();
            updateNotificationBell();

            soundToggle = document.getElementById('enable-sounds');
            notificationSound = document.getElementById('notification-sound');
            notificationSound.volume = 0.3;

            updateButtonState();

            soundToggle.addEventListener('click', toggleSound);
        });

        function toggleSound() {
            const isEnabled = localStorage.getItem('soundsEnabled') === 'true';
            
            // Immediately toggle state (don't wait for playback test)
            localStorage.setItem('soundsEnabled', !isEnabled);
            updateButtonState();

            // Only test playback if enabling (not disabling)
            if (!isEnabled) {
                testAudioPlayback();
            }
        }

        function testAudioPlayback() {
            notificationSound.currentTime = 0;
            notificationSound.play()
                .then(() => {
                notificationSound.pause();
                notificationSound.currentTime = 0;
                })
                .catch(e => {
                console.error("Audio blocked:", e);
                localStorage.setItem('soundsEnabled', 'false');
                updateButtonState();
                showPermissionAlert();
                });
        }

        function updateButtonState() {
            const isEnabled = localStorage.getItem('soundsEnabled') === 'true';
            soundToggle.querySelector('.sound-icon').textContent = isEnabled ? '🔊' : '🔔';
            soundToggle.querySelector('.sound-text').textContent = isEnabled ? 'Disable Sounds' : 'Enable Sounds';
            soundToggle.classList.toggle('enabled', isEnabled);
        }

        function showPermissionAlert() {
            soundToggle.classList.add('error');
            setTimeout(() => soundToggle.classList.remove('error'), 1000);
        }

        // Global function - now can access notificationSound
        window.playNotificationSound = () => {
            if (localStorage.getItem('soundsEnabled') === 'true') {
                notificationSound.currentTime = 0;
                notificationSound.play()
                .catch(e => {
                    console.error("Playback failed:", e);
                    // Don't disable sounds automatically - just show error
                    soundToggle.classList.add('error');
                    setTimeout(() => soundToggle.classList.remove('error'), 1000);
                });
            }
        };

        function playNotificationSound() {
            try {
                const sound = new Audio("{{ asset('sounds/notification.mp3') }}");
                sound.volume = 0.3; // 30% volume to avoid being annoying
                sound.play().catch(e => console.log("Sound play prevented:", e));
            } catch (e) {
                console.warn("Couldn't play notification sound:", e);
            }
        }

        function updateNotificationBell() {
            fetch('/notifications/unread-count')
                .then(res => res.json())
                .then(data => {
                    const counter = document.getElementById('notification-count');
                    counter.textContent = data.count;
                    counter.style.display = data.count > 0 ? 'block' : 'none';
                })
                .catch(err => console.error('Error fetching notification count:', err));
        }

        function initPrivateNotification() {
        if (typeof window.Echo === 'undefined') {
            console.warn('Echo not ready, retrying...');
            setTimeout(initPrivateNotification, 200);
            return;
        }

        window.Echo.private(`App.Models.User.{{ Auth::user()->id }}`)
            .notification((notification) => {
                console.log('New notification:', notification);
                
                // Show toast notification
                showNotification({
                    title: notification.title || 'New Assignment',
                    message: notification.message,
                    type: 'info',
                    icon: notification.icon,
                    time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                    url: notification.url || null
                });

                window.playNotificationSound();

                // Update the bell counter
                updateNotificationBell();
                
                // Reload dropdown if open
                if (document.querySelector('[x-data="{ open: false }"]').__x.$data.open) {
                    loadNotificationList();
                }
            });
        }

        function showNotification(data) {
            const notificationsDiv = document.getElementById('notifications');
            const notification = document.createElement('div');
            
            notification.className = 'notification-entry animate-fade-in';
            notification.innerHTML = `
                <div class="notification-container ${data.type}">
                    <div class="notification-icon">
                        ${data.icon
                            ? `<img src="${data.icon}" alt="" class="h-8 w-8 rounded-full object-cover">`
                            : `<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>`
                        }
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <span class="notification-title">${data.title}</span>
                            <span class="notification-time">${data.time}</span>
                        </div>
                        <p class="notification-message">${data.message}</p>
                    </div>
                    <button class="notification-close">&times;</button>
                </div>
            `;

            if (data.url) {
                notification.querySelector('.notification-container').addEventListener('click', () => {
                    window.location.href = data.url;
                });
            }

            notification.querySelector('.notification-close').addEventListener('click', (e) => {
                e.stopPropagation();
                notification.classList.add('animate-fade-out');
                setTimeout(() => notification.remove(), 300);
            });

            notificationsDiv.appendChild(notification);
            
            // Auto-remove after 8 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.classList.add('animate-fade-out');
                    setTimeout(() => notification.remove(), 300);
                }
            }, 8000);
        }

        function loadNotificationList() {
            const list = document.getElementById('notification-list');
            list.innerHTML = `
                <div class="px-4 py-6 text-center">
                    <div class="animate-pulse flex justify-center">
                        <div class="h-8 w-8 bg-gray-700 rounded-full"></div>
                    </div>
                    <p class="mt-2 text-sm text-gray-400">Loading notifications...</p>
                </div>
            `;

            fetch('/notifications/unread')
                .then(res => res.json())
                .then(data => {
                    if (data.notifications.length === 0) {
                        list.innerHTML = `
                            <div class="px-4 py-6 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-400">No new notifications</p>
                            </div>
                        `;
                        return;
                    }

                    let html = '';
                    data.notifications.forEach(n => {
                        html += `
                            <a href="${n.url || '#'}" 
                            class="block px-4 py-3 hover:bg-gray-700/50 transition-colors duration-150 notification-item"
                            data-id="${n.id}"
                            @click="markAsRead('${n.id}')"
                            >
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 pt-0.5">
                                        <div class="h-8 w-8 rounded-full bg-indigo-500/20 flex items-center justify-center">
                                            ${n.icon
                                                ? `<img src="${n.icon}" class="h-8 w-8 rounded-full object-cover" alt="${n.sender_name}">`
                                                : `<div class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center text-white">
                                                    ${n.sender_name ? n.sender_name.charAt(0) : '?'}
                                                </div>`
                                            }
                                        </div>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-white">
                                            ${n.title}
                                            ${n.read_at ? '' : '<span class="ml-2 inline-block h-2 w-2 rounded-full bg-blue-500"></span>'}
                                        </p>
                                        <p class="text-xs text-gray-300 mt-1">${n.message}</p>
                                        <p class="text-xs text-gray-500 mt-1">${n.time}</p>
                                    </div>
                                </div>
                            </a>
                        `
                        console.log(n);
                    });

                    list.innerHTML = html;
                    
                    // Add click handlers
                    document.querySelectorAll('.notification-item').forEach(el => {
                        el.addEventListener('click', function() {
                            const id = this.getAttribute('data-id');
                            markNotificationAsRead(id);
                        });
                    });
                })
                .catch(err => {
                    console.error('Error loading notifications:', err);
                    list.innerHTML = `
                        <div class="px-4 py-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-400">Error loading notifications</p>
                        </div>
                    `;
                });
        }

        function markNotificationAsRead(id) {
            fetch(`/notifications/read/${id}`, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(() => {
                updateNotificationBell();
            });
        }
    </script>
</x-layout>