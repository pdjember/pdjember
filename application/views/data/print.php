<!-- Begin Page Content -->
<div class="container-fluid">
   <img src="<?= base_url('assets/img/logo.png'); ?>" alt="">
   <center>
      <h1><?= $title ?></h1>
      <h2><?= $sub_title ?></h2><br>
   </center>

   <!-- Page Heading -->


   <div class="row">
      <div class="col-lg-8">
         <table border="0">
            <tr>
               <td width="150">Nama</td>
               <td width="10">:</td>
               <td width="250"><?= $user['nama'] ?></td>
               <td rowspan="6"><img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail" width="105" height="125"></td>
            </tr>
            <tr>
               <td>Tempat & Tanggal Lahir</td>
               <td>:</td>
               <td><?= $user['tmp_lahir'] . ', ' . date('d F Y', strtotime($user['tgl_lahir'])); ?></td>

            </tr>
            <tr>
               <td>Jenis Kelamin</td>
               <td>:</td>
               <td><?php if ($user['kelamin'] == "L") { ?>
                     Laki-laki
                  <?php } else { ?>
                     Perempuan
                  <?php } ?></td>
            </tr>

            <tr>
               <td>Alamat</td>
               <td>:</td>
               <td><?= $user['alamat'] ?></td>
            </tr>
            <tr>
               <td>No HP/WA</td>
               <td>:</td>
               <td><?= $user['no_hp'] ?></td>

            </tr>

            <tr>
               <td>Email</td>
               <td>:</td>
               <td><?= $user['email'] ?></td>
            </tr>

            <tr>
               <td>Tingkatan</td>
               <td>:</td>
               <td><?= $user['tingkatan'] ?></td>

            </tr>

            <tr>
               <td>Unit Ranting</td>
               <td>:</td>
               <td><?= $user['nama_unit'] ?></td>

            </tr>
         </table>




      </div>
   </div>

</div>
<!-- End of Main Content -->
</div>