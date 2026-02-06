
document.addEventListener('DOMContentLoaded', () => {
  let barChartInstance = null;
  let pieChartInstance = null;

  async function loadGraphInfo(year = new Date().getFullYear()){

    const barChart = document.getElementById('bar-chart');
    const pieChart = document.getElementById('pie-chart');
    
    const barChartData = await fetchDataGet(`/student023/shop/backend/endpoints/db_select_total_income_per_month.php?year=${year}`, true, true)
    const pieChartData = await fetchDataGet(`/student023/shop/backend/endpoints/db_select_total_income_per_vendor.php?`, true, true);
    const barData = {
      labels: getMonths(),
      datasets: [{
        label: 'Monthly Sales',
        data: Object.values(barChartData),
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)'
        ],
        borderWidth: 1
      }]
    };

    const pieData = {
      labels: pieChartData.labels,
      datasets: [{
        data: Object.values(pieChartData.data),
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)'
        ],
        borderWidth: 1
      }]
    };

    if(barChartInstance){
      barChartInstance.destroy();
    }

    if(pieChartInstance){
      pieChartInstance.destroy();
    }

    barChartInstance = new Chart(barChart, {
      type: "bar",
      data: barData
    })

    pieChartInstance = new Chart(pieChart, {
      type: "pie",
      data: pieData
    })

  }

  document.getElementById('bar-chart-year').addEventListener('change', (e) => {
    const year = e.target.value;
    loadGraphInfo(year)
  })

  loadGraphInfo();
})
