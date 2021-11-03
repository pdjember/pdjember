<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sekcab extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pesan_model', 'pesan');
        $this->load->model('Anggota_model', 'anggota');
        $this->load->model('Data_model', 'data');
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Ukt_model', 'ukt');
        logged_in();
    }

    function materiUkt()
    {
        $data['title'] = 'Materi UKT';
        $data['menu'] = $this->menu->getMenu();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['user'] = $this->anggota->getUser();
        $data['tingkatan'] = $this->data->getTingkatan();
        $data['materi_ukt'] = $this->data->getMateriUkt();

        $this->form_validation->set_rules('materi', 'Materi', 'required');
        $this->form_validation->set_rules('tingkatan', 'Tingkatan', 'required');
        $this->form_validation->set_rules('kd_materi', 'KD Materi', 'required|trim|is_unique[materi_ukt.kd_materi]', [
            'required' => 'Kode Materi harus diisi!',
            'is_unique' => 'Kode materi sudah terdaftar, ganti dengan yang lain!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sekcab/materi_ukt', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_tingkatan' => $this->input->post('tingkatan'),
                'materi' => $this->input->post('materi'),
                'kd_materi' => $this->input->post('kd_materi')
            ];
            $this->db->insert('materi_ukt', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan</div>');
            redirect('sekcab/materiukt');
        }
    }

    function deleteMateriUkt($materi_ukt_id)
    {
        $this->db->delete('materi_ukt', ['id' => $materi_ukt_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
        redirect('sekcab/materiUkt');
    }

    function pengujiUkt()
    {
        $data['title'] = 'Penguji UKT';
        $data['menu'] = $this->menu->getMenu();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['user'] = $this->anggota->getUser();
        $data['pelatih'] = $this->data->getPelatih();
        $data['tingkatan'] = $this->data->getTingkatan();
        $data['penguji'] = $this->ukt->getPenguji();

        $this->form_validation->set_rules('id_anggota', 'ID', 'required|trim');
        $this->form_validation->set_rules('tingkatan', 'Tingkatan', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sekcab/penguji_ukt', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_anggota' => $this->input->post('id_anggota'),
                'penguji' => $this->input->post('tingkatan')
            ];
            $this->db->insert('penguji_ukt', $data);
            $this->db->set('role_id', 8);
            $this->db->where('id', $this->input->post('id_anggota'));
            $this->db->update('anggota');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan</div>');
            redirect('sekcab/pengujiUkt');
        }
    }

    function deletePenguji($penguji_id_anggota)
    {
        $this->db->delete('penguji_ukt', ['id_anggota' => $penguji_id_anggota]);
        $this->db->set('role_id', 3);
        $this->db->where('id', $penguji_id_anggota);
        $this->db->update('anggota');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
        redirect('sekcab/pengujiUkt');
    }

    function surat()
    {
        $data['title'] = 'Surat';
        $data['menu'] = $this->menu->getMenu();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['user'] = $this->anggota->getUser();
        $data['surat'] = $this->pesan->getSurat();

        $this->form_validation->set_rules('no_surat', 'No Surat', 'required|trim');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required|trim');
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sekcab/surat', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'tanggal' => $this->input->post('tanggal'),
                'no_surat' => $this->input->post('no_surat'),
                'isi_surat' => $this->input->post('perihal'),
                'tujuan' => $this->input->post('tujuan'),
                'i/o' => $this->input->post('io'),
                'link' => $this->input->post('link')
            ];
            $this->db->insert('surat', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan</div>');
            redirect('sekcab/surat');
        }
    }

    function deleteSurat($surat_id)
    {
        $this->db->delete('surat', ['id' => $surat_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
        redirect('sekcab/surat');
    }

    function jadwal()
    {

        $data['title'] = 'Jadwal Kegiatan';
        $data['menu'] = $this->menu->getMenu();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['user'] = $this->anggota->getUser();
        $data['jadwal'] = $this->db->get('jadwal')->result_array();

        $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'required|trim');
        $this->form_validation->set_rules('mulai', 'Tanggal Mulai', 'required|trim');
        $this->form_validation->set_rules('selesai', 'Tanggal Selesai', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sekcab/jadwal', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'kegiatan' => $this->input->post('kegiatan'),
                'mulai' => $this->input->post('mulai'),
                'selesai' => $this->input->post('selesai')
            ];

            $this->db->insert('jadwal', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal berhasil ditambahkan</div>');
            redirect('sekcab/jadwal');
        }
    }
}
