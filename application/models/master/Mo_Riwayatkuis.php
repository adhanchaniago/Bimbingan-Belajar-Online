<?php class Mo_Riwayatkuis extends CI_Model{
	public function getDatakuis($data){
		$queryall = $this->db->get('tb_gokuis');
		$sql = "SELECT * 
		FROM tb_gokuis
		INNER JOIN tb_kuis ON tb_gokuis.tb_kuis_id_kuis=tb_kuis.id_kuis
		INNER JOIN tb_kategori_kuis on tb_kuis.tb_kategori_kuis_id_kategori_kuis = tb_kategori_kuis.id_kategori_kuis
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
	public function getkuis($id){
		$sql = " SELECT * 
		FROM tb_gokuis
		INNER JOIN tb_kuis ON tb_gokuis.tb_kuis_id_kuis=tb_kuis.id_kuis
		INNER JOIN tb_kategori_kuis on tb_kuis.tb_kategori_kuis_id_kategori_kuis = tb_kategori_kuis.id_kategori_kuis where id_gokuis='$id' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insertkuis($data){
		$query = $this->db->insert('tb_kuis', $data); return $query;
	}
	public function updatekuis($data){
		$this->db->where('id_kuis',$data['id']); 
		$query=$this->db->update('tb_kuis',$data); return $query;
	}
	public function deletekuis($data){
		$query=$this->db->delete('tb_kuis',$data); return $query;
	}
	public function checkId($id){
		$sql = "SELECT * FROM tb_kuis WHERE id_kuis='$id' ";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		if($total > 0){
			return "Data Sama";
		} else {
			return "OK";
		}
	}
	public function checkData(){
		$sql = "SELECT * FROM tb_kuis where id!='0'";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		// print_r($total);die();
		if($total > 0){
			return "Data tidak boleh lebih dari satu";
		} else {
			return "OK";

		}
	}
	// Model for kuis API
	public function apikuis(){
		$query = $this->db->query("SELECT * FROM `tb_kuis` WHERE id=1"); return $query->result();
	}
}
?>