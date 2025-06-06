<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Application Settings Dashboard">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <title>Settings Dashboard</title>

  <!-- Tailwind CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Inline Styles -->
  <style>
    #particles-js {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -10;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }
    
    .nav-container {
      display: flex;
      gap: 1.5rem;
      justify-content: center;
      margin-bottom: 2.5rem;
      border-bottom: 1px solid rgba(55, 65, 81, 0.5);
      padding-bottom: 1.25rem;
    }

    .nav-tab {
      position: relative;
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-tab:hover {
      background: rgba(59, 130, 246, 0.1);
    }

    .nav-tab.active {
      background: rgba(59, 130, 246, 0.2);
    }

    .nav-tab span {
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 500;
      color: #e2e8f0;
    }

    .nav-tab.active span {
      color: #93c5fd;
    }

    .nav-tab span::after {
      content: '';
      position: absolute;
      width: 100%;
      transform: scaleX(0);
      height: 2px;
      bottom: -0.5rem;
      left: 0;
      background: linear-gradient(90deg, #3b82f6 0%, #6366f1 100%);
      transform-origin: bottom right;
      transition: transform 0.4s cubic-bezier(0.86, 0, 0.07, 1);
    }

    .nav-tab:hover span::after,
    .nav-tab.active span::after {
      transform: scaleX(1);
      transform-origin: bottom left;
    }

    .content-transition {
      animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(12px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Glassmorphism effect for cards */
    .glass-card {
      background: rgba(15, 23, 42, 0.7);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.36);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    ::-webkit-scrollbar-track {
      background: rgba(15, 23, 42, 0.6);
    }
    ::-webkit-scrollbar-thumb {
      background: rgba(59, 130, 246, 0.5);
      border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: rgba(59, 130, 246, 0.7);
    }

    /* Floating animation for home button */
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-4px); }
    }
  </style>
</head>
<body class="text-gray-100 min-h-screen font-sans antialiased">

  <!-- Animated Particles Background -->
  <div id="particles-js" aria-hidden="true"></div>

  <!-- Main Content Container -->
  <div class="container mx-auto px-4 py-8 md:px-8 max-w-7xl relative z-10">
    <!-- Enhanced Home Button -->
    <div class="mb-8">
      <a href="/" class="home-button inline-flex items-center space-x-3 px-4 py-3 rounded-xl bg-slate-800/70 hover:bg-slate-700/80 border border-slate-600/50 text-slate-200 hover:text-white transition-all duration-300 group glass-card shadow-lg hover:shadow-xl hover:animate-float">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400 group-hover:text-blue-300 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>
        <span class="font-medium tracking-tight text-lg">Back to Home</span>
      </a>
    </div>

    <!-- Page Header -->
    <div class="mb-10 text-center">
      <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-400 to-indigo-500 bg-clip-text text-transparent mb-3">Settings Center</h1>
      <p class="text-lg text-gray-400 max-w-2xl mx-auto">Manage your application's users, roles, and system configurations</p>
    </div>

    <!-- Navigation Tabs -->
    <nav class="mb-12">
      <ul class="nav-container">
        <li>
          <a href="{{ route('settings.users.index') }}" 
            class="nav-tab {{ request()->routeIs('settings.users.*') ? 'active' : '' }}"
            aria-current="{{ request()->routeIs('settings.users.*') ? 'page' : 'false' }}"
          >
            <span>
              <i class="fas fa-users"></i>
              User Management
            </span>
          </a>
        </li>
        @hasrole('admin')
          <li>
            <a href="{{ route('settings.roles.index') }}" 
              class="nav-tab {{ request()->routeIs('settings.roles.*') ? 'active' : '' }}"
              aria-current="{{ request()->routeIs('settings.roles.*') ? 'page' : 'false' }}"
            >
              <span>
                <i class="fas fa-user-shield"></i>
                Role Permissions
              </span>
            </a>
          </li>
        @endhasrole
      </ul>
    </nav>

    @if (session()->has('failure'))
    <div class="container container--narrow">
      <div class="alert alert-danger text-center">
        {{session('failure')}}
      </div>
    </div>
    @endif

    @if (session()->has('success'))
    <div class="container container--narrow">
      <div class="alert alert-success text-center">
        {{session('success')}}
      </div>
    </div>
    @endif

    <!-- Dynamic Content Area -->
    <main class="content-transition glass-card rounded-2xl p-6 md:p-8">
      {{ $slot }}
    </main>
  </div>

  <!-- Footer -->
  <footer class="mt-16 py-6 text-center text-gray-500 text-sm">
    <div class="container mx-auto px-4">
      <p>© {{ date('Y') }} SDG. All rights reserved.</p>
    </div>
  </footer>

  <!-- JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script src="{{ asset('js/settings.js') }}" defer></script>

  <!-- Dropzone -->
   <script type="text/javascript">
    new Dropzone('#image-upload', {
      thumbnailWidth: 200,
      acceptedFiles: ".jpeg,.jpg,.png"
    })
   </script>

  <!-- Enhanced particlesJS Configuration -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      particlesJS("particles-js", {
        particles: {
          number: { 
            value: 80, 
            density: { 
              enable: true, 
              value_area: 1000 
            } 
          },
          color: { 
            value: ["#60a5fa", "#818cf8", "#a78bfa", "#f472b6", "#34d399"] 
          },
          shape: {
            type: ["circle", "triangle", "polygon"],
            stroke: { 
              width: 0, 
              color: "#000000" 
            },
            polygon: { 
              nb_sides: 6 
            }
          },
          opacity: {
            value: 0.5,
            random: true,
            anim: { 
              enable: true, 
              speed: 1, 
              opacity_min: 0.1, 
              sync: false 
            }
          },
          size: {
            value: 3,
            random: true,
            anim: { 
              enable: true, 
              speed: 3, 
              size_min: 0.3, 
              sync: false 
            }
          },
          move: {
            enable: true,
            speed: 1.5,
            direction: "none",
            random: true,
            straight: false,
            out_mode: "bounce",
            bounce: true,
            attract: { 
              enable: true, 
              rotateX: 600, 
              rotateY: 1200 
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
          detect_on: "canvas",
          events: {
            onhover: { 
              enable: true, 
              mode: "grab" 
            },
            onclick: { 
              enable: true, 
              mode: "push" 
            },
            resize: true
          },
          modes: {
            grab: { 
              distance: 180, 
              line_linked: { 
                opacity: 0.3 
              } 
            },
            bubble: { 
              distance: 250, 
              size: 10, 
              duration: 2, 
              opacity: 0.8, 
              speed: 3 
            },
            repulse: { 
              distance: 120, 
              duration: 0.4 
            },
            push: { 
              particles_nb: 4 
            },
            remove: { 
              particles_nb: 2 
            }
          }
        },
        retina_detect: true
      });
    });
  </script>
</body>
</html>