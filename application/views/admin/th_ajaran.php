<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">
        <div class="col-xl-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3 btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                <span class="icon text-white-40"><i class="fas fa-plus"></i></span>
                <span class="text">Tambah Data</span>
            </a>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tahun Ajaran</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Tanggal UKT</th>
                            <th scope="col">Active</th>
                            <th scope="col">Daftar UKT</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($th_ajaran as $ta) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $ta['th_ajaran']; ?></td>
                                <td><?= $ta['semester']; ?></td>
                                <td><?= date('l, d F Y', strtotime($ta['tgl_ukt'])); ?></td>
                                <td>
                                    <center><input class="form-check-input" type="checkbox" <?php
                                                                                            if ($ta['aktif'] == 1) {
                                                                                                echo "checked";
                                                                                            } ?> disabled></center>

                                </td>
                                <td>
                                    <center><input class="form-check-input" type="checkbox" <?php
                                                                                            if ($ta['daftar_ukt'] == 1) {
                                                                                                echo "checked";
                                                                                            } ?> disabled></center>

                                </td>
                                <td>
                                    <a href="#" class="badge badge-success" data-toggle="modal" data-target="#editModal<?= $ta['id']; ?>">Edit</a>
                                    <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?= $ta['id']; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
</div>

<!-- Modal edit tahun-->
<?php foreach ($th_ajaran as $ta) : ?>
    <div class="modal fade" id="editModal<?= $ta['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Tahun Ajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/updateTh_ajaran'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= encrypt_url($ta['id']); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="th_ajaran" class="col-sm-3 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="th_ajaran" name="th_ajaran" value="<?= $ta['th_ajaran']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                            <div class="col-sm-9">
                                <select name="semester" id="semester" class="custom-select">
                                    <option value="1" <?php if ($ta['semester'] == 1) {
                                                            echo "selected";
                                                        } ?>>Ganjil</option>
                                    <option value="2" <?php if ($ta['semester'] == 2) {
                                                            echo "selected";
                                                        } ?>>Genap</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_ukt" class="col-sm-3 col-form-label">Tanggal UKT</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tgl_ukt" name="tgl_ukt" value="<?= $ta['tgl_ukt']; ?>">
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" aria-label="Checkbox for following text input" value="1" id="aktif" name="aktif" <?php if ($ta['aktif'] == 1) {
                                                                                                                                                echo "checked";
                                                                                                                                            } ?>>
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Aktif?" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" aria-label="Checkbox for following text input" value="1" id="daftar_ukt" name="daftar_ukt" <?php if ($ta['daftar_ukt'] == 1) {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>>
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Dapat mendaftar UKT" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Tambah-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Tambah Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/th_ajaran'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="th_ajaran" class="col-sm-3 col-form-label">Tahun Ajaran</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="th_ajaran" name="th_ajaran">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                        <div class="col-sm-9">
                            <select name="semester" id="semester" class="custom-select">
                                <option value="1">Ganjil</option>
                                <option value="2">Genap</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_ukt" class="col-sm-3 col-form-label">Tanggal UKT</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl_ukt" name="tgl_ukt">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input" value="1" id="aktif" name="aktif" checked>
                            </div>
                        </div>
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Aktif?" readonly>
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

<!-- Delete Modal-->
<?php foreach ($th_ajaran as $ta) : ?>
    <div class="modal fade" id="deleteModal<?= $ta['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data ini?
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger" href="<?= base_url('admin/deleteTh_ajaran/') . $ta['id'] ?>">Hapus</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>