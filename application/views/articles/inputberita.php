<div class="container-fluid">

          <!-- Page Heading -->
         <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

         <div class="row">
         	<div class="col-lg-8">
         		<?= form_open_multipart('articles/inputBerita'); ?>
         		<div class="form-group">
				    <label for="judul">Judul Berita</label>
				    <input type="text" class="form-control" id="judul" name="judul">
				    <?= form_error('judul','<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="form-group">
				    <label for="exampleFormControlTextarea1">Isi Berita</label>
				    <textarea class="form-control" id="isi" name="isi" rows="3"></textarea>
				    <?= form_error('isi','<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				 <div class="form-group">
				 	<label for="exampleFormControlTextarea1">Foto Berita</label>
				    <div class="col-sm-10">
				    	<div class="row">
				    		<div class="col-sm-3">
				    			<img src="<?= base_url('assets/img/article/default.jpg'); ?>" class="img-thumbnail">
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

				  <div class="form-group row">
				  	<div class="col-sm-10">
				  		<button type="submit" class="btn btn-primary btn-icon-split">
				  		<span class="icon text-white-40"><i class="fas fa-plus"></i></span>
				  		<span class="text">Posting Berita</span>
				  	</button>
				  	</div>
				  	<div class="col-sm-2">
				  		<a href="<?= base_url('articles');?>" class="btn btn-secondary btn-icon-split">
						    <span class="icon text-white-40"><i class="fas fa-arrow-left"></i></span>
						    <span class="text">Kembali</span>	
						</a>
				  	</div>
				  </div>

         		</form>
         		</div>
         	</div>
         </div>
     </div>