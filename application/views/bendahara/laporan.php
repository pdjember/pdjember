<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                    <!-- <a href="<?= base_url('bendahara/cetakLaporanCabang'); ?>" class="btn btn-primary mb-3 btn-icon-split">-->
                    <a href="#" class="btn btn-primary mb-3 btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                        <span class="icon text-white-40"><i class="fas fa-print"></i></span>
                        <span class="text">Cetak Laporan per periode</span>
                    </a>

                    <a href="<?= base_url('bendahara/cetakLaporanCabang'); ?>" class="btn btn-secondary mb-3 btn-icon-split">
                        <span class="icon text-white-40"><i class="fas fa-print"></i></span>
                        <span class="text">Cetak Laporan Total</span>
                    </a>

                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Masuk</th>
                                <th scope="col">Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($laporan as $trx) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= date('d F Y', strtotime($trx['tgl_trx'])); ?></td>
                                    <td><?= $trx['ket']; ?></td>
                                    <td><?php if ($trx['jenis_trx'] == "D") {
                                            echo "Masuk";
                                        } else if ($trx['jenis_trx'] == "C") {
                                            echo "Keluar";
                                        } ?></td>
                                    <td><?= $trx['semester']; ?></td>
                                    <td><?= $trx['th_ajaran']; ?></td>
                                    <td><?php if ($trx['jenis_trx'] == "D") {
                                            echo "Rp " . number_format($trx['nominal'], 0, ".", ".");
                                        } else {
                                            echo "Rp 0";
                                        } ?></td>
                                    <td><?php if ($trx['jenis_trx'] == "C") {
                                            echo "Rp " . number_format($trx['nominal'], 0, ".", ".");
                                        } else {
                                            echo "Rp 0";
                                        } ?></td>
                                </tr>
                            <?php $i++;
                            endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <h5><b>Jumlah Pemasukan</b></h5>
                                </td>
                                <td colspan="2">
                                    <?php foreach ($jml_masuk as $pemasukan) : ?>
                                        <h5><b><?= "Rp " . number_format($pemasukan['jml_pemasukan'], 0, ".", "."); ?></b></h5>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <h5><b>Jumlah Pengeluaran</b></h5>
                                </td>
                                <td colspan="2">
                                    <?php foreach ($jml_keluar as $pengeluaran) : ?>
                                        <h5><b><?= "Rp " . number_format($pengeluaran['jml_pengeluaran'], 0, ".", "."); ?></b></h5>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <h5><b>Saldo Akhir</b></h5>
                                </td>
                                <td colspan="2">
                                    <?php foreach ($jml_keluar as $keluar) : ?>
                                        <?php foreach ($jml_masuk as $masuk) {
                                            $saldo = $masuk['jml_pemasukan'] - $keluar['jml_pengeluaran']; ?>
                                            <h5><b><?= "Rp " . number_format($saldo, 0, ".", "."); ?></b></h5>
                                    <?php }
                                    endforeach; ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
</div>

<!-- Cetak laporan modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('bendahara/cetakLaporanCabang'); ?>" method="POST">
                    <div class="form-group row">
                        <label for="tgl_trx" class="col-sm-3 col-form-label">Dari tanggal</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl_trx1" name="tgl_trx1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_trx" class="col-sm-3 col-form-label">Sampai tanggal</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl_trx2" name="tgl_trx2">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Cetak</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>