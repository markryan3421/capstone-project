const sdgs = [
  "No Poverty", "Zero Hunger", "Good Health and Well-being", "Quality Education",
  "Gender Equality", "Clean Water and Sanitation", "Affordable and Clean Energy",
  "Decent Work and Economic Growth", "Industry, Innovation, and Infrastructure",
  "Reduced Inequality", "Sustainable Cities and Communities", "Responsible Consumption and Production",
  "Climate Action", "Life Below Water", "Life on Land", "Peace, Justice, and Strong Institutions",
  "Partnerships for the Goals"
];

const container = document.getElementById('sdg-container');

// Generate cards with canvas elements
sdgs.forEach((title, index) => {
  const chartId = `chart${index + 1}`;
  container.innerHTML += `
    <div class="bg-gray-800 rounded-2xl shadow-lg p-5 flex flex-col justify-between h-72">
      <div>
        <h2 class="text-xl font-semibold mb-2">${title}</h2>
        <div class="relative w-full h-36"><canvas id="${chartId}"></canvas></div>
      </div>
      <div class="flex justify-end mt-4">
        <a href="/sdg/no-poverty" class="text-blue-400 text-sm hover:underline">View full details</a>
      </div>
    </div>
  `;
});

// Temporary dummy data for each chart
sdgs.forEach((_, index) => {
  const chartId = `chart${index + 1}`;
  const ctx = document.getElementById(chartId)?.getContext("2d");

  if (ctx) {
    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["2019", "2020", "2021", "2022", "2023"],
        datasets: [{
          label: "Progress (%)",
          data: Array.from({ length: 5 }, () => Math.floor(Math.random() * 100)),
          backgroundColor: "#3B82F6"
        }]
      },
      options: {
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: { beginAtZero: true, ticks: { color: "#ccc" } },
          x: { ticks: { color: "#ccc" } }
        },
        responsive: true,
        maintainAspectRatio: false
      }
    });
  }
});
export default {};
