<?php
class M_login extends CI_Model {
    /*Check Login*/
   	function validate($username, $password)
	{
		$this->db->where('status',1);
		$this->db->where('password', $password);
		$this->db->where('username', $username);
		$query = $this->db->get('login');
		return $query->result();	
	} 
	/*Get Session values */ 
	function get_id($username, $password)
	{ 
		$this->db->where('password', $password);
		$this->db->where('username', $username);	
		return $this->db->get('login')->result(); 		
	}


		
}