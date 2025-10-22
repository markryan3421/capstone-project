document.addEventListener('DOMContentLoaded', () => {
  if (!window.Chart || !window.chartData) return;

  const { totalGoals, compliantGoals, nonCompliantGoals, shortTermCount, longTermCount } = window.chartData;

  const complianceCtx = document.getElementById('complianceChart');
  if (complianceCtx) {
      new Chart(complianceCtx, {
          type: 'bar',
          data: {
              labels: ['Total Goals', 'Compliant', 'Non-Compliant'],
              datasets: [{
                  label: 'Count',
                  data: [totalGoals, compliantGoals, nonCompliantGoals],
                  backgroundColor: [
                      'rgba(59, 130, 246, 0.7)',
                      'rgba(16, 185, 129, 0.7)',
                      'rgba(239, 68, 68, 0.7)'
                  ],
                  borderColor: [
                      'rgba(59, 130, 246, 1)',
                      'rgba(16, 185, 129, 1)',
                      'rgba(239, 68, 68, 1)'
                  ],
                  borderWidth: 1,
                  barPercentage: 0.6,
                  categoryPercentage: 0.8
              }]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: { legend: { display: false } },
              scales: { y: { beginAtZero: true } }
          }
      });
  }

  const distributionCtx = document.getElementById('distributionChart');
  if (distributionCtx) {
      new Chart(distributionCtx, {
          type: 'doughnut',
          data: {
              labels: ['Short', 'Long'],
              datasets: [{
                  data: [shortTermCount, longTermCount],
                  backgroundColor: [
                      'rgba(59, 130, 246, 0.7)',
                      'rgba(139, 92, 246, 0.7)'
                  ],
                  borderColor: [
                      'rgba(59, 130, 246, 1)',
                      'rgba(139, 92, 246, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                  legend: { position: 'right' }
              },
              cutout: '60%'
          }
      });
  }
});
