<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_jadwal extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession','my')); cek_login();
		$this->load->model('master/Mo_jadwal', 'modJad');
	}
	function index(){
		$data['title'] = "Data Jadwal Kursus";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_template', 'pengguna/_dataJadwal3', $data);
	}
	
	function getData(){
		$data = array(
			'start' => $_POST['start'],
			'length' => $_POST['length'],
			// 'filtervalue' => $_POST['filtervalue'],
			// 'filtertext' => $_POST['filtertext'],
		);
		$res = $this->modJad->getDataJadwal($data);
		echo json_encode($res);
	}
	function filterTentor(){
		$res = $this->modJad->getFilterTentor($_GET['q']);
		echo json_encode($res);
	}

	function filterSiswa(){
		$res = $this->modJad->getFilterSiswa($_GET['q']);
		echo json_encode($res);
	}

	function filterKategori(){
		$res = $this->modJad->getFilterKategori($_GET['q']);
		echo json_encode($res);
	}

	function filterMapel(){
		$res = $this->modJad->getFilterBidangStudi($_GET['q']);
		echo json_encode($res);
	}

	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->modJad->getJadwal($data['id']);echo json_encode($res);
	}

	// function getDataSelect(){
	// 	$res = $this->modJad->getJadwal($_POST['id']);
	// 	echo json_encode($res);
	// }

	function getDataDetilJadwal(){
		$res = $this->modJad->getDetilJadwal();
		echo json_encode($res);
	}

	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$kode= 'KBI';
		$status = 'tambah';
		$key = generateKodeForm($kode,$status);
		$data = array(
			"idapp_kursus" => $key,
			"tb_bidangStudi_id_bidangStudi" => $data["bidangStudiId"],
			"idSiswa" => $data["idSiswa"],
			"idTentor" => $data["idTentor"],
			"tb_kategori_kategoriId" => $data["kategoriId"],

			"waktuKursus" => $data['waktuKursus'],
			"tglKursus" => $data['tglKursus'],
			"durasiKursus" => $data["durasiKursus"],
			"tempatKursus" => $data["tempatKursus"],
			"statusKursus" => $data["statusKursus"],
			"pertemuan_ke" => $data["pertemuan_ke"],
			"tglselesai" => $data["tglselesai"],
			"keterangan" => $data["keterangan"]
		);
		$res = $this->modJad->insertJadwal($data);
			echo json_encode($res); 
		}
		function update(){
			$data = json_decode(file_get_contents('php://input'), true);
			$res = $this->modJad->updateJadwal($data);echo $res;
		}
		function delete(){
			$data = json_decode(file_get_contents('php://input'), true);
			$data = array( 'idapp_kursus' => $data['id']);
			$res = $this->modJad->deleteJadwal($data);echo $res;

			 
		}
		function checkId(){
			$data = json_decode(file_get_contents('php://input'), true);
			$check = $this->modJad->checkId($data['idapp_kursus']);
			$res = array( 'res' => $check);echo json_encode($res);
		}
	}
	?>