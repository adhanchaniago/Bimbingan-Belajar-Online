<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('login','configsession'));
		cek_login();
	}
	public function index() {
		$data['page']  = "home";
		$data['title'] = "Dashboard Administrator ";  
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		// print_r($data['session']);die();
		$this->template->load('_template','dashboard/_home', $data);
	}
	// Notif
	public function notif(){
		$data['title'] = "Halaman notif";
		 // print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_template','Admin/Setting/_notif',$data);
	}

}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */