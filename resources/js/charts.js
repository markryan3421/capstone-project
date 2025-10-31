document.addEventListener('DOMContentLoaded', () => {
    if (!window.Chart || !window.chartData) return;
  
    const { totalGoals, compliantGoals, nonCompliantGoals, shortTermCount, longTermCount } = window.chartData;
  
    // Calculate percentages for better visualization
    const complianceRate = totalGoals > 0 ? (compliantGoals / totalGoals) * 100 : 0;
    const nonComplianceRate = totalGoals > 0 ? (nonCompliantGoals / totalGoals) * 100 : 0;
    const shortTermPercentage = totalGoals > 0 ? (shortTermCount / totalGoals) * 100 : 0;
    const longTermPercentage = totalGoals > 0 ? (longTermCount / totalGoals) * 100 : 0;
  
    const complianceCtx = document.getElementById('complianceChart');
    if (complianceCtx) {
        new Chart(complianceCtx, {
            type: 'bar',
            data: {
                labels: ['Total Goals', 'Compliant', 'Non-Compliant'],
                datasets: [{
                    label: 'Goals Count',
                    data: [totalGoals, compliantGoals, nonCompliantGoals],
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgba(99, 102, 241, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                    barPercentage: 0.7,
                    categoryPercentage: 0.8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        display: false 
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.95)',
                        titleColor: '#f1f5f9',
                        bodyColor: '#cbd5e1',
                        borderColor: 'rgba(99, 102, 241, 0.5)',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                const label = context.dataset.label || '';
                                const value = context.parsed.y;
                                const total = context.dataset.data[0]; // Total goals
                                let percentage = '';
                                
                                if (context.dataIndex === 0) {
                                    percentage = '100% of total';
                                } else if (context.dataIndex === 1) {
                                    percentage = `${complianceRate.toFixed(1)}% compliance rate`;
                                } else if (context.dataIndex === 2) {
                                    percentage = `${nonComplianceRate.toFixed(1)}% non-compliance rate`;
                                }
                                
                                return `${label}: ${value} (${percentage})`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(148, 163, 184, 0.2)',
                            drawBorder: false
                        },
                        ticks: {
                            color: 'rgb(148, 163, 184)',
                            font: {
                                size: 11,
                                family: "'Inter', sans-serif"
                            },
                            padding: 8
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'rgb(148, 163, 184)',
                            font: {
                                size: 12,
                                family: "'Inter', sans-serif",
                                weight: '500'
                            },
                            padding: 12
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }
  
    const distributionCtx = document.getElementById('distributionChart');
    if (distributionCtx) {
        new Chart(distributionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Short Term Goals', 'Long Term Goals'],
                datasets: [{
                    data: [shortTermCount, longTermCount],
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.9)',
                        'rgba(139, 92, 246, 0.9)'
                    ],
                    borderColor: [
                        'rgba(99, 102, 241, 1)',
                        'rgba(139, 92, 246, 1)'
                    ],
                    borderWidth: 3,
                    borderRadius: 6,
                    spacing: 2,
                    hoverBackgroundColor: [
                        'rgba(99, 102, 241, 1)',
                        'rgba(139, 92, 246, 1)'
                    ],
                    hoverOffset: 12
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        position: 'bottom',
                        labels: {
                            color: 'rgb(148, 163, 184)',
                            font: {
                                size: 12,
                                family: "'Inter', sans-serif"
                            },
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            pointRadius: 6
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.95)',
                        titleColor: '#f1f5f9',
                        bodyColor: '#cbd5e1',
                        borderColor: 'rgba(99, 102, 241, 0.5)',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '65%',
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart',
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    }
  
    // Add custom CSS for better chart appearance
    const style = document.createElement('style');
    style.textContent = `
        .chart-container {
            position: relative;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.9));
            border-radius: 16px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .chart-title {
            color: #f8fafc;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            font-family: 'Inter', sans-serif;
        }
        
        .chart-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-value {
            color: #f8fafc;
            font-size: 1.5rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
        }
        
        .stat-label {
            color: #94a3b8;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            font-family: 'Inter', sans-serif;
        }
        
        /* Custom chart container styling */
        .chart-wrapper {
            background: rgba(15, 23, 42, 0.5);
            border-radius: 12px;
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    `;
    document.head.appendChild(style);
  });