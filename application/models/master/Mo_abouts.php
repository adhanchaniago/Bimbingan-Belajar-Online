<?php class Mo_abouts extends CI_Model{
	// Model for web administrator
	public function getDataAbouts($data){
		$queryall = $this->db->get('tb_abouts');
		$sql = "SELECT * FROM tb_abouts
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
	public function getAbouts($id){
		$sql = "SELECT * FROM tb_abouts WHERE id='$id' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insertAbouts($data){
		$query = $this->db->insert('tb_abouts', $data); return $query;
	}
	public function updateAbouts($data){
		$this->db->where('id',$data['id']); 
		$query=$this->db->update('tb_abouts',$data); return $query;
	}
	public function deleteAbouts($data){
		$query=$this->db->delete('tb_abouts',$data); return $query;
	}
	public function checkId($id){
		$sql = "SELECT * FROM tb_abouts WHERE id='$id' ";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		if($total > 0){
			return "Data Sama";
		} else {
			return "OK";
		}
	}
	public function checkData(){
		$sql = "SELECT * FROM tb_abouts where id!='0'";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		// print_r($total);die();
		if($total > 0){
			return "Data tidak boleh lebih dari satu";
		} else {
			return "OK";

		}
	}

	
	// Model for abouts API
	public function apiAbouts(){
		$query = $this->db->query("SELECT * FROM tb_abouts"); return $query->result();
	}
}
?>