<?php
class Ukt_model extends CI_Model
{
    public function getPesertaUkt()
    {
        $query = "SELECT `anggota`.*, `unit`.`nama_unit`,`tingkatan`.`tingkatan`, (`tingkatan`.`id`+1) as tingkatan2 from `anggota` 
        JOIN `unit`	ON `anggota`.`id_unit` = `unit`.`id`
        JOIN `tingkatan` ON `anggota`.`id_tingkatan` = `tingkatan`.`id`
					WHERE `anggota`.`ukt`=1 ORDER BY `anggota`.`id_tingkatan`, `anggota`.`nama` ASC";

        return $this->db->query($query)->result_array();
    }

    public function getPenguji()
    {
        $query = "SELECT `penguji_ukt`.*,`tingkatan`.`tingkatan`,`anggota`.`nama` from `penguji_ukt` 
        JOIN `tingkatan` ON `penguji_ukt`.`penguji` = `tingkatan`.`id`
        JOIN `anggota` ON `penguji_ukt`.`id_anggota` = `anggota`.`id`
					WHERE `anggota`.`role_id`=8 ORDER BY `anggota`.`id_tingkatan`, `anggota`.`nama` ASC";

        return $this->db->query($query)->result_array();
    }

    public function getTingkatan()
    {
        $query = "SELECT * FROM tingkatan where id < 8 ";
        return $this->db->query($query)->result();
    }


    public function getPeserta($kd_materi_id)
    {
        $query = "SELECT anggota.id,anggota.nama,anggota.id_tingkatan 
        as tingkat,materi_ukt.kd_materi,materi_ukt.materi,materi_ukt.id_tingkatan,unit.nama_unit 
        FROM anggota JOIN materi_ukt on anggota.id_tingkatan = materi_ukt.id_tingkatan 
        JOIN unit ON anggota.id_unit = unit.id WHERE anggota.ukt =1 AND materi_ukt.kd_materi='$kd_materi_id' ";
        return $this->db->query($query)->result_array();
    }

    public function getMateri()
    {
        $id_penguji = $this->session->userdata('id');
        $query = "SELECT materi_ukt.*,penguji_ukt.id_anggota,penguji_ukt.penguji 
        FROM materi_ukt JOIN penguji_ukt ON penguji_ukt.penguji = materi_ukt.id_tingkatan 
        WHERE penguji_ukt.id_anggota = $id_penguji";
        return $this->db->query($query)->result_array();
    }

    public function getNilai($kd_materi_id)
    {
        $id_penguji = $this->session->userdata('id');
        $th_ajaran = $this->session->userdata('th_ajaran');
        $query = "SELECT nilai_ukt.id, anggota.nama, unit.nama_unit, materi_ukt.materi, nilai_ukt.nilai FROM nilai_ukt
        JOIN anggota ON anggota.id = nilai_ukt.id_anggota
        JOIN materi_ukt ON materi_ukt.kd_materi = nilai_ukt.kd_materi
        JOIN unit ON anggota.id_unit = unit.id
        WHERE nilai_ukt.kd_materi = '$kd_materi_id' AND nilai_ukt.id_penguji='$id_penguji' AND nilai_ukt.id_th_ajaran = '$th_ajaran'";

        return $this->db->query($query)->result_array();
    }
    public function getJmlTingkatan()
    {
        $query = "SELECT tingkatan.id,tingkatan.tingkatan,COUNT(anggota.id) AS `jumlah` 
		FROM anggota LEFT OUTER JOIN tingkatan ON tingkatan.id=anggota.id_tingkatan
		WHERE anggota.ukt=1 GROUP BY tingkatan.id";

        return $this->db->query($query)->result_array();
    }

    public function getJmlUnit()
    {
        $query = "SELECT unit.id,unit.nama_unit,COUNT(anggota.id) AS `jumlah` 
        FROM anggota LEFT OUTER JOIN unit ON unit.id=anggota.id_unit 
        WHERE anggota.ukt=1 GROUP BY unit.id ";

        return $this->db->query($query)->result_array();
    }

    public function simpanNilai($data)
    {
        $i = 0;
        $id_penguji = $this->session->userdata('id');
        $th_ajaran = $this->session->userdata('th_ajaran');
        $kd = $data['kd'];
        $nilai = $data['nilai'];
        foreach ($data['id'] as $id) {
            $record = array(
                'id_anggota' => $id,
                'kd_materi' => $kd,
                'nilai' =>  $nilai[$i],
                'id_penguji' => $id_penguji,
                'id_th_ajaran' => $th_ajaran
            );
            $this->db->insert('nilai_ukt', $record);
            $i++;
        }
    }

    function getAdminPeserta()
    {
        $th_ajaran = $this->session->userdata('th_ajaran');
        $query = "SELECT admin_ukt.id_anggota, anggota.nama, unit.nama_unit, admin_ukt.bayar, admin_ukt.foto, admin_ukt.ijazah FROM admin_ukt
        JOIN anggota ON anggota.id = admin_ukt.id_anggota 
        JOIN unit ON unit.id = anggota.id_unit
        WHERE id_th_ajaran = '$th_ajaran' ORDER BY anggota.nama";

        return $this->db->query($query)->result_array();
    }

    function getKenaikan()
    {
        $query = "SELECT `anggota`.*, `unit`.`nama_unit`,`tingkatan`.`tingkatan`, (`tingkatan`.`id`+1) as tingkatan2 from `anggota` 
        JOIN `unit`	ON `anggota`.`id_unit` = `unit`.`id`
        JOIN `tingkatan` ON `anggota`.`id_tingkatan`+1 = `tingkatan`.`id`
					WHERE `anggota`.`ukt`=1 ORDER BY `anggota`.`id_tingkatan`, `anggota`.`nama` ASC";

        return $this->db->query($query)->result_array();
    }

    function getNilaiIjazah($id_tingkatan)
    {
        $th_ajaran = $this->session->userdata('th_ajaran');
        $this->db->query("SET @sql = ''");
        $this->db->query("SELECT GROUP_CONCAT(DISTINCT CONCAT('max(case when kd_materi = ''',kd_materi,''' then nilai else 0 end) AS ',kd_materi)) INTO @sql FROM vw_nilai_ijazah WHERE id_tingkatan = '$id_tingkatan'");
        $this->db->query("SET @sql = CONCAT('SELECT nama, tingkatan, nama_unit, ', @sql, ' FROM vw_nilai_ijazah WHERE id_tingkatan = ''$id_tingkatan'' AND id_th_ajaran = ''$th_ajaran'' GROUP BY nama')");
        $this->db->query("PREPARE stmt FROM @sql");
        $this->db->query("EXECUTE stmt");
        $this->db->query("DEALLOCATE PREPARE stmt");

        $query = $this->db->get();
        return $query->result();
    }
}
