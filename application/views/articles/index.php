<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
         <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <!-- /.container-fluid -->
        <div class="row">
         	<div class="col-rg	">
         		<?= form_error('menu','<div class="alert alert-danger" role="alert">',' </div>'); ?>
         		<?= $this->session->flashdata('message'); ?>

         		
         		<div class="card card-shadow mb-4">
         			<div class="card-header py-3">
         				<h6 class="m-0 font-weight-bold text-primary">Artikel dan Berita</h6>

         			</div>
         			
         			<div class="card-body">
         				<div class="row">
						    <a href="<?= base_url('articles/inputBerita');?>" class="btn btn-primary btn-icon-split">
						    <span class="icon text-white-40"><i class="fas fa-pencil-alt"></i></span>
						    <span class="text">Tulis Berita</span>	
						    </a>
         				</div>
         				<br>
         				<table class="table table-responsive table-hover" width="100%" cellpadding="0" cellspacing="1">
         				<?php foreach ($berita as $b) : ?>
         					<tr>
         					<td width="750">
         					<a href="<?= base_url('articles/editArticle/').$b['id'];?>"><?= $b['judul']; ?></a> <br>
         					</td>
         					<td><small><i><?= $b['nama']; ?></i></small></td>
         					<td><?= date('d F Y',$b['date_posted']);?></td>
         					<td>
         					<a href="<?= base_url('articles/editArticle/').$b['id'];?>" class="badge badge-success">Edit</a>
         					<a href="<?= base_url('articles/deleteArticle/').$b['id'];?>" class="badge badge-danger">Delete</a>
         					</td>
         					</tr>
         				<?php endforeach; ?>
         				</table>
         			</div>
         		</div>

         	</div>
         </div>
     </div>
 </div>
