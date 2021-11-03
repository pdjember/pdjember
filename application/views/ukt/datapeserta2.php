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
                    <h6 class="m-0 font-weight-bold text-primary">Data Peserta UKT</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tingkatan</th>
                                    <th scope="col">Unit Ranting</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($peserta as $p) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= ucwords($p['nama']); ?></td>
                                        <td><?= $p['tingkatan']; ?></td>
                                        <td><?= $p['nama_unit']; ?></td>
                                        <td><a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?= $p['id']; ?>">Delete</a></td>
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

<!-- Delete Modal -->
<?php foreach ($peserta as $p) : ?>
    <div class="modal fade" id="deleteModal<?= $p['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Data Peserta UKT</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Menghapus data ini akan menyebabkan peserta tidak lagi terdaftar sebagai peserta UKT.
                    <br>Apakah anda yakin akan menghapus data <b><?= ucwords($p['nama']); ?> (<?= $p['nama_unit']; ?>)</b> ?
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger" href="<?= base_url('panitia/deletePeserta/') . encrypt_url($p['id']); ?>">Hapus</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>