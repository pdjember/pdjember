<?php
class Data_model extends CI_Model
{

	public function getJmlAnggotaAktif()
	{

		$query = "SELECT COUNT('id') as `total` FROM `anggota` WHERE `st_aktif`=1 and `role_id` != 1";

		return $this->db->query($query)->row_array();
	}

	public function getJmlCalonAnggota()
	{
		$query = "SELECT COUNT('id') as `total` FROM `anggota` WHERE `resmi`=0";

		return $this->db->query($query)->row_array();
	}

	public function getJmlTidakAktif()
	{
		$query = "SELECT COUNT('id') as `total` FROM `anggota` WHERE `st_aktif`=0 and `role_id` != 1";

		return $this->db->query($query)->row_array();
	}

	public function getJmlPelatih()
	{

		$query = "SELECT COUNT('id') as `total` FROM `anggota` WHERE `st_aktif`=1 AND `role_id`=3";

		return $this->db->query($query)->row_array();
	}

	public function getJmlUnit()
	{
		$query = "SELECT COUNT('id') as `total` FROM `unit` WHERE `st_aktif`=1";

		return $this->db->query($query)->row_array();
	}
	public function getJmlTingkatan()
	{
		$query = "SELECT tingkatan.id,tingkatan.tingkatan,COUNT(anggota.id) AS `jumlah` 
		FROM anggota LEFT OUTER JOIN tingkatan ON tingkatan.id=anggota.id_tingkatan
		WHERE anggota.resmi=1 and anggota.role_id != 1 GROUP BY tingkatan.id";

		return $this->db->query($query)->result_array();
	}

	public function getAnggotaUnit()
	{
		$query = "SELECT unit.`id`,unit.`nama_unit`,COUNT(anggota.`id`) AS `jumlah` 
		FROM anggota LEFT OUTER JOIN unit ON unit.`id`=anggota.`id_unit`
		WHERE anggota.resmi=1 and anggota.`role_id` != 1 GROUP BY unit.`id`";

		return $this->db->query($query)->result_array();
	}

	public function getTotalAnggota()
	{
		$query = "SELECT count(id) as jumlah FROM anggota where resmi=1 and role_id != 1";

		return $this->db->query($query)->result_array();
	}

	public function getAnggota()
	{
		$query = "SELECT * from vw_anggota
					WHERE `resmi`=1 and `role_id` != 1 ORDER BY `nama` ASC";

		return $this->db->query($query)->result_array();
	}

	public function getAnggotaAktif()
	{
		$query = "SELECT * from vw_anggota
					WHERE `resmi`=1 AND `st_aktif`=1 and `role_id` != 1 ORDER BY `nama` ASC";

		return $this->db->query($query)->result_array();
	}

	public function getAnggotaNonAktif()
	{
		$query = "SELECT * from vw_anggota
					WHERE `st_aktif`=0 and `role_id` != 1 ORDER BY `nama` ASC";

		return $this->db->query($query)->result_array();
	}

	public function getPelatih()
	{
		$query = "SELECT * from vw_anggota
					WHERE `st_aktif`=1 AND `role_id`=3 ORDER BY `nama` ASC";

		return $this->db->query($query)->result_array();
	}

	public function getUnit()
	{
		$query = "SELECT * FROM `unit`
				    WHERE `st_aktif`=1";

		return $this->db->query($query)->result_array();
	}

	public function getTingkatan()
	{
		$query = "SELECT * FROM `tingkatan`";
		return $this->db->query($query)->result_array();
	}

	public function getMateriUkt()
	{
		$query = "SELECT `materi_ukt`.*,`tingkatan`.`tingkatan` FROM `materi_ukt`
		JOIN `tingkatan` on `materi_ukt`.`id_tingkatan` = `tingkatan`.`id`";
		return $this->db->query($query)->result_array();
	}
	public function getCalonAnggota()
	{
		$query = "SELECT `anggota`.*, `unit`.`nama_unit` from `anggota` 
					JOIN `unit`	ON `anggota`.`id_unit` = `unit`.`id`
					WHERE `anggota`.`resmi`=0";
		return $this->db->query($query)->result_array();
	}

	public function getRole()
	{
		$query = "SELECT * from `user_role` WHERE `id`>1";
		return $this->db->query($query)->result_array();
	}

	public function getKategori()
	{
		$query = "SELECT * from `kategori`";
		return $this->db->query($query)->result_array();
	}

	public function getPrestasi()
	{
		$query = "SELECT * from vw_prestasi 
		ORDER BY `tgl_event` DESC ";
		return $this->db->query($query)->result_array();
	}

	public function getTh_ajaran()
	{
		$query = "SELECT * FROM `th_ajaran` ORDER BY `aktif` DESC";
		return $this->db->query($query)->result_array();
	}

	public function getTh_ajaran_aktif()
	{
		$query = "SELECT * FROM `th_ajaran` WHERE `aktif`=1";
		return $this->db->query($query)->row_array();
	}

	public function tglDaftarUkt()
	{
		$query = "SELECT ADDDATE(tgl_ukt, INTERVAL -1 MONTH) AS tgl_pendafaran FROM th_ajaran WHERE aktif = 1 ";
		return $this->db->query($query)->row_array();
	}

	public function getTh_ajaran_aktif1()
	{
		$query = "SELECT * FROM `th_ajaran` WHERE `aktif`=1";
		return $this->db->query($query)->result();
	}

	public function getOrganisasi()
	{
		$query = "SELECT profile_org.*, anggota.nama FROM `profile_org` 
		JOIN anggota ON anggota.id = profile_org.id_ketua WHERE profile_org.id=1";
		return $this->db->query($query)->row_array();
	}

	public function getFiles()
	{
		$query = "SELECT file_center.*, anggota.nama FROM `file_center` 
		JOIN anggota ON anggota.id = file_center.id_anggota WHERE 1";
		return $this->db->query($query)->result_array();
	}
}
