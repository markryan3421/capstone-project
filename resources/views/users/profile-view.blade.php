<x-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main Card -->
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
                <div class="p-8">

                    <!-- Header Section -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                        <div class="flex items-center">
                            <a href="/" class="flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm font-medium transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Home
                            </a>
                        </div>
                        
                        <h2 class="font-bold text-3xl text-gray-900 dark:text-white leading-tight text-center sm:text-left">
                            User Profile
                        </h2>
                        
                        <a href="/profile/{{ $user->user_slug }}/edit"
                            class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-700 dark:hover:bg-indigo-600 text-white font-semibold rounded-lg transition-all duration-200 transform hover:-translate-y-0.5 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 shadow-lg hover:shadow-indigo-500/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Profile
                        </a>
                    </div>

                    <!-- Profile Overview -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl p-8 shadow-inner mb-10 border border-blue-100 dark:border-blue-800/50">
                        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                            <!-- Avatar -->
                            <div class="relative group">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" 
                                         alt="{{ $user->name }}" 
                                         class="w-24 h-24 rounded-2xl object-cover ring-4 ring-white dark:ring-gray-800 shadow-xl">
                                @else
                                    <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center ring-4 ring-white dark:ring-gray-800 shadow-xl">
                                        <span class="text-3xl font-bold text-white">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- User Info -->
                            <div class="flex-1 text-center sm:text-left">
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $user->name }}</h1>
                                <p class="text-gray-600 dark:text-gray-300 text-lg mb-4">{{ $user->email }}</p>
                                
                                <!-- Stats -->
                                <div class="flex flex-wrap gap-6 justify-center sm:justify-start">
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $user->goals->count() }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Goals</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                                            {{ $user->goals->where('status', 'completed')->count() }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Completed</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                            {{ $user->created_at->diffForHumans() }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Member since</p>
                                    </div>
                                </div>
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

                    <!-- Content Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        <!-- Basic Information -->
                        <div class="lg:col-span-1">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b border-gray-200 dark:border-gray-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Basic Information
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Full Name</p>
                                        <p class="text-gray-900 dark:text-white font-semibold">{{ $user->name ?? 'Not provided' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Email Address</p>
                                        <p class="text-gray-900 dark:text-white font-semibold">{{ $user->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Account Created</p>
                                        <p class="text-gray-900 dark:text-white font-semibold">{{ $user->created_at->format('F d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">SDG Assignment</p>
                                        <p class="text-gray-900 dark:text-white font-semibold">
                                            @if($user->sdg)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    {{ $user->sdg->name }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    Not assigned
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Assigned Goals -->
                        <div class="lg:col-span-2">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                                <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Assigned Goals
                                    </h3>
                                    <span class="bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 text-sm font-medium px-3 py-1 rounded-full">
                                        {{ $user->goals->count() }} total
                                    </span>
                                </div>

                                @forelse($user->goals as $goal)
                                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-5 mb-4 border border-gray-200 dark:border-gray-600 hover:shadow-md transition-shadow duration-200">
                                        <div class="flex justify-between items-start mb-3">
                                            <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ $goal->title }}</h4>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                                @if($goal->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                @elseif($goal->status === 'in_progress') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $goal->status)) }}
                                            </span>
                                        </div>
                                        
                                        <p class="text-gray-600 dark:text-gray-300 mb-4 text-sm">{{ $goal->description }}</p>
                                        
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                            <div>
                                                <p class="text-gray-500 dark:text-gray-400 text-xs font-medium">Due Date</p>
                                                <p class="text-gray-900 dark:text-white font-semibold">{{ $goal->end_date ? \Carbon\Carbon::parse($goal->end_date)->format('M d, Y') : 'No deadline' }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-500 dark:text-gray-400 text-xs font-medium">Type</p>
                                                <p class="text-gray-900 dark:text-white font-semibold">{{ $goal->type ?? 'General' }} Goal</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-500 dark:text-gray-400 text-xs font-medium">Progress</p>
                                                <div class="flex items-center space-x-2">
                                                    <div class="w-16 bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $goal->compliance_percentage ?? 0 }}%"></div>
                                                    </div>
                                                    <span class="text-gray-900 dark:text-white font-semibold text-xs">{{ $goal->compliance_percentage ?? 0 }}%</span>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-gray-500 dark:text-gray-400 text-xs font-medium">Priority</p>
                                                <p class="text-gray-900 dark:text-white font-semibold capitalize">{{ $goal->priority ?? 'Medium' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Goals Assigned</h4>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm">This user doesn't have any goals assigned yet.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let notificationSound;
        let soundToggle;
        // Initialize notification system
        document.addEventListener('DOMContentLoaded', function() {
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
    </script>
</x-layout>