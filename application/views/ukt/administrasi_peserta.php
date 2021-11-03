<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- /.container-fluid -->
    <div class="row">
        <div class="col-xl-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Unit Ranting</th>
                                    <th scope="col">Pembayaran</th>
                                    <th scope="col">Pas Foto</th>
                                    <th scope="col">Fotocopy Ijazah</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($peserta as $p) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= ucwords($p['nama']); ?></td>
                                        <td><?= $p['nama_unit']; ?></td>
                                        <td align="center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?= $p['bayar']; ?>" <?php if ($p['bayar'] == 1) {
                                                                                                                                echo "checked";
                                                                                                                            } ?> disabled>
                                            </div>
                                        </td>
                                        <td align="center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?= $p['foto']; ?>" <?php if ($p['foto'] == 1) {
                                                                                                                                echo "checked";
                                                                                                                            } ?> disabled>
                                            </div>
                                        </td>
                                        <td align="center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?= $p['ijazah']; ?>" <?php if ($p['ijazah'] == 1) {
                                                                                                                                    echo "checked";
                                                                                                                                } ?> disabled>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="#" class="badge badge-info" data-toggle="modal" data-target="#checkModal<?= $p['id_anggota']; ?>">Check</a>
                                        </td>
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

<!-- check berkas modal -->

<?php foreach ($peserta as $p) : ?>
    <div class="modal fade" id="checkModal<?= $p['id_anggota']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Cek Kelengkapan Administrasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('panitia/updateAdministrasi'); ?>" method="post">

                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= encrypt_url($p['id_anggota']); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_trx" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= ucwords($p['nama']); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nom" class="col-sm-3 col-form-label">Pembayaran</label>
                            <div class="col-sm-9">
                                <select name="bayar" id="bayar" class="custom-select">
                                    <option value="1" <?php if ($p['bayar'] == 1) {
                                                            echo "selected";
                                                        } ?>>Sudah</option>
                                    <option value="0" <?php if ($p['bayar'] == 0) {
                                                            echo "selected";
                                                        } ?>>Belum</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nom" class="col-sm-3 col-form-label">Foto 3x4</label>
                            <div class="col-sm-9">
                                <select name="foto" id="foto" class="custom-select">
                                    <option value="1" <?php if ($p['foto'] == 1) {
                                                            echo "selected";
                                                        } ?>>Ada</option>
                                    <option value="0" <?php if ($p['foto'] == 0) {
                                                            echo "selected";
                                                        } ?>>Tidak ada</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nom" class="col-sm-3 col-form-label">Fotocopy Ijazah</label>
                            <div class="col-sm-9">
                                <select name="ijazah" id="ijazah" class="custom-select">
                                    <option value="1" <?php if ($p['ijazah'] == 1) {
                                                            echo "selected";
                                                        } ?>>Ada</option>
                                    <option value="0" <?php if ($p['ijazah'] == 0) {
                                                            echo "selected";
                                                        } ?>>Tidak ada</option>
                                </select>
                            </div>
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

<?php endforeach; ?>
