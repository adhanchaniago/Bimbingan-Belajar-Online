<?php class Mo_riwayatJadwal extends CI_Model{
	public function getDataJadwal($data){
		$queryall = $this->db->get('detailjadwal');
		$sql =
		" SELECT dj.kodeKursus,	dj.idBidangStudi_bidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dj.idBidangStudi_bidangStudi=tb_bidangstudi.id_bidangStudi ) AS bidangStudi, 
		/* NAMA BIDANG STUDI */

		dj.idTentor_detailKursus,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dj.idSiswa_appKursus=tb_pengguna.penggunaId ) AS Siswa, 
		/* NAMA Tentor */

		dj.idSiswa_appKursus,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dj.idTentor_detailKursus=tb_pengguna.penggunaId ) AS Tentor, 
		/* NAMA Tentor */

		(SELECT tb_pengguna.umur from tb_pengguna where dj.idTentor_detailKursus=tb_pengguna.penggunaId ) AS Umur, 
		/* Umur Tentor */

		dj.hari, dj.jam, dj.tglKursus,
		app_kursus.ratings,
		app_kursus.tempatKursus
		FROM detailjadwal as dj
		INNER JOIN app_kursus on dj.kodeKursus=app_kursus.idapp_kursus
		WHERE ".$data['filtervalue']. " like '%" .$data['filtertext']. "%' ";
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

	public function getJadwal($idUnix){
		$sql = "SELECT * FROM detailjadwal WHERE idUnix='$idUnix' ";
		$query = $this->db->query($sql); 
		return $query->result();
	}
	public function insertJadwal($data){
		$query = $this->db->insert('detailjadwal', $data);
		return $query;
	}
	public function updateJadwal($data){
		$this->db->where('idUnix',$data['idUnix']); 
		$query=$this->db->update('detailjadwal',$data);
		return $query;
	}
	public function deleteJadwal($data){
		$query=$this->db->delete('detailjadwal',$data); 
		return $query;
	}
	public function checkId($idUnix){
		$sql = "SELECT * FROM detailjadwal WHERE idUnix='$idUnix' ";
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