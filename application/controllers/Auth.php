<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Pesan_model', 'pesan');
		$this->load->model('Anggota_model', 'anggota');
		$this->load->model('Data_model', 'data');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', ['required' => 'Email tidak boleh kosong']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'Password tidak boleh kosong']);
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Halaman Login - Perisai Diri Jember';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->login();
		}
	}

	private function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->get_where('anggota', ['email' => $email])->row_array();
		$th_ajaran = $this->db->get_where('th_ajaran', ['aktif' => 1])->row_array();

		if ($user) {
			# jika akun aktif
			if ($user['st_aktif'] == 1) {
				# cek password
				if (password_verify($password, $user['password'])) {

					$data = [
						'id' => $user['id'],
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'id_unit' => $user['id_unit'],
						'th_ajaran' => $th_ajaran['id']

					];
					$this->session->set_userdata($data);

					if ($user['role_id'] == 4) {

						redirect('ketua');
					} else {

						redirect('personal');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
					redirect('auth');
				}
			} else {

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun ini tidak aktif. Hubungi Admin</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun email tidak terdaftar.</div>');
			redirect('auth');
		}
	}

	public function registration()
	{
		$data['unit'] = $this->db->get('unit')->result_array();

		if ($this->session->userdata('email')) {
			redirect('user');
		}

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama tidak boleh kosong!']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[anggota.email]', [
			'required' => 'Email harus diisi!',
			'is_unique' => 'Alamat Email sudah terdaftar, ganti dengan yang lain!'
		]);
		$this->form_validation->set_rules('unit', 'Unit', 'required|trim', ['required' => 'Unit Latihan harus diisi!']);
		$this->form_validation->set_rules('pass1', 'Password', 'required|trim|min_length[8]|matches[pass2]', [
			'required' => 'Password harus diisi!',
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('pass2', 'Password', 'required|trim|matches[pass1]');

		if ($this->form_validation->run() == false) {

			$data['title'] = 'Registrasi Anggota Baru - Perisai Diri Jember';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {

			$email = $this->input->post('email', true);
			$data = [
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'email' => htmlspecialchars($email),
				'image' => 'default.png',
				'password' => password_hash($this->input->post('pass1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'resmi' => 0,
				'st_aktif' => 0,
				'id_tingkatan' => 1,
				'id_unit' => htmlspecialchars($this->input->post('unit', true)),
				'date_created' => time(),
				'ukt' => 0

			];

			$pesan = [
				'from' => 'admin@pdjember.org',
				'to' => htmlspecialchars($email),
				'subjek' => encrypt_text('Selamat Datang'),
				'isi' => encrypt_text('Salam Bunga Sepasang. Selamat bergabung dengan Keluarga Silat Nasional Perisai Diri Jember. Silahkan update data anda di menu edit profile pada menu top bar di pojok kanan atas. Pesan ini tidak perlu dibalas karena pesan ini adalah pesan yang dibuat secara otomatis.'),
				'to_read' => 0,
				'fr_read' => 0,
				'fr_del' => 0,
				'to_del' => 0,
				'date_sent' => time()

			];

			//siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token = ['email' => $email, 'token' => $token, 'date_created' => time()];

			$this->db->insert('anggota', $data);
			$this->db->insert('pesan', $pesan);
			$this->db->insert('user_token', $user_token);
			$this->_sendEmail($token, 'verify');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat, akun anda berhasil dibuat. Silahkan mengikuti Diklat Anggota Baru untuk mengaktifkan akun anda.</div>');
			redirect('auth');
		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_user' => 'pdjember@gmail.com',
			'smtp_pass' => 'perisaidirijember',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->from('pdjember@gmail.com', 'Perisai Diri Kabupaten Jember');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {

			$this->email->subject('Aktivasi Akun');
			$this->email->message('Klik link untuk verifikasi akun anda : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . $token . '">Aktivasi akun</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil logout.</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}
}
