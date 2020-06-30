<?php class Mo_indikatorNilai extends CI_Model{
	
	public function getDataNilai($data){
		$queryall = $this->db->get('tb_indikator');
		$sql = "SELECT * FROM tb_indikator
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

	public function getNilai($idIndikator){
		$sql = "SELECT * FROM tb_indikator WHERE idIndikator='$idIndikator' ";
		$query = $this->db->query($sql); 
		return $query->result();
	}
	public function insertNilai($data){
		$query = $this->db->insert('tb_indikator', $data);
		return $query;
	}
	public function updateNilai($data){
		$this->db->where('idIndikator',$data['idIndikator']); 
		$query=$this->db->update('tb_indikator',$data);
		return $query;
	}
	public function deleteNilai($data){
		$query=$this->db->delete('tb_indikator',$data); 
		return $query;
	}
	public function checkId($namaIndikator){
		$sql = "SELECT * FROM tb_indikator WHERE namaIndikator='$namaIndikator' ";
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