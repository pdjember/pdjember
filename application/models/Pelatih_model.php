<?php
class Pelatih_model extends CI_Model
{
    public function getAnggotaUnit()
    {
        $unit = $this->session->userdata('id_unit');
        $query = "SELECT * from vw_anggota WHERE `st_aktif` = 1 AND `id_unit` = '$unit' AND `role_id` != 1 
        ORDER BY `nama` ASC";

        return $this->db->query($query)->result_array();
    }

    public function getAbsensi()
    {
        $unit = $this->session->userdata('id_unit');
        $query = "SELECT absensi.*,anggota.nama,anggota.id_unit,unit.nama_unit
        FROM absensi
        JOIN anggota ON absensi.id_anggota = anggota.id
        JOIN unit ON absensi.id_unit = unit.id 
        WHERE absensi.tanggal = CURDATE() AND absensi.lokasi = '$unit' ORDER BY absensi.jam DESC";

        return $this->db->query($query)->result_array();
    }
    public function simpanAbsen($data)
    {
        $th_ajaran = $this->db->get_where('th_ajaran', ['aktif' => 1])->row_array();
        $i = 0;
        foreach ($data['id'] as $id) {
            date_default_timezone_set('Asia/Jakarta');
            $record = array(
                'id_anggota' => $id,
                'tanggal' => date('Y-m-d'),
                'jam' => date('H:i'),
                'id_unit' => $this->session->userdata('id_unit'),
                'id_pelatih' => $this->session->userdata('id'),
                'lokasi' => $this->session->userdata('id_unit'),
                'id_th_ajaran' => $th_ajaran['id']
            );
            $this->db->insert('absensi', $record);
            $i++;
        }
    }

    public function getDataFisik()
    {
        $unit = $this->session->userdata('id_unit');
        $query = "SELECT `anggota`.`id`,`anggota`.`nama`,`anggota`.`st_aktif`,`ability`.* from `ability`
        JOIN `anggota` ON `anggota`.`id` = `ability`.`id_anggota`
        WHERE `anggota`.`st_aktif`=1 AND `anggota`.`id_unit` = '$unit' ORDER BY `anggota`.`nama` ASC";
        return $this->db->query($query)->result_array();
    }
}
