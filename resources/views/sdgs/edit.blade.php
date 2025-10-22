<x-sdg>
  <!-- Edit Section -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-16 mx-auto">
    <!-- Header with Back Navigation -->
    <div class="mb-8">
      <a href="{{ route('sdgs.index') }}" 
         class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors duration-200 mb-6 group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-200 group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="font-medium">Back to SDGs</span>
      </a>
      
      <div class="flex items-center gap-3 mb-2">
        <div class="p-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6 text-emerald-600 dark:text-emerald-400">
            <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit SDG</h1>
      </div>
      <p class="text-lg text-gray-600 dark:text-gray-400 ml-11">
        Update the details for <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $sdg->name }}</span>
      </p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12 items-start">
      <!-- Left Column - Preview Card -->
      <div class="space-y-6">
        <div class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Preview</h3>
          
          <!-- Preview Card -->
          <div class="group relative flex flex-col w-full min-h-80 bg-center bg-cover rounded-xl overflow-hidden border border-gray-300 dark:border-gray-600 shadow-md"
               style="background-image: url('{{ asset('storage/sdg-covers/' . $sdg->cover_photo) }}');" 
               id="preview-card">
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-90"></div>
            
            <!-- Content Container -->
            <div class="flex flex-col justify-end h-full p-6 relative z-10">
              <h3 class="text-2xl font-bold text-white mb-2" id="preview-name">
                {{ old('name', $sdg->name) }}
              </h3>
              <p class="text-white/80 text-sm">
                Sustainable Development Goal
              </p>
            </div>
          </div>
          
          <!-- Preview Tips -->
          <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
            <div class="flex items-start gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <div class="text-sm text-blue-800 dark:text-blue-200">
                <p class="font-medium">Preview updates in real-time</p>
                <p class="mt-1">Changes to the name and cover photo will be reflected here instantly.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column - Form -->
      <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-8">
        <form class="w-full" method="POST" action="{{ route('sdgs.update', $sdg->slug) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          
          <div class="space-y-6">
            <!-- Cover Photo Upload -->
            <div>
              <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-4">Cover Photo</label>
              <div class="flex flex-col sm:flex-row gap-6 items-start">
                <!-- Current Avatar -->
                <div class="text-center">
                  <div class="relative inline-block">
                    <img 
                      class="size-32 rounded-xl ring-4 ring-white dark:ring-gray-800 shadow-lg object-cover transition-all duration-300 hover:scale-105" 
                      src="{{ asset('storage/sdg-covers/' . $sdg->cover_photo) }}" 
                      alt="Current cover preview" 
                      id="avatar-preview"
                    >
                    <div class="mt-2 ml-2 absolute -bottom-2 -right-2 bg-emerald-500 text-white p-1.5 rounded-full shadow-lg">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                      </svg>
                    </div>
                  </div>
                  <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Current</p>
                </div>

                <!-- Upload Area -->
                <div class="flex-1">
                  <div class="file-upload-area border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center transition-all duration-300 hover:border-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 group">
                    <input type="file" name="cover_photo" id="avatar" class="hidden" accept="image/*">
                    <div class="cursor-pointer" onclick="document.getElementById('avatar').click()">
                      <div class="mx-auto w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                      </div>
                      <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                          Click to upload new cover
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                          PNG, JPG or WEBP (Max 5MB)
                        </p>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Selected file name -->
                  <div id="file-name" class="mt-3 text-sm text-gray-600 dark:text-gray-400 hidden">
                    <span class="font-medium">Selected:</span> 
                    <span id="selected-file-name"></span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Name Input -->
           <div class="space-y-4">
  <!-- Label with better spacing and typography -->
  <div class="mb-4">
    <label for="name" class="block text-lg font-bold text-gray-900 dark:text-white mb-2">
      SDG Name
      <span class="text-red-500 ml-1">*</span>
    </label>
    <p class="text-sm text-gray-600 dark:text-gray-400">
      Enter the official name of this Sustainable Development Goal
    </p>
  </div>

  <!-- Input Container -->
  <div class="relative group">
  <!-- Input Field -->
  <input type="text" id="name" name="name" value="{{ old('name', $sdg->name) }}" required
    class="pr-12 py-4 px-4 block w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl text-base focus:border-emerald-500 focus:ring-4 focus:ring-emerald-200 dark:focus:ring-emerald-800/50 transition-all duration-300 bg-white dark:bg-gray-700 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 font-medium shadow-sm hover:border-gray-400 dark:hover:border-gray-500"
    placeholder="e.g., No Poverty, Quality Education, Climate Action..."
    oninput="updatePreview()">
  
  <!-- Icon moved to right side -->
  <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1 size-5 text-emerald-600 dark:text-emerald-400 transition-all duration-200 group-focus-within:text-emerald-700 dark:group-focus-within:text-emerald-300 group-focus-within:scale-110">
      <path fill-rule="evenodd" d="M10 2c-1.716 0-3.408.106-5.07.31C3.806 2.45 3 3.414 3 4.517V17.25a.75.75 0 0 0 1.075.676L10 15.082l5.925 2.844A.75.75 0 0 0 17 17.25V4.517c0-1.103-.806-2.068-1.93-2.207A41.403 41.403 0 0 0 10 2Z" clip-rule="evenodd" />
    </svg>
  </div>
  
  <!-- Focus Border Effect -->
  <div class="absolute inset-0 rounded-xl border-2 border-transparent group-focus-within:border-emerald-300 dark:group-focus-within:border-emerald-600 pointer-events-none transition-all duration-300"></div>
