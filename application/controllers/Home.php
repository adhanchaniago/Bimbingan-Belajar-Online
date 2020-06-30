<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	function index() {
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		$data['msg1']= "Page Not Found !";
		$data['msg2']= "YOU SEEM TO BE TRYING TO FIND HIS WAY HOME";
		$this->load->view('errors/_dataErrors404', $data);
	}

}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */