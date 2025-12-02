function highlightTask(taskId) {
    const taskElement = document.getElementById(taskId);
    if (taskElement) {
        // Add Tailwind animation classes
        taskElement.classList.add('animate-pulse', 'ring-4', 'ring-blue-500', 'ring-opacity-50');
        
        // Scroll to the task
        setTimeout(() => {
        const offset = 100;
        const elementPosition = taskElement.getBoundingClientRect().top + window.pageYOffset;
        const offsetPosition = elementPosition - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
        }, 100);

        // Remove animation classes after completion
        setTimeout(() => {
        taskElement.classList.remove('animate-pulse', 'ring-4', 'ring-blue-500', 'ring-opacity-50');
        }, 2000);
    }
    }

    // Same event listeners as above
    document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash) {
        const taskId = window.location.hash.substring(1);
        setTimeout(() => {
        highlightTask(taskId);
        }, 500);
    }
});