</div>

  <!-- Error Message with Better Styling -->
  @error('name')
    <div class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-start gap-3 transition-all duration-300">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 dark:text-red-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <div>
        <p class="text-sm font-medium text-red-800 dark:text-red-200">{{ $message }}</p>
      </div>
    </div>
  @enderror

  <!-- Character Count (Optional) -->
  <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400 mt-2">
    <span>Enter the complete SDG name</span>
    <span id="char-count" class="font-mono">{{ strlen(old('name', $sdg->name)) }}/120</span>
  </div>
</div>


            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4">
              <button type="submit" 
                class="flex-1 inline-flex justify-center items-center gap-x-3 py-3 px-4 text-sm font-semibold rounded-xl border border-transparent bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white shadow-lg hover:shadow-emerald-500/25 transition-all duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                  <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                </svg>
                Save Changes
              </button>
              
              <a href="{{ route('sdgs.index') }}" 
                 class="inline-flex justify-center items-center gap-x-2 py-3 px-4 text-sm font-medium rounded-xl border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200">
                Cancel
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Update preview when name changes
    function updatePreview() {
      const nameInput = document.getElementById('name');
      const previewName = document.getElementById('preview-name');
      previewName.textContent = nameInput.value || '{{ $sdg->name }}';
    }

    // Handle file upload preview
    document.getElementById('avatar').addEventListener('change', function(e) {
      const file = e.target.files[0];
      const fileNameDisplay = document.getElementById('file-name');
      const selectedFileName = document.getElementById('selected-file-name');
      
      if (file) {
        // Show selected file name
        selectedFileName.textContent = file.name;
        fileNameDisplay.classList.remove('hidden');
        
        // Preview image
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('avatar-preview').src = e.target.result;
          document.getElementById('preview-card').style.backgroundImage = `url(${e.target.result})`;
        }
        reader.readAsDataURL(file);
      } else {
        fileNameDisplay.classList.add('hidden');
      }
    });

    // Add some interactive feedback
    document.addEventListener('DOMContentLoaded', function() {
      const inputs = document.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.classList.add('ring-2', 'ring-emerald-200', 'dark:ring-emerald-800', 'rounded-xl');
        });
        
        input.addEventListener('blur', function() {
          this.parentElement.classList.remove('ring-2', 'ring-emerald-200', 'dark:ring-emerald-800', 'rounded-xl');
        });
      });
    });
  </script>
</x-sdg>