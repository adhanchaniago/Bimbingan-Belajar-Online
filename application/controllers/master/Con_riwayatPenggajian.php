<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_riwayatPenggajian extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); cek_login();
		$this->load->model('master/Mo_riwayatPenggajian','mod'); 
	}
	function index(){
		$data['title'] = "Data Riwayat Penggajian Tentor";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_template', 'pengguna/_datariwayatPenggajian', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			
			// 'filterdate' => $_POST['filterdate'],

			'filtertext' => $_POST['filtertext']);
		$res = $this->mod->getDatariwayatPenggajian($data); echo json_encode($res);
	}
	// function getDataSelect(){
	// 	$data = json_decode(file_get_contents('php://input'), true);
	// 	$res = $this->mod->getriwayatPembayaran($data['id']); echo json_encode($res);
	// }
	// function save(){
	// 	$data = json_decode(file_get_contents('php://input'), true);
	// 	$check = $this->mod->checkData();
	// 	if($check == "OK"){
	// 		$this->mod->insertriwayatPembayaran($data);
	// 	}
	// 	$res = array("result" => $check); echo json_encode($res);
	// }
	// function InsertDetailBayar(){
	// 	$data = json_decode(file_get_contents('php://input'), true);
	// 	$data = array(
	// 	'idUnixs' => uniqid(),
	// 	'kodeKursus_app_kursus' 	=> $data['idapp_kursus'], 
	// 	'jumlahBayar' 	=> $data['jumlahBayar'], 
	// 	'metodebayar' 	=> $data['metode'], 
	// 	'noRek' 	=> $data['noRek']
	// 	);
	// 	$res = $this->mod->insertDetailriwayatPembayaran($data); echo $res;
	// }
	// function delete(){
	// 	$data = json_decode(file_get_contents('php://input'), true);
	// 	$data = array( 'id' => $data['id']);
	// 	$res = $this->mod->deleteriwayatPembayaran($data); echo $res;
	// }
	// function checkId(){
	// 	$data = json_decode(file_get_contents('php://input'), true);
	// 	$check = $this->mod->checkId($data['id']);
	// 	$res = array( 'res' => $check); echo json_encode($res);
	// }
	// function checkData(){
	// 	$check = $this->mod->checkData();
	// 	$res = array( 'res' => $check); echo json_encode($res);
	// }
}
?>