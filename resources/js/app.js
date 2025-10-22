// ✅ Core imports
import './bootstrap'
import Alpine from 'alpinejs'
import 'preline'

// ✅ Initialize Alpine.js
window.Alpine = Alpine
Alpine.start()

// ✅ Make Preline re-initialize dynamically when Alpine changes
document.addEventListener('alpine:init', () => {
    window.HSStaticMethods?.autoInit();
});

// ✅ Import global libraries
import { Chart } from 'chart.js/auto'
import { tsParticles } from 'tsparticles-engine'

// Make them globally accessible for inline scripts
window.Chart = Chart
window.tsParticles = tsParticles

// ✅ Import your other scripts
import Settings from './settings'
import './notification'
import './particles'
import './charts'
