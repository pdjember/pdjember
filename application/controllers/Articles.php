<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Articles extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Pesan_model', 'pesan');
		$this->load->model('Anggota_model', 'anggota');
		$this->load->model('Article_model', 'article');
	}

	function index()
	{
		$data['title'] = 'Berita';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['user'] = $this->anggota->getUser();

		$data['berita'] = $this->article->getNews();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('articles/index', $data);
		$this->load->view('templates/footer');
	}

	function inputBerita()
	{
		$data['title'] = 'Input Berita';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['news'] = $this->db->get('news')->result_array();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['user'] = $this->anggota->getUser();

		$this->form_validation->set_rules('judul', 'Judul', 'required|trim');
		$this->form_validation->set_rules('isi', 'Isi', 'required|trim');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('articles/inputberita', $data);
			$this->load->view('templates/footer');
		} else {

			$judul = $this->input->post('judul');
			$isi = $this->input->post('isi');
			$operator = $data['user']['id'];
			$upload_image = $_FILES['image'];

			if ($upload_image) {

				$config['upload_path'] = './assets/img/article/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['news']['image'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/img/article' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = [
				'judul' => $judul,
				'isi' => $isi,
				'id_operator' => $operator,
				'date_posted' => time()
			];

			$this->db->insert('news', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berita berhasil ditambahkan</div>');
			redirect('articles');
		}
	}

	function deleteArticle($berita_id)
	{
		$this->db->delete('news', ['id' => $berita_id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berita berhasil dihapus</div>');
		redirect('articles');
	}

	function editArticle($berita_id)
	{
		$data['title'] = 'Edit Berita';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$this->form_validation->set_rules('judul', 'Judul', 'required|trim');
		$this->form_validation->set_rules('isi', 'Isi', 'required|trim');

		if ($this->form_validation->run() == false) {
		} else {
		}
	}
}
