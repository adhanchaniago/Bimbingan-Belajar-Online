<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_riwayatBelajarSiswa extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); 
		cek_login();
		$this->load->model('master/Mo_riwayatPerkembangan', 'perkembangan');
	}
	function index(){
		$data['title'] = "Data Riwayat Perkembangan Siswa";
		$data['session']= session();
		$this->template->load('_template', 'pengguna/_datariwayatPerkembangan', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->perkembangan->getDataPerkembangan($data);
		echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->perkembangan->getDataPerkembangan($data['id']);
		echo json_encode($res);
	}

	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->perkembangan->checkId($data['id']);
		if($check == "OK"){
			$this->perkembangan->insertPerkembangan($data);
		}
		$res = array("result" => $check);
		echo json_encode($res);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->perkembangan->updatePerkembangan($data);
		echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'idDperkembangan' => $data['id']);
		$res = $this->perkembangan->deletePerkembangan($data);
		echo $res;
	}
	function checkId(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->perkembangan->checkId ($data['id']);
		$res = array( 'res' => $check);
		echo json_encode($res);
	}
}
?>