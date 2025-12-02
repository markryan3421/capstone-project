<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - SDG Portal</title>
  @vite('resources/css/app.css')
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
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
    
    /* Contact page specific styles */
    .contact-card {
      background: rgba(31, 41, 55, 0.5);
      border: 1px solid rgba(255, 255, 255, 0.05);
      border-radius: 1rem;
      padding: 2rem;
      margin-bottom: 1.5rem;
    }
    .contact-icon {
      width: 3rem;
      height: 3rem;
      border-radius: 0.75rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
    }
    .form-input {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 0.75rem;
      padding: 0.75rem 1rem;
      color: white;
      width: 100%;
      transition: all 0.3s ease;
    }
    .form-input:focus {
      outline: none;
      border-color: #10b981;
      box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
    }
    .contact-method {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 0.75rem;
      padding: 1.5rem;
      transition: all 0.3s ease;
    }
    .contact-method:hover {
      background: rgba(255, 255, 255, 0.08);
      transform: translateY(-2px);
    }

    /* Enhanced styles */
    .bg-gradient-contact {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
    }
    .contact-section {
      background: rgba(30, 41, 59, 0.4);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 1.5rem;
    }
    .social-hover {
      transition: all 0.3s ease;
    }
    .social-hover:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
    }
  </style>
</head>

