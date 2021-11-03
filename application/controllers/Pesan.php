<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Pesan_model', 'pesan');
		$this->load->model('Anggota_model', 'anggota');
		logged_in();
	}

	function tulisPesan()
	{
		$subjek = encrypt_text($this->input->post('subjek'));
		$isi = encrypt_text($this->input->post('isi'));
		$data = [
			'from' => htmlspecialchars($this->session->userdata('email')),
			'to' => htmlspecialchars($this->input->post('penerima')),
			'subjek' => $subjek,
			'isi' => $isi,
			'to_read' => 0,
			'fr_read' => 0,
			'to_del' => 0,
			'fr_del' => 0,
			'date_sent' => time()
		];

		$this->db->insert('pesan', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesan terkirim</div>');
		redirect('pesan/inbox');
	}

	function inbox()
	{
		$data['title'] = 'Kotak Masuk';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();
		$data['penerima'] = $this->pesan->getPenerima();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('pesan/inbox', $data);
		$this->load->view('templates/footer');
	}

	function outbox()
	{
		$data['title'] = 'Pesan Terkirim';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();

		$data['outbox'] = $this->pesan->getOutbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('pesan/outbox', $data);
		$this->load->view('templates/footer');
	}

	function bacaPesan($notifikasi_id)
	{
		$data['title'] = 'Kotak Masuk';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['penerima'] = $this->pesan->getPenerima();
		$notifikasi_id = decrypt_url($notifikasi_id);
		$data['baca'] = $this->pesan->getPesan($notifikasi_id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('pesan/baca', $data);
		$this->load->view('templates/footer');

		$this->db->where('id', $notifikasi_id);
		$this->db->update('pesan', ['to_read' => 1]);
	}

	function bacaPesanKeluar($notifikasi_id)
	{
		$data['title'] = 'Pesan Terkirim';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$data['penerima'] = $this->pesan->getPenerima();
		$notifikasi_id = decrypt_url($notifikasi_id);
		$data['baca'] = $this->pesan->getPesanKeluar($notifikasi_id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('pesan/baca_terkirim', $data);
		$this->load->view('templates/footer');

		$this->db->where('id', $notifikasi_id);
		$this->db->update('pesan', ['fr_read' => 1]);
	}

	function hapusPesanMasuk($notifikasi_id)
	{
		$notifikasi_id = decrypt_url($notifikasi_id);
		$this->db->where('id', $notifikasi_id);
		$this->db->update('pesan', ['to_del' => 1]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesan berhasil dihapus</div>');
		redirect('pesan/inbox');
	}

	function hapusPesanKeluar($notifikasi_id)
	{
		$notifikasi_id = decrypt_url($notifikasi_id);
		$this->db->where('id', $notifikasi_id);
		$this->db->update('pesan', ['fr_del' => 1]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesan berhasil dihapus</div>');
		redirect('pesan/outbox');
	}
}
