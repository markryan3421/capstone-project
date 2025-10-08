<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDGs</title>
  <script src="https://cdn.tailwindcss.com"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- Add Flowbite CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  
  <style>
    .sdg-card {
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      image-rendering: -webkit-optimize-contrast;
      image-rendering: crisp-edges;
    }
    
    /* Ensure images don't get blurry on transform */
    .sdg-card img {
      image-rendering: -webkit-optimize-contrast;
      image-rendering: crisp-edges;
    }
  </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
  <!-- Card Blog -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Header Section -->
    <div class="text-center mb-12">
      <p class="text-lg text-gray-600 dark:text-gray-400 mb-4">Hi, {{ Auth::user()->name }}!</p>
      <blockquote class="text-center text-4xl font-bold text-gray-900 dark:text-white">
        Here are the list of <br>
        <span class="relative inline-block mt-2">
          <span class="relative z-10 bg-gradient-to-r from-emerald-500 to-green-600 text-white px-4 py-2 rounded-lg shadow-lg">
            Sustainable Development Goals
          </span>
          <span class="absolute -inset-1 bg-emerald-500/20 blur-lg rounded-lg"></span>
        </span>
        <br>
        <span class="text-xl font-normal text-gray-600 dark:text-gray-400 mt-4 block">
          that we are working on.
        </span>
      </blockquote>
    </div>
    <!-- End Header -->

    <!-- Action Bar -->
    <div class="flex justify-between items-center mb-8">
      <div class="flex-1"></div>
      <a href="{{ route('sdgs.create') }}" 
         class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg hover:shadow-blue-500/25">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add New SDG
      </a>
    </div>
    
    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($sdgs as $sdg)
        <!-- Card -->
        <div class="group relative flex flex-col w-full min-h-80 bg-center bg-cover rounded-2xl hover:shadow-2xl transition-all duration-500 ease-in-out overflow-hidden border border-gray-200 dark:border-gray-700 sdg-card"
          style="background-image: url('{{ asset('storage/sdg-covers/' . $sdg->cover_photo) }}');">
          
          <!-- Gradient Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity duration-500"></div>
          
          <!-- Content Container -->
          <div class="flex flex-col justify-between h-full p-6 relative z-10">
            <!-- Top Content -->
            <div class="flex-1">
              <h3 class="text-2xl font-bold text-white mb-2 transform group-hover:translate-y-0 transition-transform duration-500">
                {{ $sdg->name }}
              </h3>
              @if($sdg->description)
                <p class="text-white/80 text-sm line-clamp-3 group-hover:line-clamp-none transition-all duration-300">
                  {{ $sdg->description }}
                </p>
              @endif
            </div>

            <!-- Bottom Actions -->
            <div class="flex items-center justify-between pt-4 mt-4 border-t border-white/20">
              <!-- Visit Link -->
              <a href="{{ route('sdgs.change', $sdg->id) }}" 
                 class="inline-flex items-center gap-2 text-white hover:text-emerald-300 font-medium transition-all duration-300 group/link">
                <span>Explore Goals</span>
                <svg class="shrink-0 size-4 transition-transform duration-300 group-hover/link:translate-x-1" 
                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m9 18 6-6-6-6"/>
                </svg>
              </a>

              <!-- Action Buttons -->
              <div class="flex items-center gap-3">
                <!-- Edit Button -->
                <a href="{{ route('sdgs.edit', $sdg->slug) }}" 
                   class="p-2 bg-white/10 hover:bg-white/20 rounded-lg transition-all duration-300 transform hover:scale-110"
                   data-tooltip-target="edit-tooltip-{{ $sdg->slug }}" 
                   data-tooltip-placement="top">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 text-white">
                    <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                    <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                  </svg>
                </a>
                <div id="edit-tooltip-{{ $sdg->slug }}" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                  Edit SDG
                  <div class="tooltip-arrow" data-popper-arrow></div>
                </div>

                <!-- Delete Button -->
                <form action="{{ route('sdgs.delete', $sdg->slug) }}" method="post" 
                      onsubmit="return confirm('Are you sure you want to delete {{ $sdg->name }}?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="p-2 bg-white/10 hover:bg-red-500/20 rounded-lg transition-all duration-300 transform hover:scale-110"
                          data-tooltip-target="delete-tooltip-{{ $sdg->slug }}" 
                          data-tooltip-placement="top">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 text-white">
                      <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52l.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                    </svg>
                  </button>
                  <div id="delete-tooltip-{{ $sdg->slug }}" role="tooltip" 
                       class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Delete SDG
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Hover Effect Border -->
          <div class="absolute inset-0 border-2 border-transparent group-hover:border-white/30 rounded-2xl transition-all duration-500 pointer-events-none"></div>
        </div>
        <!-- End Card -->
      @endforeach
    </div>
    <!-- End Grid -->

    <!-- Empty State -->
    @if($sdgs->isEmpty())
      <div class="text-center py-16">
        <div class="max-w-md mx-auto">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-gray-400 dark:text-gray-600 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
          </svg>
          <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">No SDGs Yet</h3>
          <p class="text-gray-600 dark:text-gray-400 mb-8">Get started by creating your first Sustainable Development Goal.</p>
          <a href="{{ route('sdgs.create') }}" 
             class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 text-white font-semibold px-8 py-3 rounded-xl transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create First SDG
          </a>
        </div>
      </div>
    @endif
  </div>
  <!-- End Card Blog -->

  <!-- Flowbite JS at the bottom of body -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>