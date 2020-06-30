<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_transaksiSiswa extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); cek_login();
		$this->load->model('master/Mo_transaksiSiswa','mod'); 
	}
	function index(){
		$data['title'] = "Data Transaksi Siswa";
		$data['session']= session();
		$this->template->load('_template', 'pengguna/_dataTransaksiSiswa', $data);
	}
	function getData(){
		$data = array( 'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->mod->getDataTransaksiSiswa($data); echo json_encode($res);
	}
	function getDataSelect(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->mod->getTransaksiSiswa($data['id']); echo json_encode($res);
	}
	function InsertDetailBayar(){
		$data = json_decode(file_get_contents('php://input'), true);
		$noPem = generateKodeForm('NT', 'tambah');

		$data = array(
		'idUnixs' => uniqid(),
		'noPembayaran' => $noPem,
		'kodeKursus_app_kursus' 	=> $data['idapp_kursus'], 
		'jumlahBayar' 	=> $data['jumlahBayar'], 
		'metodebayar' 	=> $data['metode'], 
		'noRek' 	=> $data['noRek'],
		'namaSiswa' 	=> $data['Siswa']
		);
		$res = $this->mod->insertDetailTransaksiSiswa($data); echo $res;
	}
}
?>