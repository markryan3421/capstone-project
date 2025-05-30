<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: window.innerWidth > 1024 }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SDG Dashboard</title>
    <link rel="icon" href="logo.png" type="image/png"> 
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-link {
            transition: all 0.2s ease;
        }
        .sidebar-link:hover {
            transform: translateX(3px);
        }
        .floating-shape {
            position: absolute;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 15s infinite ease-in-out;
        }
        .rotating-circle {
            position: absolute;
            width: 30px;
            height: 30px;
            border: 2px dashed rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: spin 20s linear infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    <script>
        tsParticles.load("tsparticles", {
            fullScreen: { enable: false },
            background: { color: "transparent" },
            particles: {
                number: { value: 60, density: { enable: true, value_area: 800 } },
                color: { value: "#ffffff" },
                shape: { type: "circle" },
                opacity: { value: 0.5, random: true },
                size: { value: 3, random: true },
                line_linked: { enable: true, distance: 150, color: "#ffffff", opacity: 0.4, width: 1 },
                move: {
                    enable: true,
                    speed: 1.5,
                    direction: "none",
                    random: true,
                    straight: false,
                    out_mode: "bounce",
                    bounce: true
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: { enable: true, mode: "grab" },
                    onclick: { enable: true, mode: "push" }
                }
            }
        });
    </script>

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
            class="fixed top-0 left-0 h-screen w-72 bg-gray-800/90 backdrop-blur-sm z-40 p-6 transition-all duration-300 ease-in-out will-change-transform border-r border-gray-700/50 shadow-xl"
            :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
            x-show="sidebarOpen"
            x-transition
            x-cloak
        >
            <!-- User Profile -->
            <div class="flex flex-col items-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-2xl font-bold text-white mb-3 shadow-md">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <p class="text-sm font-semibold text-gray-200">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ Auth::user()->email }}</p>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="space-y-1.5">
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
                        <a href="{{ route('goals.create') }}" class="flex items-center px-3 py-2 text-sm rounded-lg hover:bg-gray-700/30 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add New Goal
                        </a>
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
                    Phases
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

                <a href="/settings/users" class="sidebar-link flex items-center px-4 py-3 rounded-lg text-gray-200 hover:bg-gray-700/50 hover:text-white transition group">
                    <div class="w-8 h-8 bg-gray-700/50 group-hover:bg-amber-600 rounded-lg flex items-center justify-center mr-3 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    Settings
                </a>

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
            <!-- Notification Messages -->
            @if(session('success'))
                <div class="bg-green-900/80 border-l-4 border-green-500 text-green-100 p-4 mb-6 rounded-lg backdrop-blur-sm shadow-lg" role="alert">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-500/90 text-white p-4 rounded-lg mb-6 backdrop-blur-sm shadow-lg">
                    <div class="flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <strong>Error:</strong>
                    </div>
                    <ul class="list-disc pl-5 space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
</body>
</html>