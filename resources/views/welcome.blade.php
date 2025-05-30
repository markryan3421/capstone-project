<!DOCTYPE html>
<html lang="en" x-data>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SDG</title>
  @vite('resources/css/app.css')
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
    .floating { animation: float 6s ease-in-out infinite; }
    .smooth-transition { transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); }
    .gradient-text {
      background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
  </style>
</head>
<body class="bg-gray-900 min-h-screen text-gray-100 relative overflow-hidden font-['Inter']">

  <!-- Enhanced Particle Background -->
  <div id="tsparticles" class="fixed inset-0 z-0"></div>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col items-center justify-center min-h-screen py-8 px-4 relative z-10">
    <div class="max-w-6xl w-full">
      <div class="flex flex-col lg:flex-row gap-12 items-center">
        <!-- Logo Side - Left (Enhanced) -->
        <div class="lg:w-1/2 flex flex-col items-center lg:items-start">
          <div class="w-80 h-80 mb-6 floating">
            <img src="{{ asset('images/logo.png') }}" alt="Bootleg Logo" 
                 class="w-full h-full object-contain drop-shadow-xl hover:drop-shadow-2xl smooth-transition">
          </div>
          <div class="text-center lg:text-left space-y-3">
            <h1 class="text-4xl font-bold gradient-text mb-2">Welcome to SDG</h1>
            <p class="text-gray-300 max-w-md text-lg leading-relaxed">
              The premier platform for managing your NGO activities and connecting with your community.
            </p>
            <div class="flex items-center justify-center lg:justify-start gap-4 pt-4">
              <div class="w-12 h-12 rounded-full bg-blue-600/20 flex items-center justify-center border border-blue-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
              </div>
              <div class="w-12 h-12 rounded-full bg-purple-600/20 flex items-center justify-center border border-purple-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
              </div>
              <div class="w-12 h-12 rounded-full bg-green-600/20 flex items-center justify-center border border-green-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Login Form Side - Right (Enhanced) -->
        <div class="lg:w-1/2 flex justify-center">
          <div class="bg-gray-800/80 backdrop-blur-sm p-10 rounded-2xl border border-gray-700/50 max-w-md w-full shadow-xl hover:shadow-2xl smooth-transition">
            <div class="flex items-center gap-4 mb-8">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-600/30 to-purple-600/30 flex items-center justify-center border border-gray-600/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <div>
                <h2 class="text-2xl font-semibold text-gray-100">NGO Portal Login</h2>
                <p class="text-sm text-gray-400">Access your organization dashboard</p>
              </div>
            </div>
            
            @if (session('status'))
              <div class="mb-6 text-sm text-red-400 bg-red-900/30 rounded-lg p-3 border border-red-800/50 flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('status') }}</span>
              </div>
            @endif

            <form action="/login" method="POST" class="space-y-6">
              @csrf
              
              <div class="space-y-3">
                <label for="email" class="text-sm font-medium text-gray-300 flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                  Email Address
                </label>
                <input type="text" 
                       id="email" 
                       name="email" 
                       placeholder="your@email.com" 
                       class="w-full px-5 py-3.5 bg-gray-900/40 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 smooth-transition @error('email') border-red-500 @enderror"
                       value="{{ old('email') }}" />
                @error('email')
                  <p class="text-sm text-red-400 mt-1 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{$message}}
                  </p>
                @enderror
              </div>
              
              <div class="space-y-3">
                <label for="password" class="text-sm font-medium text-gray-300 flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                  Password
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       placeholder="••••••••" 
                       class="w-full px-5 py-3.5 bg-gray-900/40 border border-gray-700 rounded-xl text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 smooth-transition" />
                @error('password')
                  <p class="text-sm text-red-400 mt-1 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{$message}}
                  </p>
                @enderror
              </div>
              
              <div class="pt-2">
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 rounded-xl font-medium hover:from-blue-700 hover:to-purple-700 smooth-transition flex items-center justify-center gap-3 shadow-lg hover:shadow-xl">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                  </svg>
                  Sign In
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Enhanced Footer -->
  <footer class="text-center py-6 text-gray-500 text-sm relative z-10 border-t border-gray-800/50 mt-8">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-center items-center gap-4 md:gap-8">
        <span>&copy; 2025 SDG Platform. All rights reserved.</span>
        <div class="hidden md:block w-px h-4 bg-gray-700/50"></div>
        <div class="flex items-center gap-4">
          <a href="#" class="hover:text-blue-400 smooth-transition">Terms</a>
          <a href="#" class="hover:text-blue-400 smooth-transition">Privacy</a>
          <a href="#" class="hover:text-blue-400 smooth-transition">Contact</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Enhanced Particle Setup -->
  <script>
    tsParticles.load("tsparticles", {
      fullScreen: { enable: false },
      background: { color: "transparent" },
      particles: {
        number: { 
          value: 60,
          density: {
            enable: true,
            value_area: 800
          }
        },
        shape: {
          type: ["circle", "triangle", "polygon"],
          polygon: {
            nb_sides: 6
          }
        },
        size: {
          value: { min: 4, max: 8 },
          random: true
        },
        color: { 
          value: ["#3b82f6", "#8b5cf6", "#ec4899", "#10b981"] 
        },
        opacity: {
          value: 0.4,
          random: true,
          anim: { 
            enable: true, 
            speed: 1, 
            opacity_min: 0.1, 
            sync: false 
          }
        },
        move: {
          enable: true,
          speed: 1.5,
          direction: "none",
          random: true,
          straight: false,
          outModes: { default: "bounce" },
          attract: {
            enable: true,
            rotateX: 600,
            rotateY: 1200
          }
        },
        rotate: {
          value: { min: 0, max: 360 },
          animation: {
            enable: true,
            speed: 10,
            sync: false
          }
        },
        line_linked: {
          enable: true,
          distance: 150,
          color: "#3b82f6",
          opacity: 0.2,
          width: 1
        }
      },
      interactivity: {
        events: {
          onhover: { 
            enable: true, 
            mode: "repulse",
            parallax: {
              enable: true,
              force: 30,
              smooth: 10
            }
          },
          onclick: { 
            enable: true,
            mode: "push" 
          }
        },
        modes: {
          repulse: { 
            distance: 120,
            duration: 0.4
          },
          push: {
            particles_nb: 3
          }
        }
      }
    });
  </script>
</body>
</html>