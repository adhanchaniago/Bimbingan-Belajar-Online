<?php class BuktiTransModel extends CI_Model{
	public function getDataBuktiTrans($data){
		$queryall = $this->db->get('tb_buktitrans ');
		$sql = "SELECT * from tb_buktitrans WHERE STATUS='DIBUAT' LIMIT " .$data["start"].",".$data['length'];
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
	public function getAkun(){
		$sql = "SELECT * FROM tb_masterakun where IDSTATUSAKUN=11";
		$query = $this->db->query($sql); return $query->result();
	}
	public function getFilterAkun($q){
		$sql = "SELECT * FROM tb_masterakun where AKUN like '%" .$q. "%' or NAMAAKUN like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}
	public function getBuktiTrans($NOMOBT){
		$sql = "SELECT tb_buktitrans.*, tb_detailbt.ADEBET, tb_detailbt.AKREDIT, tb_detailbt.KETERANGAN, tb_detailbt.JDEBET, tb_detailbt.JKREDIT, md.NAMAAKUN as NAMADEBET, mk.NAMAAKUN as NAMAKREDIT FROM tb_buktitrans inner join tb_detailbt on tb_buktitrans.NOMOBT=tb_detailbt.NOMOBT left join tb_masterakun md on md.AKUN=tb_detailbt.ADEBET left join tb_masterakun mk on mk.AKUN=tb_detailbt.AKREDIT WHERE tb_buktitrans.NOMOBT='$NOMOBT' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function insertBuktiTrans($data){ 
		$query = $this->db->insert('tb_buktitrans', $data); 
		return $query;
	}
	public function insertDetailBt($data){ 
		$query = $this->db->insert('tb_detailbt', $data); 
		return $query;
	}
	public function updateBuktiTrans($data){
		$this->db->where('NOMOBT',$data['NOMOBT']); 
		$query=$this->db->update('tb_buktitrans',$data); 
		return $query;
	}
	public function deleteBuktiTrans($data){
		$this->db->where('NOMOBT',$data['NOMOBT']); 
		$query=$this->db->delete('tb_buktitrans',$data);
		return $query;
	}
	public function deleteDetailBt($data){
		$this->db->where('NOMOBT',$data['NOMOBT']); 
		$query=$this->db->delete('tb_detailbt',$data);
		return $query;
	}
	public function getDataBuktiTransAcc($data){
		$queryall = $this->db->get('tb_buktitrans ');
		$sql = "SELECT * from tb_buktitrans WHERE STATUS='".$data['status']."' LIMIT " .$data["start"].",".$data['length'];
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
}
?>