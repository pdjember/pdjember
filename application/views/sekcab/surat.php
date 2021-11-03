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
                            <th scope="col">Tanggal</th>
                            <th scope="col">No Surat</th>
                            <th scope="col">Perihal</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Keluar/masuk</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($surat as $data) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= date('d F Y', strtotime($data['tanggal'])); ?></td>
                                <td><?= $data['no_surat']; ?></td>
                                <td><?= $data['isi_surat']; ?></td>
                                <td><?= $data['tujuan']; ?></td>
                                <td>
                                    <?php if ($data['i/o'] == "i") {
                                        echo "Surat Masuk";
                                    } else {
                                        echo "Surat Keluar";
                                    } ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('sekcab/deleteSurat/') . $data['id'] ?>" class="badge badge-danger">Delete</a>
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
<!-- Modal tambah data surat-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('sekcab/surat'); ?>" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="Nomor Surat">
                    </div>

                    <div class="form-group">
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Perihal">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Tujuan">
                    </div>

                    <div class="form-group">
                        <select name="io" id="io" class="custom-select">
                            <option value="i">Surat Masuk</option>
                            <option value="o">Surat Keluar</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="link" name="link" placeholder="Link Google Drive">
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