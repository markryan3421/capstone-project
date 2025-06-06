<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subscribe to Our Newsletter</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    /* Custom file input styling */
    .file-input-container {
      position: relative;
      overflow: hidden;
      display: inline-block;
    }
    .file-input-button {
      border: 1px solid #e5e7eb;
      border-radius: 9999px;
      padding: 0.5rem 1rem;
      font-size: 0.875rem;
      font-weight: 500;
      background-color: #f9fafb;
      color: #4f46e5;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    .file-input-button:hover {
      background-color: #f3f4f6;
      color: #4338ca;
    }
    .file-input {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }
    /* Dark mode styles */
    .dark .file-input-button {
      background-color: #1e1b4b;
      border-color: #4f46e5;
      color: #a5b4fc;
    }
    .dark .file-input-button:hover {
      background-color: #312e81;
    }
  </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
  <!-- Notification Messages -->
  @if(session('success'))
    <div class="bg-green-900/80 border-l-4 border-green-500 text-green-100 p-4 mb-6 rounded-lg backdrop-blur-sm shadow-lg" role="alert">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <p>{{ session('success') }}</p>
        </div>
    </div>
  @endif

  @if ($errors->any())
    <div class="bg-red-500/90 text-white p-4 rounded-lg mb-6 backdrop-blur-sm shadow-lg">
        <div class="flex items-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <strong>Error:</strong>
        </div>
        <ul class="list-disc pl-5 space-y-1 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  {{ $slot }}

  <script>
    // Avatar preview functionality
    document.getElementById('avatar').addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          document.getElementById('avatar-preview').src = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>
</html>