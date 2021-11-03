<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- /.container-fluid -->
    <div class="row">
        <div class="col-xl-12">

            <?= $this->session->flashdata('message'); ?>

            <?php if ($th_ajaran['daftar_ukt'] == 1) { ?>
                <a href="#" class="btn btn-primary mb-4 btn-icon-split" data-toggle="modal" data-target="#confirmModal">
                    <span class="icon text-white-40"><i class="fas fa-feather-alt"></i></span>
                    <span class="text">Daftar UKT</span>
                </a>
            <?php }
            if ($user['ukt'] == 1) { ?>
                <a href="<?= base_url('personal/cetakFormulirUkt'); ?>" class="btn btn-secondary mb-4 btn-icon-split">
                    <span class="icon text-white-40"><i class="fas fa-print"></i></span>
                    <span class="text">Cetak Formulir Pendaftaran UKT</span>
                </a>
            <?php } ?>


            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Nilai UKT</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Nama</b></label>
                        <label class="col-sm-0 col-form-label"><b>:</b></label>
                        <label class="col-sm-7 col-form-label"><b><?= ucwords($user['nama']); ?></b></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Tingkatan</b></label>
                        <label class="col-sm-0 col-form-label"><b>:</b></label>
                        <label class="col-sm-7 col-form-label"><b><?= ucwords($user['tingkatan']); ?></b></label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><b>Unit</b></label>
                        <label class="col-sm-0 col-form-label"><b>:</b></label>
                        <label class="col-sm-7 col-form-label"><b><?= ucwords($user['nama_unit']); ?></b></label>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">KD Materi</th>
                                    <th scope="col">Materi UKT</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($nilai as $p) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $p['kd_materi']; ?></td>
                                        <td><?= $p['materi']; ?></td>
                                        <td><?= $p['rata2']; ?></td>
                                        <td><?php if ($p['rata2'] >= 60) {
                                                echo "<p class='badge badge-pill badge-success'>Lulus</p>";
                                            } else {
                                                echo "<p class='badge badge-pill badge-danger'>Tidak Lulus</p>";
                                            } ?></td>
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
<!-- End of Main Content -->
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfrimasi Pendaftaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Sebelum mendaftar UKT pastikan kelengkapan data berikut :</p>
                <ul>
                    <li>Jumlah Kehadiran lebih dari 70%</li>
                    <li>Bukti pembayaran UKT</li>
                    <li>Rekomendasi dari pelatih dan pas foto warna 3x4 (2 lembar)</li>
                    <li>Fotocopy ijazah 1 lembar (bagi tingkat Dasar 2 ke atas)</li>
                </ul>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="<?= base_url('personal/daftar_ukt'); ?>">Daftar</a>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>