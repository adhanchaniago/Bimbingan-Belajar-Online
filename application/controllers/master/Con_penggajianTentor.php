<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_penggajianTentor extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); cek_login();
		$this->load->model('master/Mo_penggajianTentor','mod'); 
	}
	function index(){
		$data['title'] = "Data Penggajian Tentor";
		$data['session']= session();
		$this->template->load('_template', 'pengguna/_datapenggajianTentor', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->mod->getDatapenggajianTentor($data); echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->mod->getpenggajianTentor($data['id']); echo json_encode($res);
	}
	function InsertDetailBayar(){
		$data = json_decode(file_get_contents('php://input'), true);
		$noPeng = generateKodeForm('NP', 'tambah');

		if ($data['metode']=='TF') 
			{ $rek = $data['noRek'];} 
		else { $rek = '-'; }

		$data = array(
		'idUnixs' => uniqid(),
		'noPenggajian' => $noPeng,
		'kodeKursus_detailKursus' => $data["kodeKursus"],
		'idTentor_detailKursus' => $data['idTentor'],
		'idSiswa_detailKursus' => $data['idSiswa'],
		'idBidang_detailKursus' => $data['idBidangStudi'],
		'metodeBayar' 	=> $data['metode'],
		'noRek' => $rek,
		'jumlahGaji' 	=> $data['jumlahGaji'],
		'jumlahBonus' 	=> $data['jumlahBonus'],
		'noTentor' => $data['NoTentor'],
		);
		$res = $this->mod->insertDetailPenggajianTentor($data); echo $res;
	}
}
?>