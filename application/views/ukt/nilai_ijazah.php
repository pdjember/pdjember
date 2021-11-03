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
                    <h6 class="m-0 font-weight-bold text-primary">Data <?= $title; ?> Menurut Tingkatan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width=100% cellspacing="">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tingkatan</th>
                                        <th scope="col">Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($tingkatan as $data) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $data->tingkatan; ?></td>
                                            <td><a href="<?= base_url('ukt/cetakNilaiIjazah/') . $data->id; ?>" class="fas fa-print"></a></td>
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