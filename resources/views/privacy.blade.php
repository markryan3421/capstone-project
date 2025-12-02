<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Privacy Policy - SDG Portal</title>
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
    
    /* Privacy page specific styles */
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
    .data-category {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 0.75rem;
      padding: 1.5rem;
      margin: 1rem 0;
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
            <a href="/login" class="bg-gradient-to-r from-blue-600 to-emerald-600 text-white px-4 py-2 rounded-lg hover:opacity-90 smooth-transition">
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
            <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-4">Privacy Policy</h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto">
              Last updated: December 15, 2024. Your privacy is important to us—here's how we protect it.
            </p>
            <div class="flex flex-wrap justify-center gap-3 mt-6">
              <div class="flex items-center gap-2 px-4 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm">12 min read</span>
              </div>
              <div class="flex items-center gap-2 px-4 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span class="text-sm">GDPR Compliant</span>
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
              <a href="#information" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">1. Information We Collect</a>
              <a href="#usage" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">2. How We Use Information</a>
              <a href="#sharing" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">3. Information Sharing</a>
              <a href="#cookies" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">4. Cookies & Tracking</a>
              <a href="#security" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">5. Data Security</a>
              <a href="#rights" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">6. Your Rights</a>
              <a href="#retention" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">7. Data Retention</a>
              <a href="#updates" class="text-gray-300 hover:text-blue-400 smooth-transition text-sm py-1">8. Policy Updates</a>
            </div>
          </div>

          <!-- Privacy Content -->
          <div class="space-y-8">
            <!-- Section 1 -->
            <section id="information" class="section-card scroll-mt-20">
              <div class="flex items-start gap-4">
                <div class="section-icon bg-blue-600/20">
                  <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <h2 class="text-2xl font-bold text-white mb-4">1. Information We Collect</h2>
                  <div class="space-y-4 text-gray-300">
                    <p>We collect information to provide better services to our users. The types of information we gather include:</p>
                    
                    <div class="data-category">
                      <h4 class="font-semibold text-white mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Personal Information
                      </h4>
                      <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
                        <li>Name, email address, and contact details</li>
                        <li>Organization information and job title</li>
                        <li>Account credentials and profile information</li>
                        <li>Payment and billing information</li>
                      </ul>
                    </div>

                    <div class="data-category">
                      <h4 class="font-semibold text-white mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Usage Data
                      </h4>
                      <ul class="list-disc list-inside space-y-1 text-gray-300 ml-4">
                        <li>Service usage patterns and preferences</li>
                        <li>SDG goal tracking and progress data</li>
                        <li>Device information and IP addresses</li>
                        <li>Log data and error reports</li>
                      </ul>
                    </div>

                    <div class="bg-blue-900/20 border border-blue-800/50 rounded-lg p-4 mt-4">
                      <p class="text-blue-200 text-sm flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>We only collect information necessary to provide our services and never sell your personal data to third parties.</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- Section 2 -->
            <section id="usage" class="section-card scroll-mt-20">
              <div class="flex items-start gap-4">
                <div class="section-icon bg-emerald-600/20">
                  <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <h2 class="text-2xl font-bold text-white mb-4">2. How We Use Your Information</h2>
                  <div class="space-y-4 text-gray-300">
                    <p>We use the information we collect for the following purposes:</p>
                    
                    <div class="grid md:grid-cols-2 gap-4 mt-4">
                      <div class="bg-emerald-900/20 border border-emerald-800/30 rounded-lg p-4">
                        <h4 class="font-semibold text-emerald-300 mb-2 flex items-center gap-2">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                          </svg>
                          Service Provision
                        </h4>
                        <ul class="text-sm space-y-1 text-emerald-200">
                          <li>• Account management</li>
                          <li>• SDG progress tracking</li>
                          <li>• Personalized dashboards</li>
                          <li>• Customer support</li>
                        </ul>
                      </div>
                      
                      <div class="bg-purple-900/20 border border-purple-800/30 rounded-lg p-4">
                        <h4 class="font-semibold text-purple-300 mb-2 flex items-center gap-2">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                          </svg>
                          Analytics & Improvement
                        </h4>
                        <ul class="text-sm space-y-1 text-purple-200">
                          <li>• Service optimization</li>
                          <li>• Feature development</li>
                          <li>• Performance monitoring</li>
                          <li>• User experience research</li>
                        </ul>
                      </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                      <div class="bg-blue-900/20 border border-blue-800/30 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-300 mb-2 flex items-center gap-2">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                          </svg>
                          Communication
                        </h4>
                        <ul class="text-sm space-y-1 text-blue-200">
                          <li>• Service updates</li>
                          <li>• Security alerts</li>
                          <li>• SDG insights</li>
                          <li>• Support responses</li>
                        </ul>
                      </div>
                      
                      <div class="bg-orange-900/20 border border-orange-800/30 rounded-lg p-4">
                        <h4 class="font-semibold text-orange-300 mb-2 flex items-center gap-2">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                          </svg>
                          Security & Legal
                        </h4>
                        <ul class="text-sm space-y-1 text-orange-200">
                          <li>• Fraud prevention</li>
                          <li>• Legal compliance</li>
                          <li>• Terms enforcement</li>
                          <li>• Safety protection</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- Section 3 -->
            <section id="sharing" class="section-card scroll-mt-20">
              <div class="flex items-start gap-4">
                <div class="section-icon bg-purple-600/20">
                  <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <h2 class="text-2xl font-bold text-white mb-4">3. Information Sharing & Disclosure</h2>
                  <div class="space-y-4 text-gray-300">
                    <p>We do not sell, trade, or rent your personal identification information to others. We may share generic aggregated demographic information not linked to any personal identification information regarding visitors and users with our business partners and trusted affiliates.</p>
                    
                    <div class="data-category">
                      <h4 class="font-semibold text-white mb-3">When We Share Information</h4>
                      <ul class="list-disc list-inside space-y-2 text-gray-300 ml-4">
                        <li><strong>Service Providers:</strong> With trusted third parties who assist us in operating our website and services</li>
                        <li><strong>Legal Requirements:</strong> When required by law or to protect our rights and safety</li>
                        <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets</li>
                        <li><strong>Consent:</strong> When you give us explicit permission to share specific information</li>
                      </ul>
                    </div>

                    <div class="bg-yellow-900/20 border border-yellow-800/50 rounded-lg p-4">
                      <p class="text-yellow-200 text-sm flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span>We require all third-party service providers to maintain the same level of data protection as we do.</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <!-- Section 4 -->
            <section id="cookies" class="section-card scroll-mt-20">
              <div class="flex items-start gap-4">
                <div class="section-icon bg-orange-600/20">
                  <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <h2 class="text-2xl font-bold text-white mb-4">4. Cookies & Tracking Technologies</h2>
                  <div class="space-y-4 text-gray-300">
                    <p>We use cookies and similar tracking technologies to track activity on our service and hold certain information to enhance your user experience.</p>
                    
                    <div class="grid gap-4 mt-4">
                      <div class="flex items-start gap-3 p-3 bg-gray-800/30 rounded-lg">
                        <div class="w-8 h-8 bg-blue-600/20 rounded-lg flex items-center justify-center flex-shrink-0">
                          <span class="text-blue-400 text-sm font-bold">ES</span>
                        </div>
                        <div>
                          <h4 class="font-semibold text-white text-sm">Essential Cookies</h4>
                          <p class="text-gray-400 text-sm">Required for basic site functionality and cannot be disabled.</p>
                        </div>
                      </div>
                      
                      <div class="flex items-start gap-3 p-3 bg-gray-800/30 rounded-lg">
                        <div class="w-8 h-8 bg-green-600/20 rounded-lg flex items-center justify-center flex-shrink-0">
                          <span class="text-green-400 text-sm font-bold">PF</span>
                        </div>
                        <div>
                          <h4 class="font-semibold text-white text-sm">Performance Cookies</h4>
                          <p class="text-gray-400 text-sm">Help us understand how visitors interact with our website.</p>
                        </div>
                      </div>
                      
                      <div class="flex items-start gap-3 p-3 bg-gray-800/30 rounded-lg">
                        <div class="w-8 h-8 bg-purple-600/20 rounded-lg flex items-center justify-center flex-shrink-0">
                          <span class="text-purple-400 text-sm font-bold">FN</span>
                        </div>
                        <div>
                          <h4 class="font-semibold text-white text-sm">Functionality Cookies</h4>
                          <p class="text-gray-400 text-sm">Enable enhanced features and personalization.</p>
                        </div>
                      </div>
                    </div>

                    <p>You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our service.</p>
                  </div>
                </div>
              </div>
            </section>

            <!-- Quick Navigation -->
            {{-- <div class="glass-card rounded-2xl p-6 text-center">
              <p class="text-gray-300 mb-4">Continue reading the full privacy policy</p>
              <div class="flex flex-wrap justify-center gap-3">
                <a href="#security" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg smooth-transition text-sm">Data Security</a>
                <a href="#rights" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg smooth-transition text-sm">Your Rights</a>
                <a href="#retention" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg smooth-transition text-sm">Data Retention</a>
                <a href="#updates" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg smooth-transition text-sm">Policy Updates</a>
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
              <a href="/terms" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">Terms</a>
              <a href="/privacy" class="text-blue-400 smooth-transition text-sm font-medium">Privacy</a>
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