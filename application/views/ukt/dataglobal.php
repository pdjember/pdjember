<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <!-- /.container-fluid -->

  <div class="row">
    <div class="col-xl-6">
      <div class="card shadow mb-3">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Jumlah Peserta UKT Berdasar Tingkatan</h6>
        </div>
        <div class="card-body">
          <div class="chart-bar">
            <canvas id="myChart" width="600" height="300"></canvas>
          </div>
          <hr>
          <script src="<?= base_url('assets'); ?>/vendor/chart.js/chart.js"></script>
          <script type="text/javascript">
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                labels: [
                  <?php
                  foreach ($jml_tingkatan as $data) {
                    echo "'" . $data['tingkatan'] . "',";
                  }
                  ?>
                ],
                datasets: [{
                  label: 'Jumlah',
                  data: [
                    <?php
                    foreach ($jml_tingkatan as $data) {
                      echo "'" . $data['jumlah'] . "',";
                    }
                    ?>
                  ],
                  backgroundColor: [
                    'rgb(153, 147, 150, 0.8)', //D1
                    'rgb(49, 46, 48, 0.8)', //D2
                    'rgba(208, 34, 25, 0.8)', //Ck
                    'rgba(85, 10, 6, 0.8)', //Pt
                    'rgba(31, 249, 74, 0.8)', //PH
                    'rgba(1, 131, 27, 0.8)', //H
                    'rgba(92, 223, 249, 0.8)', //HB
                    'rgba(14, 24, 220, 0.8)', //B
                    'rgba(4, 12, 153, 0.8)', //BM
                    'rgba(249, 55, 21, 0.8)', //M
                    'rgba(251, 138, 8, 0.8)', //MK
                    'rgba(251, 231, 44, 0.8)', //PM
                    'rgba(253, 229, 11, 0.8)' //P
                  ],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  xAxes: [{
                    ticks: {
                      beginAtZero: true
                    }
                  }]
                }
              }
            });
          </script>
        </div>
      </div>
    </div>

    <div class="col-xl-6">
      <div class="card shadow mb-3">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Jumlah Peserta UKT Berdasar unit</h6>
        </div>
        <div class="card-body">
          <div class="chart-doughnut">
            <canvas id="myChart1" width="600" height="300"></canvas>
          </div>
          <hr>
          <script src="<?= base_url('assets'); ?>/vendor/chart.js/chart.js"></script>
          <script type="text/javascript">
            var ctx = document.getElementById('myChart1').getContext('2d');
            var myChart1 = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: [
                  <?php
                  foreach ($jml_unit as $data) {
                    echo "'" . $data['nama_unit'] . "',";
                  }
                  ?>
                ],
                datasets: [{
                  label: 'Jumlah',
                  data: [
                    <?php
                    foreach ($jml_unit as $data) {
                      echo "'" . $data['jumlah'] . "',";
                    }
                    ?>
                  ],
                  backgroundColor: [
                    'rgb(150, 21, 21, 0.8)',
                    'rgb(230, 149, 57, 0.8)',
                    'rgb(213, 230, 57, 0.8)',
                    'rgb(115, 230, 57, 0.8)',
                    'rgb(19, 156, 30, 0.8)',
                    'rgb(67, 222, 170, 0.8)',
                    'rgb(7, 187, 219, 0.8)',
                    'rgb(7, 155, 219, 0.8)',
                    'rgb(7, 106, 219, 0.8)',
                    'rgb(7, 39, 219, 0.8)',
                    'rgb(117, 7, 219, 0.8)',
                    'rgb(170, 7, 219, 0.8)',
                    'rgb(205, 7, 219, 0.8)',
                    'rgb(219, 7, 117, 0.8)'
                  ],
                  borderWidth: 1
                }]
              }
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- End of Main Content -->
</div>