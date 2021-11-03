        <!-- Begin Page Content -->
        <div class="container-fluid">

        	<!-- Page Heading -->
        	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        	<div class="row">
        		<div class="col-xl-12">
        			<?= $this->session->flashdata('message'); ?>
        			<a href="" class="btn btn-primary mb-3 btn-icon-split" data-toggle="modal" data-target="#newUnitModal">
        				<span class="icon text-white-40"><i class="fas fa-plus"></i></span>
        				<span class="text">Tambah Unit</span>
        			</a>
        			<div class="table-responsive">
        				<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        					<thead>
        						<tr>
        							<th scope="col">#</th>
        							<th scope="col">Unit Latihan</th>
        							<th scope="col">Alamat</th>
        							<th scope="col">Action</th>
        						</tr>
        					</thead>
        					<tbody>
        						<?php $i = 1; ?>
        						<?php foreach ($unit as $u) : ?>
        							<tr>
        								<th scope="row"><?= $i; ?></th>
        								<td><?= $u['nama_unit']; ?></td>
        								<td><?= $u['alamat']; ?></td>
        								<td>
        									<div class="form-check">
        										<a href="#" class="badge badge-info" data-toggle="modal" data-target="#editModal<?= $u['id']; ?>">Edit</a>
        										<a href="<?= base_url('data/hapusUnit/') . encrypt_url($u['id']); ?>" class="badge badge-danger">Delete</a>
        								</td>
        			</div>
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

        <!-- Insert Modal -->

        <div class="modal fade" id="newUnitModal" tabindex="-1" role="dialog" aria-labelledby="newUnitModalLabel" aria-hidden="true">
        	<div class="modal-dialog" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="newUnitModalLabel">Tambah Unit Baru</h5>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        					<span aria-hidden="true">&times;</span>
        				</button>
        			</div>
        			<form action="<?= base_url('data/unit'); ?>" method="post">
        				<div class="modal-body">
        					<div class="form-group">
        						<input type="text" class="form-control" id="unit" name="unit" placeholder="Nama Unit">
        						<?= form_error('unit', '<small class="text-danger pl-3">', '</small>'); ?>
        					</div>

        					<div class="form-group">
        						<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Unit">
        						<?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
        					</div>

        					<div class="input-group mb-3">
        						<div class="input-group-prepend">
        							<div class="input-group-text">
        								<input type="checkbox" aria-label="Checkbox for following text input" value="1" id="st_aktif" name="st_aktif" checked>
        							</div>
        						</div>
        						<input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Aktif?" readonly>
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

        <!-- Edit Modal -->
        <?php foreach ($unit as $u) : ?>
        	<div class="modal fade" id="editModal<?= $u['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        		<div class="modal-dialog modal-lg" role="document">
        			<div class="modal-content">
        				<div class="modal-header">
        					<h5 class="modal-title" id="exampleModalLabel">Ubah Unit</h5>
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        						<span aria-hidden="true">&times;</span>
        					</button>
        				</div>
        				<div class="modal-body">
        					<form action="<?= base_url('data/ubahUnit'); ?>" method="post">

        						<div class="form-group row">
        							<div class="col-sm-9">
        								<input type="hidden" class="form-control" id="id_unit" name="id_unit" value="<?= encrypt_text($u['id']); ?>" readonly>
        							</div>
        						</div>

        						<div class="form-group row">
        							<label for="nama" class="col-sm-3 col-form-label">Nama Unit</label>
        							<div class="col-sm-9">
        								<input type="text" class="form-control" id="nama" name="nama" value="<?= $u['nama_unit']; ?>">
        							</div>
        						</div>

        						<div class="form-group row">
        							<label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
        							<div class="col-sm-9">
        								<input type="text" class="form-control" id="alamat" name="alamat" value="<?= $u['alamat']; ?>">
        							</div>
        						</div>

        						<div class="form-group row">
        							<label for="ketua" class="col-sm-3 col-form-label">Ketua Unit</label>
        							<div class="col-sm-9">
        								<select class="custom-select" id="ketua" name="ketua">
        									<option value="0" <?php if ($u['id_ketua'] == 0) {
																	echo "selected";
																} ?>>Pilih Anggota ....</option>
        									<?php foreach ($ketua as $a) : ?>
        										<?php if ($a['id_unit'] == $u['id']) { ?>
        											<option value="<?= $a['id']; ?>" <?php if ($u['id_ketua'] == $a['id']) {
																							echo "selected";
																						} ?>><?= ucwords($a['nama']); ?></option>
        										<?php  } ?>

        									<?php endforeach; ?>
        								</select>
        							</div>
        						</div>

        						<div class="form-group row">
        							<label for="ketua" class="col-sm-3 col-form-label">Penanggung Jawab Teknik</label>
        							<div class="col-sm-9">
        								<select class="custom-select" id="pt" name="pt">
        									<option value="0" <?php if ($u['id_pt'] == 0) {
																	echo "selected";
																} ?>>Pilih Anggota ....</option>
        									<?php foreach ($ketua as $a) : ?>
        										<?php if ($a['id_unit'] == $u['id']) { ?>
        											<option value="<?= $a['id']; ?>" <?php if ($u['id_pt'] == $a['id']) {
																							echo "selected";
																						} ?>><?= ucwords($a['nama']); ?></option>
        										<?php  } ?>

        									<?php endforeach; ?>
        								</select>
        							</div>
        						</div>

        						<div class="form-group row">
        							<label for="kehadiran" class="col-sm-3 col-form-label">Jml hari latihan per semester</label>
        							<div class="col-sm-9">
        								<input type="number" class="form-control" id="jml_hari" name="jml_hari" value="<?= $u['jml_hari']; ?>">
        							</div>
        						</div>

        						<div class="form-group row">
        							<label for="kehadiran" class="col-sm-3 col-form-label">Hari latihan</label>
        							<div class="col-sm-9">
        								<?php $hari = explode(",", $u['hari']);  ?>
        								<p><input type="checkbox" name="hari[]" value="0" <?php if (in_array("0", $hari)) {
																								echo "checked";
																							} ?>> Ahad |
        									<input type="checkbox" name="hari[]" value="1" <?php if (in_array("1", $hari)) {
																								echo "checked";
																							} ?>> Senin |
        									<input type="checkbox" name="hari[]" value="2" <?php if (in_array("2", $hari)) {
																								echo "checked";
																							} ?>> Selasa |
        									<input type="checkbox" name="hari[]" value="3" <?php if (in_array("3", $hari)) {
																								echo "checked";
																							} ?>> Rabu |
        									<input type="checkbox" name="hari[]" value="4" <?php if (in_array("4", $hari)) {
																								echo "checked";
																							} ?>> Kamis |
        									<input type="checkbox" name="hari[]" value="5" <?php if (in_array("5", $hari)) {
																								echo "checked";
																							} ?>> Jumat |
        									<input type="checkbox" name="hari[]" value="6" <?php if (in_array("6", $hari)) {
																								echo "checked";
																							} ?>> Sabtu
        								</p>
        							</div>
        						</div>

        						<div class="form-group row">
        							<label for="email" class="col-sm-3 col-form-label">Status Aktif</label>
        							<div class="col-sm-9">
        								<select name="st_aktif" id="st_aktif" class="custom-select">
        									<option value="1" <?php if ($u['st_aktif'] == 1) {
																	echo "selected";
																} ?>>Aktif</option>
        									<option value="0" <?php if ($u['st_aktif'] == 0) {
																	echo "selected";
																} ?>>Tidak Aktif</option>
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
        	</div>
        <?php endforeach; ?>