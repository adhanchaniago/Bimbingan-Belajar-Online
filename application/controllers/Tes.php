<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tes extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('login','configsession','my'));
		cek_login();
	}
	function index() {
		$data['session']= session();
		echo "tes data / Uji coba <br/>".$data['session'];
	}

	function multiImgFile() {
		$data['title'] = 'Fungsi Upload Image';
		$this->template->load('_template','_uploadmultiImg', $data);
		// $this->load->view('_uploadImg', $data);
	}
	function imgFile() {
		$data['title'] = 'Fungsi Upload Image';
		$this->template->load('_template','_uploadImg', $data);
		// $this->load->view('_uploadImg', $data);
	}

	function coba(){
		$data['session']= session();
		$data['title'] = 'Data Uji Coba';
		
		$this->template->load('_template','_uploadmultiImg', $data);
	}
	function hapusBackSlash(){
        $url = "http:\/\/tesdata.com\/images";

        echo $url.'<br/>';
        echo 'Hapus Back Slash URL : '.delBSlash($url);
        die();

    }
}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */