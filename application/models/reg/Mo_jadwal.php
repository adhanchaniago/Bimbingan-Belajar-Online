<?php class Mo_jadwal extends CI_Model{
	// Model for web administrator
	public function getDataJadwal($data){
		$queryall = $this->db->get('app_kursus');
		$sql = "SELECT
		app_kursus.idapp_kursus,
		tb_pengguna.namaDepan AS Siswa,
		tb_role.nama AS role,
		app_kursus.idSiswa,
		app_kursus.idTentor,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where app_kursus.idTentor= tb_pengguna.penggunaId) AS Tentor,
		app_kursus.tb_kategori_kategoriId AS kategoriId,
		app_kursus.tb_bidangStudi_id_bidangStudi AS bidangStudiId,
		app_kursus.tglKursus,
		app_kursus.tglselesai,
		app_kursus.waktuKursus,
		app_kursus.durasiKursus,
		app_kursus.tempatKursus,
		app_kursus.pertemuan_ke,
		app_kursus.keterangan,
		app_kursus.statusKursus,
		tb_kategori.kategoriName AS kategoriMapel,
		tb_bidangstudi.namaBidangStudi
		FROM app_kursus
		INNER JOIN tb_pengguna on app_kursus.idSiswa = tb_pengguna.penggunaId
		INNER JOIN tb_role ON tb_pengguna.tb_role_roleId = tb_role.roleId
		INNER JOIN tb_kategori ON tb_pengguna.tb_kategori_kategoriId = tb_kategori.kategoriId 
		INNER JOIN tb_bidangstudi ON app_kursus.tb_bidangStudi_id_bidangStudi = tb_bidangstudi.id_bidangStudi
		where ".$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
		$data = $query->result();
		$total = $queryall->num_rows();
		$dataRecord = array(
			"RecordsTotal" => $total,
			"RecordsFiltered" => $total,
			"Data" => $data,
		); return $dataRecord;
	}
	public function getJadwal($id){
		$sql = " 
		SELECT
		app_kursus.idapp_kursus,
		tb_pengguna.namaDepan AS Siswa,
		tb_role.nama AS role,
		app_kursus.idSiswa,
		app_kursus.idTentor,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where app_kursus.idTentor= tb_pengguna.penggunaId) AS Tentor,
		app_kursus.tb_kategori_kategoriId AS kategoriId,
		app_kursus.tb_bidangStudi_id_bidangStudi AS bidangStudiId,
		app_kursus.tglKursus,
		app_kursus.tglselesai,
		app_kursus.waktuKursus,
		app_kursus.durasiKursus,
		app_kursus.tempatKursus,
		app_kursus.pertemuan_ke,
		app_kursus.keterangan,
		app_kursus.statusKursus,
		tb_kategori.kategoriName AS kategoriMapel,
		tb_bidangstudi.namaBidangStudi
		FROM app_kursus
		INNER JOIN tb_pengguna on app_kursus.idSiswa = tb_pengguna.penggunaId
		INNER JOIN tb_role ON tb_pengguna.tb_role_roleId = tb_role.roleId
		INNER JOIN tb_kategori ON tb_pengguna.tb_kategori_kategoriId = tb_kategori.kategoriId 
		INNER JOIN tb_bidangstudi ON app_kursus.tb_bidangStudi_id_bidangStudi = tb_bidangstudi.id_bidangStudi
		where app_kursus.idapp_kursus = '$id' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function getFilterTentor($q){
		$sql = "SELECT tbp.namaDepan as Tentor, tbp.namaBelakang as namaBelakangTentor, tbp.penggunaId as idTentor from tb_pengguna as tbp where tbp.tb_role_roleId = 2 and tbp.namaDepan like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}
	public function getFilterSiswa($q){
		$sql = "SELECT tbp.namaDepan as Siswa, tbp.namaBelakang as namaBelakangSiswa, tbp.penggunaId as idSiswa from tb_pengguna as tbp where tbp.tb_role_roleId = 3 and tbp.namaDepan LIKE '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}
	public function getFilterBidangStudi($q){
		$sql = "SELECT tbs.namaBidangStudi, tbs.id_bidangStudi as bidangStudiId from tb_bidangstudi as tbs where namaBidangStudi LIKE '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	} 

	public function insertJadwal($data){
		$query = $this->db->insert('app_kursus', $data); return $query;
	}
	public function updateJadwal($data){
		$data = array(
			"tb_bidangStudi_id_bidangStudi" => $data["bidangStudiId"],
			"idSiswa" => $data["idSiswa"],
			"idTentor" => $data["idTentor"],
			"tb_kategori_kategoriId" => $data["kategoriId"],

			"waktuKursus" => $data['waktuKursus'],
			"tglKursus" => $data['tglKursus'],
			"durasiKursus" => $data["durasiKursus"],
			"tempatKursus" => $data["tempatKursus"],
			"statusKursus" => $data["statusKursus"],
			"pertemuan_ke" => $data["pertemuan_ke"],
			"tglselesai" => $data["tglselesai"],
			"keterangan" => $data["keterangan"]
		);
		print_r($data);die();
		$this->db->where('idapp_kursus',$data['idapp_kursus']);
		$query=$this->db->update('app_kursus',$data); return $query;
	}
	public function deleteJadwal($data){
		$query=$this->db->delete('app_kursus',$data); return $query;
	}
	// public function checkId($id){
	// 	$sql = "SELECT * FROM app_kursus WHERE idapp_kursus='$id' ";
	// 	$query = $this->db->query($sql);
	// 	$total = $query->num_rows();
	// 	if($total > 0){
	// 		return "Data Sama";
	// 	} else {
	// 		return "OK";
	// 	}
	// }
	// Model for Jadwal API
	public function forApi_sessionUserSiswa($Session_UserSiswa){
		$query = $this->db->query(" 
			SELECT
			app_kursus.idapp_kursus, /* tambahan */
			tb_pengguna.namaDepan AS Siswa, /* tambahan */
			tb_role.nama AS role, /* tambahan */
			app_kursus.idSiswa,
			app_kursus.idTentor,
			(SELECT tb_pengguna.namaDepan from tb_pengguna 
			where app_kursus.idTentor= tb_pengguna.penggunaId
		) AS Tentor, /* tambahan */
		app_kursus.tglKursus,
		app_kursus.tglselesai, /* tambahan */
		app_kursus.waktuKursus,
		app_kursus.durasiKursus,
		app_kursus.tempatKursus,
		app_kursus.pertemuan_ke,
		app_kursus.keterangan,
		app_kursus.statusKursus,
		tb_kategori.kategoriName AS kategoriMapel, /* tambahan */
		tb_bidangstudi.namaBidangStudi
		-- app_kursus.tb_kategori_kategoriId AS kategoriId,  /* hapus */ 
		-- app_kursus.tb_bidangStudi_id_bidangStudi AS bidangStudiId,	/*hapus */
		-- app_kursus.tb_jumPertemuan_idjumPertemuan AS jumPertemuanId, /* hapus */
		-- 	SELECT app_kursus.idapp_kursus, 
		-- 	app_kursus.tb_kategori_kategoriId AS kategoriId, 
		-- app_kursus.tb_bidangStudi_id_bidangStudi AS bidangStudiId, 
		-- app_kursus.tb_jumPertemuan_idjumPertemuan AS jumPertemuanId, 
		-- app_kursus.idSiswa,
		-- app_kursus.tglKursus, 
		-- app_kursus.waktuKursus,
		-- app_kursus.tempatKursus,
		-- app_kursus.keterangan, 
		-- app_kursus.statusKursus, 
		-- app_kursus.pertemuan_ke, 
		-- app_kursus.tglselesai, 
		-- tb_bidangstudi.namaBidangStudi, 
		-- -- tb_jumpertemuan.nama AS namaJumPertemuan, tb_jumpertemuan.jumlah AS jumlahPertemuan,
		-- app_kursus.durasiKursus
		FROM app_kursus
		INNER JOIN tb_pengguna on app_kursus.idSiswa = tb_pengguna.penggunaId
		INNER JOIN tb_role ON tb_pengguna.tb_role_roleId = tb_role.roleId
		INNER JOIN tb_kategori ON tb_pengguna.tb_kategori_kategoriId = tb_kategori.kategoriId 
		INNER JOIN tb_bidangstudi ON app_kursus.tb_bidangStudi_id_bidangStudi = tb_bidangstudi.id_bidangStudi
		where app_kursus.idapp_kursus = app_kursus.idapp_kursus and  app_kursus.idSiswa = '$Session_UserSiswa'");
		return $query->result();
	}

	public function forApi_sessionUserTentor($Session_UserTentor){
		$query = $this->db->query(" 
			SELECT
			app_kursus.idapp_kursus, /* tambahan */
			tb_pengguna.namaDepan AS Siswa, /* tambahan */
			tb_role.nama AS role, /* tambahan */
			app_kursus.idSiswa,
			app_kursus.idTentor,
			(SELECT tb_pengguna.namaDepan from tb_pengguna 
			where app_kursus.idTentor= tb_pengguna.penggunaId
		) AS Tentor, /* tambahan */
		app_kursus.tglKursus,
		app_kursus.tglselesai, /* tambahan */
		app_kursus.waktuKursus,
		app_kursus.durasiKursus,
		app_kursus.tempatKursus,
		app_kursus.pertemuan_ke,
		app_kursus.keterangan,
		app_kursus.statusKursus,
		tb_kategori.kategoriName AS kategoriMapel, /* tambahan */
		tb_bidangstudi.namaBidangStudi
		FROM app_kursus
		INNER JOIN tb_pengguna on app_kursus.idSiswa = tb_pengguna.penggunaId
		INNER JOIN tb_role ON tb_pengguna.tb_role_roleId = tb_role.roleId
		INNER JOIN tb_kategori ON tb_pengguna.tb_kategori_kategoriId = tb_kategori.kategoriId 
		INNER JOIN tb_bidangstudi ON app_kursus.tb_bidangStudi_id_bidangStudi = tb_bidangstudi.id_bidangStudi
		where app_kursus.idapp_kursus = app_kursus.idapp_kursus and  app_kursus.idTentor = '$Session_UserTentor' ");
		return $query->result();
	}
}
?>