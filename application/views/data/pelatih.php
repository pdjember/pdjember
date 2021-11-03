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
                    <h6 class="m-0 font-weight-bold text-primary">Data Anggota Keseluruhan</h6>
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">TTL</th>
                                    <th scope="col">L/P</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Tingkatan</th>
                                    <th scope="col">Unit/Ranting</th>
                                    <th scope="col">Aktif</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($dataAnggota as $d) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= ucwords($d['nama']); ?></td>
                                        <td><?= ucwords($d['tmp_lahir']) . ", " . date('d F Y', strtotime($d['tgl_lahir'])); ?></td>
                                        <td><?= $d['kelamin']; ?></td>
                                        <td><?= $d['alamat']; ?></td>
                                        <td><?= $d['no_hp']; ?></td>
                                        <td><?= $d['tingkatan']; ?></td>
                                        <td><?= $d['nama_unit']; ?></td>
                                        <td><input type="checkbox" <?php if ($d['st_aktif'] == 1) {
                                                                        echo "checked";
                                                                    } ?>>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('data/deletePelatih/') . encrypt_url($d['id']); ?>" class="badge badge-danger">Delete</a>
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
<!-- Input Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pelatih</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('data/dataPelatih'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="id" id="id" class="custom-select">
                            <option>Pilih Anggota ....</option>
                            <?php foreach ($anggota as $data) : ?>
                                <option value="<?= $data['id']; ?>"><?= ucwords($data['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
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