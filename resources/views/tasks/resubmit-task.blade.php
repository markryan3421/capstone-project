<x-layout>
    <div class="container mx-auto px-4 py-8 bg-white dark:bg-gray-900 rounded-lg shadow-md">
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
