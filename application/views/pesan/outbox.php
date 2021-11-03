<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- /.container-fluid -->
    <div class="row">
        <div class="col-xl-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', ' </div>'); ?>
            <?= $this->session->flashdata('message'); ?>

            <div class="card card-shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellpadding="0" cellspacing="1">
                            <thead>
                                <th scope="col">Subjek</th>
                                <th scope="col">Penerima</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Action</th>
                            </thead>
                            <tbody>
                                <?php foreach ($outbox as $o) : ?>
                                    <tr>
                                        <td>
                                            <?php if ($o['fr_read'] == 0) { ?>
                                                <a href="<?= base_url('pesan/bacaPesanKeluar/' . encrypt_url($o['id'])); ?>"><b><?= decrypt_text($o['subjek']); ?></b></a>
                                            <?php } else { ?> <a href="<?= base_url('pesan/bacaPesanKeluar/' . encrypt_url($o['id'])); ?>"><?= decrypt_text($o['subjek']); ?></a> <?php } ?>
                                        </td>
                                        <td><small><i><?= ucwords($o['nama']); ?></i></small></td>
                                        <td><?= date('d F Y', $o['date_sent']); ?></td>
                                        <td>
                                            <a href="#" class="fas fa-trash" data-toggle="modal" data-target="#deleteModal<?= $o['id']; ?>"></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<!-- Delete Modal-->
<?php foreach ($outbox as $o) : ?>
    <div class="modal fade" id="deleteModal<?= $o['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Pesan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin akan menghapus pesan ini?</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="<?= base_url('pesan/hapusPesanKeluar/') . encrypt_url($o['id']); ?>">Delete</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>