<!-- Begin Page Content -->

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-xl-6">
      <?= $this->session->flashdata('message'); ?>
      <div class="card shadow mb-3">
        <div class="card-header py-2">
          <h6 class="m-0 font-weight-bold text-primary">Informasi Organisasi</h6>
        </div>
        <div class="card-body">

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Nama Organisasi</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= $organisasi['nama_org']; ?></label>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Alamat</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= $organisasi['alamat']; ?></label>
          </div>


          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Ketua Cabang</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= $organisasi['nama']; ?></label>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Wakil Ketua Cabang</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= $organisasi['nama']; ?></label>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Sekretaris Cabang</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= $organisasi['nama']; ?></label>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Bendahara Cabang</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= $organisasi['nama']; ?></label>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label">No Telepon</label>
            <label class="col-sm-0 col-form-label">:</label>
            <label class="col-sm-7 col-form-label"><?= $organisasi['no_telp']; ?></label>
          </div>

        </div>
      </div>

      <?php if ($user['role_id'] == 1) { ?>

        <a href="#" class="btn btn-primary mb-4 btn-icon-split" data-toggle="modal" data-target="#editModal">
          <span class="icon text-white-40"><i class="fas fa-edit"></i></span>
          <span class="text">Ubah Data</span>
        </a>
      <?php
      } ?>

    </div>

    <div class="col-xl-3">
      <div class="row">
        <div class="card mb-3" style="max-width: 300px;">
          <div class="card-body">
            <img src="<?= base_url('assets/img/icon/') . $organisasi['img']; ?>" class="card-img" alt="...">
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="card shadow mb-3">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Kalender Kegiatan <?= $organisasi['nama_org']; ?></h6>
        </div>

        <div class="card-body">
          <div class="col-lg-12">
            <div id="calendar"></div>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data Organisasi</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"></div>

      <div class="col-xl-12">
        <form action="" method="POST">
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama" name="nama" value="<?= $organisasi['nama_org']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama_org" name="nama_org" value="<?= $organisasi['alamat']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="alamat" class="col-sm-3 col-form-label">No Telepon</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama_org" name="nama_org" value="<?= $organisasi['no_telp']; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="ketua" class="col-sm-3 col-form-label">Ketua Cabang</label>
            <div class="col-sm-9">
              <select class="custom-select" id="ketua" name="ketua">
                <option value="0" <?php if ($organisasi['id_ketua'] == 0) {
                                    echo "selected";
                                  } ?>>Pilih Anggota ....</option>
                <?php foreach ($anggota as $a) : ?>
                  <option value="<?= $a['id']; ?>" <?php if ($organisasi['id_ketua'] == $a['id']) {
                                                      echo "selected";
                                                    } ?>><?= ucwords($a['nama']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="ketua" class="col-sm-3 col-form-label">Wakil Ketua Cabang</label>
            <div class="col-sm-9">
              <select class="custom-select" id="wakil" name="wakil">
                <option value="0" <?php if ($organisasi['id_wakil'] == 0) {
                                    echo "selected";
                                  } ?>>Pilih Anggota ....</option>
                <?php foreach ($anggota as $a) : ?>
                  <option value="<?= $a['id']; ?>" <?php if ($organisasi['id_wakil'] == $a['id']) {
                                                      echo "selected";
                                                    } ?>><?= ucwords($a['nama']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="ketua" class="col-sm-3 col-form-label">Sekretaris Cabang</label>
            <div class="col-sm-9">
              <select class="custom-select" id="sekcab" name="sekcab">
                <option value="0" <?php if ($organisasi['id_sekcab'] == 0) {
                                    echo "selected";
                                  } ?>>Pilih Anggota ....</option>
                <?php foreach ($anggota as $a) : ?>
                  <option value="<?= $a['id']; ?>" <?php if ($organisasi['id_sekcab'] == $a['id']) {
                                                      echo "selected";
                                                    } ?>><?= ucwords($a['nama']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="ketua" class="col-sm-3 col-form-label">Bendahara Cabang</label>
            <div class="col-sm-9">
              <select class="custom-select" id="bendahara" name="bendahara">
                <option value="0" <?php if ($organisasi['id_bendahara'] == 0) {
                                    echo "selected";
                                  } ?>>Pilih Anggota ....</option>
                <?php foreach ($anggota as $a) : ?>
                  <option value="<?= $a['id']; ?>" <?php if ($organisasi['id_bendahara'] == $a['id']) {
                                                      echo "selected";
                                                    } ?>><?= ucwords($a['nama']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-3">Logo</div>
            <div class="col-sm-9">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?= base_url('assets/img/icon/') . $organisasi['img']; ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Pilih file</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Update</button>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
</div>