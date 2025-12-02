<x-layout class="bg-gray-900/50 min-h-screen backdrop-blur-sm">
  <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-gray-800/70 backdrop-blur-lg shadow-xl rounded-xl p-8 border border-gray-700/30">
      <h2 class="text-2xl font-bold text-white mb-6">Late Resubmission Form</h2>

      <form method="POST" action="{{ route('submissions.late-submission', $task->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Subject Field -->
        <div>
          <label class="block text-sm font-medium text-gray-300 mb-2">Subject *</label>
          <input 
            type="text" 
            name="subject" 
            required
            placeholder="What is this submission about?"
            class="w-full px-4 py-2.5 bg-gray-700/50 border border-gray-600/50 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400"
          >
        </div>

        <!-- Date Field -->
        <div>
          <label class="block text-sm font-medium text-gray-300 mb-2">Submission Date</label>
          <input 
            type="text" 
            value="{{ now()->format('Y-m-d') }}" 
            readonly
            class="w-full px-4 py-2.5 bg-gray-700/30 border border-gray-600/30 rounded-lg text-gray-300"
          >
        </div>

        <!-- Comments Field -->
        <div>
          <label class="block text-sm font-medium text-gray-300 mb-2">Comments</label>
          <textarea 
            name="comments" 
            rows="4" 
            placeholder="Add any additional notes..."
            class="w-full px-4 py-2.5 bg-gray-700/50 border border-gray-600/50 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400"
          ></textarea>
        </div>

        <!-- File Upload -->
        <!-- Multi-File Upload with Preview -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Attach Files *</label>
            
            <!-- Upload Area -->
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:border-gray-400 dark:hover:border-gray-500 transition-all duration-300 bg-white dark:bg-gray-800/50 hover:bg-gray-50 dark:hover:bg-gray-800/70"
                id="upload-area">
                <div class="space-y-3 text-center" id="upload-placeholder">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center items-center flex-wrap gap-1">
                        <label class="relative cursor-pointer rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 transition-colors duration-200">
                            <span class="underline">Upload files</span>
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
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">DOC, DOCX, PDF, XLS, PPT, TXT, ZIP, Images up to 10MB each</p>
                </div>
            </div>

            <!-- Files Preview Container -->
            <div id="files-preview-container" class="mt-4 space-y-3 hidden">
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Selected Files
                </h4>
                <div id="files-preview-list" class="space-y-2"></div>
                
                <!-- Add More Files Button -->
                <div class="pt-2 border-t border-gray-200 dark:border-gray-600">
                    <label class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 cursor-pointer">
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
            <div id="file-error" class="hidden mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span id="error-message"></span>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
          <button 
            type="submit" 
            class="px-6 py-3 bg-blue-600/90 hover:bg-blue-500 text-white font-medium rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800/50 shadow-lg"
          >
            Submit Task
          </button>
        </div>
      </form>
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

        // File type icons mapping
        const fileIcons = {
            pdf: {
                icon: `<svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                      </svg>`,
                bg: 'bg-red-100 dark:bg-red-900/30'
            },
            doc: {
                icon: `<svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                      </svg>`,
                bg: 'bg-blue-100 dark:bg-blue-900/30'
            },
            xls: {
                icon: `<svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                      </svg>`,
                bg: 'bg-green-100 dark:bg-green-900/30'
            },
            ppt: {
                icon: `<svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                      </svg>`,
                bg: 'bg-orange-100 dark:bg-orange-900/30'
            },
            image: {
                icon: `<svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>`,
                bg: 'bg-purple-100 dark:bg-purple-900/30'
            },
            zip: {
                icon: `<svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                      </svg>`,
                bg: 'bg-yellow-100 dark:bg-yellow-900/30'
            },
            default: {
                icon: `<svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                      </svg>`,
                bg: 'bg-gray-100 dark:bg-gray-700'
            }
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
            const iconConfig = fileIcons[fileType] || fileIcons.default;
            
            const previewElement = document.createElement('div');
            previewElement.className = 'flex items-center justify-between bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 border border-gray-200 dark:border-gray-600';
            previewElement.innerHTML = `
                <div class="flex items-center space-x-3 min-w-0 flex-1">
                    <div class="${iconConfig.bg} rounded-lg w-8 h-8 flex items-center justify-center flex-shrink-0">
                        ${iconConfig.icon}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">${file.name}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">${formatFileSize(file.size)}</p>
                    </div>
                </div>
                <button type="button" class="text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors duration-200 flex-shrink-0 ml-2" data-file-index="${index}">
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
            
            // Show/hide preview container based on whether we have files
            if (selectedFiles.length > 0) {
                filesPreviewContainer.classList.remove('hidden');
            } else {
                filesPreviewContainer.classList.add('hidden');
            }
            
            // Update file count in the header
            const header = filesPreviewContainer.querySelector('h4');
            header.innerHTML = `
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Selected Files (${selectedFiles.length})
            `;
            
            // Update the hidden file input for form submission
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

        // Update the hidden file input with current selection
        function updateHiddenFileInput() {
            // Create a new DataTransfer object
            const dataTransfer = new DataTransfer();
            
            // Add all selected files to the DataTransfer
            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });
            
            // Update the hidden file input with the files
            // hiddenFileInput.files = dataTransfer.files;
            
            // Also update the main file input for fallback
            fileInput.files = dataTransfer.files;
        }

        // Event listeners
        fileInput.addEventListener('change', function(e) {
            handleFileSelection(e.target.files);
        });

        addMoreFilesInput.addEventListener('change', function(e) {
            handleFileSelection(e.target.files);
            // Clear the input to allow selecting the same files again
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
            uploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            uploadArea.classList.add('border-blue-400', 'dark:border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        }

        function unhighlight() {
            uploadArea.classList.remove('border-blue-400', 'dark:border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        }

        uploadArea.addEventListener('drop', function(e) {
            handleFileSelection(e.dataTransfer.files);
        });

        // Form submission handler
        document.querySelector('form').addEventListener('submit', function(e) {
            if (selectedFiles.length === 0) {
                e.preventDefault();
                errorMessage.textContent = 'Please select at least one file.';
                fileError.classList.remove('hidden');
                return;
            }
            
            // Ensure the hidden file input is updated before submission
            updateHiddenFileInput();
            
            // Optional: You can also use FormData here if needed
            // const formData = new FormData(this);
            // selectedFiles.forEach(file => {
            //     formData.append('files[]', file);
            // });
            
            console.log('Submitting files:', selectedFiles);
        });

        // Initialize
        updateFilesPreview();
    });
    </script>
</x-layout>