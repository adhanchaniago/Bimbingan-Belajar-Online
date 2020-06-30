<?php class Mo_pengguna extends CI_Model{
	public function getDataPengguna($data){
		$queryall = $this->db->get('tb_pengguna');
		$sql = " SELECT tb_pengguna.penggunaId, tb_pengguna.tb_role_roleId, tb_pengguna.app_rate_idapp_rate, tb_pengguna.tb_kategori_kategoriId, tb_pengguna.namaDepan, tb_pengguna.namaBelakang, tb_pengguna.alamat, tb_pengguna.tempatTinggal, tb_pengguna.tempatLahir, tb_pengguna.tglLahir, tb_pengguna.umur, tb_pengguna.email, tb_pengguna.noWa, tb_pengguna.foto, tb_pengguna.pendidikanTerakir, tb_pengguna.pengalamanMengjar,tb_pengguna.guruMapel,tb_role.nama AS role,tb_kategori.kategoriName AS kategori, tb_pengguna.`status` 
		FROM tb_role , tb_pengguna , tb_kategori 

		where ".$data['filtervalue']. " like '%" .$data['filtertext']. "%' AND tb_pengguna.tb_role_roleId = tb_role.roleId AND 
		tb_pengguna.tb_kategori_kategoriId = tb_kategori.kategoriId

		GROUP BY tb_pengguna.penggunaId limit ".$data["start"].",".$data['length'];
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
	public function getFilterKota($q){
		$sql = "SELECT IDKOTA, NAMAKOTA FROM tb_kabupaten where NAMAKOTA like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}
	// public function getFilterProvinsi($q){
	// 	$sql = "SELECT * FROM tb_provinsi where NAMAPROVINSI like '%" .$q. "%' LIMIT 10";
	// 	$query = $this->db->query($sql); return $query->result();
	// }
	// public function getFilterNegara($q){
	// 	$sql = "SELECT * FROM tb_negara where NAMANEGARA like '%" .$q. "%' LIMIT 10";
	// 	$query = $this->db->query($sql); return $query->result();
	// }
	public function getPengguna($id){
		$sql = "SELECT app_users.username, app_users.`password`, app_users.tb_pengguna_penggunaid, tb_pengguna.penggunaId, tb_pengguna.tb_role_roleId, tb_pengguna.app_rate_idapp_rate, tb_pengguna.tb_kategori_kategoriId, tb_pengguna.namaDepan, tb_pengguna.namaBelakang, tb_pengguna.alamat, tb_pengguna.tempatTinggal, tb_pengguna.tempatLahir, tb_pengguna.tglLahir, tb_pengguna.umur, tb_pengguna.email, tb_pengguna.noWa, tb_pengguna.foto, tb_pengguna.pendidikanTerakir, tb_pengguna.pengalamanMengjar,tb_pengguna.guruMapel,tb_role.nama AS role,tb_kategori.kategoriName AS kategori, tb_pengguna.status, tb_pengguna.namaBank, tb_pengguna.noRek FROM app_users , tb_role , tb_pengguna , tb_kategori 
		where app_users.username = app_users.username AND app_users.password = app_users.password AND tb_pengguna.tb_role_roleId = tb_role.roleId AND tb_pengguna.tb_kategori_kategoriId = tb_kategori.kategoriId AND app_users.tb_pengguna_penggunaid = '$id' AND tb_pengguna.penggunaId = '$id' ";
		$query = $this->db->query($sql); return $query->result();
	}
	// public function insertPengguna($data){
	// 	$query = $this->db->insert('tb_pengguna', $data); return $query;
	// }
	public function updatePengguna($data){
		$data = array(
			"penggunaId" => $data["penggunaId"],
			"namaDepan" => $data["namaDepan"],
			"namaBelakang" => $data["namaBelakang"],
			"alamat" => $data["alamat"],
			"tempatTinggal" => $data["tempatTinggal"],
			"tempatLahir" => $data["tempatLahir"],
			"email" => $data["email"],
			"umur" => $data["umur"],
			"tglLahir" => $data["tglLahir"],
			"noWa" => $data["noWa"],
			"pendidikanTerakir" => $data["pendidikanTerakir"],
			"pengalamanMengjar" => $data["pengalamanMengjar"],
			"guruMapel" => $data["guruMapel"],
			"tb_kategori_kategoriId" => $data["tb_kategori_kategoriId"],
			"tb_role_roleId" => $data["tb_role_roleId"],
			'namaBank' => $data['namaBank'],
			'noRek' => $data['noRek'],
		);
		$this->db->where('penggunaId',$data['penggunaId']);
		$query=$this->db->update('tb_pengguna',$data); return $query;
	}
	public function deletePengguna($data){ 
		$query=$this->db->delete('tb_pengguna',$data); return $query;
	}
	public function checkId($NPWP){
		$sql = "SELECT * FROM tb_pengguna WHERE NPWP='$NPWP' ";
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