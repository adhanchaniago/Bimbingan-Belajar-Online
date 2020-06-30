<?php class Mo_jadwal extends CI_Model{
	// Model for web administrator
	public function getDataJadwal($data){
		$queryall = $this->db->get('detailkursus');
		$sql = "SELECT dk.idUnix, dk.kodeKursus,
		(SELECT app_kursus.idSiswa from app_kursus where app_kursus.idapp_kursus= dk.kodeKursus ) AS idSiswa,/* IDSISWA */
		(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* NAMA SISWA */
		(SELECT tb_pengguna.umur from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS UsiaSiswa, /* USIA SISWA */
		(SELECT tb_pengguna.pendidikanSekarang from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS PendidikanSiswa, /* PENDIDIKAN SISWA */
		(SELECT tb_pengguna.alamat from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS AlamatSiswa, /* ALAMAT SISWA */	
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS Tentor, /* TENTOR */
		dk.idBidangStudi, 
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* BIDANG STUDI */
		(SELECT tb_bidangstudi.kategoriStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS kategoriBidangStudi, /* KATEGORI BIDANG STUDI */
		dk.statusKursus
		from detailkursus as dk
-- 		where dk.idTentor='001' and dk.statusKursus='aktif'

		where statusKursus != 'tuntas' LIMIT " .$data["start"].",".$data['length'];

		$query = $this->db->query($sql);
		$data = $query->result();
		$total = $queryall->num_rows();
		$dataRecord = array(
			"RecordsTotal" => $total,
			"RecordsFiltered" => $total,
			"Data" => $data,
		); return $dataRecord;
	}
	public function getJadwal($idUnix){
		$sql = " 
		SELECT dk.idUnix, dk.kodeKursus,
		(SELECT app_kursus.idSiswa from app_kursus where app_kursus.idapp_kursus= dk.kodeKursus ) AS idSiswa,/* IDSISWA */
		(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* NAMA SISWA */
		(SELECT tb_pengguna.umur from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS UsiaSiswa, /* USIA SISWA */
		(SELECT tb_pengguna.pendidikanSekarang from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS PendidikanSiswa, /* PENDIDIKAN SISWA */
		(SELECT tb_pengguna.alamat from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS AlamatSiswa, /* ALAMAT SISWA */	
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS Tentor, /* TENTOR */
		dk.idBidangStudi, 
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* BIDANG STUDI */
		(SELECT tb_bidangstudi.kategoriStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS kategoriBidangStudi, /* KATEGORI BIDANG STUDI */
		dk.statusKursus
		from detailkursus as dk
-- 		where dk.idTentor='001' and dk.statusKursus='aktif'

		where statusKursus != 'tuntas' and dk.idUnix = '$idUnix' ";
		$query = $this->db->query($sql); return $query->result();
	}

	public function getDetilJadwal(){
		$sql = " SELECT * FROM detailJadwal 
		inner join detailkursus on detailJadwal.idDetailKursus=detailkursus.idUnix ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getPenjualan($KODEPENJUALAN){
		$sql = "SELECT tb_penjualan.*, tb_customer.NAMACUSTOMER FROM tb_penjualan inner join tb_customer on tb_customer.IDCUSTOMER=tb_penjualan.IDCUSTOMER WHERE KODEPENJUALAN='$KODEPENJUALAN' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getFilterTentor($q){
		$sql = "SELECT tbp.namaDepan AS Tentor, tbp.namaBelakang AS namaBelakangTentor, tbp.penggunaId AS idTentor, tbp.guruMapel FROM tb_pengguna AS tbp
		WHERE tbp.tb_role_roleId = 2 and tbp.namaDepan like '%" .$q. "%' OR tbp.guruMapel like '%" .$q. "%'  LIMIT 10";
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

	// Query for login app in siswa. 
	public function forApi_sessionUserSiswa($SessionUser){
		$query = $this->db->query(" 
			SELECT ak.idapp_kursus, 
			ak.idSiswa, 
			tb_pengguna.namaDepan,
			tb_pengguna.namaBelakang,
			tb_pengguna.penggunaId,
			tb_pengguna.umur,
			ak.tb_kategori_kategoriId as idrole, (SELECT tb_role.nama from tb_role where tb_pengguna.penggunaId= tb_role.roleId ) AS role,
			ak.tglDaftarKursus, ak.tempatKursus, ak.ratings
			FROM app_kursus as ak
			INNER JOIN tb_pengguna on ak.idSiswa=tb_pengguna.penggunaId
			where ak.idapp_kursus = ak.idapp_kursus and ak.idSiswa = '$SessionUser' and tb_pengguna.tb_role_roleId='3' ");
		return $query->result();
	}

	// Query for login app in tentor. 
	public function forApi_sessionUserTentor($SessionUser){
		$query = $this->db->query(" 
				SELECT dk.idTentor,
				(SELECT tb_pengguna.namaDepan from tb_pengguna 
				where dk.idTentor= tb_pengguna.penggunaId
				) AS Tentor,
				tb_pengguna.namaBelakang,
				tb_pengguna.umur,
				app_kursus.ratings,
				dk.statusKursus
				from detailkursus as dk
				INNER JOIN tb_pengguna on dk.idTentor=tb_pengguna.penggunaId
				INNER JOIN app_kursus on dk.kodeKursus=app_kursus.idapp_kursus
				where dk.idTentor='$SessionUser' and tb_pengguna.tb_role_roleId='2'
				GROUP BY dk.idTentor");
		return $query->result();
	}
}
?>