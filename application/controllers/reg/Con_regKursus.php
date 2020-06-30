<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_regKursus extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('configsession','my'));
		$this->load->model('reg/Mo_pengguna', 'model');
		$this->load->model('reg/Mo_kursusModel', 'kursusModel');
	}
	function index(){
		$data['title'] = "Form Registrasi Kursus";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_templatePendaftaran', 'RegSiswa/_dataRegistrasiKursus', $data);
	}

	function getData(){
		$data = array(
			'start' => $_POST['start'],
			'length' => $_POST['length'],
			// 'filtervalue' => $_POST['filtervalue'],
			// 'filtertext' => $_POST['filtertext'],
		);
		$res = $this->kursusModel->getDataKursus($data);
		echo json_encode($res);
	}

	function checkallowed(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->model->checkallowed($data['id']);
		$res = array( 'res' => $check);
		echo json_encode($res);
	}

	function saveRegKursus(){
		$data = json_decode(file_get_contents('php://input'), true);
		$no = generateKodeForm('KB', 'tambah');
		$noinv = generateKodeForm('INV', 'tambah');
		
		$datakursus = array(
			'TOTAL_ALL' => $data['TOTAL_ALL'],
			'idapp_kursus' => $no,
			'idSiswa' 	=> $data['idSiswa'],
			'tempatKursus' => $data['tempatKursus'],
			'noInv' => $noinv,
			'metodebayar' => '-',
			'jumlahTelahBayar' => '0',
			// 'keterangan' => '-',
		);
		$listkursus = json_decode($data['LISTKURSUS'], true);
		$res = $this->kursusModel->insertKursus($datakursus);
		
		// die();
		foreach ($listkursus as $v){

			if ($v['jumlahSesi']!=0 && $v['id_bidangStudi']!=''){
				$datalistkursus = array(
					'idUnix' => uniqid(),
					'subTotal' => $v['TOTALPENJUALAN'],
					'kodeKursus' => $no,
					'idBidangStudi' => $v['id_bidangStudi'],
					'jumlahSesi' => $v['jumlahSesi'],
					'perSesi' => $v['hargaperSesi'],

					'idTentor' => '-',
					'tglKursus' => $v['tglKursus'],
					'durasiKursus' => '90',
					'statusKursus' => 'mendaftar',
					'pertemuanKe' => $v['pertemuanKe'],
					'tglselesai' => $v['tglselesai'],
					'waktuKursus' => '-',
					'KETERANGANTRANSAKSI' => 'Belum Dibayar',
					'keteranganKursus' => '-'
					// detailkursus
				);

				$this->kursusModel->insertDetailKursus($datalistkursus);
				
			}
		}
		echo json_encode(array("res"=>"Berhasil", "KODE"=> $no));
	}


	function filterHarga(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->kursusModel->getFilterHarga($data['id_bidangStudi']);
		echo json_encode($res);
	}
	function filterKursus(){
		$res = $this->kursusModel->getFilterKursusHarga($_GET['q']);
		echo json_encode($res);
	}

	// tes auto fill jquery
	function tes_form(){
		$data['title'] = "Form Tes data with PHP and jquery";
		$this->template->load('_templatePendaftaran','RegSiswa/_dataRegistrasiKursus_tes',$data);
	}
	function getidSiswa(){
		$id = $_GET['idsiswa'];
		$data = $this->kursusModel->showbyIdSiswa($id);
		$data = array(
			'namaDepan' => $data['namaDepan'],
			'namaBelakang' => $data['namaBelakang']
		);
		echo json_encode($data);
	}
	function getBidStudi(){
		$bidangStudi = $_GET['bidangStudi'];
		$data = $this->kursusModel->showbyidBidStudi($bidangStudi);
		$data = array(
			'hargaperSesi' => $data['hargaperSesi']
		);
		echo json_encode($data);
	}

}
?>