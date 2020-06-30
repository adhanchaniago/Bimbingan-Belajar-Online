<script>
	model.masterModel={
		penggunaId:"",
		namaDepan:"",
		namaBelakang:"",
		noWa:"",
		email:"",

		alamat:"",
		tempatTinggal:"",
		tempatLahir:"",
		tglLahir:"",
		umur:0,

		pendidikanTerakir:"",
		pendidikanSekarang:"",
		nomorKtp:"",
		kategori:"",
		IDKOTA:0,
		NAMAKOTA:"",
		namaDepan:"",
	}
	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		DataFilter: ko.observableArray(['namaDepan']),
		FilterValue: ko.observable('namaDepan'),
	}
	material.idanggotasiswa = function() {
		ajax.open('GET', '<?= site_url('reg/Con_regAnggSiswa/checkIdAnggotaSiswa') ?>', true);
		ajax.onreadystatechange = function(){
			if(this.readyState ===4 && this.status ===200){
				let data = JSON.parse(this.responseText)
				for (var i=0; i<data.length; i++) {
					document.getElementById('result').innerHTML += '<li>'+ data[i].name +'</li>';
				}
			}
		}
		ajax.send();
	}
	// material.saveRegAnggota = function(){
	// 	model.Processing(true);
	// 	var url = "<?php echo base_url('reg/Con_regAnggSiswa/saveRegAnggota') ?>";

	// 	if(material.Mode() === 'Update')
	// 		url = "<?php echo base_url('reg/Con_regAnggSiswa/update') ?>";

	// 	ajaxPost(url, material.Recordmaterial, function (res) {
	// 		if (material.Mode() == "Update"){ 
	// 			material.back(0);
	// 			swal({ title: "Good job!",
	// 				text: "Updated <?= $title ?>!",
	// 				icon: "success",
	// 			}); 
	// 		} else { 
	// 			swal({ title: "Good job!",
	// 				text: "Added new <?= $title ?>!",
	// 				icon: "success",
	// 			});
	// 		}
	// 		model.Processing(false);
	// 	});
	// }
	material.drawKota = function(){
		$("input[name=txtNAMAKOTA]").tokenInput("<?= base_url('reg/Con_regAnggSiswa/filterKota') ?>", {
			zindex: 700,
			allowFreeTagging: false,
			placeholder: 'Ketikkan nama kota!',
			tokenValue: 'NAMAKOTA',
			propertyToSearch: "NAMAKOTA",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.NAMAKOTA(item.NAMAKOTA);
				po.IDKOTA(item.IDKOTA);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.NAMAKOTA("");
				po.IDKOTA("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.NAMAKOTA+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}
	material.simpanDanLanjut_Reg_kursus = function(){
		model.Processing(true);
		noktp = material.Recordmaterial.nomorKtp();

		if (material.Recordmaterial.nomorKtp() !== "" ) {

			var url = "<?php echo base_url('reg/Con_regAnggSiswa/saveRegAnggota') ?>";

			swal({
				title: "Trimakasih telah mendaftar.",
				text: "Gunakan Nomor ktp ini : "+noktp+",  untuk mencari Id pendaftaran anda selanjutnya",
				type: "info",
				showCancelButton: false,
				closeOnConfirm: false,
				showLoaderOnConfirm: true,
			}, function () {
				ajaxPost(url, material.Recordmaterial, function (res) {
					setTimeout(function () {
						swal("Ajax request finished!");
					}, 2000);
					if (showLoaderOnConfirm=true) {
						window.location.href="<?= base_url('registrasi-kursus');?>"; /* Redirect to controller carier/Con_carier.php*/
					}
				});
			});
			model.Processing(false);

		} else {
			swal(
				"Warning..!", 
				"Data Harus Di isi", 
				"warning"
				);
		}
		model.Processing(false);
	}
</script>
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<!-- ============================================================== -->
		<!-- Right sidebar -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- End Right sidebar -->
		<!-- ============================================================== -->
		<div class="col-md-12">
			<div class="card card card-body p-b-0" data-bind="with:material">  
				<div class="col-md-5 align-self-left">
					<h3 class="text-themecolor"><?= $title ?></h3>
				</div>          
				<!-- Nav tabs -->
				<ul class="nav nav-tabs customtab" id="tabnavform">
					<!-- <li class="nav-item"><a class="nav-link active" href="#tabform" data-toggle="tab">Pendaftaran siswa</a></li> -->
					<!-- <li class="nav-item"><a class="nav-link" href="#tabformregisterKursus" data-toggle="tab">Pendaftaran Kursus</a></li> -->
				</ul>
				<!-- End Nav tabs -->
				<div class="content tab-content" id="tabnavform-content">
					<div class="tab-pane active" id="tabform">
						<div class="card-body p-20 animated fadeIn m">

							<div class="row p-t-23 " data-bind="with:Recordmaterial" >

								<div class="col-md-4 margBottom">
									<div class="form-group ">
										<label class="control-label">NIK / NISN</label>
										<input type="number" name="txtnomorKtp" data-bind="value:nomorKtp, checkId: 'reg/Con_regAnggSiswa/checkKtp'"" max="16" id="" required="" class="form-control">
										<div class="form-control-feedback" data-bind="visible: model.CheckId()==true">Nomor ktp sudah ada!</div>
									</div>
								</div>

								<div class="col-md-9 margBottom">
									<div class="input-group">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Nama Depan</label>
										<input type="text" name="txtnamaDepan" data-bind="value:namaDepan" id="" required="" class="form-control">
									</div>
								</div>
								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Nama Belakang</label>
										<input type="text" name="txtnamaBelakang" data-bind="value:namaBelakang" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Alamat Rumah</label>
										<input type="text" name="txtalamat" data-bind="value:alamat" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Alamat Tempat Tinggal</label>
										<input type="text" name="txttempatTinggal" data-bind="value:tempatTinggal" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-2 ">
									<div class="form-group ">
										<label class="control-label">Umur</label>
										<input type="text" name="txtumur" data-bind="value:umur" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-4 ">
									<div class="form-group ">
										<label class="control-label">Tempat Lahir</label>
										<input type="text" name="txtNAMAKOTA" data-bind="value:tempatLahir" class="form-control">
										<small>Ketikkan nama Kota.</small>
									</div>
								</div> 

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Tanggal Lahir</label>
										<input type="date" name="txttglLahir" data-bind="value:tglLahir" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Email</label>
										<input type="email" name="txtemail" data-bind="value:email" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">No WhatsApp</label>
										<input type="text" name="txtnoWa" data-bind="value:noWa" class="form-control">
										<!-- <small>awali dengan '62', untuk pengganti '0'</small> -->
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Pendidikan Terakir</label>
										<input type="text" name="txtpendidikanTerakir"  data-bind="value:pendidikanTerakir" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Pendidikan Sekarang</label>
										<input type="text" name="txtpendidikanSekarang"  data-bind="value:pendidikanSekarang" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<!-- <label class="control-label">Kategori</label> -->
										<!-- <input type="text" name="txtkategori" data-bind="value:kategori" class="form-control"> -->
									</div>
								</div>

							</div> <!--  ./end record material -->

							<div class="row p-t-23 margMin" >
								<div class="col-md-12 margMin">
									<div class="form-group ">
										<!-- <button class="btn btn-sm btn-info" data-bind="click: saveRegAnggota" data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Simpan</span></button> -->
										<button class="btn btn-xl btn-default" data-toggle="tooltip"  data-placement="top"  data-original-title="nomor urut  belakang anda" ><span class="glyphicon glyphicon-floppy-disk"></span>
											<i class="fa fa-number"></i>Tersedia No urut ID : xxx<?= $no['noUrut']+1 ?>
										</button>
										<button data-bind="click: simpanDanLanjut_Reg_kursus" class="btn btn-xl btn-info" >Simpan & Next >></button>
									</div>
								</div>
							</div><!-- ./ row button -->

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<script>
	$(document).ready(function () { 
		model.Processing(true);
		material.drawKota();
	});
</script>