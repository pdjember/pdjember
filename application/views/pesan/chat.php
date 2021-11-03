<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- /.container-fluid -->
    <div class="row">
        <div class="col-rg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', ' </div>'); ?>
            <?= $this->session->flashdata('message'); ?>

            <div class="card card-shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">


                </div>
            </div>

        </div>
    </div>
</div>
</div>