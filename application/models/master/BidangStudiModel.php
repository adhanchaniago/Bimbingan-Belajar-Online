<?php class BidangStudiModel extends CI_Model{
	public function getDataBidangStudi($data){
		$queryall = $this->db->get('tb_bidangstudi');
		$sql = "SELECT * FROM tb_bidangstudi
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
	public function getBidangStudi($id_bidangStudi){
		$sql = "SELECT * FROM tb_bidangstudi WHERE id_bidangStudi='$id_bidangStudi' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insertBidangStudi($data){
		$query = $this->db->insert('tb_bidangstudi', $data); return $query;
	}
	public function updateBidangStudi($data){
		$this->db->where('id_bidangStudi',$data['id_bidangStudi']); 
		$query=$this->db->update('tb_bidangstudi',$data); return $query;
	}
	public function deleteBidangStudi($data){
		$query=$this->db->delete('tb_bidangstudi',$data); return $query;
	}
	public function checkId($namaBidangStudi){
		$sql = "SELECT * FROM tb_bidangstudi WHERE namaBidangStudi='$namaBidangStudi' ";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		if($total > 0){
			return "Data Sama";
		} else {
			return "OK";
		}
	}
}
?>