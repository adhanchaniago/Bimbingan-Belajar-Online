<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_riwayatJadwal extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); 
		cek_login();
		$this->load->model('master/Mo_riwayatJadwal', 'jadwal');
	}
	function index(){
		$data['title'] = "Data Riwayat Jadwal";
		$data['session']= session();
		$this->template->load('_template', 'pengguna/_datariwayatJadwal', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->jadwal->getDataJadwal($data);
		echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->jadwal->getJadwal($data['id']);
		echo json_encode($res);
	}

	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->jadwal->checkId($data['idUnix']);
		if($check == "OK"){
			$this->jadwal->insertJadwal($data);
		}
		$res = array("result" => $check);
		echo json_encode($res);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->jadwal->updateJadwal($data);
		echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'idUnix' => $data['id']);
		$res = $this->jadwal->deleteJadwal($data);
		echo $res;
	}
	function checkId(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->jadwal->checkId($data['id']);
		$res = array( 'res' => $check);
		echo json_encode($res);
	}
}
?>