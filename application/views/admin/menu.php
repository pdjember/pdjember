<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



	<div class="row">
		<div class="col-rg-6">
			<?= form_error('menu', '<div class="alert alert-danger" role="alert">', ' </div>'); ?>
			<?= $this->session->flashdata('message'); ?>

			<a href="" class="btn btn-primary mb-3 btn-icon-split" data-toggle="modal" data-target="#exampleModal">
				<span class="icon text-white-40"><i class="fas fa-plus"></i></span>
				<span class="text">Tambah Menu</span></a>
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Menu</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($menu as $m) : ?>
						<tr>
							<th scope="row"><?= $i; ?></th>
							<td><?= $m['menu']; ?></td>
							<td><a href="" class="badge badge-success" data-toggle="modal" data-target="#editModal<?= $m['id']; ?>">Edit</a> <a href="<?= base_url('admin/deleteMenu/') . $m['id']; ?>" class="badge badge-danger">Delete</a></td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Menu Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/menu'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="menu" name="menu" placeholder="Nama menu">
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

<?php foreach ($menu as $m) : ?>
	<div class="modal fade" id="editModal<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Edit Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('admin/updateMenu'); ?>" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="id">ID Menu</label>
							<input type="text" class="form-control" id="id" name="id" value="<?= $m['id']; ?>" readonly>
						</div>
						<div class="form-group">
							<label for="menu">Nama Menu</label>
							<input type="text" class="form-control" id="menu" name="menu" value="<?= $m['menu']; ?>">
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
