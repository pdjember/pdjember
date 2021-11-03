<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <!--- Container Fluid --->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rekap Kehadiran</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <a href="" class="btn btn-primary mb-3 btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                        <span class="icon text-white-40"><i class="fas fa-plus"></i></span>
                        <span class="text">Input Absen</span>
                    </a>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Unit Asal</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jam</th>
                                        <th scope="col">Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($rekap as $data) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= ucwords($data['nama']); ?></td>
                                                <td><?= $data['nama_unit']; ?></td>
                                                <td><?= date('d F Y', strtotime($data['tanggal'])); ?></td>
                                                <td><?= $data['jam']; ?></td>
                                                <td><a href="<?= base_url('pelatih/deleteAbsensi/') . encrypt_url($data['id']); ?>" class="badge badge-danger">Hapus</a></td>
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
    </div>
    <!-- /.container-fluid -->
</div>
</div>
<!-- End of Main Content -->

<!-- Input Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pelatih/inputAbsen'); ?>" method="post">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Hadir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($absen as $a) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= ucwords($a['nama']); ?></td>
                                        <td><input type="checkbox" name="id[]" value="<?= $a['id']; ?>"></td>
                                    </tr>
                                <?php
                                    $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
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
