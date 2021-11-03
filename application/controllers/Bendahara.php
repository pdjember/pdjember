<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bendahara extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('cetak_pdf');
        $this->load->model('Pesan_model', 'pesan');
        $this->load->model('Anggota_model', 'anggota');
        $this->load->model('Data_model', 'data');
        $this->load->model('Bendahara_model', 'bendahara');
    }

    function pemasukanCabang()
    {
        $data['title'] = 'Pemasukan Cabang';
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['user'] = $this->anggota->getUser();
        $data['th_ajaran_aktif'] = $this->data->getTh_ajaran();
        $data['transaksi'] = $this->bendahara->getPemasukanCabang();
        $data['pemasukan'] = $this->bendahara->getJmlPemasukanCabang();


        $this->form_validation->set_rules('tgl_trx', 'Tanggal Transaksi', 'required|trim');
        $this->form_validation->set_rules('ket', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bendahara/pemasukan_cab', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'tgl_trx' => $this->input->post('tgl_trx'),
                'jenis_trx' => "D",
                'ket' => $this->input->post('ket'),
                'nominal' => $this->input->post('nominal'),
                'id_th_ajaran' => $this->input->post('th_ajaran'),
                'id_user' => $this->session->userdata('id')
            ];

            $this->db->insert('kas_cabang', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil ditambahkan</div>');
            redirect('bendahara/pemasukanCabang');
        }
    }

    function updatePemasukanCabang()
    {
        $data = [
            'tgl_trx' => $this->input->post('tgl_trx'),
            'ket' => $this->input->post('ket'),
            'nominal' => $this->input->post('nominal'),
            'id_th_ajaran' => $this->input->post('th_ajaran'),
            'id_user' => $this->session->userdata('id')
        ];

        $this->db->where('id', decrypt_url($this->input->post('id')));
        $this->db->update('kas_cabang', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil diubah</div>');
        redirect('bendahara/pemasukanCabang');
    }

    function deletePemasukanCabang($trx_id)
    {
        $this->db->delete('kas_cabang', ['id' => $trx_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil dihapus</div>');
        redirect('bendahara/pemasukanCabang');
    }

    function pemasukanUnit()
    {
        $data['title'] = 'Pemasukan Unit';
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['user'] = $this->anggota->getUser();
        $data['th_ajaran_aktif'] = $this->data->getTh_ajaran();
        $data['transaksi'] = $this->bendahara->getPemasukanUnit();
        $data['pemasukan'] = $this->bendahara->getJmlPemasukanUnit();


        $this->form_validation->set_rules('tgl_trx', 'Tanggal Transaksi', 'required|trim');
        $this->form_validation->set_rules('ket', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bendahara/pemasukan_un', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'id_unit' => $this->session->userdata('id_unit'),
                'tgl_trx' => $this->input->post('tgl_trx'),
                'jenis_trx' => "D",
                'ket' => $this->input->post('ket'),
                'nominal' => $this->input->post('nominal'),
                'id_th_ajaran' => $this->input->post('th_ajaran'),
                'id_user' => $this->session->userdata('id')
            ];

            $this->db->insert('kas_unit', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil ditambahkan</div>');
            redirect('bendahara/pemasukanUnit');
        }
    }

    function updatePemasukanUnit()
    {
        $data = [
            'tgl_trx' => $this->input->post('tgl_trx'),
            'ket' => $this->input->post('ket'),
            'nominal' => $this->input->post('nominal'),
            'id_th_ajaran' => $this->input->post('th_ajaran'),
            'id_user' => $this->session->userdata('id')
        ];

        $this->db->where('id', decrypt_url($this->input->post('id')));
        $this->db->update('kas_unit', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil diubah</div>');
        redirect('bendahara/pemasukanUnit');
    }

    function deletePemasukanUnit($trx_id)
    {
        $this->db->delete('kas_unit', ['id' => $trx_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil dihapus</div>');
        redirect('bendahara/pemasukanUnit');
    }


    function pengeluaranCabang()
    {
        $data['title'] = 'Pengeluaran Cabang';
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['user'] = $this->anggota->getUser();
        $data['th_ajaran_aktif'] = $this->data->getTh_ajaran();
        $data['transaksi'] = $this->bendahara->getPengeluaranCabang();
        $data['pengeluaran'] = $this->bendahara->getJmlPengeluaranCabang();


        $this->form_validation->set_rules('tgl_trx', 'Tanggal Transaksi', 'required|trim');
        $this->form_validation->set_rules('ket', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bendahara/pengeluaran_cab', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'tgl_trx' => $this->input->post('tgl_trx'),
                'jenis_trx' => "C",
                'ket' => $this->input->post('ket'),
                'nominal' => $this->input->post('nominal'),
                'id_th_ajaran' => $this->input->post('th_ajaran'),
                'id_user' => $this->session->userdata('id')
            ];

            $this->db->insert('kas_cabang', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil ditambahkan</div>');
            redirect('bendahara/pengeluaranCabang');
        }
    }

    function updatePengeluaranCabang()
    {
        $data = [
            'tgl_trx' => $this->input->post('tgl_trx'),
            'ket' => $this->input->post('ket'),
            'nominal' => $this->input->post('nominal'),
            'id_th_ajaran' => $this->input->post('th_ajaran'),
            'id_user' => $this->session->userdata('id')
        ];

        $this->db->where('id', decrypt_url($this->input->post('id')));
        $this->db->update('kas_cabang', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil diubah</div>');
        redirect('bendahara/pengeluaranCabang');
    }

    function deletePengeluaranCabang($trx_id)
    {
        $this->db->delete('kas_cabang', ['id' => $trx_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil dihapus</div>');
        redirect('bendahara/pengeluaranCabang');
    }


    function pengeluaranUnit()
    {
        $data['title'] = 'Pengeluaran Unit';
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['user'] = $this->anggota->getUser();
        $data['th_ajaran_aktif'] = $this->data->getTh_ajaran();
        $data['transaksi'] = $this->bendahara->getPengeluaranUnit();
        $data['pengeluaran'] = $this->bendahara->getJmlPengeluaranUnit();


        $this->form_validation->set_rules('tgl_trx', 'Tanggal Transaksi', 'required|trim');
        $this->form_validation->set_rules('ket', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bendahara/pengeluaran_un', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'id_unit' => $this->session->userdata('id_unit'),
                'tgl_trx' => $this->input->post('tgl_trx'),
                'jenis_trx' => "C",
                'ket' => $this->input->post('ket'),
                'nominal' => $this->input->post('nominal'),
                'id_th_ajaran' => $this->input->post('th_ajaran'),
                'id_user' => $this->session->userdata('id')
            ];

            $this->db->insert('kas_unit', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil ditambahkan</div>');
            redirect('bendahara/pengeluaranUnit');
        }
    }

    function updatePengeluaranUnit()
    {
        $data = [
            'tgl_trx' => $this->input->post('tgl_trx'),
            'ket' => $this->input->post('ket'),
            'nominal' => $this->input->post('nominal'),
            'id_th_ajaran' => $this->input->post('th_ajaran'),
            'id_user' => $this->session->userdata('id')
        ];

        $this->db->where('id', decrypt_url($this->input->post('id')));
        $this->db->update('kas_unit', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil diubah</div>');
        redirect('bendahara/pengeluaranUnit');
    }

    function deletePengeluaranUnit($trx_id)
    {
        $this->db->delete('kas_unit', ['id' => $trx_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil dihapus</div>');
        redirect('bendahara/pengeluaranUnit');
    }

    function lap_cabang()
    {
        $data['title'] = 'Laporan Keuangan';
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['user'] = $this->anggota->getUser();
        $data['th_ajaran_aktif'] = $this->data->getTh_ajaran();
        $data['laporan'] = $this->bendahara->getLapCabang();
        $data['jml_masuk'] = $this->bendahara->getJmlPemasukanCabang();
        $data['jml_keluar'] = $this->bendahara->getJmlPengeluaranCabang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bendahara/laporan', $data);
        $this->load->view('templates/footer');
    }

    function lap_unit()
    {
        $data['title'] = 'Laporan Keuangan';
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['user'] = $this->anggota->getUser();
        $data['th_ajaran_aktif'] = $this->data->getTh_ajaran();
        $data['laporan'] = $this->bendahara->getLapUnit();
        $data['jml_masuk'] = $this->bendahara->getJmlPemasukanUnit();
        $data['jml_keluar'] = $this->bendahara->getJmlPengeluaranUnit();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bendahara/laporan_unit', $data);
        $this->load->view('templates/footer');
    }

    function cetakLaporanCabang()
    {

        $this->form_validation->set_rules('tgl_trx1', 'tanggal 1', 'required|trim');
        $this->form_validation->set_rules('tgl_trx2', 'tanggal 2', 'required|trim');

        if ($this->form_validation->run() == false) {

            $lap_all = $this->bendahara->printLaporanCabangAll();
            $jml_pemasukan = $this->bendahara->printPemasukanCabangAll();
            $jml_pengeluaran = $this->bendahara->printPengeluaranCabangAll();

            $pdf = new FPDF('P', 'mm', 'A4');
            $pdf->AddPage();

            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Image('assets/img/icon/BUNGA SEPASANG.png', 15, 8, 26, 21);
            $pdf->Image('assets/img/icon/logo.png', 175, 8, 18, 18);
            $pdf->Cell(0, 7, 'Laporan Keuangan', 0, 1, 'C');
            $pdf->Cell(0, 7, 'Perisai Diri Cabang Jember', 0, 1, 'C');
            $pdf->Cell(10, 7, '', 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(8, 6, 'No', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Tanggal', 1, 0, 'C');
            $pdf->Cell(80, 6, 'Keterangan', 1, 0, 'C');
            $pdf->Cell(20, 6, 'Jenis', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Masuk', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Keluar', 1, 1, 'C');


            $pdf->SetFont('Arial', '', 10);
            $no = 1;
            foreach ($lap_all as $lap) {
                $pdf->Cell(8, 6, $no, 1, 0, 'C');
                $pdf->Cell(30, 6, date('d F Y', strtotime($lap->tgl_trx)), 1, 0, 'C');
                $pdf->Cell(80, 6, $lap->ket, 1, 0);
                if ($lap->jenis_trx == "D") {
                    echo $pdf->Cell(20, 6, "Masuk", 1, 0, 'C');
                } elseif ($lap->jenis_trx == "C") {
                    echo $pdf->Cell(20, 6, "Keluar", 1, 0, 'C');
                }
                if ($lap->jenis_trx == "D") {
                    $pdf->Cell(25, 6, "Rp " . number_format($lap->nominal, 0, ".", "."), 1, 0, 'R');
                    $pdf->Cell(25, 6, "Rp 0", 1, 1, 'R');
                } elseif ($lap->jenis_trx == "C") {
                    $pdf->Cell(25, 6, "Rp 0", 1, 0, 'R');
                    $pdf->Cell(25, 6, "Rp " . number_format($lap->nominal, 0, ".", "."), 1, 1, 'R');
                }
                $no++;
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(118, 8, "Jumlah Pemasukan", 1, 0, 'C');
            foreach ($jml_pemasukan as $pemasukan) :
                $pdf->Cell(70, 8, "Rp " . number_format($pemasukan->jumlah, 0, ".", "."), 1, 1, 'R');
            endforeach;
            $pdf->Cell(118, 8, "Jumlah Pengeluaran", 1, 0, 'C');
            foreach ($jml_pengeluaran as $pengeluaran) :
                $pdf->Cell(70, 8, "Rp " . number_format($pengeluaran->jumlah, 0, ".", "."), 1, 1, 'R');
            endforeach;
            $pdf->Cell(118, 8, "Saldo Akhir", 1, 0, 'C');
            foreach ($jml_pemasukan as $pemasukan) :
                foreach ($jml_pengeluaran as $pengeluaran) {
                    $saldo = ($pemasukan->jumlah) - ($pengeluaran->jumlah);
                    $pdf->Cell(70, 8, "Rp " . number_format($saldo, 0, ".", "."), 1, 1, 'R');
                }

            endforeach;

            $pdf->Output();
        } elseif ($this->form_validation->run() == true) {

            $tgl1 = $this->input->post('tgl_trx1');
            $tgl2 = $this->input->post('tgl_trx2');

            $query = "SELECT * FROM `kas_cabang` WHERE `tgl_trx` BETWEEN '$tgl1' AND '$tgl2' ORDER BY `tgl_trx` ASC";

            $query1 = "SELECT SUM(`nominal`) AS `pemasukan` FROM `kas_cabang` 
        WHERE `jenis_trx`='D' AND `tgl_trx` BETWEEN '$tgl1' AND '$tgl2' ORDER BY `tgl_trx` ASC";

            $query2 = "SELECT SUM(`nominal`) AS `pengeluaran` FROM `kas_cabang` 
        WHERE `jenis_trx`='C' AND `tgl_trx` BETWEEN '$tgl1' AND '$tgl2' ORDER BY `tgl_trx` ASC";

            $data = $this->db->query($query)->result();
            $jml_pemasukan = $this->db->query($query1)->result();
            $jml_pengeluaran = $this->db->query($query2)->result();
            $jml_pemasukan1 = $this->bendahara->printPemasukanCabangAll();
            $jml_pengeluaran1 = $this->bendahara->printPengeluaranCabangAll();

            $pdf = new FPDF('P', 'mm', 'A4');
            $pdf->AddPage();


            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Image('assets/img/icon/BUNGA SEPASANG.png', 15, 8, 26, 21);
            $pdf->Image('assets/img/icon/logo.png', 175, 8, 18, 18);
            $pdf->Cell(0, 7, 'Laporan Keuangan', 0, 1, 'C');
            $pdf->Cell(0, 7, 'Perisai Diri Cabang Jember', 0, 1, 'C');
            $pdf->Cell(10, 7, '', 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(8, 6, 'No', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Tanggal', 1, 0, 'C');
            $pdf->Cell(80, 6, 'Keterangan', 1, 0, 'C');
            $pdf->Cell(20, 6, 'Jenis', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Masuk', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Keluar', 1, 1, 'C');


            $pdf->SetFont('Arial', '', 10);
            $no = 1;
            foreach ($data as $lap) {
                $pdf->Cell(8, 6, $no, 1, 0, 'C');
                $pdf->Cell(30, 6, date('d F Y', strtotime($lap->tgl_trx)), 1, 0, 'C');
                $pdf->Cell(80, 6, $lap->ket, 1, 0);
                if ($lap->jenis_trx == "D") {
                    echo $pdf->Cell(20, 6, "Masuk", 1, 0, 'C');
                } elseif ($lap->jenis_trx == "C") {
                    echo $pdf->Cell(20, 6, "Keluar", 1, 0, 'C');
                }
                if ($lap->jenis_trx == "D") {
                    $pdf->Cell(25, 6, "Rp " . number_format($lap->nominal, 0, ".", "."), 1, 0, 'R');
                    $pdf->Cell(25, 6, "Rp 0", 1, 1, 'R');
                } elseif ($lap->jenis_trx == "C") {
                    $pdf->Cell(25, 6, "Rp 0", 1, 0, 'R');
                    $pdf->Cell(25, 6, "Rp " . number_format($lap->nominal, 0, ".", "."), 1, 1, 'R');
                }
                $no++;
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(118, 8, "Jumlah Pemasukan", 1, 0, 'C');
            foreach ($jml_pemasukan as $pemasukan) :
                $pdf->Cell(70, 8, "Rp " . number_format($pemasukan->pemasukan, 0, ".", "."), 1, 1, 'R');
            endforeach;
            $pdf->Cell(118, 8, "Jumlah Pengeluaran", 1, 0, 'C');
            foreach ($jml_pengeluaran as $pengeluaran) :
                $pdf->Cell(70, 8, "Rp " . number_format($pengeluaran->pengeluaran, 0, ".", "."), 1, 1, 'R');
            endforeach;
            $pdf->Cell(118, 8, "Saldo Akhir", 1, 0, 'C');
            foreach ($jml_pemasukan1 as $pemasukan) :
                foreach ($jml_pengeluaran1 as $pengeluaran) {
                    $saldo = ($pemasukan->jumlah) - ($pengeluaran->jumlah);
                    $pdf->Cell(70, 8, "Rp " . number_format($saldo, 0, ".", "."), 1, 1, 'R');
                }

            endforeach;
            $pdf->Output();
        }
    }

    function cetakLaporanUnit()
    {
        $this->form_validation->set_rules('tgl_trx1', 'tanggal 1', 'required|trim');
        $this->form_validation->set_rules('tgl_trx2', 'tanggal 2', 'required|trim');

        if ($this->form_validation->run() == true) {
            $tgl1 = $this->input->post('tgl_trx1');
            $tgl2 = $this->input->post('tgl_trx2');
            $unit = $this->session->userdata('id_unit');

            $query = "SELECT * FROM `kas_unit` 
                WHERE `id_unit`='$unit' AND `tgl_trx` BETWEEN '$tgl1' AND '$tgl2' ORDER BY `tgl_trx` ASC";

            $query1 = "SELECT SUM(`nominal`) AS `pemasukan` FROM `kas_unit` 
        WHERE `id_unit`='$unit' AND `jenis_trx`='D' AND `tgl_trx` BETWEEN '$tgl1' AND '$tgl2' ORDER BY `tgl_trx` ASC";

            $query2 = "SELECT SUM(`nominal`) AS `pengeluaran` FROM `kas_unit` 
        WHERE `id_unit`='$unit' AND `jenis_trx`='C' AND `tgl_trx` BETWEEN '$tgl1' AND '$tgl2' ORDER BY `tgl_trx` ASC";

            $query3 = "SELECT * FROM `unit` WHERE `id`='$unit'";

            $data = $this->db->query($query)->result();
            $jml_pemasukan = $this->db->query($query1)->result();
            $jml_pengeluaran = $this->db->query($query2)->result();
            $jml_pemasukan1 = $this->bendahara->printPemasukanUnitAll();
            $jml_pengeluaran1 = $this->bendahara->printPengeluaranUnitAll();
            $unit2 = $this->db->query($query3)->result();

            $pdf = new FPDF('P', 'mm', 'A4');
            $pdf->AddPage();

            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Image('assets/img/icon/BUNGA SEPASANG.png', 15, 10, 27, 22);
            $pdf->Image('assets/img/icon/logo.png', 175, 10, 18, 18);
            $pdf->Cell(0, 7, 'Laporan Keuangan', 0, 1, 'C');
            $pdf->Cell(0, 7, 'Perisai Diri Cabang Jember', 0, 1, 'C');
            foreach ($unit2 as $u) :
                $pdf->Cell(0, 7, 'Unit : ' . $u->nama_unit, 0, 1, 'C');
            endforeach;
            $pdf->Cell(10, 7, '', 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(8, 6, 'No', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Tanggal', 1, 0, 'C');
            $pdf->Cell(80, 6, 'Keterangan', 1, 0, 'C');
            $pdf->Cell(20, 6, 'Jenis', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Masuk', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Keluar', 1, 1, 'C');


            $pdf->SetFont('Arial', '', 10);
            $no = 1;
            foreach ($data as $lap) {
                $pdf->Cell(8, 6, $no, 1, 0, 'C');
                $pdf->Cell(30, 6, date('d F Y', strtotime($lap->tgl_trx)), 1, 0, 'C');
                $pdf->Cell(80, 6, $lap->ket, 1, 0);
                if ($lap->jenis_trx == "D") {
                    echo $pdf->Cell(20, 6, "Masuk", 1, 0, 'C');
                } elseif ($lap->jenis_trx == "C") {
                    echo $pdf->Cell(20, 6, "Keluar", 1, 0, 'C');
                }
                if ($lap->jenis_trx == "D") {
                    $pdf->Cell(25, 6, "Rp " . number_format($lap->nominal, 0, ".", "."), 1, 0, 'R');
                    $pdf->Cell(25, 6, "Rp 0", 1, 1, 'R');
                } elseif ($lap->jenis_trx == "C") {
                    $pdf->Cell(25, 6, "Rp 0", 1, 0, 'R');
                    $pdf->Cell(25, 6, "Rp " . number_format($lap->nominal, 0, ".", "."), 1, 1, 'R');
                }
                $no++;
            }
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(118, 8, "Jumlah Pemasukan", 1, 0, 'C');
            foreach ($jml_pemasukan as $pemasukan) :
                $pdf->Cell(70, 8, "Rp " . number_format($pemasukan->pemasukan, 0, ".", "."), 1, 1, 'R');
            endforeach;
            $pdf->Cell(118, 8, "Jumlah Pengeluaran", 1, 0, 'C');
            foreach ($jml_pengeluaran as $pengeluaran) :
                $pdf->Cell(70, 8, "Rp " . number_format($pengeluaran->pengeluaran, 0, ".", "."), 1, 1, 'R');
            endforeach;
            $pdf->Cell(118, 8, "Saldo Akhir", 1, 0, 'C');
            foreach ($jml_pemasukan1 as $pemasukan) :
                foreach ($jml_pengeluaran1 as $pengeluaran) {
                    $saldo = ($pemasukan->jumlah) - ($pengeluaran->jumlah);
                    $pdf->Cell(70, 8, "Rp " . number_format($saldo, 0, ".", "."), 1, 1, 'R');
                }
            endforeach;
            $pdf->Output();
        } elseif ($this->form_validation->run() == false) {

            $data = $this->bendahara->printLaporanUnitAll();
            $jml_pemasukan = $this->bendahara->printPemasukanUnitAll();
            $jml_pengeluaran = $this->bendahara->printPengeluaranUnitAll();

            $unit = $this->session->userdata('id_unit');
            $query3 = "SELECT * FROM `unit` WHERE `id`='$unit'";
            $unit2 = $this->db->query($query3)->result();

            $pdf = new FPDF('P', 'mm', 'A4');

            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 18);

            $pdf->Image('assets/img/icon/BUNGA SEPASANG.png', 15, 10, 27, 22);
            $pdf->Image('assets/img/icon/logo.png', 175, 10, 18, 18);
            $pdf->Cell(0, 7, 'Laporan Keuangan', 0, 1, 'C');
            $pdf->Cell(0, 7, 'Perisai Diri Cabang Jember', 0, 1, 'C');
            foreach ($unit2 as $u) :
                $pdf->Cell(0, 7, 'Unit : ' . $u->nama_unit, 0, 1, 'C');
            endforeach;
            $pdf->Cell(10, 7, '', 0, 1);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(8, 6, 'No', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Tanggal', 1, 0, 'C');
            $pdf->Cell(80, 6, 'Keterangan', 1, 0, 'C');
            $pdf->Cell(20, 6, 'Jenis', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Masuk', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Keluar', 1, 1, 'C');


            $pdf->SetFont('Arial', '', 10);
            $no = 1;
            foreach ($data as $lap) {
                $pdf->Cell(8, 6, $no, 1, 0, 'C');
                $pdf->Cell(30, 6, date('d F Y', strtotime($lap->tgl_trx)), 1, 0, 'C');
                $pdf->Cell(80, 6, $lap->ket, 1, 0);
                if ($lap->jenis_trx == "D") {
                    echo $pdf->Cell(20, 6, "Masuk", 1, 0, 'C');
                } elseif ($lap->jenis_trx == "C") {
                    echo $pdf->Cell(20, 6, "Keluar", 1, 0, 'C');
                }
                if ($lap->jenis_trx == "D") {
                    $pdf->Cell(25, 6, "Rp " . number_format($lap->nominal, 0, ".", "."), 1, 0, 'R');
                    $pdf->Cell(25, 6, "Rp 0", 1, 1, 'R');
                } elseif ($lap->jenis_trx == "C") {
                    $pdf->Cell(25, 6, "Rp 0", 1, 0, 'R');
                    $pdf->Cell(25, 6, "Rp " . number_format($lap->nominal, 0, ".", "."), 1, 1, 'R');
                }
                $no++;
            }
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(118, 8, "Jumlah Pemasukan", 1, 0, 'C');
            foreach ($jml_pemasukan as $pemasukan) :
                $pdf->Cell(70, 8, "Rp " . number_format($pemasukan->jumlah, 0, ".", "."), 1, 1, 'R');
            endforeach;
            $pdf->Cell(118, 8, "Jumlah Pengeluaran", 1, 0, 'C');
            foreach ($jml_pengeluaran as $pengeluaran) :
                $pdf->Cell(70, 8, "Rp " . number_format($pengeluaran->jumlah, 0, ".", "."), 1, 1, 'R');
            endforeach;
            $pdf->Cell(118, 8, "Saldo Akhir", 1, 0, 'C');
            foreach ($jml_pemasukan as $pemasukan) :
                foreach ($jml_pengeluaran as $pengeluaran) {
                    $saldo = ($pemasukan->jumlah) - ($pengeluaran->jumlah);
                    $pdf->Cell(70, 8, "Rp " . number_format($saldo, 0, ".", "."), 1, 1, 'R');
                }
            endforeach;
            $pdf->Output();
        }
    }
}
