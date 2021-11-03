<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('cetak_pdf');
		$this->load->model('Pesan_model', 'pesan');
		$this->load->model('Anggota_model', 'anggota');
		$this->load->model('Data_model', 'data');
		logged_in();
	}

	function index()
	{
		$data['title'] = 'Data Keseluruhan';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();

		$data['aktif'] = $this->data->getJmlAnggotaAktif();
		$data['calon'] = $this->data->getJmlCalonAnggota();
		$data['no_aktif'] = $this->data->getJmlTidakAktif();
		$data['jml_pelatih'] = $this->data->getJmlPelatih();
		$data['unit'] = $this->data->getJmlUnit();
		$data['tingkatan'] = $this->data->getJmlTingkatan();
		$data['anggotaUnit'] = $this->data->getAnggotaUnit();
		$data['total_anggota'] = $this->data->getTotalAnggota();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data/index', $data);
		$this->load->view('templates/footer');
	}

	function unit()
	{
		$data['title'] = 'Unit Latihan';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['ketua'] = $this->db->get('anggota')->result_array();
		$data['user'] = $this->anggota->getUser();

		$data['unit'] = $this->data->getUnit();
		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$this->form_validation->set_rules('unit', 'Unit', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('data/unit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('unit', [
				'nama_unit' => $this->input->post('unit'),
				'id_ketua' => 0,
				'st_aktif' => $this->input->post('st_aktif'),
				'alamat' => $this->input->post('alamat'),
				'jml_hari' => 0

			]);

			$update = ['role_id' => 4];

			$this->db->where('id', $this->input->post('ketua'));
			$this->db->update('anggota', $update);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Unit berhasil ditambahkan</div>');
			redirect('data/unit');
		}
	}

	function ubahUnit()
	{
		$hari = implode(",", $this->input->post('hari'));
		$data = [
			'nama_unit' => $this->input->post('nama'),
			'id_ketua' => $this->input->post('ketua'),
			'id_pt' => $this->input->post('pt'),
			'st_aktif' => $this->input->post('st_aktif'),
			'alamat' => $this->input->post('alamat'),
			'jml_hari' => $this->input->post('jml_hari'),
			'hari' => $hari
		];

		$this->db->where('id', decrypt_text($this->input->post('id_unit')));
		$this->db->update('unit', $data);

		$data1 = ['role_id' => 4];
		$this->db->where('id', $this->input->post('ketua'));
		$this->db->update('anggota', $data1);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diperbarui</div>');
		redirect('data/unit');
	}

	function hapusUnit($unit_id)
	{
		$unit_id = decrypt_url($unit_id);
		$this->db->delete('unit', ['id' => $unit_id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Unit berhasil dihapus</div>');
		redirect('data/unit');
	}

	function dataAnggota()
	{
		$data['title'] = 'Data Anggota';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['dataAnggota'] = $this->data->getAnggota();
		$data['user'] = $this->anggota->getUser();
		$data['tingkatan'] = $this->db->get('tingkatan')->result_array();
		$data['unit'] = $this->db->get('unit')->result_array();
		$data['role'] = $this->data->getRole();


		$this->db->where('role_id !=', 0);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data/anggota', $data);
		$this->load->view('templates/footer');
	}

	function dataAnggotaAktif()
	{
		$data['title'] = 'Data Anggota';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['dataAnggota'] = $this->data->getAnggotaAktif();
		$data['tingkatan'] = $this->db->get('tingkatan')->result_array();
		$data['unit'] = $this->db->get('unit')->result_array();
		$data['role'] = $this->data->getRole();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data/anggota', $data);
		$this->load->view('templates/footer');
	}

	function dataAnggotaNonAktif()
	{
		$data['title'] = 'Data Anggota';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['dataAnggota'] = $this->data->getAnggotaNonAktif();
		$data['user'] = $this->anggota->getUser();
		$data['tingkatan'] = $this->db->get('tingkatan')->result_array();
		$data['unit'] = $this->db->get('unit')->result_array();
		$data['role'] = $this->data->getRole();


		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data/anggota', $data);
		$this->load->view('templates/footer');
	}

	function dataPelatih()
	{
		$data['title'] = 'Data Pelatih';
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['anggota'] = $this->data->getAnggotaAktif();
		$data['dataAnggota'] = $this->data->getPelatih();

		$this->form_validation->set_rules('id', 'ID', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('data/pelatih', $data);
			$this->load->view('templates/footer');
		} else {
			$id = $this->input->post('id');
			$this->db->set('role_id', 3);
			$this->db->where('id', $id);
			$this->db->update('anggota');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan</div>');
			redirect('data/dataPelatih');
		}
	}

	function deletePelatih($dataAnggota_id)
	{
		$dataAnggota_id = decrypt_url($dataAnggota_id);
		$this->db->set('role_id', 2);
		$this->db->where('id', $dataAnggota_id);
		$this->db->update('anggota');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
		redirect('data/dataPelatih');
	}

	function deleteAnggota($dataAnggota_id)
	{
		$dataAnggota_id = decrypt_url($dataAnggota_id);
		$this->db->delete('anggota', ['id' => $dataAnggota_id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
		redirect('data/dataAnggota');
	}

	function updateAnggota()
	{
		$data = [
			'st_aktif' => $this->input->post('st_aktif'),
			'id_unit' => $this->input->post('unit'),
			'id_tingkatan' => $this->input->post('tingkatan'),
			'role_id' => $this->input->post('role')
		];

		$this->db->where('email', $this->input->post('email'));
		$this->db->update('anggota', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diperbarui</div>');
		redirect('data/dataAnggota');
	}

	function details($dataAnggota_id)
	{
		$data['title'] = 'Detail Data Anggota';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();

		$dataAnggota_id = decrypt_url($dataAnggota_id);
		$data['anggota'] = $this->db->get_where('anggota', ['id' => $dataAnggota_id])->row_array();
		$data['fisik'] = $this->db->get_where('ability', ['id_anggota' => $dataAnggota_id])->result_array();
		$data['tingkatan'] = $this->db->get('tingkatan')->result_array();
		$data['unit'] = $this->db->get('unit')->result_array();
		$data['role'] = $this->db->get('user_role')->result_array();

		$query = "SELECT nilai_ukt.kd_materi,round(AVG(nilai_ukt.nilai)) AS rata2,anggota.id,anggota.nama,materi_ukt.materi 
		FROM anggota JOIN nilai_ukt ON nilai_ukt.id_anggota = anggota.id 
		JOIN materi_ukt ON materi_ukt.kd_materi = nilai_ukt.kd_materi 
		WHERE anggota.id='$dataAnggota_id' GROUP BY nilai_ukt.kd_materi";

		$data['nilai'] = $this->db->query($query)->result_array();

		$query1 = "SELECT * from vw_prestasi
		WHERE `id_anggota`=$dataAnggota_id ORDER BY `tgl_event` DESC";

		$data['prestasi'] = $this->db->query($query1)->result_array();



		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data/details', $data);
		$this->load->view('templates/footer');
	}


	function printData($dataAnggota_id)
	{
	}

	function calonAnggota()
	{
		$data['title'] = 'Data Calon Anggota';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$data['dataCalonAnggota'] = $this->data->getCalonAnggota();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data/calonanggota', $data);
		$this->load->view('templates/footer');
	}

	function aktivasiAnggota($dataCalonAnggota_id)
	{
		$data = ['st_aktif' => 1, 'resmi' => 1];

		$dataCalonAnggota_id = decrypt_url($dataCalonAnggota_id);
		$this->db->where('id', $dataCalonAnggota_id);
		$this->db->update('anggota', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diperbarui</div>');
		redirect('data/calonAnggota');
	}

	function deleteCalonAnggota($dataCalonAnggota_id)
	{
		$dataCalonAnggota_id = decrypt_url($dataCalonAnggota_id);
		$this->db->delete('anggota', ['id' => $dataCalonAnggota_id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
		redirect('data/calonAnggota');
	}

	function prestasi()
	{
		$data['title'] = 'Prestasi';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();
		$data['anggota'] = $this->data->getAnggotaAktif();
		$data['kategori'] = $this->data->getKategori();
		$data['prestasi'] = $this->data->getPrestasi();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$this->form_validation->set_rules('id_anggota', 'Atlit', 'required|trim');
		$this->form_validation->set_rules('event', 'Event', 'required|trim');
		$this->form_validation->set_rules('tanggal', 'Tanggal Event', 'required|trim');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
		$this->form_validation->set_rules('usia', 'Usia', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('data/prestasi', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'id_anggota' => $this->input->post('id_anggota'),
				'event' => $this->input->post('event'),
				'tgl_event' => $this->input->post('tanggal'),
				'juara' => $this->input->post('juara'),
				'id_kategori' => $this->input->post('kategori'),
				'kelas' => $this->input->post('kelas'),
				'usia' => $this->input->post('usia')
			];
			$this->db->insert('prestasi', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan</div>');
			redirect('data/prestasi');
		}
	}

	function deletePrestasi($prestasi_id)
	{
		$prestasi_id = decrypt_url($prestasi_id);
		$this->db->delete('prestasi', ['id' => $prestasi_id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
		redirect('data/prestasi');
	}
}
