<?php class Mo_riwayatAbsensi extends CI_Model{
	
	public function getDataAbsensi($data){
		$queryall = $this->db->get('detailriwayatabsen');

		// $filterdate = " AND DATE_FORMAT(tgldanWaktuKursus, '%Y-%m-%d') BETWEEN '".$data['filterdateto']."' AND '".$data['filterdatefrom']."'";

		// if ($data['filterdateto'] == '' && $data['filterdatefrom'] == '') { $filterdate = ''; }


		$sql = " SELECT dr.idUnixRiwayat, dr.kodeKursus,
		app_kursus.idSiswa,
		(SELECT tb_pengguna.namaDepan from tb_pengguna
		where app_kursus.idSiswa= tb_pengguna.penggunaId
		) AS Siswa, /* tambahan */
		detailkursus.idTentor,
		(SELECT tb_pengguna.namaDepan from tb_pengguna
		where detailkursus.idTentor= tb_pengguna.penggunaId
		) AS Tentor, /* tambahan */
		dr.idBidangstudi,
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi
		where dr.idBidangStudi= tb_bidangstudi.id_bidangStudi
		) AS BidangStudi, /* tambahan */
		dr.tgldanWaktuKursus,
		DATE_FORMAT(dr.tgldanWaktuKursus, '%Y-%m-%d') as tglAbsesn,
		DATE_FORMAT(dr.tgldanWaktuKursus, '%H:%i') as jamAbsesn,
		detailkursus.statusKursus
		FROM
		detailriwayatabsen AS dr
		INNER JOIN app_kursus ON app_kursus.idapp_kursus = dr.kodeKursus
		INNER JOIN tb_pengguna ON app_kursus.idSiswa = tb_pengguna.penggunaId
		INNER join detailkursus ON dr.kodeKursus=detailkursus.kodeKursus
		where " .$data['filtervalue']." like '%" .$data['filtertext']. "%' AND dr.kodeKursus=app_kursus.idapp_kursus and dr.idBidangstudi=detailkursus.idBidangStudi and detailkursus.statusKursus ='aktif' limit ".$data["start"].",".$data['length'];
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

	public function getAbsensi($idUnixRiwayat){
		$sql = "SELECT * FROM detailriwayatabsen WHERE idUnixRiwayat='$idUnixRiwayat' ";
		$query = $this->db->query($sql); 
		return $query->result();
	}
	public function insertAbsensi($data){
		$query = $this->db->insert('detailriwayatabsen', $data);
		return $query;
	}
	public function updateAbsensi($data){
		$this->db->where('idUnixRiwayat',$data['idUnixRiwayat']); 
		$query=$this->db->update('detailriwayatabsen',$data);
		return $query;
	}
	public function deleteAbsensi($data){
		$query=$this->db->delete('detailriwayatabsen',$data); 
		return $query;
	}
	public function checkId($idUnixRiwayat){
		$sql = "SELECT * FROM detailriwayatabsen WHERE detailriwayatabsen='$detailriwayatabsen' ";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		if($total > 0){
			return "Data Anda Sama";
		} else {
			return "OK";
		}
	}
}
?>