<body class="bg-gradient-contact text-gray-100 font-['Inter']">
  <!-- Main Content -->
  <div id="mainContent" class="relative">
    <!-- Navigation Header -->
    <header class="glass-card border-b border-gray-700/50 sticky top-0 z-40">
      <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
          <a href="/" class="flex items-center gap-3 group">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
              <img src="{{ asset('images/logo1.png') }}" alt="SDG Logo" class="w-6 h-6 object-contain">
            </div>
            <span class="text-xl font-bold gradient-text group-hover:opacity-80 smooth-transition">SDG Portal</span>
          </a>
          
          <nav class="hidden md:flex items-center gap-6">
            <a href="/login" class="bg-gradient-to-r from-blue-600 to-emerald-600 text-white px-6 py-2.5 rounded-xl hover:opacity-90 smooth-transition shadow-lg hover:shadow-xl transition-all duration-200">
              Sign In
            </a>
          </nav>
          
          <!-- Mobile menu button -->
          <button class="md:hidden text-gray-300 p-2 hover:bg-gray-800/50 rounded-lg transition-colors duration-200">
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
          <!-- Page Header -->
          <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800/50 rounded-full border border-gray-700/50 text-sm text-gray-300 mb-6">
              <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
              We're here to help
            </div>
            <h1 class="text-4xl md:text-6xl font-bold gradient-text mb-6">Get In Touch</h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
              Have questions about SDG tracking? Need support with your account? We're here to help you drive sustainable impact and achieve your development goals.
            </p>
            <div class="flex flex-wrap justify-center gap-4 mt-8">
              <div class="flex items-center gap-3 px-5 py-3 bg-gradient-to-r from-gray-800/60 to-gray-900/40 rounded-xl border border-gray-700/50 backdrop-blur-sm">
                <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                <span class="text-sm font-medium">Response within 24 hours</span>
              </div>
              <div class="flex items-center gap-3 px-5 py-3 bg-gradient-to-r from-gray-800/60 to-gray-900/40 rounded-xl border border-gray-700/50 backdrop-blur-sm">
                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                <span class="text-sm font-medium">Expert SDG consultants</span>
              </div>
              <div class="flex items-center gap-3 px-5 py-3 bg-gradient-to-r from-gray-800/60 to-gray-900/40 rounded-xl border border-gray-700/50 backdrop-blur-sm">
                <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                <span class="text-sm font-medium">Multiple contact options</span>
              </div>
            </div>
          </div>

          <!-- Contact Methods Grid -->
          <div class="grid lg:grid-cols-3 gap-8 mb-16">
            <!-- Email -->
            <div class="group text-center">
              <div class="contact-section p-8 h-full hover:border-emerald-500/30 transition-all duration-300">
                <div class="contact-icon bg-emerald-600/20 mx-auto group-hover:scale-110 smooth-transition group-hover:bg-emerald-600/30">
                  <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Email Support</h3>
                <p class="text-gray-400 mb-4 leading-relaxed">Send us a detailed message and we'll get back to you with comprehensive assistance.</p>
                <a href="mailto:support@sdgportal.org" class="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 smooth-transition font-semibold text-lg">
                  support@sdgportal.org
                  <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                  </svg>
                </a>
                <p class="text-emerald-300/70 text-sm mt-3 font-medium">Typically replies within 4 hours</p>
              </div>
            </div>

            <!-- Phone -->
            <div class="group text-center">
              <div class="contact-section p-8 h-full hover:border-blue-500/30 transition-all duration-300">
                <div class="contact-icon bg-blue-600/20 mx-auto group-hover:scale-110 smooth-transition group-hover:bg-blue-600/30">
                  <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                  </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Phone Support</h3>
                <p class="text-gray-400 mb-4 leading-relaxed">Speak directly with our SDG experts for immediate assistance and guidance.</p>
                <a href="tel:+1-555-SDG-PORTAL" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 smooth-transition font-semibold text-lg">
                  +1 (555) SDG-PORTAL
                  <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                  </svg>
                </a>
                <p class="text-blue-300/70 text-sm mt-3 font-medium">Mon-Fri, 9AM-6PM EST</p>
              </div>
            </div>

            <!-- Office -->
            <div class="group text-center">
              <div class="contact-section p-8 h-full hover:border-purple-500/30 transition-all duration-300">
                <div class="contact-icon bg-purple-600/20 mx-auto group-hover:scale-110 smooth-transition group-hover:bg-purple-600/30">
                  <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Visit Our Office</h3>
                <p class="text-gray-400 mb-4 leading-relaxed">Schedule an in-person consultation at our sustainable development hub.</p>
                <div class="text-purple-400 font-semibold text-lg">
                  Sustainable Development Hub
                </div>
                <p class="text-purple-300/70 text-sm mt-3 font-medium">New York, NY 10017</p>
              </div>
            </div>
          </div>

          <!-- Main Content Grid -->
          <div class="grid lg:grid-cols-2 gap-12">
            <!-- Contact Form Section -->
            <div class="contact-section p-8">
              <h2 class="text-3xl font-bold text-white mb-2">Send us a Message</h2>
              <p class="text-gray-400 mb-8">Fill out the form below and we'll get back to you as soon as possible.</p>
              
              <form class="space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                  <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-3">First Name</label>
                    <input type="text" class="w-full px-4 py-3.5 bg-gray-800/30 border border-gray-700/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 placeholder-gray-500 transition-all duration-200" placeholder="Enter your first name">
                  </div>
                  <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-3">Last Name</label>
                    <input type="text" class="w-full px-4 py-3.5 bg-gray-800/30 border border-gray-700/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 placeholder-gray-500 transition-all duration-200" placeholder="Enter your last name">
                  </div>
                </div>
                
                <div>
                  <label class="block text-sm font-semibold text-gray-300 mb-3">Email Address</label>
                  <input type="email" class="w-full px-4 py-3.5 bg-gray-800/30 border border-gray-700/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 placeholder-gray-500 transition-all duration-200" placeholder="your@email.com">
                </div>
                
                <div>
                  <label class="block text-sm font-semibold text-gray-300 mb-3">Subject</label>
                  <input type="text" class="w-full px-4 py-3.5 bg-gray-800/30 border border-gray-700/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 placeholder-gray-500 transition-all duration-200" placeholder="What is this regarding?">
                </div>
                
                <div>
                  <label class="block text-sm font-semibold text-gray-300 mb-3">Message</label>
                  <textarea rows="5" class="w-full px-4 py-3.5 bg-gray-800/30 border border-gray-700/50 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 placeholder-gray-500 transition-all duration-200 resize-none" placeholder="Tell us about your inquiry..."></textarea>
                </div>
                
                <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                  Send Message
                </button>
              </form>
            </div>

            <!-- Additional Information -->
            <div class="space-y-8">
              <!-- FAQ Section -->
              <div class="contact-section p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                  <div class="w-10 h-10 bg-blue-600/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                  </div>
                  Frequently Asked Questions
                </h2>
                
                <div class="space-y-6">
                  <div class="border-b border-gray-700/50 pb-6">
                    <h4 class="font-semibold text-white mb-3 text-lg">How do I track SDG progress for my organization?</h4>
                    <p class="text-gray-400 leading-relaxed">Our platform provides customized dashboards and analytics tools specifically designed for organizational SDG tracking. Contact us for a personalized demo.</p>
                  </div>
                  
                  <div class="border-b border-gray-700/50 pb-6">
                    <h4 class="font-semibold text-white mb-3 text-lg">Can I integrate with existing sustainability software?</h4>
                    <p class="text-gray-400 leading-relaxed">Yes! We offer API integrations with major sustainability platforms and custom integration services for proprietary systems.</p>
                  </div>
                  
                  <div class="pb-2">
                    <h4 class="font-semibold text-white mb-3 text-lg">What support do you offer for SDG reporting?</h4>
                    <p class="text-gray-400 leading-relaxed">We provide comprehensive reporting templates, GRI alignment, and expert consultation for sustainability reporting frameworks.</p>
                  </div>

                  <div class="text-center pt-4">
                    <a href="#" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 smooth-transition font-medium group">
                      View all FAQs
                      <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                      </svg>
                    </a>
                  </div>
                </div>
              </div>

              <!-- Social Links -->
              <div class="contact-section p-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                  <div class="w-10 h-10 bg-purple-600/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                  </div>
                  Connect With Us
                </h2>
                
                <div class="grid grid-cols-3 gap-4">
                  <a href="#" class="social-hover bg-gradient-to-br from-blue-500/10 to-blue-600/10 hover:from-blue-500/20 hover:to-blue-600/20 border border-blue-500/20 hover:border-blue-400/40 rounded-xl p-4 text-center group">
                    <svg class="w-6 h-6 text-blue-400 group-hover:scale-110 transition-transform duration-200 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                    </svg>
                    <span class="text-xs text-blue-400 font-medium">Twitter</span>
                  </a>
                  
                  <a href="#" class="social-hover bg-gradient-to-br from-blue-600/10 to-blue-700/10 hover:from-blue-600/20 hover:to-blue-700/20 border border-blue-600/20 hover:border-blue-500/40 rounded-xl p-4 text-center group">
                    <svg class="w-6 h-6 text-blue-400 group-hover:scale-110 transition-transform duration-200 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                    <span class="text-xs text-blue-400 font-medium">LinkedIn</span>
                  </a>
                  
                  <a href="#" class="social-hover bg-gradient-to-br from-purple-500/10 to-pink-500/10 hover:from-purple-500/20 hover:to-pink-500/20 border border-purple-500/20 hover:border-purple-400/40 rounded-xl p-4 text-center group">
                    <svg class="w-6 h-6 text-purple-400 group-hover:scale-110 transition-transform duration-200 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.042-3.441.219-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.017z"/>
                    </svg>
                    <span class="text-xs text-purple-400 font-medium">Instagram</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="py-8 border-t border-gray-800/50 bg-gray-900/80 backdrop-blur-sm mt-16">
        <div class="container mx-auto px-4">
          <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="text-gray-500 text-sm mb-4 md:mb-0">
              &copy; 2025 SDG Platform. All rights reserved.
            </div>
            <div class="flex gap-6">
              <a href="/about" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">About</a>
              <a href="/terms" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">Terms</a>
              <a href="/privacy" class="text-gray-400 hover:text-blue-400 smooth-transition text-sm">Privacy</a>
              <a href="/contact" class="text-blue-400 smooth-transition text-sm font-medium">Contact</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script>
    // Form handling and validation
    document.addEventListener('DOMContentLoaded', function() {
      const contactForm = document.querySelector('form');
      
      contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const requiredFields = contactForm.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
          if (!field.value.trim()) {
            isValid = false;
            field.style.borderColor = '#ef4444';
          } else {
            field.style.borderColor = 'rgba(255, 255, 255, 0.1)';
          }
        });
        
        if (isValid) {
          // Simulate form submission
          const submitBtn = contactForm.querySelector('button[type="submit"]');
          const originalText = submitBtn.innerHTML;
          
          submitBtn.innerHTML = `
            <svg class="w-5 h-5 animate-spin mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Sending Message...
          `;
          submitBtn.disabled = true;
          
          setTimeout(() => {
            // Show success message (in a real app, this would be handled by your backend)
            alert('Thank you for your message! We\'ll get back to you within 24 hours.');
            contactForm.reset();
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
          }, 2000);
        }
      });
    });
  </script>
</body>
</html>