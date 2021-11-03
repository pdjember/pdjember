<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelatih extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Pesan_model', 'pesan');
        $this->load->model('Anggota_model', 'anggota');
        $this->load->model('Pelatih_model', 'pelatih');
        logged_in();
    }

    function absensi()
    {
        $data['title'] = 'Absensi Latihan';
        $data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->anggota->getUser();
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['absen'] = $this->pelatih->getAnggotaUnit();
        $data['rekap'] = $this->pelatih->getAbsensi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelatih/absensi', $data);
        $this->load->view('templates/footer');
    }

    function dataFisik()
    {
        $data['title'] = 'Data Fisik Siswa';
        $data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->anggota->getUser();
        $data['inbox'] = $this->pesan->getInbox();
        $data['unread'] = $this->pesan->getUnread();
        $data['notifikasi'] = $this->pesan->getNotif();
        $data['anggota'] = $this->pelatih->getAnggotaUnit();
        $data['dataFisik'] = $this->pelatih->getDataFisik();

        $this->form_validation->set_rules('id', 'Id', 'required|trim|is_unique[ability.id_anggota]', [
            'required' => 'Pilih anggota terlebih dahulu!',
            'is_unique' => 'Data anggota sudah ada!'
        ]);
        $this->form_validation->set_rules('power', 'Power', 'required');
        $this->form_validation->set_rules('speed', 'Speed', 'required');
        $this->form_validation->set_rules('stamina', 'Stamina', 'required');
        $this->form_validation->set_rules('agility', 'Agility', 'required');
        $this->form_validation->set_rules('teknik', 'Teknik', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pelatih/fisik', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_anggota' => $this->input->post('id'),
                'power' => $this->input->post('power'),
                'stamina' => $this->input->post('stamina'),
                'agility' => $this->input->post('agility'),
                'speed' => $this->input->post('speed'),
                'teknik' => $this->input->post('teknik')
            ];

            $this->db->insert('ability', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan</div>');
            redirect('pelatih/dataFisik');
        }
    }
    function updateDataFisik()
    {
        $data = [
            'power' => $this->input->post('power'),
            'stamina' => $this->input->post('stamina'),
            'agility' => $this->input->post('agility'),
            'speed' => $this->input->post('speed'),
            'teknik' => $this->input->post('teknik')
        ];

        $this->db->where('id_anggota', $this->input->post('id'));
        $this->db->update('ability', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan</div>');
        redirect('pelatih/dataFisik');
    }
    function inputAbsen()
    {
        $data = $this->input->post();
        unset($data['submit']);
        $this->pelatih->simpanAbsen($data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
        redirect('pelatih/absensi');
    }

    function deleteAbsensi($data_id)
    {
        $absen_id = decrypt_url($data_id);
        $this->db->delete('absensi', ['id' => $absen_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Absensi berhasil dihapus</div>');
        redirect('pelatih/absensi');
    }

    function deleteFisik($dataFisik_id)
    {
        $dataFisik_id = decrypt_url($dataFisik_id);
        $this->db->delete('ability  ', ['id' => $dataFisik_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
        redirect('pelatih/dataFisik');
    }
}
