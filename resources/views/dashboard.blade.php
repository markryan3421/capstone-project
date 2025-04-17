<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false, itotOpen: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Botleg Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>
  <style>
    .floating-shape {
      position: absolute;
      width: 30px;
      height: 30px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 4px;
      animation: floatShape 20s linear infinite;
      z-index: -1;
    }

    @keyframes floatShape {
      0%   { transform: translateY(0) rotate(0deg); opacity: 0.3; }
      50%  { transform: translateY(-100px) rotate(180deg); opacity: 0.1; }
      100% { transform: translateY(0) rotate(360deg); opacity: 0.3; }
    }

    .rotating-circle {
      position: absolute;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 255, 255, 0.3);
      animation: rotateCircle 25s linear infinite;
      z-index: -2;
    }

    @keyframes rotateCircle {
      0%   { transform: rotate(0deg); opacity: 0.3; }
      50%  { transform: rotate(180deg); opacity: 0.5; }
      100% { transform: rotate(360deg); opacity: 0.3; }
    }

    .wave {
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 150px;
      z-index: -1;
    }

    .lines {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.1) 50%, rgba(255, 255, 255, 0.1) 75%, transparent 75%, transparent);
      background-size: 50px 50px;
      animation: moveLines 5s linear infinite;
      z-index: -3;
    }

    @keyframes moveLines {
      0% { background-position: 0 0; }
      100% { background-position: 50px 50px; }
    }

    .sidebar {
      transition: transform 0.3s ease-out, opacity 0.3s ease-out;
    }

    .sidebar-link {
      transition: background-color 0.3s ease, padding-left 0.3s ease;
    }

    .sidebar-link:hover {
      background-color: #4b5563;
      padding-left: 20px;
    }

    .sub-link {
      transition: max-height 0.3s ease-out;
      overflow: hidden;
    }
  </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen font-sans relative overflow-hidden">

  <div id="tsparticles" class="fixed inset-0 z-0"></div>

  <!-- Floating shapes with delay -->
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

  <div class="flex transition-all duration-300 ease-in-out relative z-10" :class="sidebarOpen ? 'ml-64' : 'ml-0'">
    <aside class="fixed left-0 top-0 h-full w-64 bg-gray-800 p-6 shadow-xl z-40 sidebar" :class="sidebarOpen ? 'transform translate-x-0 opacity-100' : 'transform -translate-x-full opacity-0'">
      <div class="flex flex-col items-center mb-6">
        <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center text-xl font-bold mb-2">A</div>
        <p class="text-sm font-semibold text-gray-300">Admin</p>
      </div>
      <nav class="space-y-2 text-gray-300 text-sm w-full">
        <a href="#" class="sidebar-link px-4 py-2 rounded flex items-center justify-between" @click="itotOpen = !itotOpen">
          <span>Itot</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transform transition-transform duration-300 ease-in-out" :class="itotOpen ? 'rotate-180' : 'rotate-0'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </a>
        <div x-show="itotOpen" x-transition:enter="transition-all ease-out duration-300" x-transition:leave="transition-all ease-in duration-300" class="sub-link pl-8">
          <a href="#" class="block px-4 py-2 rounded">Sub-link 1</a>
          <a href="#" class="block px-4 py-2 rounded">Sub-link 2</a>
        </div>
        <a href="#" class="sidebar-link block px-4 py-2 rounded">Baylo</a>
        <a href="#" class="sidebar-link block px-4 py-2 rounded">Balut</a>
        <a href="#" class="sidebar-link block px-4 py-2 rounded">Suyop</a>
        <a href="#" class="sidebar-link block px-4 py-2 rounded">Ta</a>
        <a href="#" class="sidebar-link block px-4 py-2 rounded">Balas</a>
        <a href="/settings" class="sidebar-link block px-4 py-2 rounded">Settings</a>
        <form action="/logout" method="POST" class="block px-4 py-2 rounded hover:bg-gray-700">
            @csrf
            <button class="btn btn-sm btn-secondary">Sign Out</button>
        </form>
        </nav>
    </aside>

    <main class="flex-1 transition-all duration-300 ease-in-out px-4 pt-20 md:px-8 space-y-8 max-w-full">
      <div class="bg-gray-800 p-6 rounded-2xl shadow">
        <h1 class="text-2xl font-bold text-white">HOME</h1>
      </div>

      <div class="bg-gray-800 p-6 rounded-2xl shadow overflow-x-auto">
        <h2 class="text-lg font-semibold mb-4 text-white">Table Name</h2>
        <table class="min-w-full text-sm text-left border border-gray-700">
          <thead class="bg-gray-700 text-white">
            <tr>
              <th class="px-4 py-2 border border-gray-600">Col 1</th>
              <th class="px-4 py-2 border border-gray-600">Col 2</th>
              <th class="px-4 py-2 border border-gray-600">Col 3</th>
              <th class="px-4 py-2 border border-gray-600">Col 4</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-gray-700 text-white">
              <td class="px-4 py-2 border border-gray-600">Row 1</td>
              <td class="px-4 py-2 border border-gray-600">Data</td>
              <td class="px-4 py-2 border border-gray-600">Data</td>
              <td class="px-4 py-2 border border-gray-600">Data</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-800 rounded-2xl shadow p-6 flex justify-between items-center">
          <div>
            <div class="text-3xl font-bold text-white">00</div>
            <div class="text-sm text-gray-400">Total Short Term Goals</div>
          </div>
          <button class="bg-blue-500 text-white px-4 py-2 rounded-xl text-sm">CTA</button>
        </div>
        <div class="bg-gray-800 rounded-2xl shadow p-6 flex justify-between items-center">
          <div>
            <div class="text-3xl font-bold text-white">00</div>
            <div class="text-sm text-gray-400">Total Long Term Goals</div>
          </div>
          <button class="bg-blue-500 text-white px-4 py-2 rounded-xl text-sm">CTA</button>
        </div>
      </div>
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
  </script>

</body>
</html>