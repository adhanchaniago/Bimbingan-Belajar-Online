<?php
	// MSG
function show_msg($content='', $type='success', $icon='fa-info-circle', $size='14px') {
	if ($content != '') {
		return  '<p class="box-msg">
		<div class="info-box alert-' .$type .'">
		<div class="info-box-icon">
		<i class="fa ' .$icon .'"></i>
		</div>
		<div class="info-box-content" style="font-size:' .$size .'">
		' .$content
		.'</div>
		</div>
		</p>';
	}
}

function show_succ_msg($content='', $size='14px') {
	if ($content != '') {
		return   '<p class="box-msg">
		<div class="info-box alert-success">
		<div class="info-box-icon">
		<i class="fa fa-check-circle"></i>
		</div>
		<div class="info-box-content" style="font-size:' .$size .'">
		' .$content
		.'</div>
		</div>
		</p>';
	}
}

function show_err_msg($content='', $size='14px') {
	if ($content != '') {
		return   '<p class="box-msg">
		<div class="info-box alert-error">
		<div class="info-box-icon">
		<i class="fa fa-warning"></i>
		</div>
		<div class="info-box-content" style="font-size:' .$size .'">
		' .$content
		.'</div>
		</div>
		</p>';
	}
}

	// MODAL
function show_my_modal($content='', $id='', $data='', $size='lg') {
	$_ci = &get_instance();

	if ($content != '') {
		$view_content = $_ci->load->view($content, $data, TRUE);

		return '<div class="modal fade" id="' .$id .'" role="dialog">
		<div class="modal-dialog modal-' .$size .'" role="document">
		<div class="modal-content">
		' .$view_content .'
		</div>
		</div>
		</div>';
	}
}

