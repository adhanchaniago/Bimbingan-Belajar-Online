<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_pengguna extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); cek_login();
		$this->load->model('master/Mo_pengguna', 'moPengg');
	}
	function index(){
		$data['title'] = "Data Pengguna Aplikasi";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_template', 'pengguna/_dataPengguna', $data);
	}
	function getData(){
		$data = array('start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->moPengg->getDataPengguna($data); echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->moPengg->getPengguna($data['id']); echo json_encode($res);
	}
	// function filterNegara(){
	// 	$res = $this->moPengg->getFilterNegara($_GET['q']); echo json_encode($res);
	// }
	// function filterProvinsi(){
	// 	$res = $this->moPengg->getFilterProvinsi($_GET['q']); echo json_encode($res);
	// }
	function filterKota(){
		$res = $this->moPengg->getFilterKota($_GET['q']); echo json_encode($res);
	}
	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->moPengg->checkId($data['penggunaId']);
		if($check == "OK"){
			$this->moPengg->insertPengguna($data);
		}
		$res = array("result" => $check); echo json_encode($res);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->moPengg->updatePengguna($data); echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'IDPengguna' => $data['id']);
		$res = $this->moPengg->deletePengguna($data); echo $res;
	}

}
?>