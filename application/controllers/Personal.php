<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Personal extends CI_Controller
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
		$data['title'] = 'My Profile';
		$data['user'] = $this->anggota->getUser();

		$dataAnggota_id = $this->session->userdata('id');
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
		$data['prestasi'] = $this->anggota->getPrestasi();
		$data['th_ajaran'] = $this->data->getTh_ajaran_aktif();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('personal/index', $data);
			$this->load->view('templates/footer');
		}
	}

	function editProfile()
	{
		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['user'] = $this->anggota->getUser();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama tidak boleh kosong']);
		$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required|trim', ['required' => 'Tempat Lahir tidak boleh kosong']);
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat tidak boleh kosong']);
		$this->form_validation->set_rules('no_hp', 'No HP', 'required|trim', ['required' => 'No HP tidak boleh kosong']);
		$this->form_validation->set_rules('tb', 'Tinggi Badan', 'required|trim', ['required' => 'Tinggi Badan tidak boleh kosong']);
		$this->form_validation->set_rules('bb', 'Berat Badan', 'required|trim', ['required' => 'Berat badan tidak boleh kosong']);

		if ($this->form_validation->run() == true) {
			$id = $this->session->userdata('id');
			$email = $this->input->post('email');
			$nama = $this->input->post('nama');
			$tmp_lahir = $this->input->post('tmp_lahir');
			$tgl_lahir = $this->input->post('tgl_lahir');
			$kelamin = $this->input->post('kelamin');
			$alamat = $this->input->post('alamat');
			$no_hp = $this->input->post('no_hp');
			$tb = $this->input->post('tb');
			$bb = $this->input->post('bb');

			//cek jika ada gambar yang akan diupload

			$upload_image = $_FILES['image'];

			if ($upload_image) {

				$config['upload_path'] = './assets/img/profile/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['user']['image'];
					if ($old_image != 'default.png') {
						if (file_exists($old_image)) {
							unlink(FCPATH . 'assets/img/profile/' . $old_image);
						}
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = [
				'nama' => $nama,
				'tmp_lahir' => $tmp_lahir,
				'tgl_lahir' => $tgl_lahir,
				'kelamin' => $kelamin,
				'alamat' => $alamat,
				'no_hp' => $no_hp,
				'tb' => $tb,
				'bb' => $bb,
				'email' => $email
			];
			$this->db->where('id', $id);
			$this->db->update('anggota', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diperbarui</div>');
			redirect('personal');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Update Profile gagal</div>');
			redirect('personal');
		}
	}

	function changePassword()
	{
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[8]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[8]|matches[new_password1]');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('personal', $data);
			$this->load->view('templates/footer');
		} else {

			$current_password = $this->input->post('current_password');
			$user = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
			$new_password = $this->input->post('new_password1');

			if (!password_verify($current_password, $user['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
				redirect('personal');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama!</div>');
					redirect('personal');
				} else {

					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('anggota');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diganti</div>');
					redirect('personal');
				}
			}
		}
	}

	function nilai()
	{
		$data['title'] = 'Rekap Nilai UKT';
		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['user'] = $this->anggota->getUser();
		$data['nilai'] = $this->anggota->getNilai();
		$data['th_ajaran'] = $this->data->getTh_ajaran_aktif();
		$data['tgl_daftar'] = $this->data->tglDaftarUkt();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('personal/nilai', $data);
		$this->load->view('templates/footer');
	}

	function absensi()
	{
		$data['title'] = 'Absensi';
		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['user'] = $this->anggota->getUser();
		$data['absensi'] = $this->anggota->getKehadiran();
		$data['unit'] = $this->anggota->getUnitAbsen();
		$data['jml_kehadiran'] = $this->anggota->getJmlKehadiran();

		$kehadiran = $this->anggota->getJmlKehadiran();
		$unit = $this->anggota->getUnit();

		$data['persen'] = round(($kehadiran['jumlah'] / $unit['jml_hari'] * 100), 2);;

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('personal/absensi', $data);
		$this->load->view('templates/footer');
	}

	function inputAbsensi()
	{
		$this->form_validation->set_rules('lokasi', 'Unit Latihan', 'required');

		if ($this->form_validation->run() == true) {
			$data = [
				'tanggal' => $this->input->post('tanggal'),
				'jam' => $this->input->post('jam'),
				'id_anggota' => $this->session->userdata('id'),
				'id_unit' => $this->session->userdata('id_unit'),
				'id_pelatih' => 0,
				'lokasi' => $this->input->post('lokasi'),
				'id_th_ajaran' => $this->session->userdata('th_ajaran')
			];

			$this->db->insert('absensi', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Absensi mandiri berhasil</div>');
			redirect('personal/absensi');
		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Absensi gagal</div>');
			redirect('personal/absensi');
		}
	}

	function daftar_ukt()
	{
		$kehadiran = $this->anggota->getJmlKehadiran();
		$minimum = $this->anggota->getJmlKehadiranMinimum();

		if ($kehadiran['jumlah'] < $minimum['jumlah']) {

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, anda tidak dapat mendaftar UKT karena jumlah kehadiran anda dibawah jumlah minimum.</div>');
			redirect('personal/nilai');
		} else {

			$this->db->insert('admin_ukt', [
				'id_anggota' => $this->session->userdata('id'),
				'id_th_ajaran' => $this->session->userdata('th_ajaran')
			]);

			$this->db->set('ukt', 1);
			$this->db->where('email', $this->session->userdata('email'));
			$this->db->update('anggota');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat, anda sudah terdaftar sebagai peserta UKT. Siapkan berkas yang dibutuhan untuk keperluan administrasi UKT.</div>');
			redirect('personal/nilai');
		}
	}

	function cetakFormulirUkt()
	{
		$data = $this->anggota->printUser();
		$ketua = $this->anggota->printPT();
		$ukt = $this->db->get_where('th_ajaran', ['aktif' => 1])->result();

		$pdf = new FPDF('P', 'mm', array(210, 330));
		$pdf->AddPage();


		$pdf->Image('assets/img/icon/LOGO PD RESMI PNG.png', 22, 8, 34, 37);

		$pdf->SetX(55);
		$pdf->SetFont('Arial', '', 14);
		$pdf->Cell(150, 10, 'Keluarga Silat Nasional Indonesia', 0, 1, 'L');

		$pdf->SetX(55);
		$pdf->SetFont('Arial', 'B', 20);
		$pdf->SetTextColor($r = 255, $g = 0, $b = 0);
		$pdf->Cell(150, 5, 'PERISAI DIRI', 0, 1, 'L');

		$pdf->SetX(55);
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->SetTextColor($r = 0, $g = 0, $b = 0);
		$pdf->Cell(150, 10, 'KABUPATEN JEMBER', 0, 1, 'L');

		$pdf->SetX(55);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(150, 2, 'Sekretariat : Jalan Letdjen Suprapto Gang II, Kebonsari, Jember. Kode Pos: 68122', 0, 1, 'L');

		$pdf->SetLineWidth(1);
		$pdf->Line(55, 40, 200, 40);
		$pdf->Cell(0, 10, '', 0, 1, 'C');

		$pdf->SetFont('Times', 'B', 14, 'C');
		$pdf->Cell(0, 6, 'Formulir Ujian Kenaikan Tingkat Perisai Diri Jember', 0, 1, 'C');
		foreach ($ukt as $u) {
			if ($u->semester == 1) {
				$pdf->Cell(0, 6, 'Semester  Ganjil', 0, 1, 'C');
			} else {
				$pdf->Cell(0, 6, 'Semester  Genap', 0, 1, 'C');
			}
			$pdf->Cell(0, 6, 'Tahun Ajaran ' . $u->th_ajaran, 0, 1, 'C');
		}
		$pdf->Ln();

		$pdf->SetFont('Times', '', 11);
		foreach ($data as $isi) {
			$pdf->SetX(25);
			$pdf->Cell(45, 6, 'Nama', 0, 0, 'L');
			$pdf->Cell(3, 6, ':', 0, 0, 'L');
			$pdf->Cell(100, 6, $isi->nama, 0, 1, 'L');
			$pdf->SetX(25);
			$pdf->Cell(45, 6, 'Tempat, tanggal Lahir', 0, 0, 'L');
			$pdf->Cell(3, 6, ':', 0, 0, 'L');
			$pdf->Cell(100, 6, $isi->tmp_lahir . ", " . date('d F Y', strtotime($isi->tgl_lahir)), 0, 1, 'L');
			$pdf->SetX(25);
			$pdf->Cell(45, 6, 'Alamat', 0, 0, 'L');
			$pdf->Cell(3, 6, ':', 0, 0, 'L');
			$pdf->Cell(100, 6, $isi->alamat, 0, 1, 'L');
			$pdf->SetX(25);
			$pdf->Cell(45, 6, 'Unit/ranting', 0, 0, 'L');
			$pdf->Cell(3, 6, ':', 0, 0, 'L');
			$pdf->Cell(100, 6, $isi->nama_unit, 0, 1, 'L');
			$pdf->SetX(25);
			$pdf->Cell(45, 6, 'Tingkatan terakhir', 0, 0, 'L');
			$pdf->Cell(3, 6, ':', 0, 0, 'L');
			$pdf->Cell(100, 6, $isi->tingkatan, 0, 1, 'L');
			$pdf->SetX(25);
			$pdf->Cell(45, 6, 'No HP/WA', 0, 0, 'L');
			$pdf->Cell(3, 6, ':', 0, 0, 'L');
			$pdf->Cell(100, 6, $isi->no_hp, 0, 1, 'L');
			$pdf->SetX(25);
			$pdf->Cell(45, 6, 'Email', 0, 0, 'L');
			$pdf->Cell(3, 6, ':', 0, 0, 'L');
			$pdf->Cell(100, 6, $isi->email, 0, 1, 'L');
		}
		$pdf->Ln();
		$pdf->SetX(25);
		$pdf->MultiCell(175, 6, 'Dengan ini saya menyatakan bersedia mengikuti Ujian Kenaikan Tingkat Perisai Diri Jember dan  bersedia mematuhi peraturan/tata tertib yang berlaku.', 0, 'L', false);
		$pdf->Ln();

		$pdf->SetX(135);
		$pdf->Cell(0, 6, 'Jember, ' . date('d F Y'), 0, 1, 'L');
		$pdf->SetX(135);
		$pdf->Cell(0, 6, 'Hormat kami, ', 0, 1, 'L');
		$pdf->Ln();
		$pdf->Ln();
		foreach ($data as $isi) {
			$pdf->SetX(135);
			$pdf->Cell(0, 6, $isi->nama, 0, 1, 'L');
		}
		$pdf->Ln();

		$pdf->SetLineWidth(1);
		$pdf->Line(25, 172, 200, 172);
		$pdf->Ln();

		$pdf->SetFont('Times', 'B', 14, 'C');
		$pdf->Cell(0, 8, 'Surat Rekomendasi Ujian Kenaikan Tingkat Perisai Diri Jember', 0, 1, 'C');
		$pdf->Ln();

		$pdf->SetFont('Times', '', 11, 'L');
		$pdf->SetX(25);
		$pdf->Cell(0, 6, 'Saya yang bertandatangan di bawah ini :', 0, 1);

		foreach ($ketua as $ketu) {
			$pdf->SetX(25);
			$pdf->Cell(45, 8, 'Nama', 0, 0, 'L');
			$pdf->Cell(3, 8, ':', 0, 0, 'L');
			$pdf->Cell(100, 8, $ketu->pt, 0, 1, 'L');
			$pdf->SetX(25);
			$pdf->Cell(45, 8, 'Jabatan', 0, 0, 'L');
			$pdf->Cell(3, 8, ':', 0, 0, 'L');
			$pdf->MultiCell(150, 8, 'Penanggung Jawab Teknik Unit/Ranting Perisai Diri ' . $ketu->nama_unit, 0, 'L', false);
			$pdf->Ln();
		}
		$pdf->SetX(25);
		$pdf->Cell(0, 6, 'Menyatakan memberikan izin kepada :', 0, 1);
		foreach ($data as $isi) {
			$pdf->SetX(25);
			$pdf->Cell(45, 6, 'Nama', 0, 0, 'L');
			$pdf->Cell(3, 6, ':', 0, 0, 'L');
			$pdf->Cell(100, 6, $isi->nama, 0, 1, 'L');
			$pdf->SetX(25);
			$pdf->Cell(45, 6, 'Tingkatan terakhir', 0, 0, 'L');
			$pdf->Cell(3, 6, ':', 0, 0, 'L');
			$pdf->Cell(100, 6, $isi->tingkatan, 0, 1, 'L');
			$pdf->Ln();
		}
		$pdf->SetX(25);
		foreach ($ukt as $u) {
			$pdf->MultiCell(175, 6, 'Untuk mengikuti UKT (Ujian Kenaikan Tingkat) Perisai Diri kabupaten Jember pada tanggal ' . date('d F Y', strtotime($u->tgl_ukt)) . ' di IAIN Jember. Demikian surat rekomendasi ini kami buat, dan dapat dipergunakan sebagimana mestinya.', 0, 'L', false);
		}
		$pdf->Ln();


		$pdf->SetX(135);
		$pdf->Cell(0, 6, 'Jember, ' . date('d F Y'), 0, 1, 'L');
		$pdf->SetX(135);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		foreach ($ketua as $isi) {
			$pdf->SetX(135);
			$pdf->Cell(0, 6, $isi->pt, 0, 1, 'L');
		}
		$pdf->Rect(35, 133, 25, 35, 'D');
		$pdf->Rect(65, 133, 25, 35, 'D');
		$pdf->Text(41, 152, 'Foto 3x4');
		$pdf->Text(71, 152, 'Foto 3x4');

		$pdf->Output();
	}

	function organisasi()
	{
		$data['title'] = 'Profil Organisasi';
		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['user'] = $this->anggota->getUser();
		$data['anggota'] = $this->data->getAnggotaAktif();
		$data['organisasi'] = $this->data->getOrganisasi();
		$data['jadwal'] = $this->db->get('jadwal')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('personal/organisasi', $data);
		$this->load->view('templates/footer');
	}

	function updateOrganisasi()
	{

		$data['organisasi'] = $this->data->getOrganisasi();

		$upload_image = $_FILES['image'];

		if ($upload_image) {

			$config['upload_path'] = './assets/img/profile/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '2048';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$old_image = $data['organisasi']['img'];
				if ($old_image != 'default.png') {
					unlink(FCPATH . 'assets/img/logo/' . $old_image);
				}
				$new_image = $this->upload->data('file_name');
				$this->db->set('img', $new_image);
			} else {
				echo $this->upload->display_errors();
			}
		}
		$id = $this->input->post('id');

		$data = [
			'nama_org' => $this->input->post('nama_org'),
			'alamat' => $this->input->post('alamat'),
			'no_telp' => $this->input->post('no_telp'),
			'id_ketua' => $this->input->post('id_ketua')
		];

		$this->db->where('id', $id);
		$this->db->update('profile_org', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diperbarui</div>');
		redirect('personal');
	}

	public function file_center()
	{
		$data['title'] = 'File Sharing';
		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['user'] = $this->anggota->getUser();
		$data['files'] = $this->data->getFiles();

		$this->form_validation->set_rules('judul', 'Judul', 'required|trim');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('personal/file_center', $data);
			$this->load->view('templates/footer');
		} else {

			$judul = $this->input->post('judul');
			$kategori = $this->input->post('kategori');
			$kontributor = $this->session->userdata('id');

			$upload_file = $_FILES['file_name'];

			if ($upload_file) {

				$config['upload_path'] = './assets/pdf/';
				$config['allowed_types'] = 'pdf';
				$config['max_size']     = '10240';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file_name')) {

					$new_file = $this->upload->data('file_name');
					$data = [
						'judul' => $judul,
						'kategori' => $kategori,
						'id_anggota' => $kontributor,
						'file' => $new_file
					];
					$this->db->insert('file_center', $data);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">File berhasil di upload</div>');
					redirect('personal/file_center');
				} else {
					echo $this->upload->display_errors();
				}
			}
		}
	}

	public function deleteFiles($files_id)
	{
		$files = decrypt_url($files_id);
		$db = $this->db->get_where('file_center', ['id' => $files])->result;
		unlink(FCPATH . 'assets/pdf/' . $db->file);

		$this->db->delete('file_center', ['id' => $files]);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">File berhasil di hapus</div>');
		redirect('personal/file_center');
	}
}
