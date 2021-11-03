<div class="container-fluid">

	<!-- Page Heading -->


	<div class="row">
		<div class="col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-header py3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-secondary">
						<img class="img-profile rounded-circle" width="40" height="40" src="<?= base_url('assets/img/profile/') . $baca['image']; ?>">
						<b><?= ucwords($baca['nama']); ?></b> <small><i><?= "(" . $baca['from'] . ")"; ?></i></small>
					</h6>

					<div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
							<div class="dropdown-header">Aksi :</div>
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#replyModal<?= encrypt_url($baca['id']); ?>">
								<span class="icon text-white-40"><i class="fas fa-reply"></i></span>
								<span class="text">Balas</span>
							</a>
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#forwardModal<?= encrypt_url($baca['id']); ?>">
								<span class="icon text-white-40"><i class="fas fa-share"></i></span>
								<span class="text">Teruskan</span>
							</a>
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal<?= encrypt_url($baca['id']); ?>">
								<span class="icon text-white-40"><i class="fas fa-trash-alt"></i></span>
								<span class="text">Hapus</span>
							</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group">
						<p><b>Subjek :</b> <br><?= decrypt_text($baca['subjek']); ?></p>
						<p><b>Pesan :</b> <br><?= decrypt_text($baca['isi']); ?></p>
					</div>

					<div class="form-group row">
						<div class="col-sm-2">
							<a href="<?= base_url('pesan/inbox'); ?>" class="btn btn-secondary btn-icon-split">
								<span class="icon text-white-40"><i class="fas fa-arrow-left"></i></span>
								<span class="text">Kembali</span>
							</a>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
</div>
</div>

<!-- Reply Modal -->
<div class="modal fade" id="replyModal<?= encrypt_url($baca['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
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
								<option value="<?= $p['email']; ?>" <?php if ($baca['from'] == $p['email']) {
																		echo "selected";
																	} ?> readonly><?= ucwords($p['nama'])  . ' ( ' . $p['nama_unit'] . ')'; ?></option>
							<?php endforeach ?>
						</select>
						<?= form_error('penerima', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>

					<div class="form-group">
						<label for="judul">Subjek</label>
						<input type="text" class="form-control" id="subjek" name="subjek" value="Re : <?= decrypt_text($baca['subjek']); ?>">
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

<!-- Forward Modal -->
<div class="modal fade" id="forwardModal<?= encrypt_url($baca['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?= base_url('pesan/tulisPesan'); ?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Teruskan Pesan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
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
						<input type="text" class="form-control" id="subjek" name="subjek" value="Fwd : <?= decrypt_text($baca['subjek']); ?>" readonly>
						<?= form_error('subjek', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>

					<div class="form-group">
						<label for="exampleFormControlTextarea1">Isi Pesan</label>
						<textarea class="form-control" id="isi" name="isi" rows="3" readonly><?= ucwords($baca['nama']); ?> menulis : <?= decrypt_text($baca['isi']); ?></textarea>
						<?= form_error('isi', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Kirim</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal<?= encrypt_url($baca['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
				<a class="btn btn-primary" href="<?= base_url('pesan/hapusPesanMasuk/') . encrypt_url($baca['id']); ?>">Delete</a>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>