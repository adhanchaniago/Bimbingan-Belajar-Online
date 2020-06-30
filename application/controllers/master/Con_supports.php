<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_supports extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession'));
		$this->load->model('master/Mo_supports','mod');
		cek_login();
	}
	function index(){
		$data['title'] = "Setup Supports Data";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_template', 'Settings/_dataSupports', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->mod->getDataSupports($data); echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->mod->getSupports($data['id']);
		echo json_encode($res);
	}
	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->mod->checkData();
		if($check == "OK"){
			$this->mod->insertSupports($data);
		}
		$res = array("result" => $check);
		echo json_encode($res);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->mod->updateSupports($data);
		echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'id' => $data['id']);
		$res = $this->mod->deleteSupports($data);
		echo $res;
	}

	function checkId(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->mod->checkId($data['id']);
		$res = array( 'res' => $check);
		echo json_encode($res);
	}
	function checkData(){
		$check = $this->mod->checkData();
		$res = array( 'res' => $check); echo json_encode($res);
	}

}
?>