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
				<span class="text">Tambah Sub Menu</span>
			</a>
			<div class="table-responsive">
				<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Title</th>
							<th scope="col">Menu</th>
							<th scope="col">Url</th>
							<th scope="col">Icon</th>
							<th scope="col">Active</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($subMenu as $sm) : ?>
							<tr>
								<th scope="row"><?= $i; ?></th>
								<td><?= $sm['title']; ?></td>
								<td><?= $sm['menu']; ?></td>
								<td><?= $sm['url']; ?></td>
								<td><?= $sm['icon']; ?></td>
								<td>
									<input type="checkbox" <?php
															if ($sm['is_active'] == 1) {
																echo "checked";
															} ?>>
								</td>
								<td>
									<a href="#" class="badge badge-success" data-toggle="modal" data-target="#editModal<?= $sm['id']; ?>">Edit</a>
									<a href="<?= base_url('admin/deleteSubMenu/') . $sm['id'] ?>" class="badge badge-danger">Delete</a>
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
<!-- Modal tambah submenu-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Sub Menu baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/submenu'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="title" name="title" placeholder="Nama sub menu">
					</div>
					<div class="form-group">
						<select name="menu_id" id="menu_id" class="custom-select">
							<option value="">Pilih menu</option>
							<?php foreach ($menu as $m) : ?>
								<option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>

							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="url" name="url" placeholder="url submenu">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input type="checkbox" aria-label="Checkbox for following text input" value="1" id="is_active" name="is_active" checked>
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

<!-- Modal edit submenu-->
<?php foreach ($subMenu as $sm) : ?>
	<div class="modal fade" id="editModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Edit Sub Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('admin/updateSubMenu'); ?>" method="post">
					<div class="modal-body">
						<div class="form-group">
							<input type="hidden" class="form-control" id="id" name="id" value="<?= $sm['id']; ?>" readonly>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="title" name="title" value="<?= $sm['title']; ?>">
						</div>
						<div class="form-group">
							<select name="menu_id" id="menu_id" class="custom-select">
								<option value="">Pilih menu</option>
								<?php foreach ($menu as $m) : ?>
									<option value="<?= $m['id']; ?>" <?php if ($sm['menu_id'] == $m['id']) {
																			echo "selected";
																		} ?>><?= $m['menu']; ?></option>

								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="url" name="url" value="<?= $sm['url']; ?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="icon" name="icon" value="<?= $sm['icon']; ?>">
						</div>
						<div class="form-group">
							<select name="is_active" id="is_active" class="custom-select">
								<option value="1" <?php if ($sm['is_active'] == 1) {
														echo "selected";
													} ?>>Aktif</option>
								<option value="0" <?php if ($sm['is_active'] == 0) {
														echo "selected";
													} ?>>Tidak Aktif</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Update</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>