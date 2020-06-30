<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';

$route['data-kuis'] = 'master/Con_kuis';

$route['data-pengguna'] = 'master/Con_pengguna';
$route['data-karya-tulis'] = 'master/Con_lombaArtikel';

$route['data-set-icons-for-setkuis'] = 'master/SetIcons';

$route['data-riwayat-perkembangan-siswa'] = 'master/Con_riwayatBelajarSiswa';

$route['data-transaksi-siswa'] = 'master/Con_transaksiSiswa';
$route['data-riwayat-pembayaran'] = 'master/Con_riwayatPembayaran';

// $route['data-kursus'] = 'master/Con_jadwal';
$route['data-pesan-kritik-saran'] = 'master/Con_kritikSaran';
$route['data-update-fitur-tentang-perusahaan'] = 'master/Con_abouts';
$route['data-update-fitur-supports'] = 'master/Con_supports';

$route['data-user-login'] = 'master/Users';

$route['data-riwayat-kursus-by-tuntas'] = 'master/Con_riwayatKursus';

$route['data-setup-judul-kuis'] = 'master/Con_setKuis';

$route['data-riwayat-kuis'] = 'master/Con_Rkuis';

$route['data-riwayat-karya-tulis'] = 'master/Con_RkaryaTulis';
$route['data-bidang-studi'] = 'settings/Con_BidangStudi';
$route['data-riwayat-absensi'] = 'master/Con_riwayatAbsensi';

$route['data-gaji-tentor'] = 'master/Con_penggajianTentor';
$route['riwayat-penggajian-tentor'] = 'master/Con_riwayatPenggajian';
$route['data-indikator-nilai'] = 'settings/Con_indikatorNilai';

$route['penjadwalan-kursus'] = 'settings/Con_JadwalKursus';




/*  rout registrasi */
$route['registrasi-sebagai-siswa-bilik-ilmu'] = 'reg/Con_regAnggSiswa';
$route['registrasi-kursus'] = 'reg/Con_regKursus';

$route['registrasi-sebagai-tentor-bilik-ilmu'] = 'carier/Con_carier';
/* --./rout registrasi */




/* API */
$route['api'] = 'master/Con_api';
$uri = $this->uri->segment(2);
$route['api/(:any)'] = function ($uri)
{
	return 'master/Con_api/'.$uri;
};

// $route['404_override'] = 'Home/index';
$route['translate_uri_dashes'] = TRUE;



/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
