<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Terms of Service - SDG Portal</title>
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
    
    /* Terms page specific styles */
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
        <div class="container mx-auto px-4 max-w-4xl">
          <!-- Page Header -->
          <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-4">Terms of Service</h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto">
              Last updated: December 15, 2024. Please read these terms carefully before using our services.
            </p>
            <div class="flex flex-wrap justify-center gap-3 mt-6">
              <div class="flex items-center gap-2 px-4 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm">15 min read</span>
              </div>
              <div class="flex items-center gap-2 px-4 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span class="text-sm">Legally Binding</span>
              </div>
            </div>
          </div>

          <!-- Table of Contents -->
          <div class="glass-card rounded-2xl p-6 mb-8">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
              <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
              </svg>
              Table of Contents
            </h3>
            <div class="grid md:grid-cols-2 gap-2">
              <a href="#acceptance" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">1. Acceptance of Terms</a>
              <a href="#accounts" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">2. User Accounts</a>
              <a href="#intellectual" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">3. Intellectual Property</a>
              <a href="#conduct" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">4. User Conduct</a>
              <a href="#data" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">5. Data & Privacy</a>
              <a href="#termination" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">6. Termination</a>
              <a href="#liability" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">7. Liability</a>
              <a href="#governing" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">8. Governing Law</a>
            </div>
          </div>

          <!-- Terms Content -->
          <div class="space-y-8">
            <!-- Section 1 -->
            <section id="acceptance" class="section-card scroll-mt-20">
              <div class="flex items-start gap-4">
                <div class="section-icon bg-blue-600/20">
                  <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <h2 class="text-2xl font-bold text-white mb-4">1. Acceptance of Terms</h2>
                  <div class="space-y-4 text-gray-300">
                    <p>By accessing and using the SDG Portal platform, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service. These terms constitute a legally binding agreement between you and Sustainable Development Goals Portal Inc.</p>
                    
                    <p>If you are using our services on behalf of an organization, you represent and warrant that you have the authority to bind that organization to these terms. In such cases, "you" and "your" will refer to that organization.</p>
                    
                    <div class="bg-yellow-900/20 border border-yellow-800/50 rounded-lg p-4 mt-4">
                      <p class="text-yellow-200 text-sm flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span>If you do not agree with any part of these terms, you must not access or use our services.</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- Section 2 -->
            <section id="accounts" class="section-card scroll-mt-20">
              <div class="flex items-start gap-4">
                <div class="section-icon bg-emerald-600/20">
                  <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <h2 class="text-2xl font-bold text-white mb-4">2. User Accounts & Registration</h2>
                  <div class="space-y-4 text-gray-300">
                    <p>To access certain features of the SDG Portal, you must register for an account. When registering, you agree to:</p>
                    
                    <ul class="list-disc list-inside space-y-2 ml-4">
                      <li>Provide accurate, current, and complete information</li>
                      <li>Maintain and promptly update your account information</li>
                      <li>Maintain the security of your password and accept all risks of unauthorized access</li>
                      <li>Notify us immediately of any unauthorized use of your account</li>
                      <li>Take responsibility for all activities that occur under your account</li>
                    </ul>
                    
                    <p>We reserve the right to disable any user account at our sole discretion if we believe you have violated these terms or applicable laws.</p>
                  </div>
                </div>
              </div>
            </section>

            <!-- Section 3 -->
            <section id="intellectual" class="section-card scroll-mt-20">
              <div class="flex items-start gap-4">
                <div class="section-icon bg-purple-600/20">
                  <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <h2 class="text-2xl font-bold text-white mb-4">3. Intellectual Property Rights</h2>
                  <div class="space-y-4 text-gray-300">
                    <p>The SDG Portal and its original content, features, and functionality are owned by Sustainable Development Goals Portal Inc. and are protected by international copyright, trademark, patent, trade secret, and other intellectual property laws.</p>
                    
                    <p>You may not:</p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                      <li>Modify, copy, or create derivative works based on our services</li>
                      <li>Use our trademarks, logos, or branding without written permission</li>
                      <li>Reverse engineer, decompile, or attempt to extract source code</li>
                      <li>Remove any copyright or proprietary notices</li>
                    </ul>
                    
                    <p>You retain ownership of any content you submit to the platform, but grant us a worldwide license to use, display, and distribute that content in connection with our services.</p>
                  </div>
                </div>
              </div>
            </section>

            <!-- Section 4 -->
            <section id="conduct" class="section-card scroll-mt-20">
              <div class="flex items-start gap-4">
                <div class="section-icon bg-orange-600/20">
                  <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <h2 class="text-2xl font-bold text-white mb-4">4. User Conduct & Responsibilities</h2>
                  <div class="space-y-4 text-gray-300">
                    <p>You agree not to engage in any of the following prohibited activities:</p>
                    
                    <div class="grid md:grid-cols-2 gap-4 mt-4">
                      <div class="bg-red-900/20 border border-red-800/30 rounded-lg p-3">
                        <h4 class="font-semibold text-red-300 mb-2">Prohibited Content</h4>
                        <ul class="text-sm space-y-1 text-red-200">
                          <li>• Illegal or fraudulent material</li>
                          <li>• Hate speech or discrimination</li>
                          <li>• Malicious software or code</li>
                          <li>• Spam or unauthorized advertising</li>
                        </ul>
                      </div>
                      
                      <div class="bg-red-900/20 border border-red-800/30 rounded-lg p-3">
                        <h4 class="font-semibold text-red-300 mb-2">Prohibited Actions</h4>
                        <ul class="text-sm space-y-1 text-red-200">
                          <li>• Harassment of other users</li>
                          <li>• Impersonation of others</li>
                          <li>• Data scraping or crawling</li>
                          <li>• Service disruption</li>
                        </ul>
                      </div>
                    </div>
                    
                    <p>We reserve the right to investigate and take appropriate legal action against anyone who violates these provisions.</p>
                  </div>
                </div>
              </div>
            </section>

            <!-- Section 5 -->
            <section id="data" class="section-card scroll-mt-20">
              <div class="flex items-start gap-4">
                <div class="section-icon bg-cyan-600/20">
                  <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <h2 class="text-2xl font-bold text-white mb-4">5. Data Protection & Privacy</h2>
                  <div class="space-y-4 text-gray-300">
                    <p>Your privacy is important to us. Our Privacy Policy explains how we collect, use, and protect your personal information. By using our services, you agree to our collection and use of data as described in our Privacy Policy.</p>
                    
                    <p>We implement appropriate technical and organizational measures to protect your data, but cannot guarantee absolute security. You are responsible for maintaining the confidentiality of your login credentials.</p>
                    
                    <div class="bg-blue-900/20 border border-blue-800/50 rounded-lg p-4 mt-4">
                      <p class="text-blue-200 text-sm flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>For detailed information about data handling, please refer to our comprehensive <a href="/privacy" class="underline hover:text-blue-300">Privacy Policy</a>.</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- Quick Navigation -->
            {{-- <div class="glass-card rounded-2xl p-6 text-center">
              <p class="text-gray-300 mb-4">Continue reading the full terms</p>
              <div class="flex flex-wrap justify-center gap-3">
                <a href="#termination" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg smooth-transition text-sm">Termination</a>
                <a href="#liability" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg smooth-transition text-sm">Liability</a>
                <a href="#governing" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg smooth-transition text-sm">Governing Law</a>
              </div>
            </div> --}}

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
              <a href="/about" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">About</a>
              <a href="/terms" class="text-blue-400 smooth-transition text-sm font-medium">Terms</a>
              <a href="/privacy" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">Privacy</a>
              <a href="/contact" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">Contact</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script>
    // Smooth scrolling for anchor links
    document.addEventListener('DOMContentLoaded', function() {
      const links = document.querySelectorAll('a[href^="#"]');
      
      links.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          
          const targetId = this.getAttribute('href');
          const targetElement = document.querySelector(targetId);
          
          if (targetElement) {
            const offset = 80;
            const elementPosition = targetElement.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;
            
            window.scrollTo({
              top: offsetPosition,
              behavior: 'smooth'
            });
          }
        });
      });
    });
  </script>
</body>
</html>