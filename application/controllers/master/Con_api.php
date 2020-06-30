<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once("application/libraries/REST/REST_Controller.php");
require_once("application/libraries/REST/Format.php");

use Restserver\Libraries\REST_Controller;

class Con_api extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model(
			array(
				'master/Mo_jadwal',
				'master/Mo_abouts',
				'master/Mo_supports',
				'master/Mo_perkembangan',
				'M_api'
			));
		$this->load->helper('my');

		 // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    function index(){
    	redirect('Auth');
    }

	// API for login app in siswa. 
    function ApiGetsessionUserSiswa(){
		// decode session login.
    	$SessionUser 	= $this->input->get('SessionUserSiswa');
    	$query			= $this->Mo_jadwal->forApi_sessionUserSiswa($SessionUser);echo json_encode($query);
    }
	// API for login app in tentor. 
    function ApiGetsessionUserTentor(){
		// decode session login.
    	$SessionUser 	= $this->input->get('SessionUserTentor');
    	$query			= $this->Mo_jadwal->forApi_sessionUserTentor($SessionUser);echo json_encode($query);
    }

	// API for abouts on android app
    function apiAbouts(){
    	$res = $this->Mo_abouts->apiAbouts(); echo json_encode($res);
    }

	// API for Supports on android app
    function apiSupports(){
    	$res = $this->Mo_supports->apiSupports(); 
    	echo json_encode($res);
    }



	// __________________________________________________________________________________________________
	// MODUL TENTOR
	// __________________________________________________________________________________________________

	// API : banyak Siswa yang di miliki tentor on android app - modul Tentor
    function apiDataSiswaTentor(){
    	$idTentor 	= $this->input->get('idTentor'); 
    	$query = $this->Mo_perkembangan->forApi_dataSiswaFromTentor($idTentor);echo json_encode($query);
    }

	// API for Indikator Penilaian on android app - modul Tentor
    function apiIndikator(){
    	$query = $this->Mo_perkembangan->forApi_indikator();echo json_encode($query);
    }

	// API : PENILAIAN SISWA PADA MODUL TENTOR, banyak Siswa yang aktif yang di miliki tentor on app - modul Tentor
    function apiPerkembangan_modulTentor(){
    	$idTentor 	= $this->input->get('idTentor'); 
    	$query = $this->Mo_perkembangan->forApi_penilaianPerkembanganSiswa($idTentor);echo json_encode($query);
    }

	// list Lomba Artikel yang di adakan oleh admin bilik ilmu. di tampilkan di modul android bagian tentor
    function listLombaArtikel(){
    	$query = $this->M_api->dataLombaArtikel();echo json_encode($query);
    }

    // API : banyak Siswa yang di miliki tentor on android app - modul Tentor
	// function apiDataSiswaTentor(){
	// 	$idTentor 	= $this->input->get('idTentor'); 
	// 	$query = $this->Mo_perkembangan->forApi_dataSiswaFromTentor($idTentor);echo json_encode($query);
	// }

	// List data Siswa Yang terikat / menjadi siswa dari tentor tertentu.
    function listSiswaFromTentor(){
    	$idTentor = $this->input->get('idTentor');
    	$query = $this->Mo_perkembangan->listDataSiswaFromTentor($idTentor);echo json_encode($query);
    }
	// List data Tentor Yang terikat / menjadi Pengajar dari Siswa tertentu.
    function listTentorFromSiswa(){
    	$idSiswa = $this->input->get('idSiswa');
    	$query = $this->Mo_perkembangan->listDataTentorFromSiswa($idSiswa);echo json_encode($query);
    }

	// API Modul data Jadwal Ajar Tentor
    function dataJadwalAjarTentor(){
    	$idTentor 	=  $this->input->get('idTentor');
    	$query = $this->M_api->JadwalAjarTentor($idTentor); echo json_encode($query);
    }

	// API Modul Update selesai kursus pada modul Jadwal Tentor
    function updateJadwalAjarTentorBerdasarkan(){
    	$kodeKursus 	=  $this->input->get('kodeKursus');
    	$idBidang 	=  $this->input->get('idBidang');
    	$query = $this->M_api->updateJadwalAjarTentorBerdasar($kodeKursus, $idBidang); echo json_encode($query);
    }

	// API Modul Profit Ajar Tentor
    function ProfitTentor(){
    	$idTentor = $this->input->get('idTentor');
    	$query = $this->M_api->_laporanProfit($idTentor); echo json_encode($query);
    }

    // API Modul Absen kehadiran Tentor - button absen kehadiran
    function absenKehadiranTentor(){
    	$idTentor = $this->input->get('idTentor');
    	$query = $this->M_api->_absenfromTentor($idTentor); echo json_encode($query);
    }

    // Update roleAbsen from detailKursus - modul tentor
    function updateRoleAbsen(){
    	$idUnix = $this->input->get('idUnix');
    	$query = $this->M_api->_UpdateRoleAbsenfromTentor($idUnix); echo json_encode($query);
    }
   

	// POST KRITIK SARAN 
    function index_postkritiksaran() {
    	$id = $this->input->get('id');
    	$isikritiksaran = $this->input->get('isikritiksaran');
    	$data = array(
    		'tb_pengguna_penggunaId' =>  $id,
    		'isikritiksaran' 		 =>  $isikritiksaran,
    		'setatus' 				 => 'New',
    	);
    	$res 	= $this->M_api->insert_kritkSaran($data);
    	echo json_encode(array('status'=>$res, 'dataInsert'=>$data));
    }

    // POST RATTING SISWA / MURID ataupun GURU / TENTOR
    function index_updateRatting(){
    	$id = $this->input->get('id');
    	$rattings = $this->input->get('rattings');
    	$data = array(
    		'penggunaId' => $id,
    		'rattings' =>  $rattings,
    	);
    	$res 	= $this->M_api->update_ratting($data);
    	echo json_encode(array('status'=>$res, 'dataUpdate'=>$data));
    }

	// POST RATTING SISWA / MURID
    // function index_updateRattingMurid(){
    // 	$data = array(
    // 		'penggunaId' => $_POST['idSiswa'],
    // 		'rattings' =>  $_POST['rattings'],
    // 	);
    // 	$res 	= $this->M_api->update_rattingMurid($data); 
    // 	echo json_encode(array('status'=>$res, 'dataUpdate'=>$data));
    // } 

    // // POST RATTING TENTOR / GURU
    // function index_updateRattingTentor(){
    // 	$data = array(
    // 		'penggunaId' => $_POST['idTentor'],
    // 		'rattings' =>  $_POST['rattings'],
    // 	);
    // 	$res 	= $this->M_api->update_rattingTentor($data); 
    // 	echo json_encode(array('status'=>$res, 'dataUpdate'=>$data));
    // } 

	// LAPORAN PROFIT TENTOR 
	// function laporanProfitTentor()
	// {

	// }

	/*
		nomor, siswa, bidangstudi, gaji, bonus, tgl di bayar.
	*/


	// _______________________________________________________________________________________
	// MODUL SISWA
	// _______________________________________________________________________________________

	// API for Laporan Perkembangan siswa on android app - modul Siswa
		function apiPerkembangan_modulSiswa()
		{
			$idSiswa 	=  $this->input->get('idSiswa');
			$query = $this->Mo_perkembangan->forApi_dataPerkembanganSiswa($idSiswa);echo json_encode($query);
		}

	// API Login for android app 
		function loginApiUsers()
		{
			$role 		= $this->input->get('role');
			$username 	= $this->input->get('username');
			$password 	= md5($this->input->get('password'));
			$query 		= $this->M_api->login_api($role,$username,$password); echo json_encode($query);
		}

	// API transaksi dan riwayat pembayaran
		function transaksi()
		{
			$idSiswa 	=  $this->input->get('idSiswa');
			$query = $this->M_api->transaksiDanDetailPembayaran($idSiswa); echo json_encode($query);
		}

	// API Modul data Jadwal Kursus Siswa
		function dataJadwalKursusSiswa()
		{
			$idSiswa 	=  $this->input->get('idSiswa');
			$query = $this->M_api->dataJadwalKursusSiswa($idSiswa); echo json_encode($query);
		}

//  C O B A 
//Mengirim atau menambah 
		

		function index_get() {
			$id = $this->input->get('id');
			$res = "SELECT * FROM app_kritiksaran where id_kritiksaran='$id' ";
			$res = $this->db->query($res)->row_array();
			echo json_encode($res);
		}

	}
	?>