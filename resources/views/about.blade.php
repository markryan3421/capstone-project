<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - SDG Portal</title>
  @vite('resources/css/app.css')
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
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
    .smooth-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    
    /* Main layout styles */
    #mainContent {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .main-wrapper {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .content-area {
      flex: 1;
    }
    
    /* About page specific styles */
    .section-card {
      background: rgba(31, 41, 55, 0.5);
      border: 1px solid rgba(255, 255, 255, 0.05);
      border-radius: 1rem;
      padding: 2rem;
      margin-bottom: 1.5rem;
    }
    .section-icon {
      width: 3rem;
      height: 3rem;
      border-radius: 0.75rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
    }
    .team-card {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 1rem;
      padding: 1.5rem;
      text-align: center;
      transition: all 0.3s ease;
    }
    .team-card:hover {
      transform: translateY(-5px);
      background: rgba(255, 255, 255, 0.08);
    }
    .team-image {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      margin: 0 auto 1rem;
      background: linear-gradient(135deg, #4f46e5 0%, #10b981 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.5rem;
      color: white;
      font-weight: bold;
    }
    .sdg-pill {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 1rem;
      font-size: 0.75rem;
      margin: 0.25rem;
    }
    .stat-card {
      text-align: center;
      padding: 1.5rem;
    }
    .stat-number {
      font-size: 2.5rem;
      font-weight: bold;
      background: linear-gradient(135deg, #4f46e5 0%, #10b981 100%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      line-height: 1;
    }
  </style>
</head>

<body class="bg-gray-900 text-gray-100 font-['Inter']">
  <!-- Main Content -->
  <div id="mainContent" class="relative">
    <!-- Navigation Header -->
    <header class="glass-card border-b border-gray-700/50 sticky top-0 z-40">
      <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
          <a href="/" class="flex items-center gap-3 group">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-emerald-600 rounded-xl flex items-center justify-center">
              <img src="{{ asset('images/logo1.png') }}" alt="SDG Logo" class="w-6 h-6 object-contain">
            </div>
            <span class="text-xl font-bold gradient-text group-hover:opacity-80 smooth-transition">SDG Portal</span>
          </a>
          
          <nav class="hidden md:flex items-center gap-6">
            <a href="/" class="bg-gradient-to-r from-blue-600 to-emerald-600 text-white px-4 py-2 rounded-lg hover:opacity-90 smooth-transition">
              Sign In
            </a>
          </nav>
          
          <!-- Mobile menu button -->
          <button class="md:hidden text-gray-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
      </div>
    </header>

    <!-- Main Wrapper -->
    <div class="main-wrapper relative z-10">
      <!-- Content Area -->
      <div class="content-area py-12">
        <div class="container mx-auto px-4 max-w-6xl">
          <!-- Hero Section -->
          <div class="text-center mb-16">
            <h1 class="text-4xl md:text-6xl font-bold gradient-text mb-6">About SDG Portal</h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto mb-8">
              Empowering organizations worldwide to achieve Sustainable Development Goals through innovative technology and data-driven insights.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
              <div class="flex items-center gap-2 px-4 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <span>Founded 2025</span>
              </div>
              <div class="flex items-center gap-2 px-4 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span>1 Organization</span>
              </div>
              <div class="flex items-center gap-2 px-4 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"/>
                </svg>
                <span>Global Impact</span>
              </div>
            </div>
          </div>

          <!-- Mission & Vision -->
          <div class="grid md:grid-cols-2 gap-8 mb-16">
            <div class="section-card">
              <div class="section-icon bg-blue-600/20">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
              </div>
              <h2 class="text-2xl font-bold text-white mb-4">Our Mission</h2>
              <p class="text-gray-300 leading-relaxed">
                To accelerate global progress towards the United Nations Sustainable Development Goals by providing organizations with powerful tools to track, measure, and optimize their sustainability initiatives through data-driven insights and collaborative platforms.
              </p>
            </div>

            <div class="section-card">
              <div class="section-icon bg-emerald-600/20">
                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
              </div>
              <h2 class="text-2xl font-bold text-white mb-4">Our Vision</h2>
              <p class="text-gray-300 leading-relaxed">
                A world where every organization, regardless of size or location, has the tools and insights needed to make meaningful contributions to sustainable development, creating a future where economic growth, social inclusion, and environmental protection go hand in hand.
              </p>
            </div>
          </div>

          <!-- Impact Statistics -->
          <div class="glass-card rounded-2xl p-8 mb-16">
            <h2 class="text-3xl font-bold text-white text-center mb-12">Our Impact in Numbers</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
              <div class="stat-card">
                <div class="stat-number">1</div>
                <p class="text-gray-400 text-sm">Organization</p>
              </div>
              <div class="stat-card">
                <div class="stat-number">15+</div>
                <p class="text-gray-400 text-sm">SDG Projects</p>
              </div>
              <div class="stat-card">
                <div class="stat-number">98%</div>
                <p class="text-gray-400 text-sm">Success Rate</p>
              </div>
              <div class="stat-card">
                <div class="stat-number">1</div>
                <p class="text-gray-400 text-sm">Country</p>
              </div>
            </div>
          </div>

          <!-- Team Section -->
          <div class="mb-16">
            <div class="text-center mb-12">
              <h2 class="text-3xl font-bold text-white mb-4">Meet Our Leadership Team</h2>
              <p class="text-gray-300 max-w-2xl mx-auto">
                Passionate professionals dedicated to driving sustainable change through technology and innovation.
              </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Team Member 1 -->
                <div class="bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-700 hover:border-blue-500/30 group">
                    <div class="relative mb-4">
                        <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-blue-500 to-purple-600 p-1 group-hover:scale-110 transition-transform duration-300">
                            <img 
                                src="{{ asset('teams/mark.jpg') }}" 
                                alt="Mark Ryan Zipagan"
                                class="w-full h-full rounded-full object-cover border-2 border-gray-800"
                                onerror="this.src='https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face&auto=format'"
                            >
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white text-center mb-1 group-hover:text-blue-400 transition-colors">Mark Ryan Zipagan</h3>
                    <p class="text-blue-400 text-sm text-center mb-3 font-medium">Project Manager</p>
                    <p class="text-gray-400 text-sm text-center mb-4 leading-relaxed">
                        Oversees the project timeline, tasks, and team coordination to ensure successful completion.
                    </p>
                    <div class="flex justify-center space-x-2 mb-4">
                        <span class="bg-blue-500/20 text-blue-300 px-3 py-1 rounded-full text-xs font-medium border border-blue-500/30">Planning</span>
                        <span class="bg-blue-500/20 text-blue-300 px-3 py-1 rounded-full text-xs font-medium border border-blue-500/30">Coordination</span>
                    </div>
                    <!-- Enhanced Social Media Icons -->
                    <div class="flex justify-center space-x-3 pt-4 border-t border-gray-700/50">
                        <a href="#" class="social-icon group bg-blue-500/10 hover:bg-blue-500 border border-blue-500/20 hover:border-blue-400">
                            <svg class="w-4 h-4 text-blue-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="#" class="social-icon group bg-pink-500/10 hover:bg-pink-500 border border-pink-500/20 hover:border-pink-400">
                            <svg class="w-4 h-4 text-pink-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="#" class="social-icon group bg-gray-500/10 hover:bg-gray-700 border border-gray-500/20 hover:border-gray-400">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366-1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022 4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679 1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-700 hover:border-emerald-500/30 group">
                    <div class="relative mb-4">
                        <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-emerald-500 to-green-600 p-1 group-hover:scale-110 transition-transform duration-300">
                            <img 
                                src="{{ asset('teams/ken.jpg') }}" 
                                alt="Kennith Decolongon"
                                class="w-full h-full rounded-full object-cover border-2 border-gray-800"
                                onerror="this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face&auto=format'"
                            >
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white text-center mb-1 group-hover:text-emerald-400 transition-colors">Kennith Decolongon</h3>
                    <p class="text-emerald-400 text-sm text-center mb-3 font-medium">Systems Analyst</p>
                    <p class="text-gray-400 text-sm text-center mb-4 leading-relaxed">
                        Analyzes user needs and designs the system's functions and requirements.
                    </p>
                    <div class="flex justify-center space-x-2 mb-4">
                        <span class="bg-emerald-500/20 text-emerald-300 px-3 py-1 rounded-full text-xs font-medium border border-emerald-500/30">Requirements</span>
                        <span class="bg-emerald-500/20 text-emerald-300 px-3 py-1 rounded-full text-xs font-medium border border-emerald-500/30">Design</span>
                    </div>
                    <!-- Enhanced Social Media Icons -->
                    <div class="flex justify-center space-x-3 pt-4 border-t border-gray-700/50">
                        <a href="#" class="social-icon group bg-emerald-500/10 hover:bg-emerald-500 border border-emerald-500/20 hover:border-emerald-400">
                            <svg class="w-4 h-4 text-emerald-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="#" class="social-icon group bg-pink-500/10 hover:bg-pink-500 border border-pink-500/20 hover:border-pink-400">
                            <svg class="w-4 h-4 text-pink-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="#" class="social-icon group bg-gray-500/10 hover:bg-gray-700 border border-gray-500/20 hover:border-gray-400">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366-1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022 4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679 1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-700 hover:border-purple-500/30 group">
                    <div class="relative mb-4">
                        <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-purple-500 to-pink-600 p-1 group-hover:scale-110 transition-transform duration-300">
                            <img 
                                src="{{ asset('teams/mab.jpg') }}" 
                                alt="John Marvin Alob"
                                class="w-full h-full rounded-full object-cover border-2 border-gray-800"
                                onerror="this.src='https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?w=150&h=150&fit=crop&crop=face&auto=format'"
                            >
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white text-center mb-1 group-hover:text-purple-400 transition-colors">John Marvin Alob</h3>
                    <p class="text-purple-400 text-sm text-center mb-3 font-medium">Programmer</p>
                    <p class="text-gray-400 text-sm text-center mb-4 leading-relaxed">
                        Develops and tests the software by writing and implementing the system's code.
                    </p>
                    <div class="flex justify-center space-x-2 mb-4">
                        <span class="bg-purple-500/20 text-purple-300 px-3 py-1 rounded-full text-xs font-medium border border-purple-500/30">Coding</span>
                        <span class="bg-purple-500/20 text-purple-300 px-3 py-1 rounded-full text-xs font-medium border border-purple-500/30">Testing</span>
                    </div>
                    <!-- Enhanced Social Media Icons -->
                    <div class="flex justify-center space-x-3 pt-4 border-t border-gray-700/50">
                        <a href="#" class="social-icon group bg-purple-500/10 hover:bg-purple-500 border border-purple-500/20 hover:border-purple-400">
                            <svg class="w-4 h-4 text-purple-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="#" class="social-icon group bg-pink-500/10 hover:bg-pink-500 border border-pink-500/20 hover:border-pink-400">
                            <svg class="w-4 h-4 text-pink-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="#" class="social-icon group bg-gray-500/10 hover:bg-gray-700 border border-gray-500/20 hover:border-gray-400">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366-1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022 4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679 1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-700 hover:border-orange-500/30 group">
                    <div class="relative mb-4">
                        <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-orange-500 to-red-600 p-1 group-hover:scale-110 transition-transform duration-300">
                            <img 
                                src="{{ asset('teams/hans.jpg') }}" 
                                alt="Hans Gabriel Montecastro"
                                class="w-full h-full rounded-full object-cover border-2 border-gray-800"
                                onerror="this.src='https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&h=150&fit=crop&crop=face&auto=format'"
                            >
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white text-center mb-1 group-hover:text-orange-400 transition-colors">Hans Gabriel Montecastro</h3>
                    <p class="text-orange-400 text-sm text-center mb-3 font-medium">Document Writer</p>
                    <p class="text-gray-400 text-sm text-center mb-4 leading-relaxed">
                        Creates and organizes all written project documentation, ensuring clarity and accuracy.
                    </p>
                    <div class="flex justify-center space-x-2 mb-4">
                        <span class="bg-orange-500/20 text-orange-300 px-3 py-1 rounded-full text-xs font-medium border border-orange-500/30">Documentation</span>
                        <span class="bg-orange-500/20 text-orange-300 px-3 py-1 rounded-full text-xs font-medium border border-orange-500/30">Reporting</span>
                    </div>
                    <!-- Enhanced Social Media Icons -->
                    <div class="flex justify-center space-x-3 pt-4 border-t border-gray-700/50">
                        <a href="#" class="social-icon group bg-orange-500/10 hover:bg-orange-500 border border-orange-500/20 hover:border-orange-400">
                            <svg class="w-4 h-4 text-orange-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="#" class="social-icon group bg-pink-500/10 hover:bg-pink-500 border border-pink-500/20 hover:border-pink-400">
                            <svg class="w-4 h-4 text-pink-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <a href="#" class="social-icon group bg-gray-500/10 hover:bg-gray-700 border border-gray-500/20 hover:border-gray-400">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366-1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022 4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679 1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

          <!-- Values Section -->
          <div class="mb-16 mt-8">
            <div class="text-center mb-12">
              <h2 class="text-3xl font-bold text-white mb-4">Our Core Values</h2>
              <p class="text-gray-300 max-w-2xl mx-auto">
                The principles that guide everything we do at SDG Portal.
              </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
              <div class="section-card text-center">
                <div class="section-icon bg-blue-600/20 mx-auto">
                  <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                  </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-3">Transparency</h3>
                <p class="text-gray-300 text-sm">
                  We believe in open data, clear communication, and honest reporting to build trust with our users and stakeholders.
                </p>
              </div>

              <div class="section-card text-center">
                <div class="section-icon bg-emerald-600/20 mx-auto">
                  <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                  </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-3">Collaboration</h3>
                <p class="text-gray-300 text-sm">
                  We work together with organizations, governments, and communities to create meaningful, scalable impact.
                </p>
              </div>

              <div class="section-card text-center">
                <div class="section-icon bg-purple-600/20 mx-auto">
                  <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                  </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-3">Innovation</h3>
                <p class="text-gray-300 text-sm">
                  We continuously evolve our platform to leverage the latest technology for maximum sustainability impact.
                </p>
              </div>
            </div>
          </div>          
        </div>
      </div>

      <!-- Footer -->
      <footer class="py-8 border-t border-gray-800/50 bg-gray-900/80 backdrop-blur-sm">
        <div class="container mx-auto px-4">
          <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="text-gray-500 text-sm mb-4 md:mb-0">
              &copy; 2025 SDG Platform. All rights reserved.
            </div>
            <div class="flex gap-6">
              <a href="/about" class="text-blue-400 smooth-transition text-sm font-medium">About</a>
              <a href="/terms" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">Terms</a>
              <a href="/privacy" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">Privacy</a>
              <a href="/contact" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">Contact</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script>
    // Simple animation for team cards on scroll
    document.addEventListener('DOMContentLoaded', function() {
      const teamCards = document.querySelectorAll('.team-card');
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }
        });
      }, { threshold: 0.1 });

      teamCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
      });
    });
  </script>
</body>
</html>