import Chart from 'chart.js/auto';

const ctx = document.getElementById('myChart');

if (ctx && window.chartData) {
  new Chart(ctx.getContext('2d'), {
    type: 'doughnut',
    data: {
      labels: window.chartData.labels,
      datasets: [{
        label: 'توزيع منتجات المكياج',
        data: window.chartData.data,
        backgroundColor: ['#FFC8C8', '#f38181', '#e06b6b', '#F9A1A1', '#F5A9B8']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: 'توزيع أصناف المكياج',
          font: {
            size: 18
          }
        },
        legend: {
          position: 'bottom'
        }
      }
    }
  });
}
