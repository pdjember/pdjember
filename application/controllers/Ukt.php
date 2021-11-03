<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ukt extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('cetak_pdf');
        $this->load->model('Pesan_model', 'pesan');
        $this->load->model('Anggota_model', 'anggota');
        $this->load->model('Ukt_model', 'ukt');
        logged_in();
    }

    public function dataGlobal()
    {
        $data['title'] = 'Data Peserta Global';
        $data['user'] = $this->anggota->getUser();

        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['jml_tingkatan'] = $this->ukt->getJmlTingkatan();
        $data['jml_unit'] = $this->ukt->getJmlUnit();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ukt/dataglobal', $data);
        $this->load->view('templates/footer');
    }
    public function dataPeserta()
    {
        $data['title'] = 'Data Peserta';
        $data['user'] = $this->anggota->getUser();

        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['peserta'] = $this->ukt->getPesertaUkt();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ukt/datapeserta', $data);
        $this->load->view('templates/footer');
    }

    public function penilaian()
    {
        $data['title'] = 'Penilaian UKT';
        $data['user'] = $this->anggota->getUser();

        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['materi'] = $this->ukt->getMateri();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ukt/penilaian', $data);
        $this->load->view('templates/footer');
    }

    function inputNilai($kd_materi_id)
    {
        $data['title'] = 'Input Nilai';
        $data['user'] = $this->anggota->getUser();

        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['materi'] = $this->ukt->getMateri();
        $data['peserta'] = $this->ukt->getPeserta($kd_materi_id);
        $data['nilai'] = $this->ukt->getNilai($kd_materi_id);
        $data['materi_aktif'] = $this->db->get_where('materi_ukt', ['kd_materi' => $kd_materi_id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ukt/input_nilai', $data);
        $this->load->view('templates/footer');
    }

    function simpanNilai()
    {
        $data = $this->input->post();
        unset($data['submit']);
        $this->ukt->simpanNilai($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
        redirect('ukt/penilaian');
    }

    function editNilai()
    {
        $this->db->set('nilai', $this->input->post('nilai'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('nilai_ukt');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Nilai berhasil di ubah.</div>');
        redirect('ukt/penilaian');
    }

    function kenaikanTingkat()
    {
        $data['title'] = 'Kenaikan Tingkat';
        $data['user'] = $this->anggota->getUser();
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['peserta'] = $this->ukt->getKenaikan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ukt/kenaikan_tingkat', $data);
        $this->load->view('templates/footer');
    }

    function nilaiIjazah()
    {
        $data['title'] = 'Nilai Ijazah';
        $data['user'] = $this->anggota->getUser();

        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['materi'] = $this->ukt->getMateri();
        $data['tingkatan'] = $this->ukt->getTingkatan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ukt/nilai_ijazah', $data);
        $this->load->view('templates/footer');
    }

    function cetakNilaiIjazah($tingkatan_id)
    {
        $nilai = $this->ukt->getNilaiIjazah($tingkatan_id);
        $header_data = $this->db->get_where('materi_ukt', ['id_tingkatan' => $tingkatan_id])->result();
        $th_ajaran = $this->db->get_where('th_ajaran', ['aktif' => '1'])->result();

        $pdf = new FPDF('L', 'mm', array(210, 330));
        $pdf->AddPage();


        $cell_width = 30;
        $cell_height = 10;

        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Image('assets/img/icon/BUNGA SEPASANG.png', 15, 8, 20, 18);
        $pdf->Image('assets/img/icon/logo.png', 285, 8, 18, 18);
        $pdf->Cell(0, 7, 'Nilai Akhir Ujian Kenaikan Tingkat', 0, 1, 'C');
        $pdf->Cell(0, 7, 'Perisai Diri Cabang Jember', 0, 1, 'C');
        $pdf->Cell(0, 7, 'Tahun Ajaran :', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(10, $cell_height, 'No', 1, 0, 'C');
        $pdf->Cell(50, $cell_height, 'Nama', 1, 0, 'C');
        $pdf->Cell(40, $cell_height, 'Unit', 1, 0, 'C');

        foreach ($header_data as $data) :

            $pdf->Cell($cell_width, $cell_height, $data->kd_materi, 1, 0, 'C');
        endforeach;
        $pdf->Cell(25, $cell_height, 'Ket', 1, 1, 'C');

        $pdf->SetFont('Arial', 'B', 12);
        $i = 1;
        foreach ($nilai as $n) {
            $pdf->Cell(10, $cell_height, $i, 1, 0, 'C');
            $pdf->Cell(50, '', $i, 1, 0, 'C');
        }

        $pdf->Output();
    }
}
