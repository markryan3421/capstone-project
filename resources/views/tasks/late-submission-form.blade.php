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
        <div>
          <label class="block text-sm font-medium text-gray-300 mb-2">Attach File *</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-600/30 border-dashed rounded-lg hover:border-gray-500/50 transition-colors">
            <div class="space-y-1 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-400 justify-center">
                <label class="relative cursor-pointer rounded-md font-medium text-blue-400 hover:text-blue-300 focus-within:outline-none">
                  <span>Upload a file</span>
                  <input 
                    type="file" 
                    name="files[]" 
                    required
                    accept=".doc,.docx,.pdf,.xls,.xlsx,.ppt,.pptx"
                    class="sr-only"
                  >
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-500">DOC, DOCX, PDF, XLS, PPT up to 10MB</p>
            </div>
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
</x-layout>