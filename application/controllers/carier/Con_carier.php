<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_carier extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('configsession','my'));
		$this->load->model('carier/Mo_pengguna', 'model');
		$this->load->model('carier/Mo_carierModel', 'carierModel');
	}
	function index(){
		$data['title'] = "Form Pendaftaran Carier Tentor";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_templatePendaftaran', 'carier/_formCarier', $data);
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

	function saveRegCarier(){
		$data = json_decode(file_get_contents('php://input'), true);
		$no = generateKodeForm('RC', 'tambah');
		$datacarier = array(
			'penggunaId' => $no,
			'nomorKtp'  => $data['nomorKtp'],
			'namaDepan' => $data['namaDepan'],
			'namaBelakang' => $data['namaBelakang'],
			'alamat' => $data['alamat'],
			'tempatTinggal' => $data['tempatTinggal'],
			'tempatLahir' => $data['NAMAKOTA'],
			'umur' => $data['umur'],
			'noWa' => hp($data['noWa']),
			'email' => $data['email'],
			'tglLahir' => $data['tglLahir'],
			'pendidikanTerakir' => $data['pendidikanTerakir'],
			'pendidikanSekarang' => $data['pendidikanSekarang'],
			'tb_role_roleId' => '2',
			'tb_kategori_kategoriId' => $data['kategoriid'],
			'status' => 'melamar',
			'namaBank' => $data['namaBank'],
			'noRek' => $data['noRek'],
		);
		// print_r($datacarier);die();
		$listcarier = json_decode($data['LISTCARIER'], true);
		$res = $this->carierModel->insertCarier($datacarier);
		// die();
		foreach ($listcarier as $v){

			if ($v['id_bidangStudi']!=''){
				$datalistcarier = array(
					'idUnix' => uniqid(),
					'pengguna_idPengguna' => $no,
					'namaBidangStudi' => $v['namaBidangStudi'],
					'kategoriStudi' => $v['kategoriStudi'],
					'jenjang' => $v['jenjang']
				);
				$this->carierModel->insertDetailCarier($datalistcarier);
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
	function checkKtp(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->model->checkKtp($data['id']);
		$res = array( 'res' => $check);
		echo json_encode($res);
	} 



// -------------------------------------------------------------------------
	function acakPass(){
		$pass = randomPass(6);
		print_r($pass);die();
		// result : Ul1@aS
	}

	function tesChange_0(){
		$nomor = '083845478148';
		echo hp($nomor);
		// result : +6283845478148
	}

	function tesChange_62(){
		$nomor = '+6283845478148';
		echo hp0($nomor);
		// result : 083845478148
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