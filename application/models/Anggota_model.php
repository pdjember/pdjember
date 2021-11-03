<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Anggota_model extends CI_Model
{

	public function getAnggota()
	{
		$query = "SELECT `anggota`.*, `unit`.`nama_unit` from `anggota` JOIN `unit`
					ON `anggota`.`id_unit` = `unit`.`id`";

		return $this->db->query($query)->result_array();
	}

	public function jumlahAnggota()
	{
		$query = "SELECT COUNT(`id`) FROM `anggota` WHERE `st_aktif`=1";
		return $this->db->query($query)->result_array();
	}

	public function getUser()
	{
		$id = $this->session->userdata('id');
		$query = "SELECT * FROM vw_user WHERE `id` = '$id'";

		return $this->db->query($query)->row_array();
	}

	public function printUser()
	{
		$dataAnggota_id = $this->session->userdata('id');
		$query = "SELECT `anggota`.*, `unit`.`nama_unit`,`tingkatan`.`tingkatan` from `anggota` 
					JOIN `unit`	ON `anggota`.`id_unit` = `unit`.`id`
					JOIN `tingkatan` ON `anggota`.`id_tingkatan` = `tingkatan`.`id`
					WHERE `anggota`.`id` = '$dataAnggota_id'";

		return $this->db->query($query)->result();
	}

	public function printPT()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT unit.*, anggota.nama AS pt FROM unit
		JOIN anggota on anggota.id = unit.id_pt
		where unit.id = '$unit'";
		return $this->db->query($query)->result();
	}

	public function getNilai()
	{
		$id = $this->session->userdata('id');
		$query = "SELECT anggota.id,anggota.nama,nilai_ukt.kd_materi,round(AVG(nilai_ukt.nilai)) AS rata2,materi_ukt.materi 
		FROM anggota JOIN nilai_ukt ON nilai_ukt.id_anggota = anggota.id 
		JOIN materi_ukt ON materi_ukt.kd_materi = nilai_ukt.kd_materi 
		WHERE anggota.id='$id' GROUP BY nilai_ukt.kd_materi";

		return $this->db->query($query)->result_array();
	}

	function getKehadiran()
	{
		$id_anggota = $this->session->userdata('id');
		$th_ajaran = $this->session->userdata('th_ajaran');

		$query = "SELECT absensi.tanggal, absensi.jam, unit.nama_unit as lokasi, absensi.id_pelatih FROM absensi
		JOIN unit ON unit.id = absensi.lokasi
		WHERE absensi.id_anggota ='$id_anggota' and absensi.id_th_ajaran = '$th_ajaran' ORDER BY absensi.jam, absensi.tanggal  DESC";

		return $this->db->query($query)->result_array();
	}

	function getJmlKehadiran()
	{
		$id_anggota = $this->session->userdata('id');
		$th_ajaran = $this->session->userdata('th_ajaran');

		$query = "SELECT COUNT(id_anggota) as jumlah FROM absensi 
		WHERE id_anggota='$id_anggota' AND id_th_ajaran='$th_ajaran'";

		return $this->db->query($query)->row_array();
	}

	function getJmlKehadiranMinimum()
	{

		$unit = $this->session->userdata('id_unit');
		$query = "SELECT (0.7*jml_hari) as jumlah FROM unit WHERE id='$unit'";

		return $this->db->query($query)->row_array();
	}

	function getPrestasi()
	{
		$dataAnggota_id = $this->session->userdata('id');
		$query = "SELECT * from vw_prestasi
		WHERE `id_anggota`=$dataAnggota_id ORDER BY `tgl_event` DESC";

		return $this->db->query($query)->result_array();
	}

	function getUnit()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT jml_hari from unit where id='$unit' ";
		return $this->db->query($query)->row_array();
	}

	function getUnitAbsen()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT id,nama_unit from unit where hari like '%" . date('w') . "%'";
		return $this->db->query($query)->result_array();
	}
}
