<div class="row">
  <div class="col-md-12">
    <div class="d-flex justify-content-center align-item-center">
      <canvas id="myChart" class="h-100 w-75"></canvas>
    </div>
    <!-- <script src="<?php echo site_url('assets/chart.js') ?>" charset="utf-8"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.js" charset="utf-8"></script>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var cData = JSON.parse('<?php echo $chart_data; ?>');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: cData.label,
            datasets: [{
                label: cData.label,
                data: cData.data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>

  </div>
</div>
