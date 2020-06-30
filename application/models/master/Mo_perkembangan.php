<?php class Mo_perkembangan extends CI_Model{
	// Model for web administrator
	public function getDataperkembangan($data){
		$queryall = $this->db->get('tb_perkembangan');
		$sql = "SELECT * FROM tb_perkembangan
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
	public function getperkembangan($id){
		$sql = "SELECT * FROM tb_perkembangan WHERE id='$id' ";
		$query = $this->db->query($sql); return $query->result();
	}
	public function insertperkembangan($data){
		$query = $this->db->insert('tb_perkembangan', $data); return $query;
	}
	public function updateperkembangan($data){
		$this->db->where('id',$data['id']); 
		$query=$this->db->update('tb_perkembangan',$data); return $query;
	}
	public function deleteperkembangan($data){
		$query=$this->db->delete('tb_perkembangan',$data); return $query;
	}
	public function checkId($id){
		$sql = "SELECT * FROM tb_perkembangan WHERE id='$id' ";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		if($total > 0){
			return "Data Sama";
		} else {
			return "OK";
		}
	}
	public function checkData(){
		$sql = "SELECT * FROM tb_perkembangan where id!='0'";
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		// print_r($total);die();
		if($total > 0){
			return "Data tidak boleh lebih dari satu";
		} else {
			return "OK";
		}
	}

	
	// Model for Indikator Penilaian API - modul tentor
	public function forApi_indikator(){
		$query = $this->db->query("SELECT * from tb_indikator"); return $query->result();
	}
	// Model for perkembangan data siswa yang dimiliki tentor API - modul tentor
	public function forApi_dataSiswaFromTentor($idtentor){
		$sql = " SELECT 
		dk.kodeKursus, 
		(SELECT app_kursus.idSiswa from app_kursus where app_kursus.idapp_kursus= dk.kodeKursus ) AS idSiswa,/* IDSISWA */

		(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* SISWA */

		dk.idTentor,
		(SELECT tb_pengguna.umur from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS umurTentor, /* UMUR TENTOR */
		
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS Tentor, /* TENTOR */
		(SELECT tb_pengguna.foto from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS fotoTentor, /* FOTO TENTOR */
		dk.idBidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* BIDANG STUDI */
		dk.statusKursus
		from detailkursus as dk
		where dk.idTentor='$idtentor' and dk.statusKursus='aktif' ";
		$query = $this->db->query($sql); return $query->result();
	}



	// for Siswa = modul Laporan Perkembangan. modul siswa
	public function forApi_dataPerkembanganSiswa($idSiswa){
		$sql = "
		SELECT
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
		) AS Tentor,

		app_kursus.ratings

		FROM detailperkembangan AS dp
		INNER JOIN app_kursus ON app_kursus.idapp_kursus = dp.kodeKursus_detailKursus
		INNER JOIN tb_pengguna ON app_kursus.idSiswa = tb_pengguna.penggunaId
		INNER JOIN detailkursus AS dk ON dp.kodeKursus_detailKursus = dk.kodeKursus
		INNER JOIN tb_bidangstudi as bs on dp.bidangStudi = bs.id_bidangStudi

		where app_kursus.idSiswa='$idSiswa' and dk.statusKursus='aktif'

		GROUP BY dp.idDperkembangan
		ORDER BY kodeKursus_detailKursus
		";
		$query = $this->db->query($sql); return $query->result();
	}
	
	// for Tentor = modul Laporan Perkembangan. modul Tentor
	public function forApi_penilaianPerkembanganSiswa($idTentor){
		$sql= " SELECT dp.idDperkembangan, dp.kodeKursus_detailKursus,
		dp.bidangStudi, bs.namaBidangStudi,
		(SELECT tb_indikator.namaIndikator from tb_indikator
		where dp.indikator= tb_indikator.idIndikator
		) AS indikator, /* indikator */
		(SELECT tb_indikator.kategoriIndikator from tb_indikator
		where dp.indikator= tb_indikator.idIndikator
		) AS KategoriIndikator, /* Kategori indikator */
		dp.nilai, dp.tglinserts,
		dk.statusKursus,
		app_kursus.idSiswa,
		tb_pengguna.namaDepan AS siswa,
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan from tb_pengguna 
		where dk.idTentor= tb_pengguna.penggunaId
		) AS Tentor, app_kursus.ratings
		FROM detailperkembangan AS dp
		INNER JOIN app_kursus ON app_kursus.idapp_kursus = dp.kodeKursus_detailKursus
		INNER JOIN tb_pengguna ON app_kursus.idSiswa = tb_pengguna.penggunaId
		INNER JOIN detailkursus AS dk ON dp.kodeKursus_detailKursus = dk.kodeKursus
		INNER JOIN tb_bidangstudi as bs on dp.bidangStudi = bs.id_bidangStudi
		where dk.idTentor='$idTentor' and dk.statusKursus='aktif'
		GROUP BY dp.idDperkembangan ORDER BY kodeKursus_detailKursus ";
		$query = $this->db->query($sql); return $query->result();
	}


	// List data Siswa Yang terikat / menjadi siswa dari tentor tertentu.
	public function listDataSiswaFromTentor($idTentor){
		$sql = "SELECT dk.kodeKursus,
		(SELECT app_kursus.idSiswa from app_kursus where app_kursus.idapp_kursus= dk.kodeKursus ) AS idSiswa,/* IDSISWA */
		(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* NAMA SISWA */
		(SELECT tb_pengguna.umur from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS UsiaSiswa, /* USIA SISWA */
		(SELECT tb_pengguna.pendidikanSekarang from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS PendidikanSiswa, /* PENDIDIKAN SISWA */
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS Tentor, /* TENTOR */
		(SELECT tb_pengguna.foto from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS fotoTentor, /*FOTO TENTOR*/
		dk.idBidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* BIDANG STUDI */
		(SELECT tb_bidangstudi.kategoriStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS kategoriBidangStudi, /* KATEGORI BIDANG STUDI */
		dk.statusKursus,		
		(SELECT tb_pengguna.rattings from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS RattingSiswa /* RATTING SISWA */
		from detailkursus as dk
		where dk.idTentor='$idTentor' and dk.statusKursus='aktif'
		";
		$query = $this->db->query($sql); return $query->result();
	}


	// List data Tentor Yang terikat / menjadi Pengajar dari siswa tertentu.
	public function listDataTentorFromSiswa($idSiswa){
		$sql = " SELECT dk.kodeKursus, 
		app_kursus.idSiswa AS idSiswa,/* IDSISWA */

		(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* SISWA */
		dk.idTentor,
		(SELECT tb_pengguna.umur from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS umurTentor, /* UMUR TENTOR */
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS Tentor, /* TENTOR */
		(SELECT tb_pengguna.foto from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS fotoTentor, /* FOTO TENTOR */
		dk.idBidangStudi, 
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* BIDANG STUDI */
		dk.statusKursus, dk.jumlahSesi
		from detailkursus as dk
		INNER JOIN app_kursus on dk.kodeKursus=app_kursus.idapp_kursus
		where app_kursus.idSiswa='$idSiswa' ";
		$query = $this->db->query($sql); return $query->result();
	}

	// for
	


}
?>