<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Con_dataUsersLogin extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('login','configsession')); cek_login();
		$this->load->model('master/Mo_dataUserLogin', 'moddul');
	}
	function index(){
		$data['title'] = "Data User Login Aplikasi";
		// print session = $session['sessionName']; sessionname in configsession_helper file.
		
		   // modal tambah data
		$data['title_modal'] = "Tambah data User";
		$data['modal_tambah_data'] = show_my_modal('modals/modal_tambah_user', 'tambah-User', $data);
        // end------
		
		$data['recordUpdate'] 	= $this->moddul->getAll();

		$data['session']= session();
		$this->template->load('_template', 'pengguna/_dataUserLogin', $data);
	}
	function getData(){
		$data = array('start' => $_POST['start'],
			'length' => $_POST['length'],
			'filtervalue' => $_POST['filtervalue'],
			'filtertext' => $_POST['filtertext']);
		$res = $this->moddul->getDataUserLogin($data); echo json_encode($res);
	}
	function getDataSelect(){ 
		$res = $this->moddul->getUserLogin($_POST['id']);
		echo json_encode($res);
	}

	function getDataSelectForAddFoto(){
		$res = $this->moddul->getUserLogin($_POST['id']);
		echo json_encode($res);
	}

	function filterUserPengguna(){
		$res = $this->moddul->getFilterUserPengguna($_GET['q']); echo json_encode($res);
	}

	function save(){
		$data = json_decode(file_get_contents('php://input'), true);
		$check = $this->moddul->checkId($data['userid']);
		if($check == "OK"){

			$config['upload_path']='./images/';
			$config['allowed_types']='jpg|png';
			$this->load->library('upload',$config);
			$this->upload->do_upload();
			$data=  $this->upload->data();
			$this->moddul->updateImg($data['userfile']);
            // redirect('admin/product');

			$this->moddul->insert($data);
		}
		$res = array("result" => $check); echo json_encode($res);
	}
	function update(){
		$data = json_decode(file_get_contents('php://input'), true);
		$res = $this->moddul->update($data); echo $res;
	}
	function delete(){
		$data = json_decode(file_get_contents('php://input'), true);
		$data = array( 'userid' => $data['id']);
		$res = $this->moddul->delete($data); echo $res;
	}
 
}
?>