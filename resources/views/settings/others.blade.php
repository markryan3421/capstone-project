<x-settings>
  <!-- Sound Settings Section -->
  <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
    <div class="flex items-center justify-between">
      <div class="flex-1">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Notification Sounds</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400">
          Enable sound alerts for new notifications and updates
        </p>
      </div>
      
      <!-- Toggle Switch with Custom CSS -->
      <button id="enable-sounds" 
              type="button"
              class="sound-toggle relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 bg-gray-200 dark:bg-gray-700"
              role="switch"
              aria-checked="false">
        <span class="sr-only">Toggle notification sounds</span>
        <span id="toggle-knob" 
              class="toggle-knob pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white dark:bg-gray-200 shadow ring-0 transition duration-200 ease-in-out"></span>
      </button>
    </div>

    <!-- Status Indicator -->
    <div class="mt-3 flex items-center text-sm">
      <span id="sound-status" class="text-gray-500 dark:text-gray-400 font-medium">Sounds disabled</span>
      <span class="mx-2 text-gray-300 dark:text-gray-600">•</span>
      <span id="sound-description" class="text-gray-400 dark:text-gray-500">No audio alerts</span>
    </div>
  </div>

  <audio id="notification-sound" preload="auto" 
      src="{{ asset('sounds/notification.mp3') }}">
  </audio>
</x-settings>

<style>
.sound-toggle {
  /* Base styles are handled by Tailwind */
}

.toggle-knob {
  transform: translateX(0.125rem); /* 2px - perfect for off state */
}

.sound-toggle.enabled .toggle-knob {
  transform: translateX(1.375rem); /* 22px - perfect for on state */
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const soundToggle = document.getElementById('enable-sounds');
    const toggleKnob = document.getElementById('toggle-knob');
    const soundStatus = document.getElementById('sound-status');
    const soundDescription = document.getElementById('sound-description');
    const notificationSound = document.getElementById('notification-sound');
    
    // Set volume
    if (notificationSound) {
        notificationSound.volume = 0.3;
    }

    // Initialize from localStorage
    updateToggleState();

    // Add click event listener
    soundToggle.addEventListener('click', function() {
        toggleSound();
    });

    function toggleSound() {
        const isEnabled = localStorage.getItem('soundsEnabled') === 'true';
        const newState = !isEnabled;
        
        // Update state immediately
        localStorage.setItem('soundsEnabled', newState);
        updateToggleState();

        // Test playback only when enabling
        if (newState && notificationSound) {
            testAudioPlayback();
        }
    }

    function updateToggleState() {
        const isEnabled = localStorage.getItem('soundsEnabled') === 'true';
        
        // Update toggle visual state
        if (isEnabled) {
            soundToggle.classList.remove('bg-gray-200', 'dark:bg-gray-700');
            soundToggle.classList.add('bg-blue-600', 'enabled');
            soundToggle.setAttribute('aria-checked', 'true');
            
            // Update status text
            soundStatus.textContent = 'Sounds enabled';
            soundStatus.className = 'text-green-600 dark:text-green-400 font-medium';
            soundDescription.textContent = 'Audio alerts active';
        } else {
            soundToggle.classList.remove('bg-blue-600', 'enabled');
            soundToggle.classList.add('bg-gray-200', 'dark:bg-gray-700');
            soundToggle.setAttribute('aria-checked', 'false');
            
            // Update status text
            soundStatus.textContent = 'Sounds disabled';
            soundStatus.className = 'text-gray-500 dark:text-gray-400 font-medium';
            soundDescription.textContent = 'No audio alerts';
        }
    }

    // ... rest of the JavaScript functions remain the same
    function testAudioPlayback() {
        notificationSound.currentTime = 0;
        notificationSound.play()
            .then(() => {
                notificationSound.pause();
                notificationSound.currentTime = 0;
            })
            .catch(e => {
                console.error("Audio blocked:", e);
                localStorage.setItem('soundsEnabled', 'false');
                updateToggleState();
                showPermissionAlert();
            });
    }

    function showPermissionAlert() {
        soundToggle.classList.add('bg-red-500');
        soundStatus.textContent = 'Permission required';
        soundStatus.className = 'text-red-600 dark:text-red-400 font-medium';
        soundDescription.textContent = 'Click allow when prompted';
        
        setTimeout(() => {
            soundToggle.classList.remove('bg-red-500');
            updateToggleState();
        }, 2000);
    }

    window.playNotificationSound = () => {
        if (localStorage.getItem('soundsEnabled') === 'true' && notificationSound) {
            notificationSound.currentTime = 0;
            notificationSound.play().catch(e => {
                console.error("Playback failed:", e);
                showPlaybackError();
            });
        }
    };

    function showPlaybackError() {
        soundStatus.textContent = 'Playback failed';
        soundStatus.className = 'text-red-600 dark:text-red-400 font-medium';
        setTimeout(() => updateToggleState(), 3000);
    }

    updateToggleState();
});
</script>