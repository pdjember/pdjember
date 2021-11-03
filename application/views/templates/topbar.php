<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <!-- Counter - Messages -->
            <?php if ($unread['total'] >= 1) : ?>
              <span class="badge badge-danger badge-counter"><?= $unread['total']; ?></span>
            <?php endif; ?>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">
              Pesan Masuk
            </h6>
            <?php
            if ($unread['total'] == 0) {
              echo "<p class='text-center small text-gray-500'>Tidak ada pesan baru</p>";
            } else {
              foreach ($notifikasi as $n) : ?>
                <a class="dropdown-item d-flex align-items-center" href="<?= base_url('pesan/bacaPesan/' . encrypt_url($n['id'])); ?>">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="<?= base_url('assets/img/profile/') . $n['image']; ?>">
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate"><?= decrypt_text($n['subjek']); ?></div>
                    <div class="small text-gray-500"><?= ucwords($n['nama'])  ?></div>
                  </div>
                </a>
            <?php endforeach;
            } ?>


            <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('pesan/inbox'); ?>">Tampilkan Lebih Banyak</a>
          </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= ucwords($user['nama']); ?></span>
            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
          </a>


          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?= base_url('personal'); ?>">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              My Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editProfil">
              <i class="fas fa-fw fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
              Edit Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePassword">
              <i class="fas fa-fw fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
              Ubah Password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Change Password Modal -->

    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="newFisikModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="changePassword">Ubah Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('personal/changePassword'); ?>" method="post">
            <div class="modal-body">
              <div class="row">
                <div class="col-xl-12">
                  <div class="form-group">
                    <input type="text" class="form-control" id="current_password" name="current_password" placeholder="Password saat ini">
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" id="new_password1" name="new_password1" placeholder="Password Baru">
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" id="new_password2" name="new_password2" placeholder="Ulangi Password">
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

    <!-- Edit Profile Modal -->

    <div class="modal fade" id="editProfil" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="editProfil">Edit Profile</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <?= form_open_multipart('personal/editProfile'); ?>
          <div class="modal-body">
            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="nama" class="col-sm-3 col-form-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" value="<?= ucwords($user['nama']); ?>">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="tmp_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" value="<?= $user['tmp_lahir']; ?>">
                <?= form_error('tmp_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $user['tgl_lahir']; ?>">
                <?= form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
              <div class="col-sm-9">
                <select class="custom-select" name="kelamin">
                  <option>Pilih jenis kelamin</option>
                  <option value="L" <?php if ($user['kelamin'] == "L") {
                                      echo "selected";
                                    } ?>>Laki-laki</option>
                  <option value="P" <?php if ($user['kelamin'] == "P") {
                                      echo "selected";
                                    } ?>>Perempuan</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $user['alamat']; ?>" placeholder="-">
                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="no_hp" class="col-sm-3 col-form-label">No HP/WA</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $user['no_hp']; ?>" placeholder="-">
                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="tb" class="col-sm-3 col-form-label">Tinggi Badan (cm)</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="tb" name="tb" value="<?= $user['tb']; ?>" placeholder="0">
                <?= form_error('tb', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="bb" class="col-sm-3 col-form-label">Berat Badan (kg)</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="bb" name="bb" value="<?= $user['bb']; ?>" placeholder="0">
                <?= form_error('bb', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="no_hp" class="col-sm-3 col-form-label">Tingkatan</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="tingkatan" name="tingkatan" value="<?= $user['tingkatan']; ?>" readonly>
              </div>
            </div>

            <div class="form-group row">
              <label for="no_hp" class="col-sm-3 col-form-label">Unit</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="tingkatan" name="tingkatan" value="<?= $user['nama_unit']; ?>" readonly>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-3">Foto</div>
              <div class="col-sm-9">
                <div class="row">
                  <div class="col-sm-3">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
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
            <div class="form-group row justify-content-end">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>