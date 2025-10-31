<x-layout>
  <div class="max-w-2xl mx-auto py-8 px-4">
    <!-- Header Section -->
    <div class="mb-8">
      <div class="flex items-center mb-4">
        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-xl mr-4">
          <svg class="h-8 w-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
          </svg>
        </div>
        <div>
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Reject Submission</h1>
          <p class="text-gray-600 dark:text-gray-400 mt-1">Provide feedback for improvement</p>
        </div>
      </div>
      
      <!-- Submission Info -->
      <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="font-medium text-gray-900 dark:text-white">Submission Details</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
              Submission #{{ $submission->id }} • {{ $submission->created_at->format('M j, Y') }}
            </p>
          </div>
          <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 text-sm font-medium rounded-full">
            Pending Review
          </span>
        </div>
      </div>
    </div>

    <!-- Rejection Form -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
      <form method="POST" action="{{ route('submissions.reject', $submission->id) }}" class="space-y-6">
        @csrf
        
        <!-- Remarks Field -->
        <div>
          <label for="remarks" class="block text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
            <svg class="h-6 w-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            Rejection Remarks
          </label>
          <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
            Please provide specific feedback on why this submission is being rejected and what improvements are needed.
          </p>
          <textarea 
            name="remarks" 
            id="remarks" 
            rows="6" 
            required
            placeholder="Be constructive and specific about what needs to be improved. This feedback will help the submitter understand how to meet the requirements..."
            class="placeholder:text-gray-500 placeholder:italic w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 resize-none shadow-sm"
          ></textarea>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">* Required field</p>
        </div>

        <!-- Warning Alert -->
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
          <div class="flex">
            <svg class="h-5 w-5 text-red-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            <div class="flex-1">
              <h4 class="text-sm font-medium text-red-800 dark:text-red-300">Important</h4>
              <p class="text-sm text-red-700 dark:text-red-400 mt-1">
                Rejecting this submission will notify the submitter and require them to make changes and resubmit.
              </p>
            </div>
          </div>
        </div>

        <!-- Form Actions -->
        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
          <a 
            href="{{ url()->previous() }}" 
            class="px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-xl text-gray-700 dark:text-gray-300 transition-all duration-200 font-medium flex items-center justify-center order-2 sm:order-1"
          >
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Cancel
          </a>
          <button 
            type="submit" 
            class="px-6 py-3 bg-red-600 hover:bg-red-700 rounded-xl text-white transition-all duration-200 font-medium flex items-center justify-center shadow-lg hover:shadow-red-500/25 order-1 sm:order-2"
          >
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Reject Submission
          </button>
        </div>
      </form>
    </div>

    <!-- Help Section -->
    <div class="mt-8 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800 p-5">
      <div class="flex items-start">
        <div class="flex-shrink-0 mt-1">
          <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-blue-800 dark:text-blue-300">Writing effective rejection feedback</h3>
          <div class="mt-2 text-sm text-blue-700 dark:text-blue-400 space-y-1">
            <p>• Be specific about what needs improvement</p>
            <p>• Provide actionable suggestions</p>
            <p>• Maintain a professional and constructive tone</p>
            <p>• Reference specific requirements or criteria</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>