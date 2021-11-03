<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Panitia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pesan_model', 'pesan');
        $this->load->model('Anggota_model', 'anggota');
        $this->load->model('Ukt_model', 'ukt');
        logged_in();
    }
    public function dataPeserta()
    {
        $data['title'] = 'Data Peserta UKT';
        $data['user'] = $this->anggota->getUser();

        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['peserta'] = $this->ukt->getPesertaUkt();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ukt/datapeserta2', $data);
        $this->load->view('templates/footer');
    }

    public function administrasi()
    {
        $data['title'] = 'Kelengkapan Administrasi Peserta UKT';
        $data['user'] = $this->anggota->getUser();

        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['peserta'] = $this->ukt->getAdminPeserta();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ukt/administrasi_peserta', $data);
        $this->load->view('templates/footer');
    }

    function updateAdministrasi()
    {
        $data = [
            'bayar' => $this->input->post('bayar'),
            'foto' => $this->input->post('foto'),
            'ijazah' => $this->input->post('ijazah')
        ];

        $this->db->where('id_anggota', decrypt_url($this->input->post('id')));
        $this->db->update('admin_ukt', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diperbarui</div>');
        redirect('panitia/administrasi');
    }

    public function deletePeserta($peserta_id)
    {
        $this->db->set('ukt', 0);
        $this->db->where('id', decrypt_url($peserta_id));
        $this->db->update('anggota');

        $this->db->delete('admin_ukt', ['id_anggota' => $peserta_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
        redirect('panitia/dataPeserta');
    }
}
