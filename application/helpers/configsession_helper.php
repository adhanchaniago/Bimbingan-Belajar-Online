<?php 
function session(){
    $CI   = get_instance(); 
	$result = array(
		'userid' 		=> $CI->session->userdata('userid'),
		'penggunaId' 	=> $CI->session->userdata('penggunaId'),
		'namaDepan' 	=> $CI->session->userdata('namaDepan'),
		'namaBelakang' 	=> $CI->session->userdata('namaBelakang'),
		'alamat' 		=> $CI->session->userdata('alamat'),
		'tempatTinggal' => $CI->session->userdata('tempatTinggal'),
		'tempatLahir' 	=> $CI->session->userdata('tempatLahir'),
		'tglLahir' 		=> $CI->session->userdata('tglLahir'),
		'umur' 			=> $CI->session->userdata('umur'),
		'email' 		=> $CI->session->userdata('email'),
		'noWa' 			=> $CI->session->userdata('noWa'),
		'foto' 			=> $CI->session->userdata('foto'),
		'roleId' 		=> $CI->session->userdata('roleId'),
		'kategoriId' 	=> $CI->session->userdata('kategoriId'),
		'kategoriName' 	=> $CI->session->userdata('kategoriName'),
		'role' 			=> $CI->session->userdata('role'),
		'is_logged_in' 	=> $CI->session->userdata('is_logged_in'));
	return $result;
}