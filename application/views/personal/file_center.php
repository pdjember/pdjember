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
                <span class="icon text-white-40"><i class="fas fa-file-upload"></i></span>
                <span class="text">Upload File</span>
            </a>

            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama/Judul File</th>
                            <th scope="col">Kontributor</th>
                            <th scope="col">Kategori</th>
                            <?php if ($user['role_id'] == 1) { ?><th scope="col">Action</th><?php } ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($files as $f) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><a href="<?= base_url('assets/pdf/') . $f['file']; ?>"><?= $f['judul']; ?></a></td>
                                <td><?= ucwords($f['nama']); ?></td>
                                <td><?= ucfirst($f['kategori']); ?></td>
                                <?php if ($user['role_id'] == 1) { ?>
                                    <td>
                                        <a href="<?= base_url('personal/deleteFiles/') . encrypt_url($f['id'])  ?>" class="badge badge-danger">Delete</a>
                                    </td>
                                <?php } ?>
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
<!-- Modal tambah data-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload File Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('personal/file_center'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="event">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul">
                </div>

                <div class="form-group">
                    <label for="tanggal">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori">
                </div>

                <div class="form-group">
                    <div class="col-sm-3">File</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_name" name="file_name">
                        <label class="custom-file-label" for="file">Pilih file</label>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>