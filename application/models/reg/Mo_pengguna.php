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
	public function getFilterQuran($q){
		$sql = "SELECT * FROM tb_bidangstudi WHERE tb_bidangstudi.kategoriStudi='QURAN' and namaBidangStudi like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}
	public function getFilterSD($q){
		$sql = "SELECT * FROM tb_bidangstudi WHERE tb_bidangstudi.kategoriStudi='SD' and namaBidangStudi like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}
	public function getFilterSMP($q){
		$sql = "SELECT * FROM tb_bidangstudi WHERE tb_bidangstudi.kategoriStudi='SMP' and namaBidangStudi like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}
	public function getFilterIPA($q){
		$sql = "SELECT * FROM tb_bidangstudi WHERE tb_bidangstudi.kategoriStudi='IPA' and namaBidangStudi like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}
	public function getFilterIPS($q){
		$sql = "SELECT * FROM tb_bidangstudi WHERE tb_bidangstudi.kategoriStudi='IPS' and namaBidangStudi like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}
	public function getFilterSiswa($q){
		$sql = "SELECT tbp.namaDepan as Siswa, tbp.namaBelakang as namaBelakangSiswa, tbp.penggunaId as idSiswa from tb_pengguna as tbp where tbp.tb_role_roleId = 3 and tbp.nomorKtp LIKE '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}
	public function getPengguna($id){
		$sql = "SELECT app_users.username, app_users.`password`, app_users.tb_pengguna_penggunaid, tb_pengguna.penggunaId, tb_pengguna.tb_role_roleId, tb_pengguna.app_rate_idapp_rate, tb_pengguna.tb_kategori_kategoriId, tb_pengguna.namaDepan, tb_pengguna.namaBelakang, tb_pengguna.alamat, tb_pengguna.tempatTinggal, tb_pengguna.tempatLahir, tb_pengguna.tglLahir, tb_pengguna.umur, tb_pengguna.email, tb_pengguna.noWa, tb_pengguna.foto, tb_pengguna.pendidikanTerakir, tb_pengguna.pengalamanMengjar,tb_pengguna.guruMapel,tb_role.nama AS role,tb_kategori.kategoriName AS kategori, tb_pengguna.status FROM app_users , tb_role , tb_pengguna , tb_kategori 
		where app_users.username = app_users.username AND app_users.password = app_users.password AND tb_pengguna.tb_role_roleId = tb_role.roleId AND tb_pengguna.tb_kategori_kategoriId = tb_kategori.kategoriId AND app_users.tb_pengguna_penggunaid = '$id' AND tb_pengguna.penggunaId = '$id' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insertSiswa($data){ 
		$query = $this->db->insert('tb_pengguna', $data); return $query;
	}
	public function updateCustomer($data){
		$dataInsert = array(
			"NPWP" => $data["NPWP"],
			"KTP" => $data["KTP"],
			"NAMACUSTOMER" => $data["NAMACUSTOMER"],
			"NEGARA" => $data["IDNEGARA"],
			"KABUPATEN" => $data["IDKOTA"],
			"PROVINSI" => $data["IDPROVINSI"],
			"JABATAN" => $data["JABATAN"],
			"NOTLP" => $data["NOTLP"],
			"NOHP" => $data["NOHP"],
			"ALAMATCUSTOMER" => $data["ALAMATCUSTOMER"],
			"NOREK" => $data["NOREK"],
			"KODEPOSCUSTOMER" => $data["KODEPOSCUSTOMER"],
			"STATUS" => $data["STATUS"],
			"EMAIL" => $data["EMAIL"]
		);
		$this->db->where('penggunaId',$data['penggunaId']);  
		$query=$this->db->update('tb_pengguna',$dataInsert); return $query;
	}
	public function deleteCustomer($data){ 
		$query=$this->db->delete('tb_pengguna',$data); return $query;
	}


	public function checkKtp($nomorKtp){
		$sql = "SELECT tb_pengguna.nomorKtp FROM tb_role , tb_pengguna , tb_kategori
		WHERE tb_pengguna.tb_role_roleId = tb_role.roleId AND 
		tb_pengguna.tb_kategori_kategoriId = tb_kategori.kategoriId and
		tb_pengguna.nomorKtp='$nomorKtp' ";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		if($total > 0){
			return "Data Sama";
		} else {
			return "OK";
		}
	}

	public function checkNomor($noWa){
		$sql = "SELECT tb_pengguna.penggunaId, tb_pengguna.alamat, tb_pengguna.noWa FROM tb_role , tb_pengguna , tb_kategori
		WHERE tb_pengguna.tb_role_roleId = tb_role.roleId AND 
		tb_pengguna.tb_kategori_kategoriId = tb_kategori.kategoriId
		and tb_pengguna.noWa='$noWa'";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		if($total > 0){
			return "Nomor Sama!";
		} else {
			return "OK";
		}
	}

	public function checkIdAnggotaSiswa(){
		$sql = "SELECT * FROM tb_urut where tb_urut.idurut=2";
		$query = $this->db->query($sql); return $query->row_array();
	}

	public function checkallowed($nomor){
		$sql = "SELECT * FROM num_unallowed WHERE nomor='$nomor' ";
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