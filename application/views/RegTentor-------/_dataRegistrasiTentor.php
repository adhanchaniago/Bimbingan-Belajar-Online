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

	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		DataFilter: ko.observableArray(['namaDepan']),
		FilterValue: ko.observable('namaDepan'),
	}


	material.back = function(tab){
		material.Mode('');
		material.grid.ajax.reload( null, false ); 
		// $("input[name=txtNPWP]").attr("disabled", false);
		ko.mapping.fromJS(model.masterModel, material.Recordmaterial);
		$("input[name=txtKota]").tokenInput('destroy');
		material.drawKota();
		model.activetab(tab);
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
		var ktp = material.Recordmaterial.nomorKtp();
		if (ktp != "") {
			var url = "<?php echo base_url('master/Con_regSiswa/saveRegAnggota') ?>";
		} else{
			swal({ title: "Warning!",
				text: "Data Field tidak boleh kosong!",
				icon: "warning",
			});
		}

		ajaxPost(url, material.Recordmaterial, function (res) {

			if (res.result == "OK"){

				if (res.result == "OK") { 
					material.back(0);
					swal({ title: "Good job!",
						text: "Added new <?= $title ?>!",
						icon: "success",
					});
				}
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

	material.removeItem = function(data){
		material.ListSubmaterial.remove(data);
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
					<!-- <li class="nav-item"><a class="nav-link active" href="#tabform" data-toggle="tab">Pendaftaran siswa</a></li> -->
					<!-- <li class="nav-item"><a class="nav-link" href="#tabformregisterKursus" data-toggle="tab">Pendaftaran Kursus</a></li> -->
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
											<i class="fa fa-number"></i>Tersedia nomor urut : xxx<?= $no['noUrut']+1 ?></button>
										<!-- <a href="<?= base_url(); ?>master/Con_regKursus" class="btn btn-sm btn-primary" >Next >></a> -->
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
											<input type="text"  name="txtalamat" data-bind="value:alamat'"  id="" required="" class="form-control">
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