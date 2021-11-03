<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-xl-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                    <a href="" class="btn btn-primary mb-3 btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                        <span class="icon text-white-40"><i class="fas fa-plus"></i></span>
                        <span class="text">Tambah Data</span>
                    </a>

                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($transaksi as $trx) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= date('d F Y', strtotime($trx['tgl_trx'])); ?></td>
                                        <td><?= $trx['ket']; ?></td>
                                        <td><?= $trx['semester']; ?></td>
                                        <td><?= $trx['th_ajaran']; ?></td>
                                        <td><?= "Rp " . number_format($trx['nominal'], 0, ".", "."); ?></td>
                                        <td>
                                            <a href="#" class="badge badge-success" data-toggle="modal" data-target="#editModal<?= $trx['id']; ?>">Edit</a>
                                            <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?= $trx['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <h5><b>Jumlah Pemasukan</b></h5>
                                    </td>
                                    <td colspan="2">
                                        <?php foreach ($pemasukan as $p) : ?>
                                            <h5><b><?= "Rp " . number_format($p['jml_pemasukan'], 0, ".", "."); ?></b></h5>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
</div>

<!-- Modal Tambah-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('bendahara/pemasukanUnit'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tgl_trx" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl_trx" name="tgl_trx">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ket" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="ket" name="ket">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nom" class="col-sm-3 col-form-label">Nominal (Rp)</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="nominal" name="nominal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nom" class="col-sm-3 col-form-label">Tahun</label>
                        <div class="col-sm-9">
                            <select name="th_ajaran" id="th_ajaran" class="custom-select">
                                <?php foreach ($th_ajaran_aktif as $th) : ?>
                                    <option value="<?= $th['id']; ?>"><?= $th['th_ajaran'] . " (" . $th['semester'] . ")"; ?></option>
                                <?php endforeach; ?>
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

<!-- Modal edit trx-->
<?php foreach ($transaksi as $trx) : ?>
    <div class="modal fade" id="editModal<?= $trx['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('bendahara/updatePemasukanUnit'); ?>" method="post">

                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= encrypt_url($trx['id']); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_trx" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tgl_trx" name="tgl_trx" value="<?= $trx['tgl_trx']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ket" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ket" name="ket" value="<?= $trx['ket']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nom" class="col-sm-3 col-form-label">Nominal (Rp)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="nominal" name="nominal" value="<?= $trx['nominal']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nom" class="col-sm-3 col-form-label">Tahun</label>
                            <div class="col-sm-9">
                                <select name="th_ajaran" id="th_ajaran" class="custom-select">
                                    <?php foreach ($th_ajaran_aktif as $th) : ?>
                                        <option value="<?= $th['id']; ?>"><?= $th['th_ajaran'] . "(" . $th['semester'] . ")"; ?></option>
                                    <?php endforeach; ?>
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


<!-- Delete Modal-->
<?php foreach ($transaksi as $trx) : ?>
    <div class="modal fade" id="deleteModal<?= $trx['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data ini?
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger" href="<?= base_url('bendahara/deletePemasukanUnit/') . $trx['id'] ?>">Hapus</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>