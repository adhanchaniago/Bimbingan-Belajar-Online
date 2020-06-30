<?php class Mo_riwayatLomba extends CI_Model{
	
	public function getDataLomba($data){
		$queryall = $this->db->get('tb_lombaartikel');
		$sql = "SELECT * FROM tb_lombaartikel
		where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' 
		limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
		$data = $query->result();
		$total = $queryall->num_rows();
		$dataRecord = array(
			"RecordsTotal" => $total,
			"RecordsFiltered" => $total,
			"Data" => $data,
		); 
		return $dataRecord;
	}

	public function getLomba($idLomba){
		$sql = "SELECT * FROM tb_lombaartikel WHERE idLomba='$idLomba' ";
		$query = $this->db->query($sql); 
		return $query->result();
	}
	public function insertLomba($data){
		$query = $this->db->insert('tb_lombaartikel', $data);
		return $query;
	}
	public function updateLomba($data){
		$this->db->where('idLomba',$data['idLomba']); 
		$query=$this->db->update('tb_lombaartikel',$data);
		return $query;
	}
	public function deleteLomba($data){
		$query=$this->db->delete('tb_lombaartikel',$data); 
		return $query;
	}
	public function checkId($idLomba){
		$sql = "SELECT * FROM tb_lombaartikel WHERE idLomba='$idLomba' ";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		if($total > 0){
			return "Data Anda Sama";
		} else {
			return "OK";
		}
	}
}
?>