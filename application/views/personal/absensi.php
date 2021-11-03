<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <!--- Container Fluid --->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rekap Kehadiran</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <a href="" class="btn btn-primary mb-3 btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                        <span class="icon text-white-40"><i class="fas fa-plus"></i></span>
                        <span class="text">Absen mandiri</span>
                    </a>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal Latihan</th>
                                        <th scope="col">Jam</th>
                                        <th scope="col">Lokasi Latihan</th>
                                        <th scope="col">Absensi oleh</th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($absensi as $data) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= date('d F Y', strtotime($data['tanggal'])); ?></td>
                                                <td><?= $data['jam']; ?></td>
                                                <td><?= $data['lokasi']; ?></td>
                                                <td><?php if ($data['id_pelatih'] > 0) {
                                                        echo "pelatih";
                                                    } else {
                                                        echo "mandiri";
                                                    }; ?></td>
                                            </tr>
                                        <?php $i++;
                                        endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <h5><b>Jumlah Kehadiran per semester</b></h5>
                                            </td>
                                            <td>
                                                <h5><b><?= $jml_kehadiran['jumlah']; ?></b></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <h5><b>Persentase kehadiran</b></h5>
                                            </td>
                                            <td>
                                                <h5><b><?= $persen . " %"; ?></b></h5>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->
</div>
</div>
<!-- End of Main Content -->

<!-- Input Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('personal/inputAbsensi'); ?>" method="post">
                <div class="modal-body">
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <div class="form-group">
                        <label class="input-label" for="tanggal">Tanggal Latihan</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="tanggal">Jam</label>
                        <input type="time" class="form-control" id="jam" name="jam" value="<?= date('H:i:s'); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="tanggal">Lokasi Latihan</label>
                        <select name="lokasi" id="lokasi" class="custom-select">
                            <option value=""><i>-- pilih unit --</i></option>
                            <?php foreach ($unit as $data) : ?>
                                <option value="<?= $data['id']; ?>"><?= $data['nama_unit']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
