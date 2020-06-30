<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_abouts extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); cek_login();
		$this->load->model('master/Mo_abouts','mod'); 
	}
	function index(){
		$data['title'] = "Setup Abouts Data";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_template', 'Settings/_dataAbouts', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->mod->getDataAbouts($data); echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->mod->getAbouts($data['id']); echo json_encode($res);
	}
	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->mod->checkData();
		if($check == "OK"){
			$this->mod->insertAbouts($data);
		}
		$res = array("result" => $check); echo json_encode($res);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->mod->updateAbouts($data); echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'id' => $data['id']);
		$res = $this->mod->deleteAbouts($data); echo $res;
	}
	function checkId(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->mod->checkId($data['id']);
		$res = array( 'res' => $check); echo json_encode($res);
	}
	function checkData(){
		$check = $this->mod->checkData();
		$res = array( 'res' => $check); echo json_encode($res);
	}
}
?>