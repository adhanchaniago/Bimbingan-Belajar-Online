<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_setKuis extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession'));
		$this->load->model('master/Mo_setKuis','mod');
		cek_login();
	}
	function index(){
		$data['title'] = "Setup Nama / Judul Kuis";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();

		// $data['icons'] = $this->db->get('tb_icons')->result();
		// print_r($data['icons']);die();

		$this->template->load('_template', 'Settings/_datasetKuis', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->mod->getDatasetKuis($data); echo json_encode($res);
	}
	function getDataSelect(){
		$res  = $this->mod->getsetKuis($_POST['id']); echo json_encode($res);
	}
	// function filterKategoriKuis(){
	// 	$res = $this->mod->getFilterKategoriKuis($_GET['q']); echo json_encode($res);
	// }
	function filterIcons(){
		$res = $this->mod->getfilterDataIcons($_GET['q']); echo json_encode($res);
	}
	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		// $check = $this->mod->checkId();
		// if($check == "OK"){
			$data = array(
				"id_kuis" => $data["id_kuis"],
				"namaKuis" => $data["namaKuis"],
				"tb_kategori_kuis_id_kategori_kuis" => $data['id_kategori_kuis'], 
				"keterangan" => $data["keterangan"],
				'icon' => $data['idIcons']
			);
			// print_r($data);die();
			$data = $this->mod->insertsetKuis($data);
		// }
		// $res = array("result" => $check);
		echo json_encode($data);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->mod->updatesetKuis($data);
		echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'id' => $data['id']);
		$res = $this->mod->deletesetKuis($data); echo $res;
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