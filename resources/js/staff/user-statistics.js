import Chart from 'chart.js/auto';

let chart = null;

// Стили для кнопок периодов
const applyButtonStyles = () => {
    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.classList.add('hover:bg-gray-600', 'transition-colors');
        if (btn.dataset.period === 'day') {
            btn.classList.add('bg-gray-600', 'text-gray-100');
        } else {
            btn.classList.add('bg-gray-700', 'text-gray-200');
        }
    });
};

// Создание графика
const createChart = (data) => {
    const canvas = document.getElementById('registrationChart');
    
    if (!canvas) {
        console.error('Canvas element not found');
        return;
    }

    if (chart) {
        chart.destroy();
    }
    
    chart = new Chart(canvas, {
        type: 'line',
        data: {
            labels: data.map(item => item.label),
            datasets: [{
                label: 'Регистрации',
                data: data.map(item => item.count),
                borderColor: '#94a3b8',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
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
                mode: 'index',
                intersect: false,
                callbacks: {
                  label: function(context) {
                    return `Регистраций: ${context.parsed.y}`;
                  }
                }
              }
            },
            scales: {
              x: {
                ticks: {
                  maxRotation: 45,
                  minRotation: 45,
                  autoSkip: true,
                  maxTicksLimit: window.innerWidth < 768 ? 8 : 12
                }
              },
              y: {
                beginAtZero: true,
                ticks: {
                  stepSize: 1,
                  color: '#999',
                  font: { size: 11 }
                }
              }
            }
        }
    });
};

const loadData = async (period) => {
    try {
        const response = await fetch(`/admin/statistics/users?period=${period}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        if (data && Array.isArray(data)) {
            createChart(data);
        } else {
            console.error('Invalid data format received');
        }
    } catch (error) {
        console.error('Error loading data:', error);
    }
};

// Инициализация
document.addEventListener('DOMContentLoaded', () => {
    applyButtonStyles();
    loadData('day');
    
    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            document.querySelectorAll('.period-btn').forEach(b => {
                b.classList.remove('bg-gray-600', 'text-gray-100');
                b.classList.add('bg-gray-700', 'text-gray-200');
            });
            
            btn.classList.remove('bg-gray-700', 'text-gray-200');
            btn.classList.add('bg-gray-600', 'text-gray-100');
            
            loadData(btn.dataset.period);
        });
    });
});