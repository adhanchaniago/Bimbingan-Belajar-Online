<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_transaksiPembelian extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); 
		$this->load->model('transaksi/LogistikTransModel');
		$this->config->load('confcompany');
		cek_login();
	}
	function index(){
		$data['title'] = "Pembelian";
	   // print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$data['Tab'] = array('Form', 'List');
		$data['pembayaran'] = $this->LogistikTransModel->getPembayaranAll();
		// $data['namaperusahaan'] = $this->config->item('NameCompany');
		$this->template->load('_template', 'Logistik/Transaksi/_transPembelian', $data);
	}
	function filterSuplier(){
		$res = $this->LogistikTransModel->getFilterSuplier($_GET['q']);
		echo json_encode($res);
	}
	function filterBarang(){
		$res = $this->LogistikTransModel->getFilterBarang($_GET['q']);
		echo json_encode($res);
	}

	/* for data filter berdasarkan kodeDetailKursus  di detailKursus */
	function filterJadwal(){
		$res = $this->LogistikTransModel->getFilterKodeDetailKursus($_GET['q']);
		echo json_encode($res);
	}
	function filterHarga(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->LogistikTransModel->getFilterHarga($data['kodebarang']);
		echo json_encode($res);
	}

	function filterTentor(){
		$res = $this->LogistikTransModel->getFilterTentor($_GET['q']);
		echo json_encode($res);
	}


	function getData(){
		$data = array(
			'start' => $_POST['start'],
			'length' => $_POST['length'],
			// 'filtervalue' => $_POST['filtervalue'],
			// 'filtertext' => $_POST['filtertext'],
		);
		$res = $this->LogistikTransModel->getDataPembelian($data);
		echo json_encode($res);
	}

	/* GET DATA DETAIL KURSUS */
	function getDataKursus(){
		$data = array(
			'start' => $_POST['start'],
			'length' => $_POST['length'],
			// 'filtervalue' => $_POST['filtervalue'],
			// 'filtertext' => $_POST['filtertext'],
		);
		$res = $this->LogistikTransModel->getDataDetailKursus($data);
		echo json_encode($res);
	}

	/* GET DATA JADWAL KURSUS */
	function getDataJadwalKursus(){
		$data = array(
			'start' => $_POST['start'],
			'length' => $_POST['length'],
			// 'filtervalue' => $_POST['filtervalue'],
			// 'filtertext' => $_POST['filtertext'],
		);
		$res = $this->LogistikTransModel->getDataJadwalKursus($data);
		echo json_encode($res);
	}

	function selectKategori(){
		$data = array(
			'start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext'],
		);
		$res = $this->LogistikTransModel->getKategori($data);
		echo json_encode($res);
	}


	function getDataSelect(){
		$res = $this->LogistikTransModel->getPembelian($_POST['id']);
		echo json_encode($res);
	}
	function getDataDetilPembelian(){
		$res = $this->LogistikTransModel->getDetilPembelian($_POST['id']);
		echo json_encode($res);
	}


	/* from data select detailKursus*/
	function getDataSelectKursus(){
		$res = $this->LogistikTransModel->getDetailKursus($_POST['id']);
		echo json_encode($res);
	}


	function getDataDetilJadwal(){
		$res = $this->LogistikTransModel->getDetailJadwalKursus($_POST['id']);
		echo json_encode($res);
	}


	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$nobl = generateKodeForm('BL', 'tambah');
		$datapembelian = array(
			'KODEPEMBELIAN' => $nobl, 
			'IDSUPPLIER' => $data['IDSUPPLIER'],
			'IDJENISPEMBAYARAN' => $data['IDJENISPEMBAYARAN'],
			'DESKRIPSI_PEMBELIAN' => $data['DESKRIPSI_PEMBELIAN'],
			'STATUS_PEMBELIAN' => 'Diajukan',
			'TOTAL_PEMBELIAN' => $data['TOTAL_PEMBELIAN'],
		);
		$listbarang = json_decode($data['LISTBARANG'], true);
		$res = $this->LogistikTransModel->insertPembelian($datapembelian);
		foreach ($listbarang as $v){
			if ($v['JUMLAHPEMBELIAN']!=0 && $v['KODEBARANG']!=''){
				$datalistbarang = array(
					'KODEDETAILPEMBELIAN'=>uniqid(),
					'KODEPEMBELIAN'=>$nobl,
					'KODEBARANG'=>$v["KODEBARANG"],
					'HARGABELI'=>$v["HARGABELI"],
					'JUMLAHPEMBELIAN'=>$v["JUMLAHPEMBELIAN"],
					'TOTALPEMBELIAN'=>$v["TOTALPEMBELIAN"],
					'PPN'=>$v["PPN"],
				);
				$datastok = array(
					'KODEBARANG'=>$v["KODEBARANG"],
					'SALDOSEBELUM'=>0,
					'SALDOSESUDAH'=>0,
				);
				$this->LogistikTransModel->insertDetailPembelian($datalistbarang);
				$cekstok = $this->LogistikTransModel->getFilterStok($v["KODEBARANG"]);
				if ($cekstok){
					$datastok["SALDOSESUDAH"] = $cekstok[0]->SALDOSESUDAH + $v["JUMLAHPEMBELIAN"];
					$datastok["SALDOSEBELUM"] = $cekstok[0]->SALDOSESUDAH;
					$this->LogistikTransModel->updateStok($datastok);
				} else {
					$datastok["SALDOSESUDAH"] = $v["JUMLAHPEMBELIAN"];
					$this->LogistikTransModel->insertStok($datastok);
				}
			}
		}
		echo json_encode(array("res"=>"Berhasil", "KODE"=> $nobl));
	}


	function saveJadwalKursus(){
		$data = json_decode(file_get_contents('php://input'), true);
		$no = generateKodeForm('DK', 'tambah');
		$dataDetailKursus = array(
			'kodeDetailKursus' => $no,
			'statusKursus' => 'Aktif',
			'kodeKursus' => $data['kodeKursus'],
			'idBidangStudi' => $data['idBidangStudi'],
		);
		$listData = json_decode($data['LISTMANYDATA'], true);
		$res = $this->LogistikTransModel->updateDetailKursus($dataDetailKursus);
		// if (is_array($listData) || is_object($listData)){

		foreach ($listData as $v){
			if ($v['hari']!='' && $v['jam']!=''){
				$datalistData = array(
					// 'KODEDETAILPEMBELIAN'=>uniqid(),
					// 'KODEPEMBELIAN'=>$nobl,
					// 'KODEBARANG'=>$v["KODEBARANG"],
					// 'HARGABELI'=>$v["HARGABELI"],
					// 'JUMLAHPEMBELIAN'=>$v["JUMLAHPEMBELIAN"],
					// 'TOTALPEMBELIAN'=>$v["TOTALPEMBELIAN"],
					// 'PPN'=>$v["PPN"],

					'idUnix' => uniqid(),
					'kodeDetailKursus_detailKursus' => $no,
					'kodeKursus' => $v['kodeKursus'],
					'idBidangStudi_bidangStudi' => $v['idBidangStudi'],
					'idTentor_detailKursus' => $v['idTentor'],
					'idSiswa_appKursus' => $v['idSiswa'],
					'hari' => $v['hari'],
					'jam' => $v['jam'],
				);
				// $datastok = array(
				// 	'KODEBARANG'=>$v["KODEBARANG"],
				// 	'SALDOSEBELUM'=>0,
				// 	'SALDOSESUDAH'=>0,
				// );
				$this->LogistikTransModel->insertDetailJadwal($datalistData);
				// $cekstok = $this->LogistikTransModel->getFilterStok($v["KODEBARANG"]);
				// if ($cekstok){
				// 	$datastok["SALDOSESUDAH"] = $cekstok[0]->SALDOSESUDAH + $v["JUMLAHPEMBELIAN"];
				// 	$datastok["SALDOSEBELUM"] = $cekstok[0]->SALDOSESUDAH;
				// 	$this->LogistikTransModel->updateStok($datastok);
				// } else {
				// 	$datastok["SALDOSESUDAH"] = $v["JUMLAHPEMBELIAN"];
				// 	$this->LogistikTransModel->insertStok($datastok);
				// }
			}
		}
		// }
		echo json_encode(array("res"=>"Berhasil", "KODE"=> $no));
	}

	function update(){
		$data = array(
			'KODEBARANG' => $_POST['KODEBARANG'],
			'NAMABARANG' => $_POST['NAMABARANG'], 
			'KODEKATEGORI' => $_POST['KODEKATEGORI'],
			'IDMERK' => $_POST['IDMERK'],
			'UKURAN' => $_POST['UKURAN'], 
			'IDSATUAN' => $_POST['IDSATUAN'],
		);
		$res = $this->LogistikTransModel->updateBarang($data);
		echo $res;
	}
	function delete(){
		$data = array(
			'KODEBARANG' => $_POST['id'],
		);
		$res = $this->LogistikTransModel->deleteBarang($data);
		echo $res;
	}

}
?>