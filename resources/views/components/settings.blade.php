<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Settings</title>

  {{-- Tailwind CSS CDN --}}
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">

  {{-- Inline Styles --}}
  <style>
    #particles-js {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -10;
        background-color: #0f172a;
    }
    
    .nav-container {
        display: flex;
        gap: 2.5rem;
        justify-content: center;
        text-align: center;
        margin-bottom: 2rem;
        border-bottom: 1px solid #374151;
        padding-bottom: 1rem;
    }

    .nav-container a {
        display: inline-block;
        position: relative;
    }

    .nav-container span {
        position: relative;
        display: inline-block;
        padding-bottom: 2px;
    }

    .nav-container span::after {
        content: '';
        position: absolute;
        width: 100%;
        transform: scaleX(0);
        height: 2px;
        bottom: 0;
        left: 0;
        background: #3b82f6;
        transform-origin: bottom right;
        transition: transform 0.3s ease-out;
    }

    .nav-container a:hover span::after,
    .nav-container a.active span::after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }

    .content-transition {
        animation: fadeIn 0.4s ease-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="text-white relative overflow-x-hidden">

  <!-- Particles Background -->
  <div id="particles-js"></div>

  <!-- Sidebar code from layout.blade.php here -->
  <div class="container mx-auto p-8 relative z-10">
    <a href="/" class="top-4 left-4 mb-3 underline underline-offset-8"><- Back to Menu</a>

    <h1 class="text-3xl font-semibold mb-6 mt-12">Settings</h1>

    <div class="nav-container">
        <li class="list-none">
            <a href="{{ route('settings.users.index') }}" 
              class="text-blue-400 hover:text-blue-500 text-lg {{ request()->routeIs('settings.users.*') ? 'active' : '' }}"
            >
                <span>Users</span>
            </a>
        </li>
        <li class="list-none">
            <a href="{{ route('settings.roles.index') }}" 
              class="text-blue-400 hover:text-blue-500 text-lg {{ request()->routeIs('settings.roles.*') ? 'active' : '' }}"
            >
                <span>Roles</span>
            </a>
        </li>
    </div>

    <div class="bg-white-800 p-6 rounded-2xl mt-6 overflow-x-auto">
        {{ $slot }}
    </div>
  </div>

  {{-- JS CDN --}}
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

  {{-- Your local JS file --}}
  <script src="{{ asset('js/settings.js') }}"></script>

  {{-- particlesJS Config --}}
  <script>
    particlesJS("particles-js", {
      particles: {
        number: { value: 100, density: { enable: true, value_area: 800 } },
        color: { value: ["#ffffff", "#60a5fa", "#f472b6", "#10b981"] },
        shape: {
          type: ["circle", "triangle", "star", "polygon"],
          stroke: { width: 0, color: "#000000" },
          polygon: { nb_sides: 5 }
        },
        opacity: {
          value: 0.3,
          random: true,
          anim: { enable: true, speed: 0.5, opacity_min: 0.1, sync: false }
        },
        size: {
          value: 4,
          random: true,
          anim: { enable: true, speed: 2, size_min: 0.5, sync: false }
        },
        move: {
          enable: true,
          speed: 1.2,
          direction: "none",
          random: false,
          straight: false,
          out_mode: "out",
          bounce: false
        }
      },
      interactivity: {
        detect_on: "canvas",
        events: {
          onhover: { enable: true, mode: "grab" },
          onclick: { enable: true, mode: "push" },
          resize: true
        },
        modes: {
          grab: { distance: 140, line_linked: { opacity: 0.5 } },
          bubble: { distance: 200, size: 8, duration: 2, opacity: 0.8, speed: 3 },
          repulse: { distance: 100, duration: 0.4 },
          push: { particles_nb: 4 },
          remove: { particles_nb: 2 }
        }
      },
      retina_detect: true
    });
  </script>
</body>
</html>
