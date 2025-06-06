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
</head>
<body>
  <!-- Card Blog -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Title -->
    <blockquote class="text-center text-4xl font-semibold text-gray-900 italic dark:text-white">
      Here are the list of <br>
      <span class="relative inline-block before:absolute before:-inset-1 before:block before:-skew-y-3 before:bg-emerald-500">
        <span class="relative text-white dark:text-gray-950">SDGs</span>
      </span>
      <br>
      that we are working on.
    </blockquote>
    <br><br>
    <!-- End Title -->

    <div class="flex mb-4">
      <a href="{{ route('sdgs.create') }}" class="font-medium bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
        + Add new SDG
      </a>
    </div>
    
    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($sdgs as $sdg)
        <!-- Card -->
        <div class="group relative flex flex-col w-full min-h-60 bg-center bg-cover rounded-xl hover:shadow-lg transition-all duration-300 ease-in-out overflow-hidden"
          style="background-image: url('{{ asset('storage/sdg-covers/' . $sdg->cover_photo) }}');">
          <!-- Dark overlay that appears on hover -->
          <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-all duration-300"></div>
          
          <div class="flex-auto p-4 md:p-6 relative z-10">
            <h3 class="text-xl text-white/90 group-hover:text-white transition-colors duration-300">
              <span class="font-bold">{{ $sdg->name }}</span>
            </h3>
          </div>
          <div class="pt-0 p-4 md:p-6 relative z-10 flex items-center justify-between">
            <a 
            href="{{ route('sdgs.change', $sdg->id) }}" 
            class="inline-flex items-center gap-2 text-sm font-medium text-white group-hover:text-white/70 transition-colors duration-300">
              Visit the site
              <svg class="shrink-0 size-4 transition-transform duration-300 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </a>

            <!-- Action buttons container -->
            <div class="flex items-center gap-3">
              <!-- Edit Button with Tooltip -->
              <a href="{{ route('sdgs.edit', $sdg->slug) }}" 
                class="text-white hover:text-green-500 transition-colors duration-200"
                data-tooltip-target="edit-tooltip-{{ $sdg->slug }}" 
                data-tooltip-placement="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                  <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                  <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                </svg>
              </a>
              <div id="edit-tooltip-{{ $sdg->slug }}" role="tooltip"
                  class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Edit
                <div class="tooltip-arrow" data-popper-arrow></div>
              </div>


              <!-- Delete Button with Tooltip -->
              <form action="{{ route('sdgs.delete', $sdg->slug) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this SDG?');">
                @csrf
                @method('DELETE')
                <div class="relative">
                  <button 
                    data-tooltip-target="delete-tooltip-{{ $sdg->slug }}" 
                    data-tooltip-placement="bottom" 
                    type="submit" 
                    class="text-white hover:text-red-500 transition-colors duration-200"
                  >
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                  </svg>

                  </button>
                  <div id="delete-tooltip-{{ $sdg->slug }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Delete
                    <div class="tooltip-arrow" data-popper-arrow></div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End Card -->
      @endforeach
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Card Blog -->

  <!-- Flowbite JS at the bottom of body -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>