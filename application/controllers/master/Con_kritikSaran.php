<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_kritikSaran extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); cek_login();
		$this->load->model('master/Mo_kritikSaran','mod'); 
	}
	function index(){
		$data['title'] = "Kritik & Saran";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_template', 'pengguna/_dataPesan', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->mod->getDatakritikSaran($data); 
		// print_r(json_encode($res));die();
		echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->mod->getkritikSaran($data['id']); echo json_encode($res);
	}

	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->mod->checkData();
		if($check == "OK"){
			$this->mod->inser($data);
		}
		$res = array("result" => $check); echo json_encode($res);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array(
			"tb_pengguna_penggunaId" => $data['tb_pengguna_penggunaId'],
			"isikritiksaran" => $data['isikritiksaran'],
			"setatus" => 'arsip',
			"id_kritiksaran" => $data['id_kritiksaran']
		);
		$res = $this->mod->update($data); echo $res;
	}
	// function update(){
	// 	$data = json_decode(file_get_contents('php://input'), true);
	// 	$res = $this->mod->update($data); echo $res;
	// }
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'id_kritiksaran' => $data['id']);
		$res = $this->mod->delete($data); echo $res;
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