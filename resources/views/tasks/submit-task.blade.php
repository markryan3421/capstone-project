<x-layout class="bg-gray-900 min-h-screen text-gray-100">
  <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Card with gradient border effect -->
    <div class="relative bg-gray-800/90 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden">
      <!-- Subtle gradient border -->
      <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-purple-500/10"></div>
      
      <div class="relative p-8">
        <!-- Header -->
        <div class="mb-8">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-white flex items-center gap-2">
              <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Submit Task
            </h2>
            <div class="px-3 py-1 bg-gray-700/50 rounded-full text-sm font-medium text-blue-300 border border-blue-500/30">
              {{ $task->title }}
            </div>
          </div>
          <p class="text-gray-400">Complete the form below to submit your task files</p>
        </div>

        <form method="POST" action="{{ route('tasks.submit', $task->slug) }}" enctype="multipart/form-data" class="space-y-8">
          @csrf
          
          <!-- Subject Field -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-300">Subject *</label>
            <input 
              type="text" 
              name="subject" 
              required
              placeholder="What is this submission about?"
              class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600/50 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400 transition-all duration-200"
            >
          </div>

          <!-- Date Field -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-300">Submission Date</label>
            <div class="flex items-center gap-2 text-gray-300">
              <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <span>{{ now()->format('F j, Y') }}</span>
            </div>
            <input 
              type="hidden" 
              value="{{ now()->format('Y-m-d') }}" 
            >
          </div>

          <!-- Comments Field -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-300">Comments</label>
            <textarea 
              name="comments" 
              rows="4" 
              placeholder="Add any additional notes or comments..."
              class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600/50 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400 transition-all duration-200 resize-none"
            ></textarea>
          </div>

          <!-- File Upload Section -->
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-300">Attach Files *</label>
            
            <!-- Upload Area -->
            <div class="mt-2 border-2 border-dashed border-gray-600/50 rounded-xl bg-gray-700/30 hover:border-blue-500/50 hover:bg-gray-700/50 transition-all duration-300 cursor-pointer group"
                id="upload-area">
              <div class="p-6 text-center" id="upload-placeholder">
                <div class="mx-auto w-12 h-12 rounded-full bg-gray-600/50 flex items-center justify-center mb-3 group-hover:bg-blue-500/20 transition-colors duration-300">
                  <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-400 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                  </svg>
                </div>
                <div class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors duration-300">
                  <label class="relative cursor-pointer font-medium text-blue-400 hover:text-blue-300 transition-colors duration-200">
                    <span class="underline">Click to upload</span>
                    <input 
                      type="file" 
                      name="files[]" 
                      id="file-input"
                      multiple
                      required
                      accept=".doc,.docx,.pdf,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar,.jpg,.jpeg,.png,.gif"
                      class="sr-only"
                    >
                  </label>
                  <span class="mx-2">or drag and drop</span>
                </div>
                <p class="mt-2 text-xs text-gray-500">DOC, DOCX, PDF, XLS, PPT, TXT, ZIP, Images up to 10MB each</p>
              </div>
            </div>

            <!-- Files Preview Container -->
            <div id="files-preview-container" class="mt-4 space-y-3 hidden">
              <h4 class="text-sm font-semibold text-gray-300 flex items-center">
                <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Selected Files
              </h4>
              <div id="files-preview-list" class="space-y-2 max-h-64 overflow-y-auto pr-2"></div>
              
              <!-- Add More Files Button -->
              <div class="pt-3 border-t border-gray-600/50">
                <label class="inline-flex items-center px-4 py-2 border border-gray-600 text-sm font-medium rounded-lg text-gray-300 bg-gray-700/50 hover:bg-gray-700 hover:border-gray-500 transition-all duration-200 cursor-pointer hover:scale-105">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  Add More Files
                  <input 
                    type="file" 
                    id="add-more-files"
                    class="sr-only"
                    multiple
                    accept=".doc,.docx,.pdf,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar,.jpg,.jpeg,.png,.gif"
                  >
                </label>
              </div>
            </div>
            
            <!-- Hidden file input for form submission -->
            <input type="file" name="files[]" id="hidden-file-input" multiple class="hidden">
            
            <!-- Error Message -->
            <div id="file-error" class="hidden mt-2 p-3 bg-red-500/10 border border-red-500/30 rounded-lg">
              <div class="flex items-center text-red-400 text-sm">
                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span id="error-message"></span>
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="pt-4">
            <button type="submit" class="w-full group relative py-3 px-6 rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg hover:shadow-blue-500/25">
              <span class="relative z-10 flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Submit Task
              </span>
              <div class="absolute inset-0 rounded-lg bg-gradient-to-r from-blue-500/50 to-purple-500/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const fileInput = document.getElementById('file-input');
      const addMoreFilesInput = document.getElementById('add-more-files');
      const hiddenFileInput = document.getElementById('hidden-file-input');
      const uploadArea = document.getElementById('upload-area');
      const uploadPlaceholder = document.getElementById('upload-placeholder');
      const filesPreviewContainer = document.getElementById('files-preview-container');
      const filesPreviewList = document.getElementById('files-preview-list');
      const fileError = document.getElementById('file-error');
      const errorMessage = document.getElementById('error-message');

      let selectedFiles = [];

      // File type icons and colors
      const fileConfigs = {
        pdf: { color: 'text-red-400', bg: 'bg-red-500/20' },
        doc: { color: 'text-blue-400', bg: 'bg-blue-500/20' },
        xls: { color: 'text-green-400', bg: 'bg-green-500/20' },
        ppt: { color: 'text-orange-400', bg: 'bg-orange-500/20' },
        image: { color: 'text-purple-400', bg: 'bg-purple-500/20' },
        zip: { color: 'text-yellow-400', bg: 'bg-yellow-500/20' },
        default: { color: 'text-gray-400', bg: 'bg-gray-500/20' }
      };

      // Format file size
      function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
      }

      // Get file type
      function getFileType(filename) {
        const ext = filename.split('.').pop().toLowerCase();
        if (['pdf'].includes(ext)) return 'pdf';
        if (['doc', 'docx'].includes(ext)) return 'doc';
        if (['xls', 'xlsx'].includes(ext)) return 'xls';
        if (['ppt', 'pptx'].includes(ext)) return 'ppt';
        if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'].includes(ext)) return 'image';
        if (['zip', 'rar', '7z', 'tar', 'gz'].includes(ext)) return 'zip';
        return 'default';
      }

      // Validate file
      function validateFile(file) {
        const validTypes = ['doc', 'docx', 'pdf', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'zip', 'rar', 'jpg', 'jpeg', 'png', 'gif'];
        const maxSize = 10 * 1024 * 1024; // 10MB
        const fileExt = file.name.split('.').pop().toLowerCase();
        
        if (!validTypes.includes(fileExt)) {
          errorMessage.textContent = `Invalid file type: ${file.name}. Please upload DOC, DOCX, PDF, XLS, PPT, TXT, ZIP, or Image files.`;
          fileError.classList.remove('hidden');
          return false;
        }
        
        if (file.size > maxSize) {
          errorMessage.textContent = `File too large: ${file.name}. Maximum size is 10MB.`;
          fileError.classList.remove('hidden');
          return false;
        }
        
        fileError.classList.add('hidden');
        return true;
      }

      // Create file preview element
      function createFilePreview(file, index) {
        const fileType = getFileType(file.name);
        const config = fileConfigs[fileType] || fileConfigs.default;
        
        const previewElement = document.createElement('div');
        previewElement.className = 'flex items-center justify-between bg-gray-700/30 rounded-lg p-3 border border-gray-600/50 hover:border-gray-500/50 transition-colors duration-200 group';
        previewElement.innerHTML = `
          <div class="flex items-center gap-3 min-w-0 flex-1">
            <div class="${config.bg} rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 ${config.color}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            </div>
            <div class="min-w-0 flex-1">
              <p class="text-sm font-medium text-white truncate">${file.name}</p>
              <p class="text-xs text-gray-400">${formatFileSize(file.size)}</p>
            </div>
          </div>
          <button type="button" class="text-gray-400 hover:text-red-400 transition-colors duration-200 flex-shrink-0 ml-2 opacity-0 group-hover:opacity-100" data-file-index="${index}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        `;
        
        return previewElement;
      }

      // Update files preview
      function updateFilesPreview() {
        filesPreviewList.innerHTML = '';
        
        selectedFiles.forEach((file, index) => {
          if (validateFile(file)) {
            const previewElement = createFilePreview(file, index);
            filesPreviewList.appendChild(previewElement);
          }
        });
        
        // Show/hide preview container
        if (selectedFiles.length > 0) {
          filesPreviewContainer.classList.remove('hidden');
          uploadArea.classList.add('hidden');
        } else {
          filesPreviewContainer.classList.add('hidden');
          uploadArea.classList.remove('hidden');
        }
        
        // Update file count in header
        const header = filesPreviewContainer.querySelector('h4');
        header.innerHTML = `
          <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Selected Files (${selectedFiles.length})
        `;
        
        updateHiddenFileInput();
      }

      // Handle file selection
      function handleFileSelection(files) {
        let hasInvalidFiles = false;
        
        Array.from(files).forEach(file => {
          if (validateFile(file)) {
            selectedFiles.push(file);
          } else {
            hasInvalidFiles = true;
          }
        });
        
        if (!hasInvalidFiles) {
          fileError.classList.add('hidden');
        }
        
        updateFilesPreview();
      }

      // Remove file from selection
      function removeFile(index) {
        selectedFiles.splice(index, 1);
        updateFilesPreview();
      }

      // Update hidden file input
      function updateHiddenFileInput() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => {
          dataTransfer.items.add(file);
        });
        fileInput.files = dataTransfer.files;
      }

      // Event listeners
      fileInput.addEventListener('change', function(e) {
        handleFileSelection(e.target.files);
      });

      addMoreFilesInput.addEventListener('change', function(e) {
        handleFileSelection(e.target.files);
        e.target.value = '';
      });

      // Event delegation for remove buttons
      filesPreviewList.addEventListener('click', function(e) {
        if (e.target.closest('button[data-file-index]')) {
          const index = parseInt(e.target.closest('button').getAttribute('data-file-index'));
          removeFile(index);
        }
      });

      // Drag and drop functionality
      ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
      });

      function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
      }

      ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
          uploadArea.classList.add('border-blue-500', 'bg-blue-500/10');
        }, false);
      });

      ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
          uploadArea.classList.remove('border-blue-500', 'bg-blue-500/10');
        }, false);
      });

      uploadArea.addEventListener('drop', function(e) {
        handleFileSelection(e.dataTransfer.files);
      });

      // Form submission handler
      document.querySelector('form').addEventListener('submit', function(e) {
        if (selectedFiles.length === 0) {
          e.preventDefault();
          errorMessage.textContent = 'Please select at least one file.';
          fileError.classList.remove('hidden');
          fileError.scrollIntoView({ behavior: 'smooth', block: 'center' });
          return;
        }
        
        updateHiddenFileInput();
        console.log('Submitting files:', selectedFiles);
      });

      // Initialize
      updateFilesPreview();
    });
  </script>
</x-layout>