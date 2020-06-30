<script>

	model.masterModel = {
		Penjadwalan: 'penjadwalan-kursus',
		Transaksi: 'data-transaksi-siswa',
		Penggajian: 'data-gaji-tentor',
		CreateUsers: 'data-user-login',
		Ri_penggajian: 'riwayat-penggajian-tentor',
		Ri_transaksi: 'data-riwayat-pembayaran',
		Ri_absensi: 'data-riwayat-absensi',
		Ri_kuis: 'data-riwayat-kuis',
		Ri_karyaTulis: 'data-riwayat-karya-tulis',
		pengguna: 'data-pengguna', /* isikan nama / value dari rootingnya  (url dengan uri = 1)*/
		notif: 'Anda Akan Menuju ke Halaman ',
	}
	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
	}
	
	material.transaksi = function () {
		var title = 'Data Transaksi Siswa!';
		if (confirm(material.Recordmaterial.notif()+title) === true) {
			window.location.replace(material.Recordmaterial.Transaksi());
		}
	}


	material.penjadwalan = function () {
		var title = 'Data Penjadwalan Kursus!';
		if (confirm(material.Recordmaterial.notif()+title) === true) {
			window.location.replace(material.Recordmaterial.Penjadwalan());
		}
	}
	material.penggajian = function () {
		var title = 'Data Penggajian Tentor!';
		if (confirm(material.Recordmaterial.notif()+title) === true) {
			window.location.replace(material.Recordmaterial.Penggajian());
		}
	}

	material.userLogin = function () {
		var title = 'Data Pengaktifan Akun Aplikasi Bilikilmu!';
		if (confirm(material.Recordmaterial.notif()+title) === true) {
			window.location.replace(material.Recordmaterial.CreateUsers());
		}
	}
	material.pengguna = function () {
		var title = 'Data Lengkap Pengguna Akun Bilikilmu!';
		if (confirm(material.Recordmaterial.notif()+title) === true) {
			window.location.replace(material.Recordmaterial.pengguna());
		}
	}


	material.riwayatKuis = function () {
		var title = 'Data Riwayat Kuis!';
		if (confirm(material.Recordmaterial.notif()+title) === true) {
			window.location.replace(material.Recordmaterial.Ri_kuis());
		}
	}

	material.riwayatAbsensi = function () {
		var title = 'Data Riwayat Absensi Kursus!';
		if (confirm(material.Recordmaterial.notif()+title) === true) {
			window.location.replace(material.Recordmaterial.Ri_absensi());
		}
	}

	material.riwayatKaryatulis = function () {
		var title = 'Data Riwayat Karya Tulis Tentor!';
		if (confirm(material.Recordmaterial.notif()+title) === true) {
			window.location.replace(material.Recordmaterial.Ri_karyaTulis());
		}
	}


</script>


<!-- ============================================================== -->
<div class="container-fluid">
	<!--  breadcrumb  -->
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-md-6">
			<!-- Bread crumb and right sidebar toggle -->
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?= base_url(); ?>Home">
					Home</a>
				</li>
				<li class="breadcrumb-item active capital">
					<?= $this->uri->segment(1); ?>
				</li>
				<li class="breadcrumb-item active capital">
					<?php $uri_Bcrumb = $this->uri->segment(2);
					$cek = substr($uri_Bcrumb, 0, 2);
					if ($cek == 'C_') {
						echo "data " . substr($uri_Bcrumb, 2, 15) . "";
					} ?>
				</li>
				<!-- <li class="breadcrumb-item active">Table editable</li> -->
			</ol>
		</div>
	</div>
	<div class="row">
		<!-- ============================================================== -->
		<!-- Right sidebar -->
		<!--   -   -->
		<!-- End Right sidebar -->
		<!-- ============================================================== -->
		<div class="col-2 ">
			<?php $this->load->view('template/_sidebar'); ?>
		</div>
		<div class="col-md-10">
			<div class="card card card-body p-b-0 trans" data-bind="with:material">  
				<div class="col-md-5 align-self-left">
					<h3 class="text-themecolor marg-top"><?= $title ?></h3>
				</div>          
				<!-- Nav tabs -->
				<!-- <ul class="nav nav-tabs customtab" id="tabnavform">
					<li class="nav-item"><a class="nav-link " href="#tabform" data-toggle="tab">Form</a></li>
					<li class="nav-item"><a class="nav-link active" href="#tablist" data-toggle="tab">List</a></li>
				</ul> -->
				<!-- End Nav tabs -->
				<div class="row">

					<div class="col-md-6">
						<div class="card card-body marg">
							<div class="row">
								<div class="col-md-4 col-lg-3 text-center">
									<a href="app-contact-detail.html"><img src="<?php echo base_url('assets/images/dashboard/512px-3.png'); ?>" alt="user" class=" img-responsive marg"></a>
								</div>
								<div class="col-md-8 col-lg-9">
									<h2 class="box-title m-b-0">1) Manage Transaksi</h2>
									<button type="button" data-bind="click:transaksi" class="btn btn-xl btn-primary">Proses Transaksi</button>
									<button type="button" data-bind="click:penggajian" class="btn btn-xl btn-info">Mulai Penggajian</button>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="card card-body marg">
							<div class="row">
								<div class="col-md-4 col-lg-3 text-center">
									<a href="app-contact-detail.html"><img src="<?php echo base_url('assets/images/dashboard/512px-2.png'); ?>" alt="user" class=" img-responsive marg"></a>
								</div>
								<div class="col-md-8 col-lg-9">
									<h2 class="box-title m-b-0">2) Manage Pengguna</h2>
									<button type="button" data-bind="click:userLogin" class="btn btn-xl btn-primary">Atur User Login</button>
									<button type="button" data-bind="click:pengguna" class="btn btn-xl btn-info">Data Pengguna App</button>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="card card-body marg">
							<div class="row">
								<div class="col-md-4 col-lg-3 text-center">
									<a href="app-contact-detail.html"><img src="<?php echo base_url('assets/images/dashboard/512px-4.png'); ?>" alt="user" class=" img-responsive marg"></a>
								</div>
								<div class="col-md-8 col-lg-9">
									<h2 class="box-title m-b-0">3) Penjadwalan</h2>
									<button type="button" data-bind="click:penjadwalan" class="btn btn-xl btn-primary">Penjadwalan Siswa</button>
									<button type="button" data-bind="click:riwayatAbsensi" class="btn btn-xl btn-info">Riwayat Absensi</button>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="card card-body marg">
							<div class="row">
								<div class="col-md-4 col-lg-3 text-center">
									<a href="app-contact-detail.html"><img src="<?php echo base_url('assets/images/dashboard/512px-5.png'); ?>" alt="user" class=" img-responsive marg"></a>
								</div>
								<div class="col-md-8 col-lg-9">
									<h2 class="box-title m-b-0">Manage Lomba</h2>
									<button type="button" data-bind="click:riwayatKuis" class="btn btn-xl btn-primary">Riwayat Kuis</button>
									<button type="button" data-bind="click:riwayatKaryatulis" class="btn btn-xl btn-info">Riwayat Karya Tulis</button>
								</div>
							</div>
						</div>
					</div>

				</div>

				<!-- </div>./ end tab-content -->

			</div><!-- ./ end material -->
		</div>
	</div>
</div>
<!-- ==============================================================