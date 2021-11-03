<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/bootsrap.min.css">
    <script src="<?= base_url('assets'); ?>/vendor/ajax/jquery.min.js"></script>


    <div class="row">
        <div class="col-xl-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Penilaian</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width=100% cellspacing="">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">KD Materi</th>
                                        <th scope="col">Materi</th>
                                        <th scope="col">Penilaian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($materi as $data) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $data['kd_materi']; ?></td>
                                            <td><?= $data['materi']; ?></td>
                                            <td><a href="<?= base_url('ukt/inputNilai/') . $data['kd_materi']; ?>" class="fas fa-edit"></a></td>
                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
</div>