<script>
	model.masterModel={
		penggunaId:"",
		namaDepan:"",
		namaBelakang:"",
		noWa:"",
		email:"",
		guruMapel:"",
		alamat:"",
		tempatTinggal:"",
		tempatLahir:"",
		tglLahir:"",
		umur:0,
		foto:"",
		pendidikanTerakir:"",
		pendidikanSekarang:"",
		pengalamanMengjar:0,
		nomorKtp:"",
		// role:"",
		kategori:"",
		status:"",
		tb_kategori_kategoriId:0,
		// tb_role_roleId:0,
		IDKOTA:0,
		NAMAKOTA:"",

		idSiswa:"",
		namaDepan:"",
		namaBelakangSiswa:"",
		Siswa:"",

		namaBidangStudi:"",
		id_bidangStudi:"",
		jenjang:"",
		hargaperSesi:0,

		namaForm:"",
		noUrut:"",
	}

	model.subModel = {
		KODEDETAILPENJUALAN: "",
		KODEPENJUALAN:"",
		KODEBARANG:"",
		NAMABARANG:"",
		IDHARGABELI:0,
		HARGAJUAL:0,
		JUMLAHPENJUALAN:0,
		TOTALPENJUALAN:0,
		JUMLAHDIKIRIM:0,
	}

	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		RecordSubmaterial: ko.mapping.fromJS(model.subModel),
		Listmaterial: ko.observableArray([]),
		ListSubmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		DataFilter: ko.observableArray(['namaDepan']),
		FilterValue: ko.observable('namaDepan'),
		TotalRupiah: ko.observable(""),
		Terbilang: ko.observable(""),
		ModeInsert: ko.observable(""),
	} 

	material.back = function(tab){
		material.Mode('');
		material.grid.ajax.reload( null, false ); 
		// $("input[name=txtNPWP]").attr("disabled", false);
		ko.mapping.fromJS(model.masterModel, material.Recordmaterial);
		$("input[name=txtKota]").tokenInput('destroy');
		$("input[name=txtQURAN]").tokenInput('destroy');
		$("input[name=txtSD]").tokenInput('destroy');
		$("input[name=txtSMP]").tokenInput('destroy');
		$("input[name=txtIPA]").tokenInput('destroy');
		$("input[name=txtIPS]").tokenInput('destroy');
		material.drawKota();
		material.drawQURAN();
		material.drawSD();
		material.drawSMP();
		material.drawIPA();
		material.drawIPS();
		model.activetab(tab);
        material.ListSubmaterial([]);
        material.checkListData();
	}  

	material.selectdata = function(id) {
		model.Processing(true); 
		ajaxPost("<?php echo site_url('master/Con_pengguna/getDataSelect') ?>", {id: id}, function (res) {
			material.back(0);
			$("input[name=txtpenggunaId]").attr("disabled", true);
			ko.mapping.fromJS(res[0], material.Recordmaterial);
			material.Mode("Update");
			model.Processing(false); 
		});
	}

	material.checkListData = function(){
		var lengthsub = material.ListSubmaterial().length, i = 4 - lengthsub;
		if (i > 0) {
			for(var a=0;a<i;a++){
				material.add();
			}
		}
		material.calculateTotal();  
	}

	material.idanggotasiswa = function() {
		ajax.open('GET', '<?= site_url('master/Con_regSiswa/checkIdAnggotaSiswa') ?>', true);
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

	material.saveRegAnggota = function(){
		model.Processing(true);
		var url = "<?php echo base_url('master/Con_regSiswa/saveRegAnggota') ?>";

		ajaxPost(url, material.Recordmaterial, function (res) {

			if (res.result == "OK"){

				if (res.result == "OK") { 
					material.back(0);
					swal({ title: "Good job!",
						text: "Added new <?= $title ?>!",
						icon: "success",
					});
				} 
				
			} else {
				swal({ title: "Warning!",
					text: "Data Field KTP Sudah Ada!",
					icon: "warning",
				});
			}

			model.Processing(false);
		});
	} 

	material.remove = function(id){
		swal({
			title: "Are you sure?",
			text: "Delete <?= $title; ?>!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes!",
			cancelButtonText: "No!",
			closeOnConfirm: false,
		}, function(isConfirm){
			if (isConfirm) {
				ajaxPost("<?php echo base_url('master/Con_pengguna/delete') ?>", {id: id}, function (res) {
					material.back(1);
					swal("Deleted!", "Deleted <?= $title; ?>", "success");
				});
			}
		});
	}


	material.drawKota = function(){
		$("input[name=txtNAMAKOTA]").tokenInput("<?= base_url('master/Con_regSiswa/filterKota') ?>", {
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

	material.drawQURAN = function(){
		$("input[name=txtQURAN]").tokenInput("<?= base_url('master/Con_regSiswa/filterQuran') ?>", {
			zindex: 700,
			allowFreeTagging: false,
			placeholder: 'Ketikkan nama bidang!',
			tokenValue: 'id_bidangStudi',
			propertyToSearch: "namaBidangStudi",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.namaBidangStudi(item.namaBidangStudi);
				po.hargaperSesi(item.hargaperSesi);
				po.jenjang(item.jenjang);
				po.id_bidangStudi(item.id_bidangStudi);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.namaBidangStudi("");
				po.hargaperSesi(0);
				po.jenjang("");
				po.id_bidangStudi("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.namaBidangStudi+" - "+item.jenjang+"- Rp."+item.hargaperSesi+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}

	material.drawSD = function(){
		$("input[name=txtSD]").tokenInput("<?= base_url('master/Con_regSiswa/filterSD') ?>", {
			zindex: 700,
			allowFreeTagging: false,
			placeholder: 'Ketikkan nama bidang studi!',
			tokenValue: 'id_bidangstudi',
			propertyToSearch: "namaBidangStudi",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.namaBidangStudi(item.namaBidangStudi);
				po.hargaperSesi(item.hargaperSesi);
				po.jenjang(item.jenjang);
				po.id_bidangStudi(item.id_bidangStudi);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.namaBidangStudi("");
				po.hargaperSesi(0);
				po.jenjang("");
				po.id_bidangStudi("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.namaBidangStudi+" - "+item.jenjang+"- Rp."+item.hargaperSesi+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}

	material.drawSMP = function(){
		$("input[name=txtSMP]").tokenInput("<?= base_url('master/Con_regSiswa/filterSMP') ?>", {
			zindex: 700,
			allowFreeTagging: false,
			placeholder: 'Ketikkan nama bidang studi!',
			tokenValue: 'id_bidangstudi',
			propertyToSearch: "namaBidangStudi",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.namaBidangStudi(item.namaBidangStudi);
				po.hargaperSesi(item.hargaperSesi);
				po.jenjang(item.jenjang);
				po.id_bidangStudi(item.id_bidangStudi);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.namaBidangStudi("");
				po.hargaperSesi(0);
				po.jenjang("");
				po.id_bidangStudi("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.namaBidangStudi+" - "+item.jenjang+"- Rp."+item.hargaperSesi+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}

	material.drawIPA = function(){
		$("input[name=txtIPA]").tokenInput("<?= base_url('master/Con_regSiswa/filterIPA') ?>", {
			zindex: 700,
			allowFreeTagging: false,
			placeholder: 'Ketikkan nama bidang studi!',
			tokenValue: 'id_bidangstudi',
			propertyToSearch: "namaBidangStudi",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.namaBidangStudi(item.namaBidangStudi);
				po.hargaperSesi(item.hargaperSesi);
				po.jenjang(item.jenjang);
				po.id_bidangStudi(item.id_bidangStudi);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.namaBidangStudi("");
				po.hargaperSesi(0);
				po.jenjang("");
				po.id_bidangStudi("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.namaBidangStudi+" - "+item.jenjang+"- Rp."+item.hargaperSesi+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}

	material.drawIPS = function(){
		$("input[name=txtIPS]").tokenInput("<?= base_url('master/Con_regSiswa/filterIPS') ?>", {
			zindex: 700,
			allowFreeTagging: false,
			placeholder: 'Ketikkan nama bidang studi!',
			tokenValue: 'id_bidangstudi',
			propertyToSearch: "namaBidangStudi",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.namaBidangStudi(item.namaBidangStudi);
				po.hargaperSesi(item.hargaperSesi);
				po.jenjang(item.jenjang);
				po.id_bidangStudi(item.id_bidangStudi);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.namaBidangStudi("");
				po.hargaperSesi(0);
				po.jenjang("");
				po.id_bidangStudi("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.namaBidangStudi+" - "+item.jenjang+"- Rp."+item.hargaperSesi+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}



	material.drawSiswa = function(){
		$("input[name=txtsiswa]").tokenInput("<?= base_url('master/Con_regSiswa/filterSiswa') ?>", {
			zindex: 700,
			allowFreeTagging: false, 
			placeholder: 'Ketikkan id pengguna anda!', 
			tokenValue: 'idSiswa',
			propertyToSearch: "idSiswa",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.Siswa(item.Siswa);
				po.namaBelakangSiswa(item.namaBelakangSiswa);
				po.idSiswa(item.idSiswa);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.Siswa("");
				po.namaBelakangSiswa("");
				po.idSiswa("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.Siswa+" "+item.namaBelakangSiswa+" - "+item.idSiswa+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}

	material.sorry = function(){
		alert("Maaf form ini dalam proses");
		window.location.href="<?= base_url('master/Con_regSiswa');?>";
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
					<li class="nav-item"><a class="nav-link active" href="#tabform" data-toggle="tab">Pendaftaran siswa</a></li>
					<li class="nav-item"><a class="nav-link" href="#tabformregisterKursus" data-toggle="tab">Pendaftaran Kursus</a></li>
				</ul>
				<!-- End Nav tabs -->
				<div class="content tab-content" id="tabnavform-content">
					<div class="tab-pane active" id="tabform">
						<div class="card-body p-20 animated fadeIn m">
							<div class="row p-t-23 margMin" >
								<div class="col-md-12 margMin">
									<div class="form-group ">

										<button class="btn btn-sm btn-info" data-bind="click: saveRegAnggota" data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Simpan</span></button>

										<button class="btn btn-sm btn-default" data-toggle="tooltip"  data-placement="top"  data-original-title="nomor urut  belakang anda" ><span class="glyphicon glyphicon-floppy-disk"></span>
											<i class="fa fa-number"></i>Tersedia nomor urut : xxx<?= $no['noUrut']+1 ?>

									</button>


									</div>
								</div>
							</div>
							<div class="row p-t-23 " data-bind="with:Recordmaterial" >

								<div class="col-md-4 margBottom">
									<div class="form-group ">
										<label class="control-label">NIK</label>
										<input type="number" name="txtnomorKtp" data-bind="value:nomorKtp, checkId: 'Con_regSiswa/checkKtp'"" max="16" id="" required="" class="form-control">
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

								<!-- checkNomor -->

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">  
										<label class="control-label">Alamat Rumah</label>
										<input type="text"  name="txtalamat" data-bind="value:alamat, checkId: 'Con_regSiswa/checkAlamat'"  id="" required="" class="form-control">
										<div class="form-control-feedback" data-bind="visible: model.CheckId()==true">Alamat  Sama!</div>

									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">  
										<label class="control-label">Alamat Tempat Tinggal</label>
										<input type="text"  name="txttempatTinggal" data-bind="value:tempatTinggal" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Tempat Lahir</label>
										<input type="text" name="txtNAMAKOTA" data-bind="value:tempatLahir" class="form-control">
										<small>Ketikkan nama Kota.</small>
									</div>
								</div> 

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Email</label>
										<input type="text" name="txtemail" data-bind="value:email" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-2 ">
									<div class="form-group ">
										<label class="control-label">Umur</label>
										<input type="text" name="txtumur" data-bind="value:umur" class="form-control">
									</div>
								</div> 

								<div class="form-group margMin col-md-4 ">
									<div class="form-group ">
										<label class="control-label">Tanggal Lahir</label>
										<input type="date" name="txttglLahir" data-bind="value:tglLahir" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">No WhatsApp</label>
										<input type="text" name="txtnoWa" data-bind="value:noWa" class="form-control">
										<small>awali dengan '62', untuk pengganti '0'</small>
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
										<label class="control-label">Pendidikan Terakir</label>
										<input type="text" name="txtpendidikanTerakir"  data-bind="value:pendidikanTerakir" id="" required="" class="form-control">
									</div>
								</div>
								
								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<!-- <label class="control-label">Kategori</label> -->
										<!-- <input type="text" name="txtkategori" data-bind="value:kategori" class="form-control"> -->
									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="tab-pane " id="tabformregisterKursus">
						<div class="card-body p-20 animated fadeIn m">

							<div class="row p-t-23 margMin" >
								<div class="col-md-12 margMin">
									<div class="form-group ">

										<button class="btn btn-sm btn-info" data-bind="click:saveRegAnggota" data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Simpan</span></button>

									</div>
								</div>
							</div>

							<div class="row p-t-23 " data-bind="with:Recordmaterial">
								
								<div class="col-md-4 margMin">
									<label class="control-label">ID ANGGOTA</label>
									<div class="form-group">
										<!-- <span class="input-group-addon" id="basic-addon1">ID</span> -->
										<input type="text" name="txtsiswa" data-bind="value:idSiswa" id="" required="" class="form-control form-token">
									</div>
								</div>
								<div class="col-md-8 margMin"></div>

								<div class="col-md-4 margMin">
									<label class="control-label">NAMA DEPAN</label>
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">ND</span>
										<input type="text" name="" data-bind="value:Siswa" id="" disabled="" class="form-control form-token">
									</div>
								</div>
								<div class="col-md-4 margMin">
									<label class="control-label">NAMA BELAKANG</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon1">NB</span>
										<input type="text" name="txtnamaBelakangSiswa" data-bind="value:namaBelakangSiswa" id="" disabled="" class="form-control">
									</div>
								</div>

								<div class="col-md-8 margMin">
									<label class="control-label">LOKASI KURSUS</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker"></i> </span>
										<input type="text" name="txttempatKursus" data-bind="value:tempatKursus" id="" required="" class="form-control">
									</div>
								</div>
								<div class="col-md-4 margMin">
								</div>


								<!-- <label class="control-label">KATEGORI BIDANG STUDI</label> -->
								<div class="demo-radio-button"> 
									<input name="txtkategoriId" type="radio" value="1" data-bind="checked: kategoriId" id="radio_41" class="with-gap radio-col-light-blue">
									<!-- <label for="radio_41">UMUM</label> -->
								</div>

								<div class="col-md-3 margMin">
									<label class="control-label">JAM MULAI</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon1"><i class="fa fa-clock-o"></i> </span>
										<input type="time" name="txtwaktuKursus" data-bind="value:waktuKursus" id="" required="" class="form-control">
									</div>
									Ex: 11:30 AM
								</div>
								<div class="col-md-3 margMin">
									<label class="control-label">TANGGAL</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar-o"></i> </span>
										<input type="date" name="txttglKursus" data-bind="value:tglKursus" id="" required="" class="form-control"> 
									</div>
								</div>

								<div class="col-md-12 margMin">
									<div class="form-group ">
										<label class="control-label">KETERANGAN</label>
										<textarea type="text" name="txtketerangan" data-bind="value:keterangan" id="" required="" class="form-control" rows="7"></textarea>
									</div>
								</div>
								
							</div> <!--  ./ recordmaterial -->

							<div class="col-md-12">
								<button class="btn btn-sm btn-info form-bt" style="margin-bottom: 10px;" data-bind="click:material.add, visible: material.ModeInsert()==''"><i class="fa fa-plus"></i> Tambah Kursus</button>
								<div class="table-responsive m-t-40" style="clear: both;">
									<table class="table table-hover color-bordered-table muted-bordered-table">
										<thead> <!-- TABLE UNTUK INVOICE  -->
											<tr id="head-transksi">
												<th class="text-center g form-bt" width="5%">NO</th>
												<th width="20%" class="text-left g form-bt">BIDANG STUDI</th>
												<th class="text-left g form-bt" width="15%">JUMLAH</th>
												<th class="text-right g form-bt" width="20%">HARGA</th>
												<th class="text-right g form-bt" width="20%">TOTAL</th>
												<th class="text-right g form-bt" width="5%">ACTION</th>
											</tr>
										</thead>
										<tbody class="margTinv" data-bind="foreach: material.ListSubmaterial">
											<tr>
												<td class="text-center fbt" data-bind="html: ($index()+1)"></td>
												<td class="fbt"><input type="text" class="form-control tokenbarang" maxlength="50" data-bind="attr:{'idtoken':'txtbarang'+$index(), 'indextoken': $index()}" /></td>
												<td class="text-left fbt"> <input type="number" class="form-control" name="txtJUMLAH" maxlength="50" data-bind="value:JUMLAHPENJUALAN, numeric: number, sumtotal: number, readonly: material.ModeInsert()"/></td>
												<td class="text-right fbt"><input type="text" class="form-control" name="txtHarga" maxlength="50" data-bind="value:HARGAJUAL, numeric: number, sumtotal: number" readonly="" /></td>
												<td data-bind="html:changeRupiah(TOTALPENJUALAN())"></td>
												<td class="text-center fbt"><button class="btn btn-sm btn-danger" data-bind="click: material.removeItem, visible: material.ModeInsert()==''"><i class="fa fa-trash-o"></i></button></td>
											</tr>
										</tbody> 

										<tfoot class="bdr_tfoot"> 
											<tr>
												<th class="text-left" width="15%" colspan="2">TERBILANG</th>
												<th class="text-left terbilangnya" width="55%" colspan="2" data-bind='html:material.Terbilang()'></th>
												<th class="text-right" width="30%" colspan="2" data-bind='html: material.TotalRupiah()'></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="clearfix"></div>
							<hr> 

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
	material.add = function(){
		var datayo = $.extend(true, {}, ko.mapping.fromJS(model.subModel));
		material.ListSubmaterial.push(datayo);
		material.drawBarang((material.ListSubmaterial().length-1),"");
	}
	$(document).ready(function () { 
		model.Processing(true);
		material.drawKota();
		material.drawSiswa();
		material.drawQURAN();
		material.drawSD();
		material.drawSMP();
		material.drawIPA();
		material.drawIPS();
        material.checkListData();
		// material.drawSD();
		material.grid = $("#myTable").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?php echo base_url('master/Con_regSiswa/getData') ?>",
				"type": "POST",
				"data": function(d){ 
					d['filtervalue'] = material.FilterValue();
					d['filtertext'] = material.FilterText();
					return d; 
				},
				"dataSrc": function (json) {// json.draw = 1;
					json.recordsTotal = json.RecordsTotal;
					json.recordsFiltered = json.RecordsFiltered;

					if (json.Data)
						return json.Data;
					else
						return [];
				},
			},
			"searching": false,
			"columns": [
				// { "data": "KTP"},
				{ "data": "NPWP"},
				{ "data": "NAMACUSTOMER" },
				{ "data": "JABATAN"},
				{ "data": "ALAMATCUSTOMER" },
				{ "data": "NOTLP"},
				{ "data": "STATUS"},
				// { "data": "KODEPOSCUSTOMER" }, 
				// { "data": "EMAIL"},
				// { "data": "NOHP"},
				{
					"data": "IDCUSTOMER",
					"render": function( data, type, full, meta){
						return "<button class='btn btn-sm btn-info' onClick='material.selectdata("+data+")'><i class='fa fa-pencil'></i></button> &nbsp; <button  id='sa-warning' class='btn btn-sm btn-danger' onClick='material.remove("+data+")' id='sa-warning' ><i class='fa fa-trash'></i></button>"; 
					}
				}
				],
			});
	});
</script>