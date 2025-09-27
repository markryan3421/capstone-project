<x-layout>
    <div class="container mx-auto px-4 py-8 bg-white dark:bg-gray-900 rounded-lg shadow-md">
        <div>
            <a href="/" class="underline-offset-4 hover:underline inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M7.793 2.232a.75.75 0 0 1-.025 1.06L3.622 7.25h10.003a5.375 5.375 0 0 1 0 10.75H10.75a.75.75 0 0 1 0-1.5h2.875a3.875 3.875 0 0 0 0-7.75H3.622l4.146 3.957a.75.75 0 0 1-1.036 1.085l-5.5-5.25a.75.75 0 0 1 0-1.085l5.5-5.25a.75.75 0 0 1 1.06.025Z" clip-rule="evenodd" />
                </svg>
                &nbsp;Back 
            </a>
        </div>

        <h4 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">Resubmit Task</h4>

        <form method="POST" action="{{ route('submissions.resubmit', $productivity->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label block text-gray-700 dark:text-gray-300 mb-2">Notes</label>
                <textarea 
                    name="subject" 
                    class="form-control w-full p-3 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                    rows="5"
                >{{ $productivity->subject }}</textarea>
            </div>

            <div>
                <label class="form-label block text-gray-700 dark:text-gray-300 mb-2">Upload New File (optional)</label>
                <input 
                    type="file" 
                    name="file_path" 
                    class="form-control w-full p-2.5 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <button 
                type="submit" 
                class="btn bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-300"
            >
                Submit Again
            </button>
        </form>
    </div>
</x-layout>
