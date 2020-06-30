<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/images/logo-light-icon3.PNG">
	<?php $uri = $this->uri->segment(2); ?>
	<title><?php 
	if ($uri == "Con_carier") {
		echo "Carier - Siapkan diri anda untuk bergabung menjadi bagian dari bilikilmu.com";
	} else if($uri == "Con_regAnggSiswa"){
		echo "Pendaftaran - Selamat datang di form pendaftaran sebagai siswa bilikilmu.com";
	} else if($uri == "Con_regKursus"){
		echo "Registrasi Kursus Siswa - Silahkan melakukan pendaftaran Kursus sesuai bidang Kursus yang di inginkan!";
	} else{
		echo "Web Administrator";
	}
	?></title>
	<!-- jquery -->
	<script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery-1.9.1.min.js"></script> 
	<!-- knockout -->
	<script src="<?php echo base_url() ?>assets/knockout/knockout-3.1.0.js"></script>
	<script src="<?php echo base_url() ?>assets/knockout/knockout.mapping-latest.js"></script>
	<script src="<?php echo base_url() ?>assets/knockout/knockout-file-bindings.js"></script>
	<link href="<?php echo base_url() ?>assets/knockout/knockout-file-bindings.css">
	<!-- Bootstrap Core CSS -->
	<link href="<?= base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- morris CSS -->
	<link href="<?= base_url(); ?>assets/plugins/morrisjs/morris.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/css/_custom.css" rel="stylesheet">
	<!-- You can change the theme colors from here -->
	<link href="<?= base_url(); ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/plugins/icheck/skins/all.css" rel="stylesheet">
	<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script> 
	<!-- form select -->
	<link href="<?= base_url(); ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
	<script src="<?= base_url(); ?>assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/multiselect/js/jquery.multi-select.js"></script>
	<!-- alert -->
	<link href="<?= base_url(); ?>assets/alert/sweetalert.css" rel="stylesheet" type="text/css">
	<script src="<?= base_url(); ?>assets/alert/sweetalert.min.js"></script>
	
	<!-- switch -->
	<!-- <script src="<?= base_url(); ?>assets/plugins/bootstrap-switch/bootstrap-switch.min.css"></script> -->

	<!-- token input -->
	<link href="<?= base_url(); ?>assets/css/token-input.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/css/token-input-facebook.css" rel="stylesheet">
	<script src="<?= base_url(); ?>assets/js/jquery.tokeninput.js"></script>
	<script src="<?= base_url(); ?>assets/js/moment.min.js"></script>

	<!-- croppie => croping images -->
	<link href="<?= base_url(); ?>assets/css/croppie.css" rel="stylesheet" >
	<script src="<?= base_url(); ?>assets/js/croppie.js" type="text/javascript"></script>

	<!-- popper --> 
	<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>

	<!-- notify -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/notify.css">
	<script src="<?= base_url(); ?>assets/js/notify.js"></script>
	
	<script>
		var model = {
			Processing: ko.observable(true),
			CheckId: ko.observable(false),
		}
	</script>
