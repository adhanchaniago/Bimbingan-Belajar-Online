<?php class Mo_riwayatPerkembangan extends CI_Model{
	public function getDataPerkembangan($data){
		$queryall = $this->db->get('detailperkembangan');
		$sql =
		" SELECT
		dp.idDperkembangan,
		dp.kodeKursus_detailKursus,

		dp.bidangStudi,
		bs.namaBidangStudi,

		(SELECT tb_indikator.namaIndikator from tb_indikator
		where dp.indikator= tb_indikator.idIndikator
		) AS indikator, /* indikator */
		(SELECT tb_indikator.kategoriIndikator from tb_indikator
		where dp.indikator= tb_indikator.idIndikator
		) AS KategoriIndikator, /* Kategori indikator */

		dp.nilai,
		dp.tglinserts,

		dk.statusKursus,
		app_kursus.idSiswa,
		tb_pengguna.namaDepan AS siswa,
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan from tb_pengguna 
		where dk.idTentor= tb_pengguna.penggunaId
		) AS Tentor
		FROM detailperkembangan AS dp
		INNER JOIN app_kursus ON app_kursus.idapp_kursus = dp.kodeKursus_detailKursus
		INNER JOIN tb_pengguna ON app_kursus.idSiswa = tb_pengguna.penggunaId
		INNER JOIN detailkursus AS dk ON dp.kodeKursus_detailKursus = dk.kodeKursus
		INNER JOIN tb_bidangstudi as bs on dp.bidangStudi = bs.id_bidangStudi
		where app_kursus.idSiswa=app_kursus.idSiswa and dk.statusKursus='aktif'
		GROUP BY dp.idDperkembangan
		ORDER BY kodeKursus_detailKursus";
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

	public function getPerkembangan($idDperkembangan){
		$sql = "SELECT * FROM detailperkembangan WHERE idDperkembangan='$idDperkembangan' ";
		$query = $this->db->query($sql); 
		return $query->result();
	}
	public function insertPerkembangan($data){
		$query = $this->db->insert('detailperkembangan', $data);
		return $query;
	}
	public function updatePerkembangan($data){
		$this->db->where('idDperkembangan',$data['idDperkembangan']); 
		$query=$this->db->update('detailperkembangan',$data);
		return $query;
	}
	public function deletePerkembangan($data){
		$query=$this->db->delete('detailperkembangan',$data); 
		return $query;
	}
	public function checkId($idDperkembangan){
		$sql = "SELECT * FROM detailperkembangan WHERE idDperkembangan='$idDperkembangan' ";
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