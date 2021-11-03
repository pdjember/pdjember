<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<!-- /.container-fluid -->
	<div class="row">
		<div class="col-xl-12">
			<?= form_error('menu', '<div class="alert alert-danger" role="alert">', ' </div>'); ?>
			<?= $this->session->flashdata('message'); ?>

			<div class="card card-shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
				</div>
				<div class="card-body">
					<a href="" class="btn btn-primary mb-3 btn-icon-split" data-toggle="modal" data-target="#tulisPesanModal">
						<span class="icon text-white-40"><i class="fas fa-fw fa-pencil-alt"></i></span>
						<span class="text">Tulis Pesan</span></a>
					<div class="table-responsive">
						<table class="table table-hover" id="dataTable" width="100%" cellpadding="0" cellspacing="0">
							<thead>
								<th scope="col">Subjek</th>
								<th scope="col">Pengirim</th>
								<th scope="col">Tanggal</th>
								<th scope="col">Action</th>
							</thead>
							<tbody>
								<?php foreach ($inbox as $i) : ?>
									<tr>
										<td width="">
											<?php if ($i['to_read'] == 0) { ?>
												<a href="<?= base_url('pesan/bacaPesan/' . encrypt_url($i['id'])); ?>"><b><?= decrypt_text($i['subjek']); ?></b></a>
											<?php } else { ?> <a href="<?= base_url('pesan/bacaPesan/' . encrypt_url($i['id'])); ?>"><?= decrypt_text($i['subjek']); ?></a> <?php } ?>
										</td>
										<td><small><i><?= ucwords($i['nama']); ?></i></small></td>
										<td><?= date('d F Y', $i['date_sent']); ?></td>
										<td>
											<a href="#" class="fas fa-trash" data-toggle="modal" data-target="#deleteModal<?= encrypt_url($i['id']); ?>"></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</div>

<!-- Kirim Pesan Modal -->
<div class="modal fade" id="tulisPesanModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editModalLabel">Balas Pesan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('pesan/tulisPesan'); ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="judul">Penerima</label>
						<select class="custom-select" name="penerima" id="penerima">
							<option value="0" selected>Pilih Penerima ...</option>
							<?php foreach ($penerima as $p) : ?>
								<option value="<?= $p['email']; ?>"><?= ucwords($p['nama'])  . ' ( ' . $p['nama_unit'] . ')'; ?></option>
							<?php endforeach ?>
						</select>
						<?= form_error('penerima', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
					<div class="form-group">
						<label for="judul">Subjek</label>
						<input type="text" class="form-control" id="subjek" name="subjek">
						<?= form_error('subjek', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>

					<div class="form-group">
						<label for="exampleFormControlTextarea1">Isi Pesan</label>
						<textarea class="form-control" id="isi" name="isi" rows="3"></textarea>
						<?= form_error('isi', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Kirim</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Delete Modal-->
<?php foreach ($inbox as $i) : ?>
	<div class="modal fade" id="deleteModal<?= encrypt_url($i['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteModalLabel">Hapus Pesan</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Apakah anda yakin akan menghapus pesan ini?</div>
				<div class="modal-footer">
					<a class="btn btn-primary" href="<?= base_url('pesan/hapusPesanMasuk/') . encrypt_url($i['id']); ?>">Delete</a>
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>