</head>
<body class="fix-header fix-sidebar card-no-border logo-left">
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader" data-bind='visible: model.Processing()==true' > 
		<div class="loading" >
			<img src="<?= base_url();?>assets/gif/loadings.gif" width="80">
			<p>Harap tunggu..!</p>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->


	<script>
		model.Resource = {


			/* HARI */
			Hari:[
			{ name: '-', value: '-'},
			{ name: 'Senin', value: 'Senin'},
			{ name: 'Selasa', value: 'Selasa'},
			{ name: 'Rabu', value: 'Rabu'},
			{ name: 'Kamis', value: 'Kamis'},
			{ name: 'Jumat', value: 'Jumat'},
			{ name: "Sabtu", value: 'Sabtu'},
			{ name: "Minggu", value: 'Minggu'}
			],

			/* WAKTU / JAM */
			Jam:[
			{ name: '-', value: '-'},
			{ name: '04:00', value: '04:00'},
			{ name: '04:15', value: '04:15'},
			{ name: '04:30', value: '04:30'},
			{ name: '04:45', value: '04:45'},

			{ name: '05:00', value: '05:00'},
			{ name: '05:15', value: '05:15'},
			{ name: '05:30', value: '05:30'},
			{ name: '05:45', value: '05:45'},

			{ name: '06:00', value: '06:00'},
			{ name: '06:15', value: '06:15'},
			{ name: '06:30', value: '06:30'},
			{ name: '06:45', value: '06:45'},

			{ name: '07:00', value: '07:00'},
			{ name: '07:15', value: '07:15'},
			{ name: '07:30', value: '07:30'},
			{ name: '07:45', value: '07:45'},

			{ name: '08:00', value: '08:00'},
			{ name: '08:15', value: '08:15'},
			{ name: '08:30', value: '08:30'},
			{ name: '08:45', value: '08:45'},

			{ name: '09:00', value: '09:00'},
			{ name: '09:15', value: '09:15'},
			{ name: '09:30', value: '09:30'},
			{ name: '09:45', value: '09:45'},

			{ name: '10:00', value: '10:00'},
			{ name: '10:15', value: '10:15'},
			{ name: '10:30', value: '10:30'},
			{ name: '10:45', value: '10:45'},

			{ name: '11:00', value: '11:00'},
			{ name: '11:15', value: '11:15'},
			{ name: '11:30', value: '11:30'},
			{ name: '11:45', value: '11:45'},

			{ name: '12:00', value: '12:00'},
			{ name: '12:15', value: '12:15'},
			{ name: '12:30', value: '12:30'},
			{ name: '12:45', value: '12:45'},

			{ name: '13:00', value: '13:00'},
			{ name: '13:15', value: '13:15'},
			{ name: '13:30', value: '13:30'},
			{ name: '13:45', value: '13:45'},

			{ name: '14:00', value: '14:00'},
			{ name: '14:15', value: '14:15'},
			{ name: '14:30', value: '14:30'},
			{ name: '14:45', value: '14:45'},

			{ name: '15:00', value: '15:00'},
			{ name: '15:15', value: '15:15'},
			{ name: '15:30', value: '15:30'},
			{ name: '15:45', value: '15:45'},

			{ name: '16:00', value: '16:00'},
			{ name: '16:15', value: '16:15'},
			{ name: '16:30', value: '16:30'},
			{ name: '16:45', value: '16:45'},

			{ name: '17:00', value: '17:00'},
			{ name: '17:15', value: '17:15'},
			{ name: '17:30', value: '17:30'},
			{ name: '17:45', value: '17:45'},

			{ name: '18:00', value: '18:00'},
			{ name: '18:15', value: '18:15'},
			{ name: '18:30', value: '18:30'},
			{ name: '18:45', value: '18:45'},

			{ name: '19:00', value: '19:00'},
			{ name: '19:15', value: '19:15'},
			{ name: '19:30', value: '19:30'},
			{ name: '19:45', value: '19:45'},

			{ name: '20:00', value: '20:00'},
			{ name: '20:15', value: '20:15'},
			{ name: '20:30', value: '20:30'},
			{ name: '20:45', value: '20:45'},

			{ name: '21:00', value: '21:00'},
			{ name: '21:15', value: '21:15'},
			{ name: '21:30', value: '21:30'},
			{ name: '21:45', value: '21:45'}
			],


			/* NAMA BANK + KODE BANK */
			selectBank:[
			{name : 'Pilih bank!', value: '-'},
			{name : 'BANK BRI', value: 'BANK BRI (002)'},
			{name : 'BANK BCA', value: 'BANK BCA (014)'},
			{name : 'BANK MANDIRI', value: 'BANK MANDIRI (008)'},
			{name : 'BANK BNI', value: 'BANK BNI (009)'},
			{name : 'BANK BNI SYARIAH', value: 'BANK BNI (427)'},
			{name : 'BANK SYARIAH MANDIRI (BSM)', value: 'BANK SYARIAH MANDIRI (451)'},
			{name : 'BANK CIMB NIAGA', value: 'BANK CIMB (022)'},
			{name : 'BANK CIMB NIAGA SYARIAH', value: 'BANK CIMB SYARIAH (022)'},
			{name : 'BANK MUAMALAT', value: 'BANK MUAMALAT (147)'},
			{name : 'BANK BTPN', value: 'BANK BTPN (213)'},
			{name : 'BANK BTPN SYARIAH', value: 'BANK BTPN SYARIAH (547)'},
			{name : 'JENIUS', value: 'JENIUS (213)'},
			{name : 'BANK BRI SYARIAH', value: 'BANK BRI SYARIAH (422)'},
			{name : 'BANK BTN', value: 'BANK BTN (200)'},
			{name : 'BANK PERMATA', value: 'BANK PERMATA (013)'},
			{name : 'BANK DANAMON', value: 'BANK DANAMON (011)'},
			{name : 'BANK BII MAYBANK', value: 'BANK BII MAYBANK (016)'},
			{name : 'BANK MEGA', value: 'BANK MEGA (426)'},
			{name : 'BANK SINARMAS', value: 'BANK SINARMAS (153)'},
			{name : 'BANK COMMONWEALTH', value: 'BANK COMMONWEALTH (950)'},
			{name : 'BANK OCBC NISP', value: 'BANK OCBC (028)'},
			{name : 'BANK BUKOPIN', value: 'BANK BUKOPIN (441)'},
			{name : 'BANK BUKOPIN SYARIAH', value: 'BANK BUKOPIN SYARIAH (521)'},
			{name : 'BANK BCA SYARIAH', value: 'BANK BCA SYARIAH (536)'},
			{name : 'BANK LIPPO', value: 'BANK LIPPO (026)'},
			{name : 'CITIBANK', value: 'CITIBANK (031)'},
			{name : 'INDOSAT DOMPETKU', value: 'INDOSAT DOMPETKU (789)'},
			{name : 'TELKOMSEL TCASH', value: 'TELKOMSEL TCASH (911)'},
			{name : 'LINKAJA', value: 'LINKAJA (911)'}
			],
		}

	</script>