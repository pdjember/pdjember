<?php

class Ketua_model extends CI_Model
{
	public function getAnggotaUnit()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT * from vw_anggota
					WHERE `resmi`=1 AND `id_unit` = '$unit' and `role_id`!=1";

		return $this->db->query($query)->result_array();
	}

	public function getAnggotaAktif()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT * from vw_anggota
					WHERE `resmi`=1 AND `st_aktif`=1 AND `id_unit` = '$unit' and `role_id`!=1";

		return $this->db->query($query)->result_array();
	}

	public function getAnggotanonAktif()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT * from vw_anggota
					WHERE `st_aktif`=0 AND `id_unit` = '$unit'";

		return $this->db->query($query)->result_array();
	}

	public function getCalonAnggota()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT * from vw_anggota
					WHERE `resmi`=0 AND `id_unit` = '$unit'";

		return $this->db->query($query)->result_array();
	}

	public function getJmlAnggotaUnitTotal()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT COUNT(`id`) AS `jumlah` FROM `anggota` WHERE `id_unit`= '$unit' and `role_id`!=1";

		return $this->db->query($query)->row_array();
	}

	public function getJmlAnggotaUnitAktif()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT COUNT(`id`) AS `jumlah` FROM `anggota` WHERE `id_unit`= '$unit' AND `st_aktif`=1 and `role_id`!=1";

		return $this->db->query($query)->row_array();
	}

	public function getJmlAnggotaUnitNonAktif()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT COUNT(`id`) AS `jumlah` FROM `anggota` WHERE `id_unit`= '$unit' AND `st_aktif`=0";

		return $this->db->query($query)->row_array();
	}

	public function getJmlCalonAnggotaUnit()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT COUNT(`id`) AS `jumlah` FROM `anggota` WHERE `id_unit`= '$unit' AND `resmi`=0 and `anggota`.`role_id`!=1";

		return $this->db->query($query)->row_array();
	}
	public function getJmlTingkat()
	{
		$unit = $this->session->userdata('id_unit');
		$query = "SELECT tingkatan.id,tingkatan.tingkatan,COUNT(anggota.id) AS `jumlah` 
		FROM anggota LEFT OUTER JOIN tingkatan ON tingkatan.id=anggota.id_tingkatan
		WHERE anggota.resmi=1 AND anggota.id_unit = $unit and `anggota`.`role_id`!=1 GROUP BY tingkatan.id";

		return $this->db->query($query)->result_array();
	}
}
