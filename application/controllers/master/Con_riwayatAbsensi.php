<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_riwayatAbsensi extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); 
		cek_login();
		$this->load->model('master/Mo_riwayatAbsensi', 'absen');
	}
	function index(){
		$data['title'] = "Riwayat Absensi Kursus";
		$data['session']= session();
		$this->template->load('_template', 'pengguna/_dataAbsensi', $data);
	}
	function getData(){
		$data = array(
			'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			// 'filterdateto' => $_POST['filterdateto'],
			// 'filterdatefrom' => $_POST['filterdatefrom'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->absen->getDataAbsensi($data);
		echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->absen->getAbsensi($data['id']);
		echo json_encode($res);
	}

	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->absen->checkId($data['idUnixRiwayat']);
		if($check == "OK"){
			$this->absen->insertAbsensi($data);
		}
		$res = array("result" => $check);
		echo json_encode($res);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->absen->updateAbsensi($data);
		echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'idUnixRiwayat' => $data['id']);
		$res = $this->absen->deleteAbsensi($data);
		echo $res;
	}

	function checkId(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->absen->checkId($data['id']);
		$res = array( 'res' => $check);
		echo json_encode($res);
	}

}
?>