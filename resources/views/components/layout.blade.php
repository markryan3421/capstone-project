<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Botleg Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>
    <link rel="stylesheet" href="style.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen font-sans relative">

    <div id="tsparticles" class="fixed inset-0 z-0 pointer-events-none"></div>

    <div class="floating-shape" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
    <div class="floating-shape" style="top: 60%; left: 80%; animation-delay: 5s;"></div>
    <div class="floating-shape" style="top: 40%; left: 50%; animation-delay: 10s;"></div>
    <div class="floating-shape" style="top: 80%; left: 30%; animation-delay: 15s;"></div>
    <div class="floating-shape" style="top: 10%; left: 70%; animation-delay: 12s;"></div>

    <div class="rotating-circle" style="top: 10%; left: 20%;"></div>
    <div class="rotating-circle" style="top: 70%; left: 70%;"></div>
    <div class="rotating-circle" style="top: 40%; left: 30%;"></div>
    <div class="rotating-circle" style="top: 60%; left: 80%;"></div>

    <svg class="wave" viewBox="0 0 1440 320">
        <path fill="#1f2937" fill-opacity="1" d="M0,96L40,122.7C80,149,160,203,240,202.7C320,203,400,149,480,149.3C560,149,640,203,720,224C800,245,880,235,960,197.3C1040,160,1120,96,1200,96C1280,96,1360,160,1400,192L1440,224L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
    </svg>

    <button class="fixed top-4 left-4 z-50 bg-blue-600 text-white px-3 py-2 rounded-full shadow-md" @click="sidebarOpen = true" x-show="!sidebarOpen">→</button>
    <button class="fixed top-4 left-4 z-50 bg-gray-800 text-white px-3 py-2 rounded-full shadow-md" @click="sidebarOpen = false" x-show="sidebarOpen" style="display: none;">←</button>

    <div class="flex transition-all duration-300 ease-in-out relative z-10 main-content" :class="sidebarOpen ? 'ml-80' : 'ml-0'">
      <aside class="fixed left-0 top-0 h-full w-72 bg-gray-800 p-6 shadow-xl z-40 sidebar"
      :class="{'transform translate-x-0 opacity-100': sidebarOpen, 'transform -translate-x-full opacity-0': !sidebarOpen, 'sidebar-open': sidebarOpen}">
            <div class="flex flex-col items-center mb-6">
                <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center text-xl font-bold mb-2">A</div>
                <p class="text-sm font-semibold text-gray-300">{{ Auth::user()->name }}</p>
            </div>
            <nav>
                <a href="/" class="sidebar-link px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3-3m0 0l3 3h4m-6-3v12" />
                    </svg>
                    Dashboard
                </a>

                <div x-data="{ itotOpen: false }">
                    <a href="#" class="sidebar-link px-4 py-2 rounded flex items-center justify-between hover:bg-gray-700 transition-colors duration-200" @click="itotOpen = !itotOpen">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v18m0 0h13l-4-8 4-8H5z" />
                            </svg>
                            Department Goal
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transform transition-transform duration-300 ease-in-out" :class="itotOpen ? 'rotate-180' : 'rotate-0'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>

                    <div x-show="itotOpen" x-transition:enter="transition-all ease-out duration-300" x-transition:leave="transition-all ease-in duration-300" class="sub-link pl-8">
                        <a href="departmentgoallist.html" class=" px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            List
                        </a>
                    </div>
                </div>

                <div x-data="{ longTermOpen: false }">
                    <div class="sidebar-link px-4 py-2 rounded flex items-center justify-between hover:bg-gray-700 transition-colors duration-200" @click="longTermOpen = !longTermOpen">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
                            </svg>
                            Long Term Goal
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transform transition-transform duration-300 ease-in-out" :class="longTermOpen ? 'rotate-180' : 'rotate-0'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <div x-show="longTermOpen" x-transition:enter="transition-all ease-out duration-300" x-transition:leave="transition-all ease-in duration-300" class="sub-link pl-8">
                        <a href="/goals/create" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add New
                        </a>
                        <a href="#" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            List
                        </a>
                    </div>
                </div>
      
      <div x-data="{ shortTermOpen: false }">
        <a href="#" class="sidebar-link px-4 py-2 rounded flex items-center justify-between hover:bg-gray-700 transition-colors duration-200" @click="shortTermOpen = !shortTermOpen">
          <span class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Short Term Goal
          </span>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transform transition-transform duration-300 ease-in-out" :class="shortTermOpen ? 'rotate-180' : 'rotate-0'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </a>
      
        <div x-show="shortTermOpen" x-transition:enter="transition-all ease-out duration-300" x-transition:leave="transition-all ease-in duration-300" class="sub-link pl-8">
          <a href="shorttermgoalform.html" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New
          </a>
          <a href="shorttermgoallist.html" class=" px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            List
          </a>
        </div>
      </div>
      
        <a href="phases.html" class="sidebar-link px-4 py-2 rounded flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
          </svg>
          Phases
        </a>
        <!-- Reports Link with Dropdown -->
        <!-- Wrapper for Alpine.js -->
        <div x-data="{ openReports: false }">
          <!-- Reports Link -->
          <button @click="openReports = !openReports" class="w-full text-left sidebar-link px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition-colors duration-200">
              <!-- Reports Icon: Document -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z" />
              </svg>
              Reports
              <!-- Dropdown Indicator -->
              <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': openReports}" class="h-4 w-4 ml-auto text-white transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
          </button>

          <!-- Dropdown Menu -->
          <div x-show="openReports" x-transition class="ml-4 space-y-2 mt-1">
              <a href="listofcompliance.html" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition-colors duration-200">
                  <!-- Compliance Icon -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4m2 -2a9 9 0 11-18 0a9 9 0 0118 0z" />
                  </svg>
                  List of Compliance
              </a>
              <a href="listofnoncompliance.html" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition-colors duration-200">
                  <!-- Non-Compliance Icon -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2a10 10 0 100 20a10 10 0 000-20z" />
                  </svg>
                  List of Non-Compliance
              </a>
          </div>
        </div>


                <!-- Alpine wrapper for Departments -->
        <div x-data="{ openDepartments: false }">
          <!-- Departments Main Link -->
          <button @click="openDepartments = !openDepartments" class="w-full text-left sidebar-link px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-700 transition-colors duration-200">
              <!-- Department Icon -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21V5a2 2 0 012-2h2a2 2 0 012 2v16m6 0V10a2 2 0 012-2h2a2 2 0 012 2v11M12 21V10" />
              </svg>
              Sustainable Development Goals 
              <!-- Dropdown arrow -->
              <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': openDepartments}" class="h-4 w-4 ml-auto text-white transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
          </button>
        </div>
 

        <a href="/settings/users" class="sidebar-link block px-4 py-2 rounded">Settings</a>
        <form action="/logout" method="POST" class="block px-4 py-2 rounded hover:bg-gray-700">
            @csrf


            <button class="btn btn-sm btn-secondary">Sign Out</button>
        </form>
      </nav>
    </aside>

    <main class="flex-1 transition-all duration-300 ease-in-out px-4 pt-20 md:px-8 space-y-8 max-w-full overflow-y-auto h-[calc(100vh-5rem)]">    
      <!-- Success Message -->
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
      {{ $slot }}
    </main>
  </div>

  <script>
    tsParticles.load("tsparticles", {
      fullScreen: { enable: false },
      background: { color: "transparent" },
      particles: {
        number: { value: 60 },
        size: { value: 3 },
        color: { value: "#9ca3af" },
        line_linked: { enable: true, distance: 150, color: "#4b5563", opacity: 0.4, width: 1 },
        move: { enable: true, speed: 0.8 },
        opacity: { value: 0.5 },
      },
      interactivity: {
        events: { onhover: { enable: true, mode: "grab" } },
      }
    });

    function dashboard() {
      return {
          sidebarOpen: false,
          itotOpen: false,
          longTermOpen: false,
          shortTermOpen: false,
          openReports: false,
          openDepartments: false,
          openUsers: false
      };
    }
  </script>

</body>
</html>