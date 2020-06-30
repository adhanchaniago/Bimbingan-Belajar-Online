<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_api extends CI_Model{
	public function __construct()
	{
		parent::__construct(); // Your own constructor code
	}

/*	
	userid
	username
	password
	tb_role_roleId
	tb_pengguna_penggunaid
	NamaPengguna
	namaBelakang

	app_rate_idapp_rate
	tb_kategori_kategoriId
	nomorKtp
	alamat
	tempatTinggal
	tempatLahir
	tglLahir

	umur
	email
	noWa
	foto
	pendidikanTerakir
	pengalamanMengjar
	guruMapel
	status
	pendidikanSekarang
	*/

	// code for login api
	public function login_api($role,$username,$password){
		$query = $this->db->query("
			SELECT app_users.userid, app_users.username,  app_users.`password`,  tb_pengguna.tb_role_roleId, app_users.tb_pengguna_penggunaid,  tb_pengguna.namaDepan as namaPengguna, tb_pengguna.namaBelakang, tb_pengguna.app_rate_idapp_rate,  tb_pengguna.tb_kategori_kategoriId, tb_pengguna.nomorKtp, tb_pengguna.alamat, tb_pengguna.tempatTinggal, tb_pengguna.tempatLahir,  tb_pengguna.tglLahir, tb_pengguna.umur,  tb_pengguna.email,  tb_pengguna.noWa,  tb_pengguna.foto, tb_pengguna.pendidikanTerakir,  tb_pengguna.pengalamanMengjar,  tb_pengguna.guruMapel, tb_pengguna.`status`, tb_pengguna.pendidikanSekarang
			FROM app_users
			INNER JOIN tb_pengguna ON app_users.tb_pengguna_penggunaid = tb_pengguna.penggunaId
			INNER JOIN tb_role on tb_pengguna.tb_role_roleId = tb_role.roleId
			INNER JOIN tb_kategori on tb_pengguna.tb_kategori_kategoriId = tb_kategori.kategoriId
			WHERE app_users.username = '$username' AND app_users.`password` = '$password' AND app_users.tb_pengguna_penggunaid = tb_pengguna.penggunaId AND tb_pengguna.tb_role_roleId = '$role'
			");
		return $query->result_array();
	}

	// API for model Lomba Artikel
	public function dataLombaArtikel(){
		$sql = "SELECT * from tb_lombaartikel";
		$query = $this->db->query($sql); return $query->result_array();
	}

	// API for modul transaksi dan detail / riwayat pembayaran
	public function transaksiDanDetailPembayaran($idSiswa){
		$sql = " SELECT 
		ak.idapp_kursus,
		ak.noInv,
		ak.idSiswa,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* NAMA SISWA */
		(SELECT tb_pengguna.alamat from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS alamatSiswa, /* ALAMAT SISWA */
		dk.tglSelesai,
		ak.TOTAL_ALL,
		dk.idBidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dk.idBidangStudi=tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* BIDANG STUDI YANG DI AMBIL SISWA */
		dk.perSesi,
		dk.KETERANGANTRANSAKSI,
		dk.keteranganKursus,
		dk.statusKursus,
		ak.tglBayar,
		ak.metodebayar,
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dk.idTentor=tb_pengguna.penggunaId ) AS Tentor /*TENTOR  */
		FROM app_kursus as ak
		INNER JOIN detailkursus as dk on ak.idapp_kursus=dk.kodeKursus
		where ak.idSiswa='$idSiswa' ";
		$query = $this->db->query($sql); return $query->result_array();
	}


	// API for modul Jadwal pada android - bagian Siswa
	public function dataJadwalKursusSiswa($idSiswa){
		$sql = " SELECT dj.kodeKursus,
		dj.idBidangStudi_bidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dj.idBidangStudi_bidangStudi=tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* NAMA BIDANG STUDI */
		dj.idTentor_detailKursus,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dj.idTentor_detailKursus=tb_pengguna.penggunaId ) AS Tentor, /* NAMA Tentor */
		dj.idSiswa_appKursus,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dj.idSiswa_appKursus=tb_pengguna.penggunaId ) AS Siswa, /* NAMA Siswa */
		-- (SELECT tb_pengguna.foto from tb_pengguna where dj.idSiswa_appKursus=tb_pengguna.penggunaId ) AS FotoSiswa, /* Foto Siswa */
		(SELECT tb_pengguna.umur from tb_pengguna where dj.idSiswa_appKursus=tb_pengguna.penggunaId ) AS Umur, /* Umur Siswa */
		dj.hari, dj.jam, dj.tglKursus,
		app_kursus.ratings,
		app_kursus.tempatKursus
		FROM detailjadwal as dj
		INNER JOIN app_kursus on dj.kodeKursus=app_kursus.idapp_kursus
		WHERE dj.idSiswa_appKursus='$idSiswa' ";
		$query = $this->db->query($sql); return $query->result_array();
	}

	// API for modul Jadwal / Ajar Tentor - bagian Tentor
	public function JadwalAjarTentor($idTentor){
		$sql = "
		SELECT dj.kodeKursus,
		dj.idBidangStudi_bidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dj.idBidangStudi_bidangStudi=tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* NAMA BIDANG STUDI */
		dj.idTentor_detailKursus,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dj.idSiswa_appKursus=tb_pengguna.penggunaId ) AS Siswa, /* NAMA Tentor */
		dj.idSiswa_appKursus,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dj.idTentor_detailKursus=tb_pengguna.penggunaId ) AS Tentor, /* NAMA Tentor */
		(SELECT tb_pengguna.umur from tb_pengguna where dj.idTentor_detailKursus=tb_pengguna.penggunaId ) AS Umur, /* Umur Tentor */
		dj.hari, dj.jam, dj.tglKursus,
		app_kursus.ratings,
		app_kursus.tempatKursus
		FROM detailjadwal as dj
		INNER JOIN app_kursus on dj.kodeKursus=app_kursus.idapp_kursus
		WHERE dj.idTentor_detailKursus='$idTentor'
		";
		$query = $this->db->query($sql); return $query->result_array();
	}

	// update Jadwal Ajar Tentor Berdasarkan kode kursus dan id bidang studi.
	public function updateJadwalAjarTentorBerdasar($kodeKursus, $idBidang){
		$sql = "
		SELECT dj.kodeKursus,
		dj.idBidangStudi_bidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dj.idBidangStudi_bidangStudi=tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* NAMA BIDANG STUDI */
		dj.idTentor_detailKursus,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dj.idSiswa_appKursus=tb_pengguna.penggunaId ) AS Siswa, /* NAMA Tentor */
		dj.idSiswa_appKursus,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dj.idTentor_detailKursus=tb_pengguna.penggunaId ) AS Tentor, /* NAMA Tentor */
		(SELECT tb_pengguna.umur from tb_pengguna where dj.idTentor_detailKursus=tb_pengguna.penggunaId ) AS Umur, /* Umur Tentor */
		dj.hari, dj.jam, dj.tglKursus,
		app_kursus.ratings,
		app_kursus.tempatKursus
		FROM detailjadwal as dj
		INNER JOIN app_kursus on dj.kodeKursus=app_kursus.idapp_kursus
		WHERE dj.kodeKursus='$kodeKursus' and dj.idBidangStudi_bidangStudi='$idBidang'
		";
		$query = $this->db->query($sql); return $query->result_array();
	}

	// API PERKEMBANGAN SISWA PADA MODUL PERKEMBANGAN SISWA
	public function readPerkembanganBagSiswa($idSiswa){
		$sql = " SELECT dp.idDperkembangan,
		dp.kodeKursus_detailKursus,

		dp.bidangStudi,
		bs.namaBidangStudi,

		(SELECT tb_indikator.namaIndikator from tb_indikator where dp.indikator= tb_indikator.idIndikator) AS indikator, /* indikator */
		(SELECT tb_indikator.kategoriIndikator from tb_indikator where dp.indikator= tb_indikator.idIndikator ) AS KategoriIndikator, /* Kategori indikator */

		dp.nilai, dp.tglinserts,
		dk.statusKursus, app_kursus.idSiswa,
		tb_pengguna.namaDepan AS siswa,
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId) AS Tentor,
		app_kursus.ratings
		FROM detailperkembangan AS dp
		INNER JOIN app_kursus ON app_kursus.idapp_kursus = dp.kodeKursus_detailKursus
		INNER JOIN tb_pengguna ON app_kursus.idSiswa = tb_pengguna.penggunaId
		INNER JOIN detailkursus AS dk ON dp.kodeKursus_detailKursus = dk.kodeKursus
		INNER JOIN tb_bidangstudi as bs on dp.bidangStudi = bs.id_bidangStudi
		where app_kursus.idSiswa='$idSiswa' and dk.statusKursus='aktif'
		GROUP BY dp.idDperkembangan
		ORDER BY kodeKursus_detailKursus";
		$query = $this->db->query($sql); return $query->result_array();
	}


	public function insert_kritkSaran($data){
		$query = $this->db->insert('app_kritiksaran', $data); return $query;
	}

	public function update_ratting($data){
		$this->db->where('penggunaId',$_POST['id']); 
		$query=$this->db->update('tb_pengguna',$data); return $query;
	}

	/* QUERY DATA LAPORAN PROFIT TENTOR  */
	public function _laporanProfit($idTentor){
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
		(dp.jumlahGaji+dp.jumlahBonus) as total,
		(select sum(dp.jumlahGaji+dp.jumlahBonus) from detailpenggajian as dp where dk.statusKursus='aktif') as totalTerimaSemua,
		dp.metodeBayar,
		dp.noRek,
		DATE_FORMAT(dp.tglBayar, '%d-%m-%Y') AS tglBayar,
		dk.statusKursus
		FROM detailpenggajian as dp, detailkursus as dk
		WHERE dp.idTentor_detailKursus='$idTentor' and dk.kodeKursus=dp.kodeKursus_detailKursus and dk.statusKursus='aktif' /* untuk api laporan profit*/
		"; $query = $this->db->query($sql); return $query->result_array();
	}


	/*  data absensi kehadiran from Tentor  */
	public function _absenfromTentor($idTentor)
	{
		$sql = "SELECT 
		dk.idUnix,
		dk.kodeKursus,
		(SELECT app_kursus.idSiswa from app_kursus where app_kursus.idapp_kursus= dk.kodeKursus ) AS idSiswa,/* IDSISWA */
		(SELECT tb_pengguna.namaDepan from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS Siswa, /* NAMA SISWA */
		(SELECT tb_pengguna.foto from tb_pengguna where idSiswa= tb_pengguna.penggunaId ) AS fotoSiswa, /*FOTO SISWA*/
		dk.idTentor,
		(SELECT tb_pengguna.namaDepan from tb_pengguna where dk.idTentor= tb_pengguna.penggunaId ) AS Tentor, /* TENTOR */
		dk.idBidangStudi,
		(SELECT tb_bidangstudi.namaBidangStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS bidangStudi, /* BIDANG STUDI */
		
		(SELECT tb_bidangstudi.kategoriStudi from tb_bidangstudi where dk.idBidangStudi= tb_bidangstudi.id_bidangStudi ) AS kategoriBidangStudi, /* KATEGORI BIDANG STUDI */
		dk.statusKursus,
		dk.roleAbsen
		from detailkursus as dk
		where dk.idTentor='$idTentor' and dk.statusKursus='aktif' and dk.roleAbsen='0' /* untuk api laporan profit*/
		"; $query = $this->db->query($sql); return $query->result_array();
	}


	public function _UpdateRoleAbsenfromTentor($idUnix)
	{
		$data = array(
			'roleAbsen' => '1'
		);
		$this->db->where('idUnix',$idUnix); 
		$query=$this->db->update('detailkursus',$data); return $query;
	}



	// public function update_rattingMurid($data){
	// 	$this->db->where('penggunaId',$_POST['idSiswa']); 
	// 	$query=$this->db->update('tb_pengguna',$data); return $query;
	// }

	// public function update_rattingTentor($data){
	// 	$this->db->where('penggunaId',$_POST['idTentor']); 
	// 	$query=$this->db->update('tb_pengguna',$data); return $query;
	// }



}