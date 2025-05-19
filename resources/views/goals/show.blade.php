<x-layout class="bg-gray-900 min-h-screen text-gray-100">
  <div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="flex justify-between items-start mb-8">
      <div>
        <h1 class="text-3xl font-bold text-white mb-2">{{ $goal->title }}</h1>
        <div class="flex items-center space-x-4">
          @php
            $statusColors = [
              'pending' => 'bg-yellow-500',
              'in-progress' => 'bg-blue-500',
              'completed' => 'bg-green-500'
            ];
          @endphp
          <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$goal->status] ?? 'bg-gray-600' }}">
            {{ ucfirst($goal->status) }}
          </span>
          <span class="px-3 py-1 rounded-full text-xs font-medium bg-purple-500">
            {{ ucfirst($goal->type) }} Term
          </span>
        </div>
      </div>
      <a href="/" class="flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Back to List
      </a>
    </div>

    <!-- Main Content -->
    <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
      <h2 class="text-xl font-semibold text-white mb-4">Description</h2>
      <p class="text-gray-300 whitespace-pre-line">{{ $goal->description }}</p>
    </div>

    <!-- Details Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
      <!-- SDG Card -->
      <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-white mb-4">SDG</h2>
        <div class="flex items-center">
          <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold mr-4">
            {{ $goal->sdg->id ?? '?' }}
          </div>
          <span class="text-gray-300">{{ $goal->sdg->name ?? 'Not assigned' }}</span>
        </div>
      </div>

      <!-- Project Manager Card -->
      <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-white mb-4">Project Manager</h2>
        <div class="flex items-center">
          <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center text-white font-bold mr-4">
            {{ substr($goal->projectManager->name ?? 'N/A', 0, 1) }}
          </div>
          <span class="text-gray-300">{{ $goal->projectManager->name ?? 'Not assigned' }}</span>
        </div>
      </div>

      <!-- Timeline Card -->
      <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-white mb-4">Timeline</h2>
        <div class="space-y-3">
          <div>
            <p class="text-sm text-gray-400">Start Date</p>
            <p class="text-gray-300">{{ \Carbon\Carbon::parse($goal->start_date)->format('M d, Y') }}</p>
          </div>
          <div>
            <p class="text-sm text-gray-400">End Date</p>
            <p class="text-gray-300">{{ \Carbon\Carbon::parse($goal->end_date)->format('M d, Y') }}</p>
          </div>
          <div>
            <p class="text-sm text-gray-400">Duration</p>
            <p class="text-gray-300">
              {{ \Carbon\Carbon::parse($goal->start_date)->diffInDays($goal->end_date) }} days
              @if($goal->end_date < now())
                (Completed)
              @elseif($goal->start_date > now())
                (Starts in {{ \Carbon\Carbon::parse($goal->start_date)->diffForHumans() }})
              @else
                (Ends in {{ \Carbon\Carbon::parse($goal->end_date)->diffForHumans() }})
              @endif
            </p>
          </div>
        </div>
      </div>

      <!-- Progress Card -->
      <div class="bg-gray-800 rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-white mb-4">Progress</h2>
        <div class="mb-4">
          <div class="flex justify-between text-sm text-gray-400 mb-1">
            <span>Completion</span>
            <span>{{ $goal->compliance_percentage ?? 0 }}%</span>
          </div>
          <div class="w-full bg-gray-700 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $goal->compliance_percentage ?? 0 }}%"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Assigned Staff Section -->
    <div class="bg-gray-800 rounded-xl shadow-lg p-6">
      <h2 class="text-xl font-semibold text-white mb-4">Assigned Staff</h2>
      @if($goal->assignedUsers->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          @foreach ($goal->assignedUsers as $user)
            <div class="flex items-center p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-colors duration-200">
              <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold mr-3">
                {{ substr($user->name, 0, 1) }}
              </div>
              <div>
                <p class="text-white">{{ $user->name }}</p>
                <p class="text-xs text-gray-400">{{ $user->email }}</p>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p class="text-gray-400 italic">No staff members assigned to this goal</p>
      @endif
    </div>
  </div>
</x-layout>