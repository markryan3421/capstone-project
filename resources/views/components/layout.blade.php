<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: true }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Botleg Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen font-sans relative" x-data="{ sidebarOpen: true }">
    <!-- Header section with particles and decorative elements -->
    <div class="absolute top-0 left-0 right-0 h-[400px] overflow-hidden z-0">
        <!-- Background Particles -->
        <div id="tsparticles" class="absolute inset-0 pointer-events-none"></div>

        <!-- Decorative elements -->
        <div class="relative">
            <!-- Floating shapes -->
            <div class="floating-shape" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
            <div class="floating-shape" style="top: 60%; left: 80%; animation-delay: 5s;"></div>
            <div class="floating-shape" style="top: 40%; left: 50%; animation-delay: 10s;"></div>
            <div class="floating-shape" style="top: 80%; left: 30%; animation-delay: 15s;"></div>
            <div class="floating-shape" style="top: 10%; left: 70%; animation-delay: 12s;"></div>

            <!-- Rotating Circles -->
            <div class="rotating-circle" style="top: 10%; left: 20%;"></div>
            <div class="rotating-circle" style="top: 70%; left: 70%;"></div>
            <div class="rotating-circle" style="top: 40%; left: 30%;"></div>
            <div class="rotating-circle" style="top: 60%; left: 80%;"></div>
        </div>
    </div>

    <!-- Update the particles configuration -->
    <script>
        tsParticles.load("tsparticles", {
            fullScreen: { enable: false },
            background: { color: "transparent" },
            particles: {
                number: { value: 50 },
                size: { value: 3 },
                move: { 
                    enable: true, 
                    speed: 1,
                    out_mode: "bounce" 
                },
                links: { 
                    enable: true, 
                    color: "#ffffff", 
                    distance: 150,
                    opacity: 0.4 
                },
                color: { value: "#ffffff" },
                opacity: { value: 0.5 }
            }
        });
    </script>

    <!-- Toggle Button (Open Sidebar) -->
    <button
        class="fixed top-0 left-0 h-screen w-6 z-50 bg-gray-800 text-white flex items-center justify-center
               hover:bg-blue-700 hover:w-8 transition-all duration-300 ease-in-out rounded-r-md shadow-md"
        @click="sidebarOpen = true"
        x-show="!sidebarOpen"
        x-cloak
    >
        <span class="transform hover:translate-x-1 transition">→</span>
    </button>

    <!-- Layout Wrapper -->
    <div class="flex relative z-10">

        <!-- Sidebar -->
        <aside
            class="fixed top-0 left-0 h-screen w-72 bg-gray-800 z-40 p-6 transition-transform duration-300 ease-in-out will-change-transform"
            :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
        >
            <!-- Sidebar Content -->
            <div class="flex flex-col items-center mb-6">
                <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center text-xl font-bold mb-2">A</div>
                <p class="text-sm font-semibold text-gray-300">{{ Auth::user()->name }}</p>
            </div>
            <nav class="space-y-2">
        <a href="/" class="sidebar-link px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3-3m0 0l3 3h4m-6-3v12" />
            </svg>
            Dashboard
        </a>

        <div x-data="{ itotOpen: false }">
            <button @click="itotOpen = !itotOpen"
                class="sidebar-link px-4 py-2 rounded flex items-center justify-between hover:bg-gray-700 transition-colors duration-200 w-full">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v18m0 0h13l-4-8 4-8H5z" />
                    </svg>
                    Goals
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-300 ease-in-out"
                    :class="itotOpen ? 'rotate-180' : 'rotate-0'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="itotOpen" x-transition class="space-y-1 pl-8">
                <a href="{{ route('goals.create') }}" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New
                </a>
                <a href="{{ route('goals.longterm') }}" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    Long Term
                </a>
                <a href="{{ route('goals.shortterm') }}" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    Short Term
                </a>
            </div>
        </div>

        <a href="{{ route('tasks.all') }}" class="sidebar-link px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
            </svg>
            Phases
        </a>

        <div x-data="{ openReports: false }">
            <button @click="openReports = !openReports"
                class="w-full text-left sidebar-link px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z" />
                </svg>
                Reports
                <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': openReports}"
                    class="h-4 w-4 ml-auto text-white transition-transform duration-200" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="openReports" x-transition class="ml-4 mt-1 space-y-2">
                <a href="{{ route('reports.compliance') }}" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4m2 -2a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                    List of Compliance
                </a>
                <a href="{{ route('reports.non-compliance') }}" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2a10 10 0 100 20a10 10 0 000-20z" />
                    </svg>
                    List of Non-Compliance
                </a>
            </div>
        </div>

        <a href="/settings/users" class="sidebar-link flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                    clip-rule="evenodd" />
            </svg>
            Settings
        </a>

        <form action="/logout" method="POST" class="w-full mt-4">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                        clip-rule="evenodd" />
                </svg>
                Sign Out
            </button>
        </form>
    </nav>
        </aside>

        <!-- Close Sidebar Button -->
        <button
            class="fixed top-0 h-screen w-6 bg-gray-800 text-white flex items-center justify-center
                   hover:bg-gray-700 hover:w-8 transition-all duration-300 ease-in-out rounded-r-md shadow-md z-50"
            @click="sidebarOpen = false"
            x-show="sidebarOpen"
            x-cloak
            :style="{ left: sidebarOpen ? '288px' : '0px' }"
        >
            <span class="transform hover:-translate-x-1 transition">←</span>
        </button>

        <!-- Main Content -->
        <main
            class="transition-transform duration-300 ease-in-out min-h-screen px-4 md:px-8 w-full pt-[100px] will-change-transform"
            :style="sidebarOpen ? 'transform: translateX(18rem);' : 'transform: translateX(0);'"
        >
            @if(session('success'))
                <div class="bg-green-900 border-l-4 border-green-500 text-green-100 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div x-data="{ showTaskModal: false }" class="{{ $attributes->get('class') }}">
                {{ $slot }}
            </div>
        </main>
    </div>

</body>
</html>