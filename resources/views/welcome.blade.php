<!DOCTYPE html>
<html lang="en" x-data>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SDG Portal</title>
  @vite('resources/css/app.css')
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    @keyframes subtleFloat {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-8px) rotate(1deg); }
    }
    .floating-logo { 
      animation: subtleFloat 8s ease-in-out infinite;
      mix-blend-mode: screen;
    }
    .smooth-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .gradient-text {
      background: linear-gradient(135deg, #4f46e5 0%, #10b981 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    .glass-card {
      background: rgba(31, 41, 55, 0.7);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }
    .particle-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }
  </style>
</head>
<body class="bg-gray-900 min-h-screen text-gray-100 font-['Inter'] relative overflow-x-hidden">

  <!-- Particle Background -->
  <div id="tsparticles" class="fixed inset-0 z-0"></div>

  <!-- Main Content -->
  <main class="relative z-10">
    <div class="container mx-auto px-4 min-h-screen flex flex-col justify-center py-12">
      <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
        <!-- Hero Section - Modified to be more centered -->
        <div class="lg:w-1/2 space-y-8 flex flex-col items-center lg:items-center relative">
          <!-- Transparent Logo with Particle Background Visible -->
          <div class="relative w-52 h-52 mb-8">
            <div class="particle-overlay"></div>
            <img src="{{ asset('images/logo1.png') }}" alt="SDG Logo" 
                 class="w-full h-full object-contain floating-logo opacity-90">
          </div>
          
          <div class="max-w-md text-center">
            <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-4 leading-tight">
              Sustainable Development <br><span class="text-white">Goals Portal</span>
            </h1>
            
            <p class="text-lg text-gray-300 mb-8 leading-relaxed">
              Empowering organizations with tools to drive meaningful change and track sustainable impact.
            </p>
            
            <div class="flex flex-wrap justify-center gap-3">
              <div class="flex items-center gap-2 px-4 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span class="text-sm font-medium">Secure</span>
              </div>
              
              <div class="flex items-center gap-2 px-4 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="text-sm font-medium">Efficient</span>
              </div>

              <div class="flex items-center gap-2 px-4 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span class="text-sm font-medium">Organized</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Login Card -->
        <div class="lg:w-1/2 flex justify-center">
          <div class="glass-card p-8 sm:p-10 rounded-2xl w-full max-w-md hover:shadow-2xl smooth-transition">
            <div class="flex items-center gap-4 mb-8">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-600/30 to-emerald-600/30 flex items-center justify-center border border-gray-600/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <div>
                <h2 class="text-2xl font-semibold text-gray-100">Organization Login</h2>
                <p class="text-sm text-gray-400">Access your SDG dashboard</p>
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

            <form action="/login" method="POST" class="space-y-5">
              @csrf
              
              <div class="space-y-2">
                <label for="email" class="text-sm font-medium text-gray-300 flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                  Email Address
                </label>
                <input type="text" 
                       id="email" 
                       name="email" 
                       placeholder="your@organization.com" 
                       class="w-full px-4 py-3 bg-gray-900/40 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 smooth-transition @error('email') border-red-500 @enderror"
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
              
              <div class="space-y-2">
                <div class="flex justify-between items-center">
                  <label for="password" class="text-sm font-medium text-gray-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Password
                  </label>

                </div>
                <input type="password" 
                       id="password" 
                       name="password" 
                       placeholder="••••••••" 
                       class="w-full px-4 py-3 bg-gray-900/40 border border-gray-700 rounded-lg text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 smooth-transition" />
                @error('password')
                  <p class="text-sm text-red-400 mt-1 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{$message}}
                  </p>
                @enderror
              </div>
              
              <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-700 bg-gray-800 text-emerald-500 focus:ring-emerald-500">
                <label for="remember-me" class="ml-2 block text-sm text-gray-300">Remember me</label>
              </div>
              
              <div class="pt-2">
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-emerald-600 text-white py-3.5 rounded-lg font-medium hover:opacity-90 smooth-transition flex items-center justify-center gap-3 shadow hover:shadow-lg">
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
  </main>

  <!-- Footer -->
  <footer class="relative z-10 py-6 border-t border-gray-800/50 mt-8">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="text-gray-500 text-sm mb-3 md:mb-0">
          &copy; 2025 SDG Platform. All rights reserved.
        </div>
        <div class="flex gap-5">
          <a href="#" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">Terms</a>
          <a href="#" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">Privacy</a>
          <a href="#" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">Contact</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Particle Configuration -->
  <script>
    tsParticles.load("tsparticles", {
      fullScreen: { enable: false },
      background: { color: "transparent" },
      particles: {
        number: { 
          value: 70,
          density: {
            enable: true,
            value_area: 800
          }
        },
        shape: {
          type: ["circle", "triangle"],
          polygon: {
            nb_sides: 6
          }
        },
        size: {
          value: { min: 2, max: 5 },
          random: true
        },
        color: { 
          value: ["#4f46e5", "#10b981", "#3b82f6", "#8b5cf6"] 
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
          speed: 0.8,
          direction: "none",
          random: true,
          straight: false,
          outModes: { default: "bounce" },
          attract: {
            enable: true,
            rotateX: 800,
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
          distance: 120,
          color: "#4f46e5",
          opacity: 0.2,
          width: 1
        }
      },
      interactivity: {
        events: {
          onhover: { 
            enable: true, 
            mode: "grab",
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
          grab: { 
            distance: 140,
            line_linked: {
              opacity: 0.5
            }
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