<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	function get_valid($username, $password, $role){

		$query = "SELECT app_users.userId as userid, app_users.username, app_users.`password`, app_users.tb_pengguna_penggunaid, tb_role.roleId, tb_pengguna.penggunaId, tb_pengguna.tb_role_roleId, tb_pengguna.app_rate_idapp_rate, tb_pengguna.tb_kategori_kategoriId as kategoriId, tb_pengguna.namaDepan, tb_pengguna.namaBelakang, tb_pengguna.alamat, tb_pengguna.tempatTinggal, tb_pengguna.tempatLahir, tb_pengguna.tglLahir, tb_pengguna.umur, tb_pengguna.email, tb_pengguna.noWa, tb_pengguna.foto, tb_pengguna.pendidikanTerakir, tb_pengguna.pengalamanMengjar, tb_pengguna.guruMapel, tb_role.nama as role, tb_kategori.kategoriName FROM app_users, tb_role, tb_pengguna, tb_kategori
			WHERE app_users.username = '$username' AND app_users.`password` = '$password' AND app_users.tb_pengguna_penggunaid = tb_pengguna.penggunaId AND tb_pengguna.tb_role_roleId = '$role' AND tb_pengguna.tb_kategori_kategoriId=tb_kategori.kategoriId and tb_pengguna.tb_kategori_kategoriId = 3 GROUP BY app_users.username";
		$data = $this->db->query($query);return $data;
	}
	function get_id($username, $password, $role){
		$query = "SELECT app_users.userId as userid, app_users.username, app_users.`password`, app_users.tb_pengguna_penggunaid, tb_role.roleId, tb_pengguna.penggunaId, tb_pengguna.tb_role_roleId, tb_pengguna.app_rate_idapp_rate, tb_pengguna.tb_kategori_kategoriId as kategoriId, tb_pengguna.namaDepan, tb_pengguna.namaBelakang, tb_pengguna.alamat, tb_pengguna.tempatTinggal, tb_pengguna.tempatLahir, tb_pengguna.tglLahir, tb_pengguna.umur, tb_pengguna.email, tb_pengguna.noWa, tb_pengguna.foto, tb_pengguna.pendidikanTerakir, tb_pengguna.pengalamanMengjar, tb_pengguna.guruMapel, tb_role.nama as role, tb_kategori.kategoriName FROM app_users, tb_role, tb_pengguna, tb_kategori
			WHERE app_users.username = '$username' AND app_users.`password` = '$password' AND app_users.tb_pengguna_penggunaid = tb_pengguna.penggunaId AND tb_pengguna.tb_role_roleId = '$role' AND tb_pengguna.tb_kategori_kategoriId=tb_kategori.kategoriId and tb_pengguna.tb_kategori_kategoriId = 3 GROUP BY app_users.username";
		$data = $this->db->query($query); return $data;
	}
	function get_admin(){
		$query = "SELECT * from tb_role WHERE nama='admin' ";
		$data = $this->db->query($query); return $data;
	}
	
}
/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */