<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- /.container-fluid -->
    <div class="row">
        <div class="col-rg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Fisik Anggota Keseluruhan</h6>
                </div>
                <div class="card-body">
                    <a href="#editFisikModal" class="btn btn-primary mb-3 btn-icon-split" data-toggle="modal" data-target="#newFisikModal">
                        <span class="icon text-white-40"><i class="fas fa-plus"></i></span>
                        <span class="text">Tambah Data</span>
                    </a>
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Speed</th>
                                <th scope="col">Power</th>
                                <th scope="col">Stamina</th>
                                <th scope="col">Agility</th>
                                <th scope="col">Teknik</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($dataFisik as $data) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= ucwords($data['nama']); ?></td>
                                    <td><?= $data['speed']; ?></td>
                                    <td><?= $data['power']; ?></td>
                                    <td><?= $data['stamina']; ?></td>
                                    <td><?= $data['agility']; ?></td>
                                    <td><?= $data['teknik']; ?></td>
                                    <td>
                                        <a href="#" class="badge badge-info" data-toggle="modal" data-target="#edit<?= $data['id']; ?>">Edit</a>
                                        <a href="<?= base_url('pelatih/deleteFisik/') . encrypt_url($data['id']); ?>" class="badge badge-danger">Delete</a>
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

<div class="modal fade" id="newFisikModal" tabindex="-1" role="dialog" aria-labelledby="newFisikModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newFisikModal">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pelatih/dataFisik'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <select name="id" id="id" class="custom-select">
                                    <option value="" selected>Pilih Anggota...</option>
                                    <?php foreach ($anggota as $a) : ?>
                                        <option value="<?= $a['id']; ?>"><?= $a['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="power">Power</label>
                                <input type="text" class="form-control" id="power" name="power">
                            </div>

                            <div class="form-group">
                                <label for="speed">Speed</label>
                                <input type="text" class="form-control" id="speed" name="speed">
                            </div>

                            <div class="form-group">
                                <label for="stamina">Stamina</label>
                                <input type="text" class="form-control" id="stamina" name="stamina">
                            </div>

                            <div class="form-group">
                                <label for="agility">Agility</label>
                                <input type="text" class="form-control" id="agility" name="agility">
                            </div>

                            <div class="form-group">
                                <label for="teknik">Teknik</label>
                                <input type="text" class="form-control" id="teknik" name="teknik">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php foreach ($dataFisik as $data) : ?>
    <div class="modal fade" id="edit<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="newFisikModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newFisikModal">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('pelatih/updateDataFisik'); ?>" method="post">
                    <div class="modal-body">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <select name="id" id="id" class="custom-select">
                                    <option value="" selected>Pilih Anggota...</option>
                                    <?php foreach ($anggota as $a) : ?>
                                        <option value="<?= $a['id']; ?>" <?php if ($a['id'] == $data['id_anggota']) {
                                                                                echo "selected";
                                                                            } ?>><?= $a['nama']; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="power">Power</label>
                                <input type="text" class="form-control" id="power" name="power" value="<?= $data['power']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="speed">Speed</label>
                                <input type="text" class="form-control" id="speed" name="speed" value="<?= $data['speed']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="stamina">Stamina</label>
                                <input type="text" class="form-control" id="stamina" name="stamina" value="<?= $data['stamina']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="agility">Agility</label>
                                <input type="text" class="form-control" id="agility" name="agility" value="<?= $data['agility']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="teknik">Teknik</label>
                                <input type="text" class="form-control" id="teknik" name="teknik" value="<?= $data['teknik']; ?>">
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