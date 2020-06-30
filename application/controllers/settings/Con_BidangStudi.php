<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_BidangStudi extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession'));cek_login();
		$this->load->model('master/BidangStudiModel','BS_model');
	}
	function index(){
		$data['title'] = "Data Bidang Studi";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_template', 'Settings/_dataBidangStudi', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->BS_model->getDataBidangStudi($data);
		echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->BS_model->getBidangStudi($data['id']);
		echo json_encode($res);
	}
	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->BS_model->checkId($data['namaBidangStudi']);
		if($check == "OK"){
			$data = array(
				'namaBidangStudi' => $data['namaBidangStudi'], 
				'kategoriStudi' => $data['kategoriStudi'],
				'jenjang' => $data['jenjang'], 
				'hargaperSesi' => $data['hargaperSesi']
			);
			$this->BS_model->insertBidangStudi($data);
		}
		$res = array("result" => $check);
		echo json_encode($res);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array(
			'id_bidangStudi' => $data['id_bidangStudi'], 
			'namaBidangStudi' => $data['namaBidangStudi'], 
			'kategoriStudi' => $data['kategoriStudi'],
			'jenjang' => $data['jenjang'], 
			'hargaperSesi' => $data['hargaperSesi']
		);
		$res = $this->BS_model->updateBidangStudi($data);
		echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'id_bidangStudi' => $data['id']);
		$res = $this->BS_model->deleteBidangStudi($data);
		echo $res;
	}

	function checkId(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->BS_model->checkId($data['id']);
		$res = array( 'res' => $check);
		echo json_encode($res);
	}

}
?>
