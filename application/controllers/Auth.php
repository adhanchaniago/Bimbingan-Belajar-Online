<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model(array('M_auth','M_api'));
		$this->load->helper('text');
	}
	public function index()
	{
		$data['title']  = "Halaman login Menu Dinamis dengan user access";
		$data['admin']  = $this->M_auth->get_admin()->row_array();
		// $data['spv'] 	= $this->M_auth->get_spv()->row_array();
		$this->load->view('_login',$data);
	}
	public function validate()
	{ 
		$username =  $this->input->post('username');
		$password =  md5($this->input->post('password'));
		$role  =  $this->input->post('role');
		// cek id yang sama dari table group
		$valid = $this->M_auth->get_valid($username, $password, $role);
		// print_r($valid->num_rows());die();
		if ($valid->num_rows() > 0 ) {
			# if valid
			$get_id = $this->M_auth->get_id($username, $password, $role)->result();
			foreach($get_id as $val)
			{ 
				$data = array( 
					'userid' 		=>	$val->userid,
					'username' 		=>	$val->username,
					'password' 		=>	$val->password,
					'penggunaId' 	=>	$val->penggunaId,
					'namaDepan' 	=>	$val->namaDepan,
					'namaBelakang' 	=>	$val->namaBelakang,
					'alamat' 		=>	$val->alamat,
					'tempatTinggal' =>	$val->tempatTinggal,
					'tempatLahir' 	=>	$val->tempatLahir,
					'tglLahir' 		=>	$val->tglLahir,
					'umur' 			=>	$val->umur,
					'email' 		=>	$val->email,
					'noWa' 			=>	$val->noWa,
					'foto' 			=>	$val->foto,
					'roleId' 		=>	$val->roleId,
					'kategoriId' 	=>	$val->kategoriId,
					'kategoriName' 	=>	$val->kategoriName,
					'role' 			=>	$val->role,
					'is_logged_in' 	=> true
				);
				$tes = $this->session->set_userdata($data); //  Create Session.
				// print_r($data['is_logged_in']);die();
				redirect('Admin');
			}
		} else {
			# if not valid
			$this->session->set_flashdata('msg1', 'Username or Password Incorrect!');
			redirect('Auth');
			// print_r('gagal');die();
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('Auth');
	}

}