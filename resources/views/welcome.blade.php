<!DOCTYPE html>
<html lang="en" x-data>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  @vite('resources/css/app.css')
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>
</head>
<body class="bg-gray-900 min-h-screen text-gray-100 relative overflow-hidden">

  <!-- Particle Background -->
  <div id="tsparticles" class="fixed inset-0 z-0"></div>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col items-center justify-center min-h-screen py-8 px-4 relative z-10">
    <div class="max-w-4xl w-full">
      <div class="flex flex-col md:flex-row gap-8 items-center">
        <!-- Logo Side - Left -->
        <div class="md:w-1/2 flex flex-col items-center md:items-start">
            <div class="w-72 h-72 mb-1">  <!-- Increased from w-64 h-64 to w-72 h-72 -->
                <img src="{{ asset('images/logo.png') }}" alt="Bootleg Logo" 
                     class="w-full h-full object-contain transform hover:scale-105 transition-transform duration-300">
            </div>
            <p class="mt-2 text-gray-300 text-center md:text-left">  <!-- Reduced mt-4 to mt-2 -->
                Welcome to Bootleg!

            </p>
            <p class="mt-1 text-blue-300 text-center md:text-left">  <!-- Reduced mt-2 to mt-1 -->
                 Here you can manage your activities and connect with your community.
            </p>
        </div>

        <!-- Login Form Side - Right -->
        <div class="md:w-1/2">
          <div class="bg-gray-800 p-4 rounded-xl border border-gray-700 max-w-xs mx-auto drop-shadow-[12px_8px_0px_rgba(0,0,0,1)]">
            <h2 class="text-lg font-semibold text-gray-100 mb-3">Login Your NGO Account</h2>
            
            {{-- Add this section for general error messages --}}
            @if (session('status'))
              <div class="mb-4 text-sm text-red-400 bg-red-900/20 rounded-lg p-3">
                {{ session('status') }}
              </div>
            @endif

            <form action="/login" method="POST" class="space-y-3">
              @csrf
              <div class="space-y-2">
                <label for="email" class="text-sm font-medium text-gray-300">Email</label>
                <input type="text" 
                       id="email" 
                       name="email" 
                       placeholder="Enter your Email" 
                       class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                       value="{{ old('email') }}" />
                @error('email')
                  <p class="text-sm text-red-400">{{$message}}</p>
                @enderror
              </div>
              <div class="space-y-2">
                <label for="password" class="text-sm font-medium text-gray-300">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" 
                       class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('password')
                  <p class="text-sm text-red-400">{{$message}}</p>
                @enderror
              </div>
              <button type="submit" 
                      class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-medium hover:bg-blue-700 transition duration-300 ease-in-out">
                Sign In
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Move footer closer -->
  <footer class="text-center mt-4 text-gray-500 text-sm relative z-10">  <!-- Reduced mt-10 to mt-4 -->
    Brandname copyright &copy; 2025
  </footer>

  <!-- Particle Setup -->
  <script>
    tsParticles.load("tsparticles", {
      fullScreen: { enable: false },
      background: { color: "transparent" },
      particles: {
        number: { value: 45 },
        shape: {
          type: ["polygon"],
          polygon: {
            nb_sides: 5
          }
        },
        size: {
          value: { min: 6, max: 10 },
          random: true
        },
        color: { value: "#6b7280" },
        opacity: {
          value: 0.3,
          random: true,
          anim: { enable: true, speed: 1, opacity_min: 0.1, sync: false }
        },
        move: {
          enable: true,
          speed: 1.2,
          direction: "none",
          random: true,
          straight: false,
          outModes: { default: "out" }
        },
        rotate: {
          value: { min: 0, max: 360 },
          animation: {
            enable: true,
            speed: 5,
            sync: false
          }
        },
        line_linked: {
          enable: false
        }
      },
      interactivity: {
        events: {
          onhover: { enable: true, mode: "repulse" },
          onclick: { enable: false }
        },
        modes: {
          repulse: { distance: 100 }
        }
      }
    });
  </script>

</body>
</html>