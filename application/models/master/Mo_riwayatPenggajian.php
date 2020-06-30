<?php class Mo_riwayatPenggajian extends CI_Model{
	public function getDatariwayatPenggajian($data){
		$queryall = $this->db->get('detailpenggajian');

		// $filtername = "AND namaSiswa='%".$data['filtername']."%' ";

		// if ($data['filtername'] == '') { $filtername = ''; }


		$sql = "
		SELECT dp.noPenggajian,
		dp.kodeKursus_detailKursus,
		dp.idTentor_detailKursus,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dp.idTentor_detailKursus) as Tentor,
		dp.idSiswa_detailKursus,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dp.idSiswa_detailKursus) as Siswa,
		dp.idBidang_detailKursus,
		(SELECT tb_bidangstudi.namaBidangStudi FROM tb_bidangstudi where tb_bidangstudi.id_bidangStudi=dp.idBidang_detailKursus) as BidangStudi,
		dp.jumlahGaji,
		dp.jumlahBonus,
		dp.metodeBayar,
		dp.noRek,
		DATE_FORMAT(dp.tglBayar, '%d-%m-%Y') AS tglBayar
		FROM detailpenggajian as dp
		where " .$data['filtervalue']. " like '%" .$data['filtertext']. "%' limit ".$data["start"].",".$data['length'];
		$query = $this->db->query($sql);
		$data = $query->result();
		$total = $queryall->num_rows();
		$dataRecord = array(
			"RecordsTotal" => $total,
			"RecordsFiltered" => $total,
			"Data" => $data,
		); return $dataRecord;
	}
	// public function getriwayatPembayaran($idapp_kursus){
	// 	$sql = "SELECT 
	// 	ak.idapp_kursus,
	// 	ak.noInv,
	// 	ak.idSiswa,
	// 	(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* NAMA SISWA */
	// 	(SELECT tb_pengguna.noWa from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS nomorSiswa, /* NAMA SISWA */
	// 	(SELECT tb_pengguna.alamat from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS alamatSiswa, /* ALAMAT SISWA */
	// 	ak.TOTAL_ALL,
	// 	dk.statusKursus
	// 	FROM app_kursus as ak
	// 	INNER JOIN detailkursus as dk on ak.idapp_kursus=dk.kodeKursus 
	// 		WHERE DK.statusKursus='aktif' and ak.idapp_kursus='$idapp_kursus' ";
	// 	$query = $this->db->query($sql); return $query->result();
	// }
	// public function insertDetailriwayatPembayaran($data){
	// 	$query = $this->db->insert('detailpembayaran', $data); return $query;
	// }
	// public function updateriwayatPembayaran($data){
	// 	$this->db->where('KODEriwayatPembayaran',$data['KODEriwayatPembayaran']); 
	// 	$query=$this->db->update('tb_riwayatPembayaran',$data); return $query;
	// }
	// public function deleteriwayatPembayaran($data){
	// 	$query=$this->db->delete('tb_riwayatPembayaran',$data); return $query;
	// }
	// public function checkId($KODEriwayatPembayaran){
	// 	$sql = "SELECT * FROM tb_riwayatPembayaran WHERE KODEriwayatPembayaran='$KODEriwayatPembayaran' ";
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