function show_my_confirm($id='', $class='', $title='Konfirmasi', $yes = 'Ya', $no = 'Tidak') {
	$_ci = &get_instance();
	if ($id != '') {
		echo   '<div class="modal fade" id="' .$id .'" role="dialog">
		<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
		<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
		<h3 style="display:block; text-align:center;">' .$title .'</h3>

		<div class="col-md-6">
		<button class="form-control btn btn-primary ' .$class .'"> <i class="glyphicon glyphicon-ok-sign"></i> ' .$yes .'</button>
		</div>
		<div class="col-md-6">
		<button class="form-control btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> ' .$no .'</button>
		</div>
		</div>
		</div>
		</div>
		</div>';
	}
}
function delZero($s) {
	$c = array ('62');
	$d = array ('0');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang disebutkany $d
        $s = strtolower(str_replace($c, '', $s)); // Ganti spasi =>  - dan ubah huruf => kecil semua
        return $s;
    }
    function delBSlash($s) {
        $c = '/';
        $d = "\/";
        $s = str_replace($d, '/', $s); // Hilangkan simbol yang disebutkany $d
        $s = strtolower(str_replace($c, '/', $s)); // Ganti spasi =>  ''
        return $s;
    }

    function hapusKarakter($s) {
    	$c = array ('RP','rp','Rp',',','.','-',',00');
    	$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang disebutkany $d
        $s = strtolower(str_replace($c, '', $s)); // Ganti spasi =>  - dan ubah huruf => kecil semua
        return $s;
    }

    function penyebut($nilai) {
    	$nilai = abs($nilai);
    	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    	$temp = "";
    	if ($nilai < 12) {
    		$temp = " ". $huruf[$nilai];
    	} else if ($nilai <20) {
    		$temp = penyebut($nilai - 10). " belas";
    	} else if ($nilai < 100) {
    		$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    	} else if ($nilai < 200) {
    		$temp = " seratus" . penyebut($nilai - 100);
    	} else if ($nilai < 1000) {
    		$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    	} else if ($nilai < 2000) {
    		$temp = " seribu" . penyebut($nilai - 1000);
    	} else if ($nilai < 1000000) {
    		$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    	} else if ($nilai < 1000000000) {
    		$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    	} else if ($nilai < 1000000000000) {
    		$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    	} else if ($nilai < 1000000000000000) {
    		$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    	}     
    	return $temp;
    }

    function terbilang($nilai) {
    	if($nilai<0) {
    		$hasil = "minus ". trim(penyebut($nilai));
    	} else {
    		$hasil = trim(penyebut($nilai));
    	}     
    	$hasil = ucfirst($hasil);		
    	return '# '.$hasil.' ribu rupiah #';
    }

    function toRupiah($angka){
    	$hasil_rupiah = "Rp " . number_format($angka,'0',',','.'); return $hasil_rupiah;
    }

    function generateKodeForm($kode, $status){
    	$CI = get_instance();
    	$CI->load->model('HelperModel');
    	$res = $CI->HelperModel->getDataUrut($kode);
    	$reskode = '';
    	if($status == 'get'){
    		$reskode = generateId($res[0]->noUrut,$kode);
    	} else {
    		$CI->HelperModel->updateDataUrut($kode, $res[0]->noUrut);
    		$reskode = generateId(($res[0]->noUrut+1),$kode);
    	}
    	return $reskode;
    }

    function generateId($kode,$namaForm){

    	$id = substr($kode,0,3);
    	$nmForm = strtoupper(substr($namaForm, 0,2));

    	$tahun = date("y");
    	$bulan = date("m");
	// ate("h:i:sa")
	// $detik = substr(date("sa"),0,2)+1;


    	$jumlah = substr($kode,0,6);
	// print_r($jumlah);die();

    	$hasil = $jumlah;
	// print_r($hasil);die();

    	$pk_n = strlen($hasil);
    	if($pk_n == 1){

    		$jumlah = "00000".$hasil;

    	}else if($pk_n == 2){

    		$jumlah = "0000".$hasil;

    	}else if($pk_n == 3){

    		$jumlah = "000".$hasil;

    	}else if($pk_n == 4){

    		$jumlah = "00".$hasil;

    	}else if($pk_n == 5){

    		$jumlah = "0".$hasil;
    		
    	}else if($pk_n == 6){

    		$jumlah = $hasil;

    	} else{

    		$jumlah = "Data Error";

    	}
    	return $data = $nmForm.''.$tahun.''.$jumlah;

    }
    function generateAI($number){

    	$id = substr($number,0,3);
	// $nmForm = strtoupper(substr($namaForm, 0,2));
    	
	// print_r($id);die();

    	$tahun = date("Y");
	// ate("h:i:sa")
    	$detik = substr(date("sa"),0,2)+1;

    	$jumlah = substr($number,0,6);
	// print_r($jumlah);die();

    	$hasil = $jumlah;
	// print_r($hasil);die();

    	$pk_n = strlen($hasil);
	// print_r($pk_n);die();
    	if($pk_n == 1){

    		$jumlah = "00000".$hasil;
		// print_r($jumlah);die();

    	}else if($pk_n == 2){

    		$jumlah = "0000".$hasil;

    	}else if($pk_n == 3){

    		$jumlah = "000".$hasil;

    	}else if($pk_n == 4){

    		$jumlah = "00".$hasil;

    	}else if($pk_n == 5){

    		$jumlah = "0".$hasil;
    		
    	}else if($pk_n == 6){

    		$jumlah = $hasil;

    	} else{

    		$jumlah = "Data Error";

    	}
    	return $jumlah;

    }

    function splitDate($tanggal){ 
    	$date=date_create();
    	$date=date_format($date,$tanggal);
    	$dateArray = date_parse_from_format('m/d/Y', $date);
    	list($tanggal, $bulan, $tahun) = explode('/', $date);
    	return $tanggal.'-'.$bulan.'-'.$tahun;
    }

    function splitTgl(){ 
    	$date=date_create(); 
    	$date=date_format($date,"d");
	// $dateArray = date_parse_from_format('m/d/Y', $date);
	// list($tanggal, $bulan, $tahun) = explode('/', $date);
	// $hasil = $tanggal;
    	if (list($tanggal) = explode('/', $date)) {
    		return $tanggal;
    	}
    }
    function splitBulan(){ 
    	$date=date_create(); 
    	$date=date_format($date,"m");
    	if (list($tanggal) = explode('/', $date)) {
    		return $tanggal;
    	}
    }
    function splitTahun(){ 
    	$date=date_create(); 
    	$date=date_format($date,"Y");
    	return $date;
    }

    function randomPass($panjang)
    {
    	$karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789!@#$%^&*()_+{}[];:.,/?`~';
    	$string = '';
    	for ($i = 0; $i < $panjang; $i++) {
    		$pos = rand(0, strlen($karakter)-1);
    		$string .= $karakter{$pos};
    	}
    	return $string;
    }

    
    function hp($nohp) {
     // kadang ada penulisan no hp 0811 239 345
    	$nohp = str_replace(" ","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
    	$nohp = str_replace("(","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
    	$nohp = str_replace(")","",$nohp);
     // kadang ada penulisan no hp 0811.239.345
    	$nohp = str_replace(".","",$nohp);

     // cek apakah no hp mengandung karakter + dan 0-9
    	if(!preg_match('/[^+0-9]/',trim($nohp))){
         // cek apakah no hp karakter 1-3 adalah +62
    		if(substr(trim($nohp), 0, 3)=='+62'){
    			$hp = trim($nohp);
    		}
         // cek apakah no hp karakter 1 adalah 0
    		elseif(substr(trim($nohp), 0, 1)=='0'){
    			$hp = ''.substr(trim($nohp), 1);
    		}
    	}
    	return $hp;
    }

    function hp0($nomor){
    	$hp0 = substr_replace($nomor,'0',0,3);
    	return $hp0;
    }


    function seo_title($s) {

    	$c = array (' ');
    	$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;

}

?>