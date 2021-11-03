<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Pesan_model extends CI_Model
{

	public function getPenerima()
	{
		$id = $this->session->userdata('id');
		$query = "SELECT `anggota`.*, `unit`.`nama_unit` from `anggota` JOIN `unit`
					ON `anggota`.`id_unit` = `unit`.`id`
					WHERE `anggota`.`id` != $id";

		return $this->db->query($query)->result_array();
	}

	public function getInbox()
	{
		$id = $this->session->userdata('email');
		$query = "SELECT `pesan`.*, `anggota`.`nama`,`anggota`.`image` from `pesan`
 					JOIN `anggota` ON `pesan`.`from` = `anggota`.`email`
 					WHERE `pesan`.`to` = '$id' AND `pesan`.`to_del`=0  
					 ORDER BY `date_sent` DESC";

		return $this->db->query($query)->result_array();
	}

	public function getOutbox()
	{
		$id = $this->session->userdata('email');
		$query = "SELECT `pesan`.*, `anggota`.`nama`,`anggota`.`image` from `pesan`
 					JOIN `anggota` ON `pesan`.`to` = `anggota`.`email`
 					WHERE `pesan`.`from` = '$id' AND `pesan`.`fr_del`=0 ORDER BY `date_sent` DESC";

		return $this->db->query($query)->result_array();
	}

	public function getUnread()
	{
		$id = $this->session->userdata('email');
		$query = "SELECT count(`id`) as `total` FROM `pesan` WHERE `to_read`= 0 AND `to` = '$id'";

		return $this->db->query($query)->row_array();
	}

	public function getNotif()
	{
		$id = $this->session->userdata('email');
		$query = "SELECT `pesan`.*, `anggota`.`nama`, `anggota`.`image` from `pesan`
 					JOIN `anggota` ON `pesan`.`from` = `anggota`.`email`
 					WHERE `pesan`.`to` = '$id' AND `to_read`=0 ORDER BY `date_sent` DESC LIMIT 5";

		return $this->db->query($query)->result_array();
	}

	public function getPesan($notifikasi_id)
	{
		$query = "SELECT `pesan`.*, `anggota`.`id` as id_anggota,`anggota`.`nama`,`anggota`.`image` from `pesan`
 					JOIN `anggota` ON `pesan`.`from` = `anggota`.`email`
 					WHERE `pesan`.`id` = '$notifikasi_id'";

		return $this->db->query($query)->row_array();
	}

	public function getPesanKeluar($notifikasi_id)
	{
		$query = "SELECT `pesan`.*, `anggota`.`nama` from `pesan`
 					JOIN `anggota` ON `pesan`.`to` = `anggota`.`email`
 					WHERE `pesan`.`id` = '$notifikasi_id'";

		return $this->db->query($query)->row_array();
	}

	public function getSurat()
	{
		$query = "SELECT * FROM `surat` ORDER BY `tanggal` DESC";
		return $this->db->query($query)->result_array();
	}
}
