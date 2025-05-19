<x-layout class="bg-gray-900 min-h-screen text-gray-100">
<div class="max-w-4xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Edit Goal</h2>

    <form action="/goals/update/{{ $goal->slug }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Creator (disabled) -->
        <div>
            <label class="block text-sm font-medium mb-1">Created By</label>
            <input type="text" 
                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300" 
                   value="{{ $goal->projectManager->name }}" disabled>
        </div>

        <!-- SDG Name -->
        <div>
            <label class="block text-sm font-medium mb-1">SDG</label>
            <input type="text" 
                    class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300" 
                    value="{{ $goal->sdg->name }}" 
                    disabled
            >
            <input type="hidden" name="sdg_id" value="{{ $goal->sdg_id }}">
        </div>

        <!-- Goal Name -->
        <div>
            <label for="goalName" class="block text-sm font-medium mb-1">Goal Name</label>
            <input type="text" name="title" id="goalName" 
                   value="{{ old('title', $goal->title) }}"
                   class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                   required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $goal->description) }}</textarea>
        </div>

        <!-- Start and End Dates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="start_date" class="block text-sm font-medium mb-1">Start Date</label>
                <input type="date" name="start_date" id="start_date"
                       class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('start_date', $goal->start_date) }}" required>
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium mb-1">End Date</label>
                <input type="date" name="end_date" id="end_date"
                       class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('end_date', $goal->end_date) }}" required>
            </div>
        </div>

        <!-- Status and Type -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="status" class="block text-sm font-medium mb-1">Status</label>
                <select name="status" id="status"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        required>
                    <option value="pending" {{ $goal->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in-progress" {{ $goal->status == 'in-progress' ? 'selected' : '' }}>In-Progress</option>
                    <option value="completed" {{ $goal->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div>
                <label for="type" class="block text-sm font-medium mb-1">Type</label>
                <select name="type" id="type"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        required>
                    <option value="short" {{ $goal->type == 'short' ? 'selected' : '' }}>Short Term</option>
                    <option value="long" {{ $goal->type == 'long' ? 'selected' : '' }}>Long Term</option>
                </select>
            </div>
        </div>

        <!-- Assigned Staffs -->
        @if ($staffUsers->isEmpty())
          <div class="bg-gray-800 p-4 rounded-md text-sm text-gray-400">
              No staff available to assign.
          </div>
        @else
          <div>
            <label class="block text-sm font-medium mb-1">Assign to Staff</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @foreach ($staffUsers as $person)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="assigned_users[]" value="{{ $person->id }}" 
                               class="form-checkbox text-blue-500"
                               {{ in_array($person->id, $goal->assignedUsers->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <span>{{ $person->name }}</span>
                    </label>
                @endforeach
            </div>
          </div>
        @endif

        <!-- Submit -->
        <button type="submit" 
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-md font-medium transition-colors duration-200">
            Update Goal
        </button>
    </form>
  </div>
</x-layout>