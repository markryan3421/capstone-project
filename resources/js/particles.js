document.addEventListener('DOMContentLoaded', () => {
  if (window.tsParticles) {
      tsParticles.load("tsparticles", {
          fullScreen: { enable: false },
          background: { color: "transparent" },
          particles: {
              number: { value: 60, density: { enable: true, value_area: 800 } },
              color: { value: "#ffffff" },
              shape: { type: "circle" },
              opacity: { value: 0.5, random: true },
              size: { value: 3, random: true },
              line_linked: { enable: true, distance: 150, color: "#ffffff", opacity: 0.4, width: 1 },
              move: {
                  enable: true,
                  speed: 1.5,
                  direction: "none",
                  random: true,
                  straight: false,
                  out_mode: "bounce",
                  bounce: true
              }
          },
          interactivity: {
              detect_on: "canvas",
              events: {
                  onhover: { enable: true, mode: "grab" },
                  onclick: { enable: true, mode: "push" }
              }
          }
      });
  } else {
      console.error('⚠️ tsParticles not found — check Vite build.');
  }
});
