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
                <span class="text">Tambah Data</span>
            </a>

            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Atlit</th>
                            <th scope="col">Event / Lomba</th>
                            <th scope="col">Tanggal Lomba</th>
                            <th scope="col">Juara</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Usia</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($prestasi as $data) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= ucwords($data['nama']); ?></td>
                                <td><?= $data['event']; ?></td>
                                <td><?= date('d F Y', strtotime($data['tgl_event'])); ?></td>
                                <td><?= $data['juara']; ?></td>
                                <td><?= $data['kategori']; ?></td>
                                <td><?= $data['kelas']; ?></td>
                                <td><?= $data['usia']; ?></td>
                                <td>
                                    <a href="<?= base_url('data/deletePrestasi/') . encrypt_url($data['id'])  ?>" class="badge badge-danger">Delete</a>
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
<!-- Modal tambah data-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('data/prestasi'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_atlit">Pilih Atlit</label>
                        <select class="custom-select" name="id_anggota" id="id_anggota">
                            <option value="0" selected>Pilih Anggota ...</option>
                            <?php foreach ($anggota as $a) : ?>
                                <option value="<?= $a['id']; ?>"><?= ucwords($a['nama']) . ' ( ' . $a['nama_unit'] . ')'; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="event">Nama Pertandingan</label>
                        <input type="text" class="form-control" id="event" name="event">
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal Pertandingan</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>

                    <div class="form-group">
                        <label for="juara">Juara</label>
                        <select class="custom-select" name="juara" id="juara">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="custom-select" name="kategori" id="kategori">
                            <?php foreach ($kategori as $k) { ?>
                                <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas Pertandingan</label>
                        <select class="custom-select" name="kelas" id="kelas">
                            <option value="-">-</option>
                            <?php $arr_aj = range('A', 'J');
                            foreach ($arr_aj as $abjad) { ?>
                                <option value="<?= $abjad; ?>"><?= $abjad; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="juara">Usia</label>
                        <select class="custom-select" name="usia" id="usia">
                            <option value="Pra-remaja">Pra-remaja</option>
                            <option value="Remaja">Remaja</option>
                            <option value="Dewasa">Dewasa</option>
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