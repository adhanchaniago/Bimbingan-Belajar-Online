<?php class aksesHalamanModel extends CI_Model{
	public function getDataAksesHalaman($data){
		$queryall = $this->db->get('tb_menuaccess');
		$sql = "SELECT tb_menuaccess.`view`, tb_menuaccess.menuaccessid, tb_level.`LEVEL`,tb_menu.menuname FROM tb_menuaccess 
		INNER JOIN tb_menu ON tb_menuaccess.menuid = tb_menu.menuid 
		INNER JOIN tb_level ON tb_menuaccess.IDLEVEL = tb_level.IDLEVEL
		where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
		$data = $query->result();
		$total = $queryall->num_rows();
		$dataRecord = array(
			"RecordsTotal" => $total,
			"RecordsFiltered" => $total,
			"Data" => $data,
		); return $dataRecord;
	}
	public function getAksesHalaman($menuaccessid){
		$sql = "SELECT * FROM tb_menuaccess WHERE menuaccessid='$menuaccessid' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insertAksesHalaman($data){
		$query = $this->db->insert('tb_menuaccess', $data); return $query;
	}
	public function updateAksesHalaman($data){
		$this->db->where('menuaccessid',$data['menuaccessid']); 
		$query=$this->db->update('tb_menuaccess',$data); return $query;
	}
	public function deleteAksesHalaman($data){
		$query=$this->db->delete('tb_menuaccess',$data); return $query;
	}
}
?>