<?php class HelperModel extends CI_Model{
	public function getDataUrut($namaForm){
		$sql = "SELECT * FROM tb_urut WHERE namaForm='$namaForm' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function updateDataUrut($namaForm, $noUrut){
		$this->db->where('namaForm',$namaForm); 
		$query=$this->db->update('tb_urut',array('noUrut'=>($noUrut+1))); 
		return $query;
	}
}?>