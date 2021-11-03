<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- /.container-fluid -->
    <div class="row">
        <div class="col-rg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', ' </div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Keseluruhan</h6>
                </div>
                <div class="card-body">
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
                                    <th scope="col">Email</th>
                                    <th scope="col">Tingkatan</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Aktif</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($anggota as $a) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= ucwords($a['nama']); ?></td>
                                        <td><?= ucwords($a['tmp_lahir']) . ", " . date('d F Y', strtotime($a['tgl_lahir'])); ?></td>
                                        <td><?= $a['kelamin']; ?></td>
                                        <td><?= $a['alamat']; ?></td>
                                        <td><?= $a['no_hp']; ?></td>
                                        <td><?= $a['email']; ?></td>
                                        <td><?= $a['tingkatan']; ?></td>
                                        <td><?= $a['role']; ?></td>
                                        <td><input type="checkbox" <?php if ($a['st_aktif'] == 1) {
                                                                        echo "checked";
                                                                    } ?>>
                                        </td>
                                        <td>
                                            <?php if ($a['role_id'] == "2" or $a['role_id'] == "4") {
                                                if ($a['st_aktif'] == 1) { ?>
                                                    <a href="<?= base_url('ketua/deaktivasiAnggota/') . encrypt_url($a['id']); ?>" class="badge badge-danger">Deactivate</a>
                                                <?php } else { ?>
                                                    <a href="<?= base_url('ketua/aktivasiAnggota/') . encrypt_url($a['id']); ?>" class="badge badge-success">Activate</a>
                                                <?php }
                                            } else { ?> <a href="#" class="badge badge-secondary">No Action</a> <?php } ?>
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