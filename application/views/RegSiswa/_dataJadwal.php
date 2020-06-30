<script>
	model.masterModel = { 
		idapp_kursus: "",
		kategoriId: 0,
		bidangStudiId: 0,
		jumPertemuanId: 0,
		idSiswa: 0, 
		idTentor: 0,
		Tentor:"",
		Siswa:"",
		tglKursus: "",
		waktuKursus: "",
		tempatKursus: "",
		keterangan: "",
		statusKursus: "",
		pertemuan_ke: 0,
		tglselesai: "",
		id_bidangStudi: 0,
		namaBidangStudi: "",
		idjumPertemuan: 0,
		namaJumPertemuan: "",
		jumlahPertemuan: 0,
		durasiKursus:"",

		idSiswa:"",
		idTentor:"",
		Siswa:"",
		namaBelakangSiswa:"",
		Tentor:"",
		namaBelakangTentor:"",

		namaBidangStudi:"",
		bidangStudiId:0,

		kategoriName:"",
		kategoriId:0,
	}
	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		DataFilter: ko.observableArray(['idSiswa']),
		FilterValue: ko.observable('idSiswa'),
	}

	material.selectdata = function(id) {
		ajaxPost("<?php echo site_url('master/Con_jadwal/getDataSelect') ?>", {id: id}, function (res) {
			material.back(0);
			$("input[name=txtidapp_kursus]").attr("disabled", true);
			ko.mapping.fromJS(res[0], material.Recordmaterial);
			var itemSelect = {
				idSiswa: res[0].idSiswa,
				Siswa: res[0].Siswa,
				idTentor: res[0].idTentor,
				Tentor: res[0].Tentor,
				bidangStudiId: res[0].bidangStudiId,
				namaBidangStudi: res[0].namaBidangStudi,
			}
			$("input[name=txtsiswa]").tokenInput("add", itemSelect);  
			$("input[name=txttentor]").tokenInput("add", itemSelect);
			$("input[name=txtnamaBidangStudi]").tokenInput("add", itemSelect);
			material.Mode("Update");
		});
	}

	material.back = function(tab){
		material.Mode('');
		material.grid.ajax.reload( null, false );
		$("input[name=txtidapp_kursus]").attr("disabled", false);
		ko.mapping.fromJS(model.masterModel, material.Recordmaterial);
		$("input[name=txtsiswa]").tokenInput('destroy');
		$("input[name=txttentor]").tokenInput('destroy');
		$("input[name=txtnamaBidangStudi]").tokenInput('destroy');
		material.drawSiswa();
		material.drawTentor();
		material.drawMapel();
		model.activetab(tab);
	}
  
	material.save = function(){
		model.Processing(true);
		var url = "<?php echo base_url('master/Con_jadwal/save') ?>";
		
		if(material.Mode() === 'Update')
			url = "<?php echo base_url('master/Con_jadwal/update') ?>";

		ajaxPost(url, material.Recordmaterial, function (res) {
			if (material.Mode() == "Update"){ 
				material.back(0);
				swal({ title: "Good job!",
					text: "Updated <?= $title ?>!",
					icon: "success",
				}); 
			} else { 
				swal({ title: "Good job!",
					text: "Added new <?= $title ?>!",
					icon: "success",
				});
			}
			model.Processing(false);
		});
	}
	material.remove = function(id){
		// model.Processing(true);
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
					ajaxPost("<?php echo base_url('master/Con_jadwal/delete') ?>", {id: id}, function (res) {
						material.back(1);
						swal("Deleted!", "Deleted <?= $title; ?>", "success");
					});
				}
			// model.Processing(false);
		});
	}

	material.drawSiswa = function(){
		$("input[name=txtsiswa]").tokenInput("<?= base_url('master/Con_jadwal/filterSiswa') ?>", {
			zindex: 700,
			allowFreeTagging: false, 
			placeholder: '', 
			tokenValue: 'idSiswa',
			propertyToSearch: "Siswa",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.Siswa(item.Siswa);
				po.idSiswa(item.idSiswa);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.Siswa("");
				po.idSiswa("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.Siswa+" "+item.namaBelakangSiswa+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}

	material.drawTentor = function(){
		$("input[name=txttentor]").tokenInput("<?= base_url('master/Con_jadwal/filterTentor') ?>", {
			zindex: 700,
			allowFreeTagging: false, 
			placeholder: '', 
			tokenValue: 'idTentor',
			propertyToSearch: "Tentor",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.Tentor(item.Tentor);
				po.idTentor(item.idTentor);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.Tentor("");
				po.idTentor("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.Tentor+" "+item.namaBelakangTentor+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}

	material.drawMapel = function(){
		$("input[name=txtnamaBidangStudi]").tokenInput("<?= base_url('master/Con_jadwal/filterMapel') ?>", {
			zindex: 700,
			allowFreeTagging: false, 
			placeholder: '',
			tokenValue: 'bidangStudiId',
			propertyToSearch: "namaBidangStudi",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.namaBidangStudi(item.namaBidangStudi);
				po.bidangStudiId(item.bidangStudiId);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.namaBidangStudi("");
				po.bidangStudiId("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.namaBidangStudi+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}

</script>
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
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
		<!-- ============================================================== -->
		<!-- End Right sidebar -->
		<!-- ============================================================== -->
		<div class="col-2 ">
			<?php $this->load->view('template/_sidebar'); ?>
		</div>
		<div class="col-md-10">
			<div class="card card card-body p-b-0" data-bind="with:material">  
				<div class="col-md-5 align-self-left">
					<h3 class="text-themecolor"><?= $title ?></h3>
				</div>          
				<!-- Nav tabs -->
				<ul class="nav nav-tabs customtab" id="tabnavform">
					<li class="nav-item"><a class="nav-link active" href="#tabform" data-toggle="tab">Form</a></li>
					<li class="nav-item"><a class="nav-link" href="#tablist" data-toggle="tab">List</a></li>
				</ul>
				<!-- End Nav tabs -->
				<div class="content tab-content" id="tabnavform-content">
					<div class="tab-pane active" id="tabform">
						<div class="card-body p-20 animated fadeIn m">
							<div class="row p-t-23 margMin" >
								<div class="col-md-12 margMin">
									<div class="form-group ">
										<button class="btn btn-sm btn-primary" data-bind="click:function(){back(1);}, visible: Mode() == 'Update'" data-toggle="tooltip" data-placement="top" data-original-title="Kembali"><span class="glyphicon glyphicon-chevron-left" ></span><< Kembali</button>
										<button class="btn btn-sm btn-info" data-bind="click:save" data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Simpan</span></button>
										<button class="btn btn-sm btn-danger" data-bind="click:function(){remove(Recordmaterial.idapp_kursus());}, visible: Mode() == 'Update'"><span class="glyphicon glyphicon-trash"></span><i class="fa fa-trash"></i> Hapus</button>
									</div>
								</div>
							</div>
							<div class="row p-t-23 " data-bind="with:Recordmaterial" >  
								<div class="col-md-12 margMin">
									<div class="form-group ">
										<!-- <label class="control-label">NOMOR</label> -->
										<!-- <input type="hidden" name="txtidapp_kursus" data-bind="value:idapp_kursus, checkId: 'C_kategori/checkId'" id="" required="" class="form-control">  -->
										<!-- <div class="form-control-feedback" data-bind="visible: model.CheckId()==true">ID Sama</div> -->
									</div>
								</div>
								<!-- ko {if: idapp_kursus == ''} -->
									<div class="col-md-3 margMin">
										<div class="form-group">
											<label class="control-label">KODE ID</label>
											<input type="text" data-bind="value:idapp_kursus" disabled="" id="" required="" class="form-control" disabled="">
										</div>
									</div>
									<div class="col-md-9 margMin">
										<div class="form-group "> 
										</div>
									</div>
								<!-- /ko -->
								<!-- ko {if: material.Mode() == 'Update'} -->
									<div class="col-md-3 margMin">
										<div class="form-group">
											<label class="control-label">KODE ID</label>
											<input type="text" name="txtidapp_kursus" data-bind="value:idapp_kursus" disabled="" id="" required="" class="form-control" disabled="">
										</div>
									</div>
									<div class="col-md-9 margMin">
										<div class="form-group ">
										</div>
									</div>
								<!-- /ko -->
								
								<div class="col-md-6 margMin">
									<label class="control-label"><span class="form-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span> SISWA</label>
									<div class="form-group">
										<input type="text" name="txtsiswa" data-bind="value:idSiswa" id="" required="" class="form-control form-token">
									</div>
								</div>
								<div class="col-md-6 margMin">
									<label class="control-label"><span class="form-group-addon" id="basic-addon1"><i class="fa fa fa-user-circle-o"></i></span> TENTOR</label>
									<div class="form-group ">
										<input type="text" name="txttentor" data-bind="value:idTentor" id="" required="" class="form-control">
									</div>
								</div>

								<div class="col-md-6 margMin">
									<label class="control-label"><span class="form-group-addon" id="basic-addon1"><i class="fa fa fa-user-circle-o"></i></span> BIDANG STUDI</label>
									<div class="form-group ">
										<input type="text" name="txtnamaBidangStudi" data-bind="value:bidangStudiId" id="" required="" class="form-control"> 
									</div>
								</div>

								<div class="form-group col-md-6 margList ">
									<div class="form-group ">
										<label class="control-label"><span class="form-group-addon" id="basic-addon1"><i class="fa fa fa-user-circle-o"></i></span> KATEGORI BIDANG STUDI</label> 
										<div class="demo-radio-button"> 
											<input name="txtkategoriId" type="radio" value="1" data-bind="checked: kategoriId" id="radio_41" class="with-gap radio-col-light-blue">
											<label for="radio_41">UMUM</label>
											<input name="txtkategoriId" type="radio" value="2" data-bind="checked: kategoriId" id="radio_42" class="with-gap radio-col-light-blue">
											<label for="radio_42">QUR'AN</label>
										</div>
									</div>
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
								<div class="col-md-2 margMin">
										<label class="control-label">DURASI</label>
									<div class="input-group ">
										<input type="text" name="txtdurasiKursus" data-bind="value:durasiKursus" id="" required="" aria-describedby="basic-addon2" class="form-control">
										<span class="input-group-addon" id="basic-addon2">jam</span> 
									</div>
								</div>
								<div class="col-md-4 margMin">
									<label class="control-label">TEMPAT</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker"></i> </span>
										<input type="text" name="txttempatKursus" data-bind="value:tempatKursus" id="" required="" class="form-control"> 
									</div>
								</div>

								<div class="form-group col-md-6 margList ">
									<div class="form-group ">
										<label class="control-label">STATUS</label> 
										<div class="demo-radio-button"> 
											<input name="txtstatusKursus" type="radio" value="Aktif" data-bind="checked: statusKursus" id="radio_40" class="with-gap radio-col-light-blue">
											<label for="radio_40">Aktif</label>
											<input name="txtstatusKursus" type="radio" value="Tuntas" data-bind="checked: statusKursus" id="radio_39" class="with-gap radio-col-light-blue">
											<label for="radio_39">Tuntas</label>
										</div>
									</div>
								</div>

								<div class="col-md-6 margMin">
									<label class="control-label">PERTEMUAN</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon1">KE : </span>
										<input type="text" name="txtpertemuan_ke" data-bind="value:pertemuan_ke" id="" required="" class="form-control"> 
									</div>
								</div>

								<div class="col-md-6 margMin">
									<label class="control-label">TANGGAL SELESAI</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar-o"></i> </span>
										<input type="date" name="txttglselesai" data-bind="value:tglselesai" id="" required="" class="form-control"> 
									</div>
								</div>
								<div class="col-md-6 margMin">
									<!-- <label class="control-label">TANGGAL SELESAI</label> -->
									<div class="input-group ">
										
									</div>
								</div>
								 
								<div class="col-md-12 margMin">
									<div class="form-group ">
										<label class="control-label">KETERANGAN</label>
										<textarea type="text" name="txtketerangan" data-bind="value:keterangan" id="" required="" class="form-control" rows="15"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tablist">
						<div class="card-body p-20" data-bind="with:material">
							<div class="row p-t-23 " >
								<div class="col-md-12 ">
									<div class="table-responsive m-t-40 animated fadeIn">
										<table id="myTable" width="100%" class="table table-bordered table-striped ">
											<thead>
												<tr> 
													<th>SISWA</th>
													<th>TENTOR</th>
													<th>JAM</th>
													<th>TANGGAL</th>
													<th>BIDANG STUDI</th>
													<!-- <th>KETERANGAN</th> -->
													<th>TEMPAT</th>
													<th>PERTEMUAN</th>
													<!-- <th>STATUS</th> -->
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
		material.drawSiswa();
		material.drawTentor();
		material.drawMapel();
		material.grid = $("#myTable").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?php echo base_url('master/Con_jadwal/getData') ?>",
				"type": "POST",
				"data": function(d){ 
					d['filtervalue'] = material.FilterValue();
					d['filtertext'] = material.FilterText();
					return d; 
				},
				"dataSrc": function (json) {
					// json.draw = 1;
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
			{"data": "Siswa"},
			{"data": "Tentor"},
			{"data": "waktuKursus"},
			{"data": "tglKursus"},
			{"data": "namaBidangStudi"},
			// {"data": "keterangan"},
			{"data": "tempatKursus"},
			{"data": "pertemuan_ke"},
			// {"data": "statusKursus"},
			{
				"data": "idapp_kursus",
				"render": function( data, type, full, meta){
					return "<button class='btn btn-sm btn-info' onClick='material.selectdata(\""+data+"\")'><i class='fa fa-pencil'></i></button> &nbsp; <button  id='sa-warning' class='btn btn-sm btn-danger' onClick='material.remove(\""+data+"\")' id='sa-warning' ><i class='fa fa-trash'></i></button>";
				}
			}
			],
		});
		model.Processing(false);
	});
</script>