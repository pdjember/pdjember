<?php

class Ketua extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Pesan_model', 'pesan');
		$this->load->model('Anggota_model', 'anggota');
		$this->load->model('Ketua_model', 'ketua');
		$this->load->model('Bendahara_model', 'bendahara');
	}

	function index()
	{
		$data['title'] = 'Dashboard Unit';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['jmlTotal'] = $this->ketua->getJmlAnggotaUnitTotal();
		$data['jmlAktif'] = $this->ketua->getJmlAnggotaUnitAktif();
		$data['jmlNonAktif'] = $this->ketua->getJmlAnggotaUnitNonAktif();
		$data['jmlCalonAnggota'] = $this->ketua->getJmlCalonAnggotaUnit();
		$data['jmlTingkatan'] = $this->ketua->getJmlTingkat();
		$data['jml_masuk'] = $this->bendahara->getJmlPemasukanUnit();
		$data['jml_keluar'] = $this->bendahara->getJmlPengeluaranUnit();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('ketua/index', $data);
		$this->load->view('templates/footer');
	}
	function dataAnggota()
	{
		$data['title'] = 'Data Anggota Unit';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$data['anggota'] = $this->ketua->getAnggotaUnit();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('ketua/dataanggota', $data);
		$this->load->view('templates/footer');
	}

	function calonAnggota()
	{
		$data['title'] = 'Data Calon Anggota';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['anggota'] = $this->ketua->getCalonAnggota();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('ketua/calonanggota', $data);
		$this->load->view('templates/footer');
	}

	function dataAnggotaAktif()
	{
		$data['title'] = 'Data Anggota Aktif';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$data['anggota'] = $this->ketua->getAnggotaAktif();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('ketua/dataanggota', $data);
		$this->load->view('templates/footer');
	}

	function dataAnggotaNonAktif()
	{
		$data['title'] = 'Data Anggota Non Aktif';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$data['anggota'] = $this->ketua->getAnggotanonAktif();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('ketua/dataanggota', $data);
		$this->load->view('templates/footer');
	}

	function deleteCalonAnggota($anggota_id)
	{
		$anggota_id = decrypt_url($anggota_id);
		$this->db->delete('anggota', ['id' => $anggota_id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
		redirect('ketua/calonAnggota');
	}

	function aktivasiAnggota($anggota_id)
	{
		$data = ['st_aktif' => 1, 'resmi' => 1];

		$anggota_id = decrypt_url($anggota_id);
		$this->db->where('id', $anggota_id);
		$this->db->update('anggota', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diperbarui</div>');
		redirect('Ketua');
	}

	function deaktivasiAnggota($anggota_id)
	{
		$data = ['st_aktif' => 0];
		$anggota_id = decrypt_url($anggota_id);
		$this->db->where('id', $anggota_id);
		$this->db->update('anggota', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diperbarui</div>');
		redirect('Ketua');
	}
}
