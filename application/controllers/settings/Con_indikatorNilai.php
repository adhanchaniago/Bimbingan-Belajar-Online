<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_indikatorNilai extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('master/Mo_indikatorNilai', 'nilai');
		$this->load->helper(array('login','configsession'));
		cek_login();

	}
	function index(){
		$data['title'] = "Data Nilai Siswa Lengkap";
		$data['session']= session();
		$this->template->load('_template', 'Settings/_dataindikatorNilai', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->nilai->getDataNilai($data);
		echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->nilai->getNilai($data['id']);
		echo json_encode($res);
	}

	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->nilai->checkId($data['namaIndikator']);
		if($check == "OK"){
			$this->nilai->insertNilai($data);
		}
		$res = array("result" => $check);
		echo json_encode($res);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->nilai->updateNilai($data);
		echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'idIndikator' => $data['id']);
		$res = $this->nilai->deleteNilai($data);
		echo $res;
	}

	function checkId(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->nilai->checkId($data['namaIndikator']);
		$res = array( 'res' => $check);
		echo json_encode($res);
	}

}
?>