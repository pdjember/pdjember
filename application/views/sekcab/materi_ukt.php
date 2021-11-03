<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<!-- Content -->
	<div class="row">
		<div class="col-rg-8">
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
							<th scope="col">Kode Materi</th>
							<th scope="col">Materi</th>
							<th scope="col">Tingkatan</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($materi_ukt as $m) : ?>
							<tr>
								<th scope="row"><?= $i; ?></th>
								<td><?= $m['kd_materi']; ?></td>
								<td><?= $m['materi']; ?></td>
								<td><?= $m['tingkatan']; ?></td>
								<td><a href="<?= base_url('sekcab/deleteMateriUkt/') . $m['id'] ?>" class="badge badge-danger">Delete</a></td>
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
			<form action="<?= base_url('sekcab/materiUkt'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<select name="tingkatan" id="tingkatan" class="custom-select">
							<option value="">Pilih Tingkatan</option>
							<?php foreach ($tingkatan as $t) : ?>
								<option value="<?= $t['id']; ?>"><?= $t['tingkatan']; ?></option>

							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="kd_materi" name="kd_materi" placeholder="Kode Materi">
						<?= form_error('kd_materi', '<small class="text-danger pl-3">', '</small>') ?>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="materi" name="materi" placeholder="Materi">
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