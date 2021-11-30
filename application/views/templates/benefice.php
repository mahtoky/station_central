<div class="row">
  <div class="col-md-12">
    <a href="#" class="btn btn-success" onclick="generatePDF()">Exporter en PDF</a>
    <div class="w-10" id="export">
      <div class="d-flex justify-content-center align-item-center">
        <div class="card text-center w-25">
          <div class="card-header">
            Benefice total
          </div>
          <div class="card-body">
            <h5 class="card-title"><?php echo number_format(round($beneficeTotal->beneficetotal, 0),2, '.', ' ').' Ariary'; ?></h5>
          </div>
        </div>
      </div>
      <h3 class="text-center m-3">Benefice par produit</h3>
      <div class="d-flex justify-content-center align-item-center">
        <table class="table w-50">
          <thead class="thead-dark">
            <tr class="text-center">
              <th scope="col">Produit</th>
              <th scope="col">Benefice</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(count($beneficeproduit) > 0){
              foreach ($beneficeproduit as $value): ?>
              <tr>
                <td class="text-left"><?php echo $value->productname; ?></td>
                <td class="text-right"><?php echo number_format(round($value->benefice, 0), 2, '.', ' '); ?> Ariary</td>
              </tr>
            <?php endforeach;
          } else { ?>
              <tr>
                <td colspan="5" class="text-center">No data founded</td>
              </tr>
          </tbody>
          <?php } ?>
        </table>
      </div>
      <h3 class="m-3 text-center">Evolution des ventes</h3>
      <div class="m-2 d-flex justify-content-center align-item-center">
        <canvas id="myChart" class="w-75 w-50"></canvas>
      </div>
    </div>
    <!-- <canvas id="myChart" width="400" height="400"></canvas> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.js" charset="utf-8"></script>
    <script src="<?php echo site_url('assets/html2pdf/html2pdf.bundle.min.js'); ?>"></script>
    <script>
      function generatePDF() {
        const element = document.getElementById("export");
        var n= "data";
        html2pdf()
        .set({
          filename:     'Galana_stats.pdf',
          html2canvas : {scale : 4}
        })
        .from(element)
        .save();
      }

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
