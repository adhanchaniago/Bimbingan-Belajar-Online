<?php class Mo_kritikSaran extends CI_Model{
	// Model for web administrator
	public function getDatakritikSaran($data){
		$queryall = $this->db->get('app_kritiksaran');
		$filtertext = $data['filtertext'];
		if ($filtertext != "") {
			$filter = " ".$data['filtervalue']. " like '%" .$data['filtertext']. "%' ";
		} else{
			$filter = " setatus like '%New%' ";
		}

		$sql = "SELECT tb_pengguna.tb_role_roleId,
		tb_pengguna.namaDepan, tb_pengguna.noWa, tb_role.nama as role,
		app_kritiksaran.id_kritiksaran,
		app_kritiksaran.tb_pengguna_penggunaId,
		app_kritiksaran.isikritiksaran,
		app_kritiksaran.setatus

		FROM app_kritiksaran
		JOIN tb_pengguna ON app_kritiksaran.tb_pengguna_penggunaId = tb_pengguna.penggunaId 
		JOIN tb_role ON tb_pengguna.tb_role_roleId = tb_role.roleId
		where $filter limit ".$data["start"].",".$data['length'];

		// print_r($sql);die();
		$query = $this->db->query($sql);
		$data = $query->result();
		$total = $queryall->num_rows();
		$dataRecord = array(
			"RecordsTotal" => $total,
			"RecordsFiltered" => $total,
			"Data" => $data,
		); return $dataRecord;
	}
	public function getkritikSaran($id){
		$sql = "SELECT tb_pengguna.tb_role_roleId,
		tb_pengguna.namaDepan, tb_pengguna.noWa, tb_role.nama as role,
		app_kritiksaran.id_kritiksaran,
		app_kritiksaran.tb_pengguna_penggunaId,
		app_kritiksaran.isikritiksaran,
		app_kritiksaran.`setatus`
		FROM app_kritiksaran
		JOIN tb_pengguna ON app_kritiksaran.tb_pengguna_penggunaId = tb_pengguna.penggunaId 
		JOIN tb_role ON tb_pengguna.tb_role_roleId = tb_role.roleId WHERE id_kritiksaran='$id' ";
		$query = $this->db->query($sql); return $query->result();
	}
	// public function insert($data){
	// 	$query = $this->db->insert('app_kritiksaran', $data); return $query;
	// }
	public function update($data){
		$this->db->where('id_kritiksaran',$data['id_kritiksaran']); 
		$query=$this->db->update('app_kritiksaran',$data); return $query;
	}
	public function delete($data){
		$query=$this->db->delete('app_kritiksaran',$data); return $query;
	}
	public function checkId($id){
		$sql = "SELECT * FROM app_kritiksaran WHERE id='$id' ";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		if($total > 0){
			return "Data Sama";
		} else {
			return "OK";
		}
	}
	public function checkData(){
		$sql = "SELECT * FROM app_kritiksaran where id!='0'";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		// print_r($total);die();
		if($total > 0){
			return "Data tidak boleh lebih dari satu";
		} else {
			return "OK";

		}
	}

	
	// Model for kritikSaran API
	public function apikritikSaran(){
		$query = $this->db->query("SELECT * FROM app_kritiksaran"); return $query->result();
	}
}
?>