<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- /.container-fluid -->
    <div class="row">
        <div class="col-xl-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', ' </div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Penilaian <?= $materi_aktif['materi']; ?></h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                            <span class="icon text-white-40"><i class="fas fa-plus"></i></span>
                            <span class="text">Input Nilai</span>
                        </button>
                    </div>
                    <br>

                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Materi UKT</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($nilai as $n) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= ucwords($n['nama']); ?></td>
                                        <td><?= $n['nama_unit']; ?></td>
                                        <td><?= $n['materi']; ?></td>
                                        <td><?= $n['nilai']; ?></td>
                                        <td>
                                            <a href="#" class="badge badge-info" data-toggle="modal" data-target="#editModal<?= $n['id']; ?>">Edit</a>
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

<!-- Input Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Nilai <?= $materi_aktif['materi']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('ukt/simpanNilai'); ?>" method="post">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($peserta as $p) : ?>
                                    <tr>
                                        <td><input type="checkbox" name="id[]" value="<?= $p['id']; ?>" <?php if ($p['id'] > 0) {
                                                                                                            echo "checked";
                                                                                                        } ?>></td>
                                        <td><?= ucwords($p['nama']); ?></td>
                                        <td><?= $p['nama_unit']; ?></td>
                                        <td><input type="hidden" name="kd" value="<?= $p['kd_materi']; ?>" readonly>
                                            <input class="form-control" type="text" name="nilai[]">
                                        </td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
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

<!-- Edit Modal -->
<?php foreach ($nilai as $n) : ?>
    <div class="modal fade" id="editModal<?= $n['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Nilai <?= $materi_aktif['materi']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('ukt/editNilai'); ?>" method="post">
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="hidden" name="id" value="<?= $n['id']; ?>" readonly>
                                            <?= ucwords($n['nama']); ?></td>
                                        <td><?= $n['nama_unit']; ?></td>
                                        <td>
                                            <input class="form-control" type="text" name="nilai" value="<?= $n['nilai']; ?>">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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