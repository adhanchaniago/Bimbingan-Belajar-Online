<script>
	model.masterModel={
		penggunaId:"",
		namaDepan:"",
		namaBelakang:"",
		noWa:0,
		email:"",
		guruMapel:"",
		alamat:"",
		tempatTinggal:"",
		tempatLahir:"",
		tglLahir:"",
		umur:0,
		foto:"",
		pendidikanTerakir:"",
		pengalamanMengjar:0,
		// role:"",
		kategori:"",
		status:"",
		tb_kategori_kategoriId:0,
		// tb_role_roleId:0,
		IDKOTA:0,
		NAMAKOTA:"",

		namaBank:"",
		noRek:"",
	}
	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		DataFilter: ko.observableArray(['namaDepan']),
		FilterValue: ko.observable('namaDepan'),
		// StatusSelected : ko.observable('status'),
	} 

	material.back = function(tab){
		material.Mode('');
		material.grid.ajax.reload( null, false ); 
		$("input[name=txtNPWP]").attr("disabled", false); 
		ko.mapping.fromJS(model.masterModel, material.Recordmaterial);
		$("input[name=txtNegara]").tokenInput('destroy');
		$("input[name=txtKota]").tokenInput('destroy');
		$("input[name=txtProvinsi]").tokenInput('destroy');
		// material.drawNegara();
		// material.drawKota();
		// material.drawProvinsi(); 
		model.activetab(tab);
	}  

	// material.selectdata = function(id) {
	// 	material.back(0);
	// 	material.Mode("Update"); 
	// 	$("input[name=txtpenggunaId]").attr("disabled", true);
	// 	$.ajax({
	// 		url: "<?php echo site_url('master/Con_pengguna/getDataSelect') ?>",
	// 		type: 'post',
	// 		dataType: 'json',
	// 		data : {id: id},
	// 		success : function(res) { 
	// 			ko.mapping.fromJS(res[0], material.Recordmaterial);
	// 			var itemSelect = {
	// 				IDNEGARA: res[0].IDNEGARA,
	// 				NAMANEGARA: res[0].NAMANEGARA,
	// 				IDPROVINSI: res[0].IDPROVINSI,
	// 				NAMAPROVINSI: res[0].NAMAPROVINSI,
	// 				IDKOTA: res[0].IDKOTA,
	// 				NAMAKOTA: res[0].NAMAKOTA,
	// 			}
	// 			$("input[name=txtNegara]").tokenInput("add", itemSelect);
	// 			$("input[name=txtProvinsi]").tokenInput("add", itemSelect);
	// 			$("input[name=txtKota]").tokenInput("add", itemSelect);
	// 		}
	// 	});
	// }

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

	material.save = function(){
		model.Processing(true);
		var url = "<?php echo base_url('master/Con_pengguna/save') ?>";
		if(material.Mode() === 'Update')
			url = "<?php echo base_url('master/Con_pengguna/update') ?>";

		ajaxPost(url, material.Recordmaterial, function (res) {
			if (res.result == "OK" || material.Mode() == "Update"){
				if (res.result == "OK") { 
					material.Mode('');
					swal({ title: "Good job!",
						text: "Added new <?= $title ?>!",
						icon: "success",
					});
				} 
				if (material.Mode() == "Update") {
					material.back(1); 
					swal({ title: "Good job!",
						text: "Updated <?= $title ?>!",
						icon: "success",
					});
				}
			} else {
				swal({ title: "Warning!",
					text: "Data Field NPWP Sudah Ada!",
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

	// material.drawKota = function(){
	// 	$("input[name=txttempatLahir]").tokenInput("<?= base_url('master/Con_pengguna/filterKota') ?>", {
	// 		zindex: 700,
	// 		allowFreeTagging: false,
	// 		placeholder: '',
	// 		tokenValue: 'NAMAKOTA',
	// 		propertyToSearch: "NAMAKOTA",
	// 		tokenLimit: 1,
	// 		theme: "facebook",
	// 		onAdd: function (item) {
	// 			var po = material.Recordmaterial;
	// 			po.NAMAKOTA(item.NAMAKOTA);
	// 			po.IDKOTA(item.IDKOTA);
	// 		},
	// 		onDelete: function(item){
	// 			var po = material.Recordmaterial;
	// 			po.NAMAKOTA("");
	// 			po.IDKOTA("");
	// 		},
	// 		resultsFormatter: function(item){
	// 			return "<li>"+item.NAMAKOTA+"</li>"
	// 		},
	// 		onResult: function (results) {
	// 			return results;
	// 		},
	// 		onCachedResult: function(res){
	// 			return res;
	// 		}
	// 	});
	// }

</script>
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
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
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<!-- ============================================================== -->
		<!-- Right sidebar -->
		<!-- ============================================================== -->
		<div class="col-2 ">
			<?php $this->load->view('template/_sidebar'); ?>
		</div>
		<!-- ============================================================== -->
		<!-- End Right sidebar -->
		<!-- ============================================================== -->
		<div class="col-md-10">
			<div class="card card card-body p-b-0" data-bind="with:material">  
				<div class="col-md-5 align-self-left">
					<h3 class="text-themecolor"><?= $title ?></h3>
				</div>          
				<!-- Nav tabs -->
				<ul class="nav nav-tabs customtab" id="tabnavform">
					<!-- <li class="nav-item"><a class="nav-link" href="#tabform" data-toggle="tab">Form</a></li> -->
					<!-- <li class="nav-item"><a class="nav-link active" href="#tablist" data-toggle="tab">List</a></li> -->
				</ul>
				<!-- End Nav tabs -->
				<div class="content tab-content" id="tabnavform-content">
					<div class="tab-pane " id="tabform">
						<div class="card-body p-20 animated fadeIn m">
							<div class="row p-t-23 margMin" >
								<div class="col-md-12 margMin">
									<div class="form-group ">
										<button class="btn btn-sm btn-primary" data-bind="click:function(){back(1);}, visible: Mode() == 'Update'" data-toggle="tooltip" data-placement="top" data-original-title="Kembali"><span class="glyphicon glyphicon-chevron-left" ></span><< Kembali</button>
										<button class="btn btn-sm btn-info" data-bind="click:save" data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Simpan</span></button>
										<button class="btn btn-sm btn-danger" data-bind="click:function(){remove(Recordmaterial.penggunaId());}, visible: Mode() == 'Update'"><span class="glyphicon glyphicon-trash"></span><i class="fa fa-trash"></i> Hapus</button>
									</div>
								</div>
							</div>
							<div class="row p-t-23 " data-bind="with:Recordmaterial" >

								<div class="col-md-3 margBottom">  
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon3">KODE ID</span>
										<input type="text" name="txtpenggunaId" data-bind="value:penggunaId" disabled="" required="" class="form-control" id="basic-url" aria-describedby="basic-addon3">
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
										<input type="text"  name="txtalamat" data-bind="value:alamat" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">  
										<label class="control-label">Alamat Tempat Tinggal</label>
										<input type="texttempatTinggal"  name="txtalamat" data-bind="value:alamat" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Tempat Lahir</label>
										<input type="text" name="txttempatLahir" data-bind="value:tempatLahir" class="form-control">
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
										<input type="text" name="txttempatTinggal"  data-bind="value:tempatTinggal" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">No WhatsApp</label>
										<input type="text" name="txtnoWa" data-bind="value:noWa" class="form-control">
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
										<label class="control-label">Pengalaman mengajar</label>
										<input type="text" name="txtpengalamanMengjar" data-bind="value:pengalamanMengjar" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">NAMA BANK</label>
										<select name="txtnamaBank" data-bind="
										options: model.Resource.selectBank,
										optionsText: 'name',
										optionsValue: 'value',
										value:namaBank"
										class="custom-select col-3" id="inlineFormCustomSelect">
									</select>
								</div>
							</div>

							<div class="form-group margMin col-md-6 ">
								<div class="form-group ">
									<label class="control-label">NO REK</label>
									<input type="number" name="txtnoRek" data-bind="value:noRek" class="form-control">
									<small>Isikan dengan nomor rekening anda</small>
								</div>
							</div>

							<div class="form-group margMin col-md-6 ">
								<div class="form-group ">
									<hr class="btn-info">
								</div>
							</div>
							<div class="form-group margMin col-md-6 ">
								<div class="form-group ">
									<hr class="btn-info">
								</div>
							</div>

							<div class="form-group col-md-6 marg2">
								<div class="form-group ">
									<label class="control-label">Mendaftar sebagai </label>
									<input type="text" name="txtguruMapel" data-bind="value:guruMapel" class="form-control">
								</div>
							</div>

							<div class="form-group col-md-6 margList">
								<div class="form-group ">
									<label class="control-label">Kategori Guru</label> 
									<div class="demo-radio-button"> 
										<input name="txttb_kategori_kategoriId" type="radio" value="1" data-bind="checked: tb_kategori_kategoriId" id="radio_36" class="with-gap radio-col-light-blue">
										<label for="radio_36">Umum</label>
										<input name="txttb_kategori_kategoriId" type="radio" value="2" data-bind="checked: tb_kategori_kategoriId" id="radio_37" class="with-gap radio-col-light-blue">
										<label for="radio_37">Qur'an</label>
											<!-- <input name="txttb_kategori_kategoriId" type="radio" value="3" data-bind="checked: tb_kategori_kategoriId" id="radio_38" class="with-gap radio-col-light-blue">
												<label for="radio_38">Pengelola</label>  -->
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="tab-pane active" id="tablist">
							<div class="card-body p-20" data-bind="with:material">
								<div class="row p-t-23 " >
									<div class="col-md-12 ">
										<div class="table-responsive m-t-40 animated fadeIn">
											<table id="myTable" width="100%" class="table table-bordered table-striped ">
												<thead>
													<tr> 
														<th width="10%">ID</th>
														<th width="25%">NAMA</th>
														<th width="20%">SEBAGAI</th>
														<th width="10%">WHATSAPP</th>
														<th width="15%">EMAIL</th>
														<th width="10%">ROLE</th>
														<th>ACTION</th>
													</tr>
												</thead> 
											</table>
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
		// material.drawKota();
		material.grid = $("#myTable").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?php echo base_url('master/Con_pengguna/getData') ?>",
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
			{"data": "penggunaId"},
			{"data": "namaDepan"},
				// {"data": "username"},
				{"data": "guruMapel"},
				{"data": "noWa"},
				{"data": "email"},
				{"data": "role"},
				{
					"data": "penggunaId",
					"render": function( data, type, full, meta){
						return "<button class='btn btn-sm btn-info' onClick='material.selectdata(\""+data+"\")'><i class='fa fa-pencil'></i></button> &nbsp; <button  id='sa-warning' class='btn btn-sm btn-danger' onClick='material.remove(\""+data+"\")' id='sa-warning' ><i class='fa fa-trash'></i></button>"; 
					}
				}
				],
			});
	});
</script>