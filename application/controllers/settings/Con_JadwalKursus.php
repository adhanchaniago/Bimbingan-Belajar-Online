<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_JadwalKursus extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession'));cek_login();
		$this->load->model('master/Mo_jadwalKursus','JK_model');
	}
	function index(){
		$data['title'] = "Data Jadwal Kursus";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_template', 'Settings/_dataJadwalKursus', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			// 'filtersiswa' => $_POST['filtersiswa'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->JK_model->getDataJadwalKursus($data);
		echo json_encode($res);
	}
	function getDataSelect(){ 
		$res = $this->JK_model->getJadwalKursus($_POST['id']);
		echo json_encode($res);
	}
	/* for data filter berdasarkan kodeDetailKursus  di detailKursus */
	function filterJadwal(){
		$res = $this->JK_model->getFilterKodeDetailKursus($_GET['q']); echo json_encode($res);
	}

	/* for data filter Select Tentor  */
	function filterTentor(){
		$res = $this->JK_model->getFilterSelectTentor($_GET['q']); echo json_encode($res);
	}
	function save(){
		$data = json_decode(file_get_contents('php://input'), true);

		$no = generateKodeForm('DK', 'tambah');
		$check = $this->JK_model->checkId($data['idUnix']);
		if($check == "OK"){
			$data = array(
				'idUnix' => uniqid(),
				'kodeDetailKursus_detailKursus' => $no,
				'kodeKursus' => $data['kodeKursus'],
				'idBidangStudi_bidangStudi' => $data['idBidangStudi'],
				'idTentor_detailKursus' => $data['idTentor'],
				'idSiswa_appKursus' => $data['idSiswa'],
				'hari' => $data['hari'],
				'jam' => $data['jam'],
			);
			$this->JK_model->insertJadwalKursus($data);
		}
		$res = array("result" => $check); echo json_encode($res);
	}
	function update(){
		// $data = json_decode(file_get_contents('php://input'), true);
		// print_r($data);die()
		$data = array(
			'idUnix' => $_POST['idUnix'],
			'kodeDetailKursus_detailKursus' => $_POST['kodeDetailKursus_detailKursus'],
			'kodeKursus' => $_POST['kodeKursus'],
			'idBidangStudi_bidangStudi' => $_POST['idBidangStudi'],
			'idTentor_detailKursus' => $_POST['idTentor'],
			'idSiswa_appKursus' => $_POST['idSiswa'],
			'hari' => $_POST['hari'],
			'jam' => $_POST['jam'],
		);
		// print_r($data);die();
		$res = $this->JK_model->updateJadwalKursus($data); echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'idUnix' => $data['id']);
		$res = $this->JK_model->deleteJadwalKursus($data); echo $res;
	}

	function checkId(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->JK_model->checkId($data['id']);
		$res = array( 'res' => $check); echo json_encode($res);
	}

}
?>
