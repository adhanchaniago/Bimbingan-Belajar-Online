<?php class Mo_transaksiSiswa extends CI_Model{
	public function getDataTransaksiSiswa($data){
		$queryall = $this->db->get('detailkursus');
		$sql = "
		SELECT 
		ak.idapp_kursus,
		ak.noInv,
		ak.idSiswa,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* NAMA SISWA */
		(SELECT tb_pengguna.noWa from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS nomorSiswa, /* NAMA SISWA */
		(SELECT tb_pengguna.alamat from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS alamatSiswa, /* ALAMAT SISWA */
		ak.TOTAL_ALL,
		dk.statusKursus
		FROM app_kursus as ak
		INNER JOIN detailkursus as dk on ak.idapp_kursus=dk.kodeKursus
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
	public function getTransaksiSiswa($idapp_kursus){
		$sql = "SELECT 
		ak.idapp_kursus,
		ak.noInv,
		ak.idSiswa,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* NAMA SISWA */
		(SELECT tb_pengguna.noWa from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS nomorSiswa, /* NAMA SISWA */
		(SELECT tb_pengguna.alamat from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS alamatSiswa, /* ALAMAT SISWA */
		ak.TOTAL_ALL,
		dk.statusKursus
		FROM app_kursus as ak
		INNER JOIN detailkursus as dk on ak.idapp_kursus=dk.kodeKursus 
			WHERE DK.statusKursus='aktif' and ak.idapp_kursus='$idapp_kursus' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insertDetailTransaksiSiswa($data){
		$query = $this->db->insert('detailpembayaran', $data); return $query;
	}
	// public function updateTransaksiSiswa($data){
	// 	$this->db->where('KODEtransaksiSiswa',$data['KODEtransaksiSiswa']); 
	// 	$query=$this->db->update('tb_transaksiSiswa',$data); return $query;
	// }
	// public function deleteTransaksiSiswa($data){
	// 	$query=$this->db->delete('tb_transaksiSiswa',$data); return $query;
	// }
	// public function checkId($KODEtransaksiSiswa){
	// 	$sql = "SELECT * FROM tb_transaksiSiswa WHERE KODEtransaksiSiswa='$KODEtransaksiSiswa' ";
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