<?php class Mo_jadwalKursus extends CI_Model{
	public function getDataJadwalKursus($data){
		$queryall = $this->db->get('detailjadwal');

		// $filter = "AND tb_pengguna.namaDepan='".$data['filtersiswa']."'";

		// if ($data['filtersiswa'] == '') { $filter = ''; }

		$sql = " SELECT dj.idUnix,
		dj.kodeDetailKursus_detailKursus,
		(SELECT dk.jumlahSesi FROM detailkursus as dk where dk.kodeDetailKursus=dj.kodeDetailKursus_detailKursus) as JumlahSesi,
		dj.kodeKursus,
		dj.idBidangStudi_bidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi FROM tb_bidangstudi where tb_bidangstudi.id_bidangStudi=dj.idBidangStudi_bidangStudi) as BidangStudi,
		dj.idTentor_detailKursus,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dj.idTentor_detailKursus) as Tentor,
		dj.idSiswa_appKursus,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dj.idSiswa_appKursus) as Siswa,
		dj.hari, dj.jam, dj.tglinsert
		FROM detailjadwal AS dj
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
	public function getJadwalKursus($idUnix){
		$sql = "SELECT dj.idUnix,
		dj.kodeDetailKursus_detailKursus,
		(SELECT dk.jumlahSesi FROM detailkursus as dk where dk.kodeDetailKursus=dj.kodeDetailKursus_detailKursus) as JumlahSesi,
		dj.kodeKursus,
		dj.idBidangStudi_bidangStudi as idBidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi FROM tb_bidangstudi where tb_bidangstudi.id_bidangStudi=dj.idBidangStudi_bidangStudi) as BidangStudi,
		dj.idTentor_detailKursus as idTentor,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dj.idTentor_detailKursus) as Tentor,
		dj.idSiswa_appKursus as idSiswa,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dj.idSiswa_appKursus) as Siswa,
		dj.hari, dj.jam, dj.tglinsert
		FROM detailjadwal AS dj WHERE idUnix='$idUnix' ";
		$query = $this->db->query($sql); return $query->result();
	}

	/* filter data kodeDetailKursus for siswa dan bidang studinya */
	public function getFilterKodeDetailKursus($q){
		$sql = "SELECT dk.kodeDetailKursus,dk.kodeKursus,
		dk.idBidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi FROM tb_bidangstudi where tb_bidangstudi.id_bidangStudi=dk.idBidangStudi) as BidangStudi,
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan FROM tb_pengguna where tb_pengguna.penggunaId=dk.idTentor) as Tentor,
		ak.idSiswa, tp.namaDepan as Siswa, tp.namaBelakang as namaBelakangSiswa
		FROM detailkursus as dk
		INNER JOIN app_kursus as ak on ak.idapp_kursus=dk.kodeKursus
		INNER JOIN tb_pengguna as tp on ak.idSiswa=tp.penggunaId
		where tp.namaDepan like '%" .$q. "%' LIMIT 10";
		$query = $this->db->query($sql); return $query->result();
	}

	public function getFilterSelectTentor($q){
		$sql = " SELECT
		tb_pengguna.penggunaId as idTentor,
		tb_pengguna.tb_role_roleId,
		tb_role.nama as role ,
		tb_pengguna.tb_kategori_kategoriId,
		tb_pengguna.namaDepan as Tentor,
		tb_pengguna.nomorKtp,
		tb_pengguna.namaBelakang as namaBelakangTentor,
		tb_pengguna.noWa,
		tb_pengguna.guruMapel,
		tb_pengguna.`status`
		FROM tb_pengguna
		inner join tb_role on tb_role.roleId=tb_pengguna.tb_role_roleId
		where tb_pengguna.namaDepan like '%" .$q. "%' AND tb_role.roleId='2' and tb_pengguna.`status`='aktif' LIMIT 10 ";
		$query = $this->db->query($sql); return $query->result();
	}

	public function insertJadwalKursus($data){
		$query = $this->db->insert('detailjadwal', $data); return $query;
	}
	public function updateJadwalKursus($data){
		$this->db->where('kodeDetailKursus_detailKursus',$data['kodeDetailKursus_detailKursus']); 
		$query=$this->db->update('detailjadwal',$data); return $query;
	}
	public function deleteJadwalKursus($data){
		$query=$this->db->delete('detailjadwal',$data); return $query;
	}
	public function checkId($idUnix){
		$sql = "SELECT * FROM detailjadwal WHERE idUnix='$idUnix' ";
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