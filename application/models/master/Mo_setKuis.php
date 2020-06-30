<?php class Mo_setKuis extends CI_Model{
	public function getDatasetKuis($data){
		$queryall = $this->db->get('tb_kuis');
		$sql = "SELECT tb_kuis.id_kuis, 
		tb_kuis.tb_kategori_kuis_id_kategori_kuis as kuis_kategoriKuisId, 
		tb_kuis.namaKuis, 
		tb_kuis.keterangan, 
		tb_icons.idIcons,
		tb_icons.namaIcon, 
		tb_icons.src,
		tb_kategori_kuis.id_kategori_kuis as kategoriKuisId, 
		tb_kategori_kuis.kategoriKuis as kategoriKuis
		from tb_kuis 
		INNER JOIN tb_icons ON tb_kuis.idIcons=tb_icons.idIcons
		INNER JOIN tb_kategori_kuis ON tb_kuis.tb_kategori_kuis_id_kategori_kuis=tb_kategori_kuis.id_kategori_kuis  
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
	public function getsetKuis($id){
		$sql = "SELECT tb_kuis.id_kuis, 
		tb_kuis.tb_kategori_kuis_id_kategori_kuis as kuis_kategoriKuisId, 
		tb_kuis.namaKuis, 
		tb_kuis.keterangan, 
		tb_icons.idIcons,
		tb_icons.namaIcon,
		tb_icons.src,
		tb_kategori_kuis.id_kategori_kuis as kategoriKuisId, 
		tb_kategori_kuis.kategoriKuis as kategoriKuis
		from tb_kuis 
		INNER JOIN tb_icons ON tb_kuis.idIcons=tb_icons.idIcons
		INNER JOIN tb_kategori_kuis ON tb_kuis.tb_kategori_kuis_id_kategori_kuis=tb_kategori_kuis.id_kategori_kuis  where tb_kuis.id_kuis='$id' ";
		$query = $this->db->query($sql); return $query->result();
	}
	// public function getFilterKategoriKuis($q){
	// 	$sql = "SELECT * FROM tb_kategori_kuis where nama like '%" .$q. "%' LIMIT 10";
	// 	$query = $this->db->query($sql); return $query->result();
	// }
	public function getfilterDataIcons($q){
		$sql = "SELECT * FROM tb_icons INNER JOIN tb_pathProjek ON tb_icons.folProjekId = tb_pathProjek.id where namaIcon like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insertsetKuis($data){
		$query = $this->db->insert('tb_kuis', $data); return $query;
	}
	public function updatesetKuis($data){
		$this->db->where('id_kuis',$data['id']); 
		$query=$this->db->update('tb_kuis',$data); return $query;
	}
	public function deletesetKuis($data){
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
	// Model for setKuis API
	public function apisetKuis(){
		$query = $this->db->query("SELECT * FROM `tb_kuis` WHERE id=1"); return $query->result();
	}
}
?>