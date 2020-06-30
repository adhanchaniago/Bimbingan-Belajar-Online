<?php class Mo_supports extends CI_Model{
	public function getDataSupports($data){
		$queryall = $this->db->get('tb_supports_info');
		$sql = "SELECT * FROM tb_supports_info
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
	public function getSupports($id){
		$sql = "SELECT * FROM tb_supports_info WHERE id='$id' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insertSupports($data){
		$query = $this->db->insert('tb_supports_info', $data); return $query;
	}
	public function updateSupports($data){
		$this->db->where('id',$data['id']); 
		$query=$this->db->update('tb_supports_info',$data); return $query;
	}
	public function deleteSupports($data){
		$query=$this->db->delete('tb_supports_info',$data); return $query;
	}
	public function checkId($id){
		$sql = "SELECT * FROM tb_supports_info WHERE id='$id' ";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		if($total > 0){
			return "Data Sama";
		} else {
			return "OK";
		}
	}
	public function checkData(){
		$sql = "SELECT * FROM tb_supports_info where id!='0'";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		// print_r($total);die();
		if($total > 0){
			return "Data tidak boleh lebih dari satu";
		} else {
			return "OK";

		}
	}

	// Model for Supports API
	public function apiSupports(){
		$query = $this->db->query("SELECT * FROM `tb_supports_info` WHERE id=1"); return $query->result();
	}
}
?>