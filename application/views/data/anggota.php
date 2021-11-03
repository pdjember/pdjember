<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<!-- /.container-fluid -->
	<div class="row">
		<div class="col-xl-12">
			<?= form_error('menu', '<div class="alert alert-danger" role="alert">', ' </div>'); ?>
			<?= $this->session->flashdata('message'); ?>

			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Data Anggota Keseluruhan</h6>
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
									<th scope="col">Tingkatan</th>
									<th scope="col">Unit/Ranting</th>
									<th scope="col">Aktif</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach ($dataAnggota as $d) : ?>
									<tr>
										<td><?= $i; ?></td>
										<td><?= ucwords($d['nama']); ?></td>
										<td><?= ucwords($d['tmp_lahir'])  . ", " . date('d F Y', strtotime($d['tgl_lahir'])); ?></td>
										<td><?= $d['kelamin']; ?></td>
										<td><?= $d['alamat']; ?></td>
										<td><?= $d['no_hp']; ?></td>
										<td><?= $d['tingkatan']; ?></td>
										<td><?= $d['nama_unit']; ?></td>
										<td><input type="checkbox" <?php if ($d['st_aktif'] == 1) {
																		echo "checked";
																	} ?>>
										</td>
										<td>
											<a href="<?= base_url('data/details/') . encrypt_url($d['id']); ?>" class="badge badge-success">Details</a>
											<a href="<?= base_url('data/printData/') . encrypt_url($d['id']); ?>" class="badge badge-warning">Print</a>
											<a href="#" class="badge badge-info" data-toggle="modal" data-target="#editModal<?= $d['id']; ?>">Edit</a>
											<a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?= $d['id']; ?>">Delete</a>
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

<!-- Edit Modal -->
<?php foreach ($dataAnggota as $d) : ?>
	<div class="modal fade" id="editModal<?= $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Menu Baru</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('data/updateAnggota'); ?>" method="post">
						<div class="form-group row">
							<label for="nama" class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nama" name="nama" value="<?= $d['nama']; ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="email" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="email" name="email" value="<?= $d['email']; ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="tingkatan" class="col-sm-2 col-form-label">Tingkatan</label>
							<div class="col-sm-10">
								<select class="custom-select" id="tingkatan" name="tingkatan">
									<?php foreach ($tingkatan as $t) : ?>
										<option value="<?= $t['id']; ?>" <?php if ($d['id_tingkatan'] == $t['id']) {
																				echo "selected";
																			} ?>><?= $t['tingkatan']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="no_hp" class="col-sm-2 col-form-label">Unit/Ranting</label>
							<div class="col-sm-10">
								<select class="custom-select" id="unit" name="unit">
									<?php foreach ($unit as $u) : ?>
										<option value="<?= $u['id']; ?>" <?php if ($d['id_unit'] == $u['id']) {
																				echo "selected";
																			} ?>><?= $u['nama_unit']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="role" class="col-sm-2 col-form-label">Role</label>
							<div class="col-sm-10">
								<select class="custom-select" id="role" name="role">
									<?php foreach ($role as $r) : ?>
										<option value="<?= $r['id']; ?>" <?php if ($d['role_id'] == $r['id']) {
																				echo "selected";
																			} ?>><?= $r['role']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="email" class="col-sm-2 col-form-label">Status Aktif</label>
							<div class="col-sm-10">
								<select name="st_aktif" id="st_aktif" class="custom-select">
									<option value="1" <?php if ($d['st_aktif'] == 1) {
															echo "selected";
														} ?>>Aktif</option>
									<option value="0" <?php if ($d['st_aktif'] == 0) {
															echo "selected";
														} ?>>Tidak Aktif</option>
								</select>
							</div>
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
<?php endforeach; ?>

<!-- Delete Modal-->
<?php foreach ($dataAnggota as $d) : ?>
	<div class="modal fade" id="deleteModal<?= $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteModalLabel">Hapus Data Anggota</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Menghapus data ini akan menghilangkan semua data yang tertaut dengan ID anggota ini. Apakah anda yakin akan menghapus data anggota ini?</div>
				<div class="modal-footer">
					<a class="btn btn-danger" href="<?= base_url('data/deleteAnggota/') . encrypt_url($d['id']); ?>">Delete</a>
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>
