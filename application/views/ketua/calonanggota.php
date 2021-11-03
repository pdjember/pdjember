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
					<h6 class="m-0 font-weight-bold text-primary">Data Calon Anggota</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Nama</th>
									<th scope="col">Email</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach ($anggota as $a) : ?>
									<tr>
										<td><?= $i; ?></td>
										<td><?= ucwords($a['nama']); ?></td>
										<td><?= $a['email']; ?></td>
										<td><a href="<?= base_url('ketua/aktivasiAnggota/') . encrypt_url($a['id']); ?>" class="badge badge-success">Aktivasi</a> <a href="<?= base_url('ketua/deleteCalonAnggota/') . encrypt_url($a['id']); ?>" class="badge badge-danger">Delete</a></td>
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
