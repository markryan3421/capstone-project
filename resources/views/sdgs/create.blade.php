<x-sdg>
  <!-- Subscribe Section -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-16 mx-auto">
    <div class="grid md:grid-cols-2 gap-8 items-center">
      <!-- Left Column - Content -->
      <div class="max-w-md">
        <h2 class="text-3xl font-bold md:text-4xl md:leading-tight dark:text-white">Add New SDG</h2>
        <p class="mt-3 text-lg text-gray-600 dark:text-gray-400">
        Use the form below to create a new Sustainable Development Goal (SDG). You can upload an image for the SDG and provide its name. Once created, you can manage it in the SDGs section.
        </p>
      </div>

      <!-- Right Column - Form -->
      <form class="w-full" method="POST" action="{{ route('sdgs.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="w-full sm:max-w-lg md:ms-auto space-y-4">
          <!-- Avatar Upload -->
          <div class="flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <img class="size-32 rounded-full ring-2 ring-white dark:ring-gray-900 object-cover" src="https://preline.co/assets/img/160x160/img1.jpg" alt="Avatar preview" id="avatar-preview">
            <div class="flex-1">
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">SDG Cover</label>
              <div class="file-input-container">
                <button type="button" class="file-input-button">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                  </svg>
                  Upload Photo
                </button>
                <input type="file" name="cover_photo" id="avatar" class="file-input" accept="image/*">
              </div>
              <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG or JPG, max 5MB</p>
            </div>
          </div>

          <!-- Name Input -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">SDG Name:</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="green" class="size-5">
                  <path fill-rule="evenodd" d="M10 2c-1.716 0-3.408.106-5.07.31C3.806 2.45 3 3.414 3 4.517V17.25a.75.75 0 0 0 1.075.676L10 15.082l5.925 2.844A.75.75 0 0 0 17 17.25V4.517c0-1.103-.806-2.068-1.93-2.207A41.403 41.403 0 0 0 10 2Z" clip-rule="evenodd" />
                </svg>
              </div>
              <input type="text" id="name" name="name" required
                class="pl-10 py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                placeholder="Your SDG name...">
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" 
            class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all dark:focus:ring-offset-gray-800">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
              </svg>
            Add
          </button>
        </div>
      </form>
    </div>
  </div>
</x-sdg>