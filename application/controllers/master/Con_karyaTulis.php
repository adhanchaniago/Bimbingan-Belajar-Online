<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_karyaTulis extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); cek_login();
		$this->load->model('master/Mo_abouts','mod'); 
	}
	function index(){
		$data['title'] = "Setup Abouts Data";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['session']= session();
		$this->template->load('_template', 'pengguna/_datakaryaTulis', $data);
	}

}