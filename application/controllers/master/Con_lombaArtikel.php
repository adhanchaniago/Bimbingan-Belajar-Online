<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_lombaArtikel extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); 
		cek_login();
		$this->load->model('master/Mo_riwayatLomba', 'lomba');
	}
	function index(){
		$data['title'] = "Data Lomba Artikel Lengkap";
		$data['session']= session();
		$this->template->load('_template', 'settings/_dataLomba', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->lomba->getDataLomba($data);
		echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->lomba->getLomba($data['id']);
		echo json_encode($res);
	}

	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->lomba->checkId($data['idLomba']);
		if($check == "OK"){
			$data = array(
				'temaArtikel' => $data['temaArtikel'],
				'minimalKata' => $data['minimalKata'],
				'batasPengumpulan' => $data['batasPengumpulan']
			);
			$this->lomba->insertLomba($data);
		}
		$res = array("result" => $check);
		echo json_encode($res);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->lomba->updateLomba($data);
		echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'idLomba' => $data['id']);
		$res = $this->lomba->deleteLomba($data);
		echo $res;
	}

	function checkId(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->lomba->checkId($data['id']);
		$res = array( 'res' => $check);
		echo json_encode($res);
	}

}
?>