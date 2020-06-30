<?php class KategoriModel extends CI_Model{
	public function getDataKategori($data){
		$queryall = $this->db->get('tb_kategori');
		$sql = "SELECT * FROM tb_kategori
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
	public function getKategori($KODEKATEGORI){
		$sql = "SELECT * FROM tb_kategori WHERE KODEKATEGORI='$KODEKATEGORI' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insertKategori($data){
		$query = $this->db->insert('tb_kategori', $data); return $query;
	}
	public function updateKategori($data){
		$this->db->where('KODEKATEGORI',$data['KODEKATEGORI']); 
		$query=$this->db->update('tb_kategori',$data); return $query;
	}
	public function deleteKategori($data){
		$query=$this->db->delete('tb_kategori',$data); return $query;
	}
	public function checkId($KODEKATEGORI){
		$sql = "SELECT * FROM tb_kategori WHERE KODEKATEGORI='$KODEKATEGORI' ";
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