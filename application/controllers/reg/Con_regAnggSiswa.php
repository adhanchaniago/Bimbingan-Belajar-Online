<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_regAnggSiswa extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper('my');
		$this->load->model('reg/Mo_pengguna', 'moPengg');
	}
	function index(){
		$data['title'] = "Form Pendaftaran Siswa";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		// $data['session']= session();
		$data['no'] = $this->moPengg->checkIdAnggotaSiswa();
		$this->template->load('_templatePendaftaran', 'RegSiswa/_dataRegistrasiSiswa', $data);
	}
	function getData(){
		$data = array('start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->moPengg->getDataPengguna($data); 

		// print_r(json_encode($res));die();
		echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->moPengg->getPengguna($data['id']); echo json_encode($res);
	}
	function filterSiswa(){
		$res = $this->moPengg->getFilterSiswa($_GET['q']); echo json_encode($res);
	}
	function filterKota(){
		$res = $this->moPengg->getFilterKota($_GET['q']); echo json_encode($res);
	}
	function filterQuran(){
		$res = $this->moPengg->getFilterQuran($_GET['q']); echo json_encode($res);
	}
	function filterSD(){
		$res = $this->moPengg->getFilterSD($_GET['q']); echo json_encode($res);
	}
	function filterSMP(){
		$res = $this->moPengg->getFilterSMP($_GET['q']); echo json_encode($res);
	}
	function filterIPA(){
		$res = $this->moPengg->getFilterIPA($_GET['q']); echo json_encode($res);
	}
	function filterIPS(){
		$res = $this->moPengg->getFilterIPS($_GET['q']); echo json_encode($res);
	}

	function saveRegAnggota(){
		$data = json_decode(file_get_contents('php://input'), true); 
		$check = $this->moPengg->checkKtp($data['nomorKtp']);

		if($check == "OK"){
			$kode= 'RG';
			$status = 'tambah';
			$key = generateKodeForm($kode,$status);

			$data = array(
				"penggunaId" => $key,
				"nomorKtp" => $data['nomorKtp'],
				"namaDepan" => $data['namaDepan'],
				"namaBelakang" => $data['namaBelakang'],
				// "alamatRumah" => $data['alamatRumah'],
				"tempatTinggal" => $data['tempatTinggal'],
				"tempatLahir" => $data['NAMAKOTA'],
				"email" => $data['email'],
				"umur" => $data['umur'],
				"tglLahir" => $data['tglLahir'],
				"noWa" => hp($data['noWa']),
				"pendidikanSekarang" => $data['pendidikanSekarang'],
				"pendidikanTerakir" => $data['pendidikanTerakir'],
				'tb_role_roleId' => '3',
				'tb_kategori_kategoriId' => '1',
			);

			$this->moPengg->insertSiswa($data);
		}
		$res = array("result" => $check); echo json_encode($res);
	}

	function checkKtp(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->moPengg->checkKtp($data['id']);
		$res = array( 'res' => $check);
		echo json_encode($res);
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
	function checkIdAnggotaSiswa(){
		$check = $this->moPengg->checkIdAnggotaSiswa();
		$res = array( 'res' => $check);
		echo json_encode($res);
	}

}
?>