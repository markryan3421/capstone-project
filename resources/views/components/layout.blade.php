<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: window.innerWidth > 1024 }">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SDG Dashboard</title>
    <link rel="icon" href="logo.png" type="image/png"> 

    <!-- Keep your extra CSS libraries -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <style>
        /* Sidebar scrollbar: hidden by default, visible on hover. Blended theme look. */
        .sidebar-scroll {
            overflow-y: auto;
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
            position: relative;
        }

        /* Hide webkit scrollbar by default */
        .sidebar-scroll::-webkit-scrollbar {
            width: 0px;
            height: 0px;
        }

        /* When hovering the sidebar, reveal a thin, blended scrollbar */
        aside:hover .sidebar-scroll {
            -ms-overflow-style: auto;
            scrollbar-width: thin;
        }

        aside:hover .sidebar-scroll::-webkit-scrollbar {
            width: 8px;
        }

        /* Track: subtle translucent layer that blends with background */
        aside:hover .sidebar-scroll::-webkit-scrollbar-track {
            background: linear-gradient(180deg, rgba(30,41,59,0.0), rgba(30,41,59,0.02));
            border-radius: 10px;
            margin: 4px 0;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.02);
        }

        /* Thumb: soft gradient using sidebar accent colors (indigo -> teal) with blur and rounded edges */
        aside:hover .sidebar-scroll::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, rgba(99,102,241,0.14), rgba(14,165,164,0.12));
            border-radius: 10px;
            border: 2px solid rgba(30,41,59,0.45); /* blend with sidebar */
            background-clip: padding-box;
            box-shadow: inset 0 1px 6px rgba(0,0,0,0.45);
            backdrop-filter: blur(4px);
            transition: background-color 180ms ease, box-shadow 180ms ease, opacity 180ms ease;
            opacity: 0.9;
        }

        /* Slightly stronger/thumb on hover for easier grabbing */
        aside:hover .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, rgba(99,102,241,0.22), rgba(14,165,164,0.18));
            box-shadow: inset 0 2px 8px rgba(0,0,0,0.55);
            opacity: 1;
        }

        /* Firefox: use scrollbar-color to mimic the above; track uses transparent to blend */
        aside:hover .sidebar-scroll {
            scrollbar-color: rgba(99,102,241,0.18) rgba(30,41,59,0.02);
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen font-sans antialiased relative">
    <!-- Background Particles and Decorative Elements -->
    <div class="absolute top-0 left-0 right-0 h-[400px] overflow-hidden z-0">
        <div id="tsparticles" class="absolute inset-0 pointer-events-none"></div>
        <div class="relative h-full">
            <div class="floating-shape" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
            <div class="floating-shape" style="top: 60%; left: 80%; animation-delay: 5s;"></div>
            <div class="floating-shape" style="top: 40%; left: 50%; animation-delay: 10s;"></div>
            <div class="floating-shape" style="top: 80%; left: 30%; animation-delay: 15s;"></div>
            <div class="floating-shape" style="top: 10%; left: 70%; animation-delay: 12s;"></div>
            
            <div class="rotating-circle" style="top: 10%; left: 20%;"></div>
            <div class="rotating-circle" style="top: 70%; left: 70%;"></div>
            <div class="rotating-circle" style="top: 40%; left: 30%;"></div>
        </div>
    </div>

    <!-- Sidebar Toggle Button -->
    <button
        class="fixed top-4 left-4 z-50 h-10 w-10 bg-gray-800/90 text-white flex items-center justify-center
            hover:bg-blue-600 transition-all duration-300 ease-in-out rounded-full shadow-lg backdrop-blur-sm"
        @click="sidebarOpen = !sidebarOpen"
        x-cloak
    >
        <span x-show="!sidebarOpen" class="text-lg">→</span>
        <span x-show="sidebarOpen" class="text-lg">←</span>
    </button>

    <!-- Layout Container -->
    <div class="flex relative z-10 min-h-screen">
        <!-- Sidebar -->
        <aside
            class="fixed top-0 left-0 h-screen w-72 bg-gray-800/90 backdrop-blur-sm z-40 p-6 transition-all duration-300 ease-in-out will-change-transform border-r border-gray-700/50 shadow-xl flex flex-col"
            :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
            x-show="sidebarOpen"
            x-transition
            x-cloak
        >
            <!-- User Profile -->
            <div class="flex flex-col items-center my-8">
                <a href="/profile/{{ Auth::user()->user_slug }}">
                    @if(Auth::user()->avatar)
                        <div class="w-25 h-25 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-2xl font-bold text-white mb-3 shadow-md overflow-hidden">
                                <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" 
                                    alt="Avatar" 
                                    class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-25 h-25 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-2xl font-bold text-white mb-3 shadow-md overflow-hidden">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                </a>
                <p class="text-sm font-semibold text-gray-200">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-xs text-gray-400 mt-1">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg> -->
                    {{ Auth::user()->email }}
                </p>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="space-y-1.5 sidebar-scroll">
                <a href="/" class="sidebar-link flex items-center px-4 py-3 rounded-lg text-gray-200 hover:bg-gray-700/50 hover:text-white transition group">
                    <div class="w-8 h-8 bg-gray-700/50 group-hover:bg-blue-600 rounded-lg flex items-center justify-center mr-3 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3-3m0 0l3 3h4m-6-3v12" />
                        </svg>
                    </div>
                    Dashboard
                </a>

                <!-- Goals Dropdown -->
                <div x-data="{ goalsOpen: false }" class="relative">
                    <button @click="goalsOpen = !goalsOpen" class="w-full sidebar-link flex items-center justify-between px-4 py-3 rounded-lg text-gray-200 hover:bg-gray-700/50 hover:text-white transition group">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gray-700/50 group-hover:bg-purple-600 rounded-lg flex items-center justify-center mr-3 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v18m0 0h13l-4-8 4-8H5z" />
                                </svg>
                            </div>
                            Goals
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-200"
                            :class="goalsOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="goalsOpen" x-transition class="ml-12 mt-1 space-y-1.5">
                        @hasanyrole(['admin', 'project-manager'])
                            <a href="{{ route('goals.create') }}" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-700/30 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add New Goal
                            </a>
                        @endhasanyrole
                        <a href="{{ route('goals.longterm') }}" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-700/30 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Long Term Goals
                        </a>
                        <a href="{{ route('goals.shortterm') }}" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-700/30 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Short Term Goals
                        </a>
                    </div>
                </div>

                <a href="{{ route('tasks.all') }}" class="sidebar-link flex items-center px-4 py-3 rounded-lg text-gray-200 hover:bg-gray-700/50 hover:text-white transition group">
                    <div class="w-8 h-8 bg-gray-700/50 group-hover:bg-green-600 rounded-lg flex items-center justify-center mr-3 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                    </div>
                    Requirements
                </a>

                <!-- Reports Dropdown -->
                <div x-data="{ reportsOpen: false }" class="relative">
                    <button @click="reportsOpen = !reportsOpen" class="w-full sidebar-link flex items-center justify-between px-4 py-3 rounded-lg text-gray-200 hover:bg-gray-700/50 hover:text-white transition group">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gray-700/50 group-hover:bg-indigo-600 rounded-lg flex items-center justify-center mr-3 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            Reports
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-200"
                            :class="reportsOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="reportsOpen" x-transition class="ml-12 mt-1 space-y-1.5">
                        <a href="{{ route('reports.compliance') }}" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-700/30 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4m2 -2a9 9 0 11-18 0a9 9 0 0118 0z" />
                            </svg>
                            Compliance Reports
                        </a>
                        <a href="{{ route('reports.non-compliance') }}" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-700/30 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2a10 10 0 100 20a10 10 0 000-20z" />
                            </svg>
                            Non-Compliance Reports
                        </a>
                    </div>
                </div>

                @hasrole(['admin'])
                    <a href="/settings/users" class="sidebar-link flex items-center px-4 py-3 rounded-lg text-gray-200 hover:bg-gray-700/50 hover:text-white transition group">
                        <div class="w-8 h-8 bg-gray-700/50 group-hover:bg-amber-600 rounded-lg flex items-center justify-center mr-3 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        Settings
                    </a>
                @endhasrole

                <form action="/logout" method="POST" class="w-full mt-6 pt-4 border-t border-gray-700/50">
                    @csrf
                    <button type="submit" class="w-full sidebar-link flex items-center px-4 py-3 rounded-lg text-gray-200 hover:bg-gray-700/50 hover:text-white transition group">
                        <div class="w-8 h-8 bg-gray-700/50 group-hover:bg-red-600 rounded-lg flex items-center justify-center mr-3 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        Sign Out
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main
            class="transition-all duration-300 ease-in-out min-h-screen px-4 md:px-8 w-full pt-24 pb-24 will-change-transform"
            :class="{ 'ml-0': !sidebarOpen, 'md:ml-72': sidebarOpen }"
        >
            <!-- Toast Container -->
            <div id="toast-container" class="fixed top-4 right-4 z-[9999] space-y-3 max-w-sm w-full" style="position: fixed; top: 20px; right: 20px;"></div>
            <!-- <div id="toast-container" class="fixed top-4 right-4 z-[9999] space-y-3 max-w-sm w-full"></div> -->
            <!-- <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-3 max-w-sm w-full"></div> -->

            <!-- Page Content -->
            <div x-data="{ showTaskModal: false }" class="{{ $attributes->get('class') }}">
                {{ $slot }}
            </div>

            <footer class="mt-16 py-6 text-center text-gray-500 text-sm">
                <div class="container mx-auto px-4">
                <p>© {{ date('Y') }} SDG. All rights reserved.</p>
                </div>
            </footer>
        </main>
    </div>

    <!-- Toast Notification -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                createToast('success', '{{ session('success') }}');
            @endif

            @if ($errors->any())
                createToast('error', {!! json_encode($errors->all()) !!});
            @endif
        });

        function createToast(type, message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            if (type === 'success') {
                toast.innerHTML = `
                    <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg shadow-lg p-4 transform transition-all duration-300 ease-in-out translate-x-full opacity-0">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 dark:text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium text-green-800 dark:text-green-200">${message}</span>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            } else {
                const errors = Array.isArray(message) ? message : [message];
                toast.innerHTML = `
                    <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg shadow-lg p-4 transform transition-all duration-300 ease-in-out translate-x-full opacity-0">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <svg class="h-5 w-5 text-red-500 dark:text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium text-red-800 dark:text-red-200">There were errors:</span>
                                </div>
                                <ul class="list-disc pl-5 space-y-1 text-sm text-red-700 dark:text-red-300">
                                    ${errors.map(error => `<li>${error}</li>`).join('')}
                                </ul>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors ml-3">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            }
            
            container.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                const toastContent = toast.querySelector('div');
                toastContent.classList.remove('translate-x-full', 'opacity-0');
                toastContent.classList.add('translate-x-0', 'opacity-100');
            }, 10);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    const toastContent = toast.querySelector('div');
                    toastContent.classList.remove('translate-x-0', 'opacity-100');
                    toastContent.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => {
                        if (toast.parentElement) {
                            toast.parentElement.removeChild(toast);
                        }
                    }, 300);
                }
            }, 5000);
        }
    </script>
</body>
</html>