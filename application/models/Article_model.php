<?php  
class Article_model extends CI_Model
{
	public function getNews()
	{
		$query = "SELECT `news`.*,`anggota`.`nama` FROM news
					JOIN `anggota` ON `news`.`id_operator`=`anggota`.`id`";
		
		return $this->db->query($query)->result_array();
	}
}

?>