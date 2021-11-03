<!-- Begin Page Content -->

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-xl-6">
      <?= $this->session->flashdata('message'); ?>
      <div class="card shadow mb-3">
        <div class="card-header py-2">
          <h6 class="m-0 font-weight-bold text-primary">Biodata Pribadi</h6>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Nama</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= ucwords($anggota['nama']); ?></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Jenis Kelamin</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label">
              <?php
              if ($anggota['kelamin'] == "L") {
                echo "Laki-laki";
              } else {
                echo "Perempuan";
              } ?>
            </label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Tempat, tanggal lahir</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= ucwords($anggota['tmp_lahir'])  . ", " . date('d F Y', strtotime($anggota['tgl_lahir'])); ?></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Alamat</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= ucfirst($anggota['alamat']); ?></label>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Tinggi Badan</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= $anggota['tb'] . " cm"; ?></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Berat Badan</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= $anggota['bb'] . " kg"; ?></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Tingkatan</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label">
              <?php foreach ($tingkatan as $t) {
                if ($anggota['id_tingkatan'] == $t['id']) {
                  echo $t['tingkatan'];
                }
              }
              ?></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Unit Latihan</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label">
              <?php foreach ($unit as $u) {
                if ($anggota['id_unit'] == $u['id']) {
                  echo $u['nama_unit'];
                }
              }
              ?></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">No HP</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= $anggota['no_hp']; ?></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Email</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= $anggota['email']; ?></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Jabatan</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label">
              <?php foreach ($role as $r) {
                if ($anggota['role_id'] == $r['id']) {
                  echo $r['role'];
                }
              }
              ?></label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Status Aktif</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label">
              <?php if ($anggota['st_aktif'] == 1) {
                echo "Aktif";
              } else {
                echo "Tidak Aktif";
              }
              ?></label>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3">
      <div class="row">
        <div class="card mb-3" style="max-width: 540px;max-height: 740px;">
          <div class="card-body">
            <img src="<?= base_url('assets/img/profile/') . $anggota['image']; ?>" class="card-img" alt="...">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="card shadow mb-4">
          <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold text-primary">Ability Chart</h6>
          </div>
          <div class="card-body">
            <div class="chart-radar">
              <canvas id="myChart" width="300" height="200"></canvas>
            </div>
            <hr>
            <script src="<?= base_url('assets'); ?>/vendor/chart.js/chart.js"></script>
            <script type="text/javascript">
              var marksCanvas = document.getElementById("myChart");
              var radarChart = new Chart(marksCanvas, {
                type: 'polarArea',
                data: {
                  labels: ["Power", "Stamina", "Speed", "Agility", "Teknik"],
                  datasets: [{
                    label: "Nilai Ability",
                    backgroundColor: [
                      "rgba(255, 0, 0, 0.6)",
                      "rgba(0, 100, 255, 0.5)",
                      "rgba(100, 255, 0, 0.5)",
                      "rgba(200, 50, 255, 0.5)",
                      "rgba(0, 255,200, 0.6)"
                    ],
                    radius: 6,
                    pointBorderWidth: 3,
                    pointHoverRadius: 10,
                    data: [
                      <?php foreach ($fisik as $data) { ?>
                      <?= "'" . $data['power'] . "',
                                        '" . $data['stamina'] . "',
                                        '" . $data['speed'] . "',
                                        '" . $data['agility'] . "',
                                        '" . $data['teknik'] . "'";
                      } ?>
                    ]
                  }]
                },
                options: {
                  scale: {
                    ticks: {
                      beginAtZero: true,
                      min: 0,
                      max: 100,
                      stepSize: 40
                    },
                    pointLabels: {
                      fontSize: 16
                    }
                  },
                  legend: {
                    position: 'left'
                  }
                }
              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-6">
      <div class="card shadow mb-3">
        <div class="card-header py-2">
          <h6 class="m-0 font-weight-bold text-primary">Prestasi</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Event / Lomba</th>
                  <th scope="col">Juara</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Kelas</th>
                  <th scope="col">Usia</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($prestasi as $p) : ?>
                  <tr>
                    <td><?= $i; ?></td>
                    <td><?= $p['event']; ?></td>
                    <td><?= $p['juara']; ?></td>
                    <td><?= $p['kategori']; ?></td>
                    <td><?= $p['kelas']; ?></td>
                    <td><?= $p['usia']; ?></td>
                  </tr>
                <?php $i++;
                endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>