<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-4">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-3">
                <form action="<?= base_url('sekcab/jadwal'); ?>" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="kegiatan">Keterangan Kegiatan</label>
                            <textarea name="kegiatan" class="form-control" id="kegiatan" cols="30" rows="2"></textarea>
                        </div>
                        <div class="form-group mt-4">
                            <label for="mulai" class="form-label"> Tgl Mulai</label>
                            <input type="datetime-local" class="form-control" name="mulai" id="mulai">
                        </div>
                        <div class="form-group mt-4">
                            <label class="form-label" for="selesai">Tgl Selesai</label>
                            <input type="datetime-local" class="form-control" name="selesai" id="selesai">
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-8">
            <div id="calendar"></div>
        </div>
    </div>

    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
</div>
