<?php class Mo_penggajianTentor extends CI_Model{
	public function getDataPenggajianTentor($data){
		$queryall = $this->db->get('detailkursus');
		$sql = "SELECT dk.idUnix, dk.kodeKursus, 
		app_kursus.idSiswa AS idSiswa,/* IDSISWA */
		(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* SISWA */
		dk.idTentor,		
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS Tentor, /* TENTOR */
		(SELECT tb_pengguna.noWa from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS NoTentor, /* NOMOR TENTOR */
		(SELECT tb_pengguna.noRek from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS noRek, /* REK TENTOR */
		dk.idBidangStudi, 
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* BIDANG STUDI */
		dk.statusKursus,
		dk.jumlahSesi
		from detailkursus as dk INNER JOIN app_kursus on dk.kodeKursus=app_kursus.idapp_kursus
		where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' and dk.statusKursus='aktif' limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
		$data = $query->result();
		$total = $queryall->num_rows();
		$dataRecord = array(
			"RecordsTotal" => $total,
			"RecordsFiltered" => $total,
			"Data" => $data,
		); return $dataRecord;
	}
	public function getPenggajianTentor($idUnix){
		$sql = "SELECT dk.kodeKursus,
		app_kursus.idSiswa AS idSiswa,/* IDSISWA */
		(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* SISWA */
		dk.idTentor,		
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS Tentor, /* TENTOR */
		(SELECT tb_pengguna.noWa from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS NoTentor, /* NOMOR TENTOR */
		(SELECT tb_pengguna.noRek from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS noRek, /* REK TENTOR */
		(SELECT tb_pengguna.namaBank from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS namaBank, /* NAMA BANK REK TENTOR */
		dk.idBidangStudi, 
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* BIDANG STUDI */
		dk.statusKursus,
		dk.jumlahSesi
		from detailkursus as dk INNER JOIN app_kursus on dk.kodeKursus=app_kursus.idapp_kursus
			WHERE dk.statusKursus='aktif' and dk.idUnix='$idUnix' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insertDetailPenggajianTentor($data){
		$query = $this->db->insert('detailpenggajian', $data); return $query;
	}
	// public function updatePenggajianTentor($data){
	// 	$this->db->where('KODEPenggajianTentor',$data['KODEPenggajianTentor']); 
	// 	$query=$this->db->update('tb_PenggajianTentor',$data); return $query;
	// }
	// public function deletePenggajianTentor($data){
	// 	$query=$this->db->delete('tb_PenggajianTentor',$data); return $query;
	// }
	// public function checkId($KODEPenggajianTentor){
	// 	$sql = "SELECT * FROM tb_PenggajianTentor WHERE KODEPenggajianTentor='$KODEPenggajianTentor' ";
	// 	$query = $this->db->query($sql);
	// 	$total = $query->num_rows();
	// 	if($total > 0){
	// 		return "Data Sama";
	// 	} else {
	// 		return "OK";
	// 	}
	// }
}
?>