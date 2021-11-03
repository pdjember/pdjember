<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bendahara_model extends CI_Model
{
    public function getPemasukanCabang()
    {
        $query = "SELECT * FROM vw_kas_cabang WHERE `jenis_trx`='D' ORDER BY `tgl_trx` DESC";

        return $this->db->query($query)->result_array();
    }

    public function getJmlPemasukanCabang()
    {
        $query = "SELECT SUM(`nominal`) AS `jml_pemasukan` FROM `kas_cabang` 
        WHERE `jenis_trx`='D'";

        return $this->db->query($query)->result_array();
    }

    public function getPengeluaranCabang()
    {
        $query = "SELECT * FROM vw_kas_cabang WHERE `jenis_trx`='C' ORDER BY `tgl_trx` DESC";

        return $this->db->query($query)->result_array();
    }

    public function getJmlPengeluaranCabang()
    {
        $query = "SELECT SUM(`nominal`) AS `jml_pengeluaran` FROM `kas_cabang` 
        WHERE `jenis_trx`='C'";

        return $this->db->query($query)->result_array();
    }

    public function printLaporanCabangAll()
    {
        $query = "SELECT * FROM `kas_cabang` 
        WHERE 1 ORDER BY `tgl_trx` ASC";

        return $this->db->query($query)->result();
    }

    function printPemasukanCabangAll()
    {
        $query = "SELECT sum(`nominal`) as jumlah FROM `kas_cabang` 
        WHERE `jenis_trx`='D'";

        return $this->db->query($query)->result();
    }

    function printPengeluaranCabangAll()
    {
        $query = "SELECT sum(`nominal`) as jumlah FROM `kas_cabang` 
        WHERE `jenis_trx`='C'";

        return $this->db->query($query)->result();
    }



    public function getPemasukanUnit()
    {
        $unit = $this->session->userdata('id_unit');
        $query = "SELECT * FROM vw_kas_unit  WHERE `id_unit`='$unit' AND `jenis_trx`='D' ORDER BY `tgl_trx` DESC";

        return $this->db->query($query)->result_array();
    }

    public function getJmlPemasukanUnit()
    {
        $unit = $this->session->userdata('id_unit');
        $query = "SELECT SUM(`nominal`) AS `jml_pemasukan` FROM `kas_unit` 
        WHERE `id_unit`='$unit' AND `jenis_trx`='D'";

        return $this->db->query($query)->result_array();
    }

    public function getPengeluaranUnit()
    {
        $unit = $this->session->userdata('id_unit');
        $query = "SELECT * FROM vw_kas_unit WHERE `id_unit`='$unit' AND `jenis_trx`='C' ORDER BY `tgl_trx` DESC";

        return $this->db->query($query)->result_array();
    }

    public function getJmlPengeluaranUnit()
    {
        $unit = $this->session->userdata('id_unit');
        $query = "SELECT SUM(`nominal`) AS `jml_pengeluaran` FROM `kas_unit` 
        WHERE `id_unit`='$unit' AND `jenis_trx`='C'";

        return $this->db->query($query)->result_array();
    }

    public function printLaporanUnitAll()
    {
        $unit = $this->session->userdata('id_unit');
        $query = "SELECT * FROM `kas_unit` 
        WHERE `id_unit` = '$unit' ORDER BY `tgl_trx` ASC";

        return $this->db->query($query)->result();
    }

    function printPemasukanUnitAll()
    {
        $unit = $this->session->userdata('id_unit');
        $query = "SELECT sum(`nominal`) as jumlah FROM `kas_unit` 
        WHERE `id_unit` = '$unit' AND `jenis_trx`='D'";

        return $this->db->query($query)->result();
    }

    function printPengeluaranUnitAll()
    {
        $unit = $this->session->userdata('id_unit');
        $query = "SELECT sum(`nominal`) as jumlah FROM `kas_unit` 
        WHERE `id_unit` = '$unit' AND `jenis_trx`='C'";

        return $this->db->query($query)->result();
    }

    public function getLapCabang()
    {
        $query = "SELECT * FROM vw_kas_cabang WHERE 1 ORDER BY tgl_trx DESC";

        return $this->db->query($query)->result_array();
    }

    public function getLapUnit()
    {
        $unit = $this->session->userdata('id_unit');
        $query = "SELECT * FROM vw_kas_unit WHERE id_unit='$unit' ORDER BY tgl_trx DESC";

        return $this->db->query($query)->result_array();
    }
}
