<?php class Mo_dataUserLogin extends CI_Model{
	public function getDataUserLogin($data){
		$queryall = $this->db->get('app_users');
		$sql = " SELECT
		app_users.userid,
		tb_pengguna.namaDepan,
		tb_pengguna.namaBelakang,
		app_users.username,
		app_users.password,
		tb_role.nama as role

		FROM app_users, tb_role, tb_pengguna 

		where ".$data['filtervalue']. " like '%" .$data['filtertext']. "%' AND tb_pengguna.tb_role_roleId = tb_role.roleId AND app_users.tb_pengguna_penggunaid = tb_pengguna.penggunaId limit ".$data["start"].",".$data['length'];
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
	function getAll()
	{
		$this->db->order_by('userid', 'ASC');
		$data = $this->db->get('app_users');
		return $data;
	}
	public function getFilterKota($q){
		$sql = "SELECT IDKOTA, NAMAKOTA FROM tb_kabupaten where NAMAKOTA like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}

	public function getFilterUserPengguna($q){
		$sql = "SELECT tb_pengguna.penggunaId,
		tb_pengguna.namaDepan, tb_pengguna.namaBelakang,
		tb_role.nama as role FROM tb_pengguna
		INNER JOIN tb_role on tb_pengguna.tb_role_roleId = tb_role.roleId where namaDepan like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}

	public function getUserLogin($id) {
		$sql = "SELECT
		app_users.userid,
		tb_pengguna.penggunaId,
		tb_pengguna.namaDepan,
		tb_pengguna.namaBelakang,
		app_users.username,
		-- app_users.password,
		tb_role.nama as role

		FROM app_users, tb_role, tb_pengguna 
		where tb_pengguna.tb_role_roleId = tb_role.roleId AND app_users.tb_pengguna_penggunaid = tb_pengguna.penggunaId and app_users.userid='$id' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insert($data, $gambar){
		$data = array(
			"userid" => uniqid(),
			"username" => $data["username"],
			"password" => md5($data["password"]),
			"tb_pengguna_penggunaid" => $data["penggunaId"]
		);
		$query = $this->db->insert('app_users', $data); return $query;
	}
	public function updateImg($data, $gambar){
		// update foto on tb_pengguna
		if (!empty($gambar)) {
			$data = array(
				'foto' => $gambar
			);
			$this->db->where("penggunaId",$data["penggunaId"]);  
			$query=$this->db->update('tb_pengguna',$data); return $query;
		}
		// end update foto
	}
	public function update($data){
		$data = array(
			"userid" => $data["userid"],
			"username" => $data["username"],
			"password" => md5($data["password"]),
		); 
		$this->db->where('userid',$data['userid']);  
		$query=$this->db->update('app_users',$data); return $query;
	}
	public function delete($data){ 
		$query=$this->db->delete('app_users',$data); return $query;
	}
	public function checkId($userid){
		$sql = "SELECT * FROM app_users WHERE userid='$userid' ";
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