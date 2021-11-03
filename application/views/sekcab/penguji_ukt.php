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
                <span class="text">Tambah Penguji</span>
            </a>

            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Penguji Tingkat</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($penguji as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= ucwords($p['nama']); ?></td>
                                <td><?= $p['tingkatan']; ?></td>
                                <td>
                                    <a href="<?= base_url('sekcab/deletePenguji/') . $p['id_anggota'] ?>" class="badge badge-danger">Delete</a>
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
<!-- Modal tambah submenu-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Penguji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('sekcab/pengujiUkt'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="id_anggota" id="id_anggota" class="custom-select">
                            <option value="">Pilih pelatih</option>
                            <?php foreach ($pelatih as $p) : ?>
                                <option value="<?= $p['id']; ?>"><?= ucwords($p['nama']); ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="tingkatan" id="tingkatan" class="custom-select">
                            <option value="">Penguji Tingkat ....</option>
                            <?php foreach ($tingkatan as $t) : ?>
                                <option value="<?= $t['id']; ?>"><?= $t['tingkatan']; ?></option>

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