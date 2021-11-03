<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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

	function role()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$this->db->where('id !=', 0);
		$data['role'] = $this->db->get('user_role')->result_array();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_role', ['role' => $this->input->post('role')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role berhasil ditambahkan</div>');
			redirect('admin/role');
		}
	}

	function roleAccess($role_id)
	{
		$data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();
		$data['user'] = $this->anggota->getUser();

		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/roleaccess', $data);
		$this->load->view('templates/footer');
	}

	function ubahAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() < 1) {

			$this->db->insert('user_access_menu', $data);
		} else {

			$this->db->delete('user_access_menu', $data);
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses berubah.</div>');
	}

	function hapusAccess($role_id)
	{
		$this->db->delete('user_role', ['id' => $role_id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role berhasil dihapus</div>');
		redirect('admin/role');
	}

	function menu()
	{
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['menu'] = $this->menu->getMenu();
		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['user'] = $this->anggota->getUser();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/menu', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil ditambahkan</div>');
			redirect('admin/menu');
		}
	}

	function updateMenu()
	{
		$menu_id = $this->input->post('id');
		$menu = $this->input->post('menu');

		$this->db->where('id', $menu_id);
		$this->db->update('user_menu', ['menu' => $menu]);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil diganti</div>');
		redirect('admin/menu');
	}
	function deleteMenu($menu_id)
	{
		$this->db->delete('user_menu', ['id' => $menu_id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil dihapus</div>');
		redirect('admin/menu');
	}

	public function submenu()
	{
		$data['title'] = 'Sub Menu Management';
		$data['user'] = $this->db->get_where('anggota', ['email' => $this->session->userdata('email')])->row_array();
		$data['menu'] = $this->menu->getMenu();
		$data['subMenu'] = $this->menu->getSubMenu();
		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['user'] = $this->anggota->getUser();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/submenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')

			];
			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu berhasil ditambahkan</div>');
			redirect('admin/submenu');
		}
	}

	function updateSubMenu()
	{
		$data = [
			'title' => $this->input->post('title'),
			'menu_id' => $this->input->post('menu_id'),
			'url' => $this->input->post('url'),
			'icon' => $this->input->post('icon'),
			'is_active' => $this->input->post('is_active')
		];
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('user_sub_menu', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu berhasil diubah</div>');
		redirect('admin/submenu');
	}

	function deleteSubMenu($subMenu_id)
	{
		$this->db->delete('user_sub_menu', ['id' => $subMenu_id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu berhasil dihapus</div>');
		redirect('admin/submenu');
	}

	function th_ajaran()
	{
		$data['title'] = 'Tahun Ajaran';
		$data['user'] = $this->anggota->getUser();
		$data['inbox'] = $this->pesan->getInbox();
		$data['unread'] = $this->pesan->getUnread();
		$data['notifikasi'] = $this->pesan->getNotif();
		$data['th_ajaran'] = $this->data->getTh_ajaran();

		$this->form_validation->set_rules('th_ajaran', 'Tahun Ajaran', 'required|trim');
		$this->form_validation->set_rules('semester', 'Semester', 'required|trim');
		$this->form_validation->set_rules('aktif', 'Aktif', 'required|trim');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/th_ajaran', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'th_ajaran' => $this->input->post('th_ajaran'),
				'semester' => $this->input->post('semester'),
				'aktif' => $this->input->post('aktif'),
				'tgl_ukt' => $this->input->post('tgl_ukt')
			];

			$this->db->where('aktif', 1);
			$this->db->update('th_ajaran', ['aktif' => 0]);
			$this->db->insert('th_ajaran', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan</div>');
			redirect('admin/th_ajaran');
		}
	}

	function updateTh_ajaran()
	{
		$data = [
			'th_ajaran' => $this->input->post('th_ajaran'),
			'semester' => $this->input->post('semester'),
			'aktif' => $this->input->post('aktif'),
			'tgl_ukt' => $this->input->post('tgl_ukt'),
			'daftar_ukt' => $this->input->post('daftar_ukt')
		];

		$this->db->where('aktif', 1);
		$this->db->update('th_ajaran', ['aktif' => 0]);
		$this->db->where('id', decrypt_url($this->input->post('id')));
		$this->db->update('th_ajaran', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah</div>');
		redirect('admin/th_ajaran');
	}

	function deleteTh_ajaran($th_ajaran_id)
	{
		$this->db->delete('th_ajaran', ['id' => $th_ajaran_id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
		redirect('admin/th_ajaran');
	}
}
