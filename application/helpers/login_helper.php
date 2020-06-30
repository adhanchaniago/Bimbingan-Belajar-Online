<?php


function is_login(){
    $ci = get_instance();
    if(empty($ci->session->userdata('id_users'))){
        redirect('auth');
    }
}


function cek_login()
  {
    $CI = get_instance();
    // print_r($CI->session->userdata('kategoriName'));die();
    if($CI->session->userdata('is_logged_in') == "")
    {
     $CI->session->set_flashdata('msg','Please Login to Continue');
     redirect('Auth');
   }

  }


function ceks_admin()
	{
    $CI     =   & get_instance();
		if($CI->session->userdata('is_logged_in')=='')
        {
           $CI->session->set_flashdata('msg','Please Login to Continue');
           redirect('Auths');
        }
	}
function ceks_manager(){
  $CI     =   & get_instance();
	if($CI->session->userdata('manager_is_logged_in')=='')
        {
            $CI->session->set_flashdata('msg','Please Login to Continue');
            redirect('login');
        }
}
function signupString($s) 
    {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d

        $s = strtolower(str_replace($c, '', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }


?>
