<script>
	model.masterModel = {
		id_bidangStudi:0,
		namaBidangStudi:"",
		kategoriStudi:"",
		jenjang:"",
		hargaperSesi:0,
		selectKategori:[
		{ name: 'Pilih kategori', value: '-', kelompok: '-'},
		{ name: 'SD', value: 'SD', kelompok: '1' },
		{ name: 'SMP', value: 'SMP', kelompok: '1' },
		{ name: 'SMA (IPA)', value: 'IPA', kelompok: '1'},
		{ name: 'SMA (IPS)', value: 'IPS', kelompok: '1'},
		{ name: "QUR'AN", value: 'QURAN', kelompok: '2'}
		],		
	}
	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		DataFilter: ko.observableArray(['namaBidangStudi']),
		FilterValue: ko.observable('namaBidangStudi'),
		
	}
	material.back = function(tab){
		material.Mode('');
		material.grid.ajax.reload( null, false );
		// $("input[name=txtKODEBidangStudi]").attr("disabled", false);
		material.Recordmaterial.kategoriStudi('-');
		ko.mapping.fromJS(model.masterModel, material.Recordmaterial);
		model.activetab(tab);
	}
	material.selectdata = function(id) {
		ajaxPost("<?php echo site_url('settings/Con_BidangStudi/getDataSelect') ?>", {id: id}, function (res) {
			material.back(0);
			// $("input[name=txtKODEBidangStudi]").attr("disabled", true);
			ko.mapping.fromJS(res[0], material.Recordmaterial);
			material.Mode("Update");
		});
	}
	material.save = function(){
		model.Processing(true);
		var url = "<?= base_url('settings/Con_BidangStudi/save') ?>";
		swal({
			title: "Data Akan disimpan setelah konfirmasi Yes.",
			text: "Apakah data sudah benar??",
			type: "info",
			showCancelButton: true, /* button cancel*/
			closeOnConfirm: false,
			showLoaderOnConfirm: true, /* button Yes*/
		}, function () {
			setTimeout(function(){
				swal({ title: "Good job!",
					text: "Added new <?= $title ?>!",
					icon: "success", /* sukses simpan / update */
				});
			}, 2000);
			if (showLoaderOnConfirm=true) {
				if(material.Mode() === 'Update')
					url = "<?= base_url('settings/Con_BidangStudi/update') ?>";
				ajaxPost(url, material.Recordmaterial, function (res) {
					if (res.result == "OK" || material.Mode() == "Update"){
						if (res.result == "OK") { 
							material.back(0);
						} 
						if (material.Mode() == "Update") { 
							material.back(0);
						}
					}
					model.Processing(false); /* end proses simpan / update*/
				});
			}
		});
		model.Processing(false); /* for process cancel button  */

		if (material.Recordmaterial.namaBidangStudi()=="") {
			swal({ title: "Warning!",
				text: "Data Field masih Kosong!",
				icon: "warning",
			});
		} /* end proccess jika kosong */
	}
	material.remove = function(id){
		// model.Processing(true);
		swal({
			title: "Are you sure?",
			text: "Delete this data !",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes!",
			cancelButtonText: "No!",
			closeOnConfirm: false,
		}, function(isConfirm){
			if (isConfirm) {
				ajaxPost("<?php echo base_url('settings/Con_BidangStudi/delete') ?>", {id: id}, function (res) {
					material.back(1);
					swal("Deleted!", "Deleted <?= $title; ?>", "success");
				});
			} // model.Processing(false);
		});
	}
	material.filtermaterial = function() {
		material.grid.ajax.reload();
	}
	material.filterreset = function() {
		material.FilterText('');
		material.grid.ajax.reload();
	}
</script>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
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
										<button class="btn btn-sm btn-danger" data-bind="click:function(){remove(Recordmaterial.id_bidangStudi());}, visible: Mode() == 'Update'"><span class="glyphicon glyphicon-trash"></span><i class="fa fa-trash"></i> Hapus</button>
									</div>
								</div>
							</div>
							<div class="row p-t-23 " data-bind="with:Recordmaterial" >  
								
								<div class="col-md-3 margMin">
									<div class="form-group ">
										<label class="control-label">BIDANG STUDI</label>
										<input type="text" name="txtnamaBidangStudi" data-bind="value:namaBidangStudi, checkId: 'settings/Con_BidangStudi/checkId'"" id="" required="" class="form-control">
										<div class="form-control-feedback" data-bind="visible: model.CheckId()==true">Data Sama</div>
									</div>
								</div>

								<div class="col-md-3 margMin">
									<div class="form-group ">
										<label class="control-label">KATEGORI</label>
										<select name="txtkategoriStudi" data-bind="
										options: selectKategori,
										optionsText: 'name',
										optionsValue: 'value',
										value:kategoriStudi"
										class="custom-select col-3" id="inlineFormCustomSelect">
									</select>
								</div>
							</div>

							<div class="col-md-3 margMin">
								<div class="form-group ">
									<label class="control-label">JENJANG</label>
									<input type="text" name="txtjenjang" data-bind="value:jenjang" id="" required="" class="form-control">
								</div>
							</div>

							<div class="col-md-3 margMin">
								<div class="form-group ">
									<label class="control-label">HARGA PER SESI</label>
									<input type="text" name="txthargaperSesi" data-bind="value:hargaperSesi" id="" required="" class="form-control">
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="tab-pane" id="tablist">
					<div class="card-body p-20" data-bind="with:material">
						<div class="row p-t-23 " >
							<!-- filter -->
							<div class="col-md-3 margFilter">
								<div class="form-group ">
									<input data-bind="value:FilterText" id="" placeholder="Filter by name" class="form-control">
								</div>
							</div>
							<div class="col-md-2 margFilter">
								<div class="form-group ">
									<button class="btn btn-xl btn-primary" data-bind="click:filtermaterial"><span class="glyphicon glyphicon-search"></span> Filter</button>
									<button class="btn btn-xl btn-warning" data-bind="click:filterreset"><span class="glyphicon glyphicon-search"></span> Reset</button>
								</div>
							</div>
							<!-- ./filter -->
							<div class="col-md-12 ">
								<div class="table-responsive m-t-40 animated fadeIn">
									<table id="myTable" width="100%" class="table table-bordered table-striped ">
										<thead>
											<tr>
												<th>NAMA</th>
												<th>KATEGORI</th>
												<th>JENJANG</th>
												<th>HARGA</th>
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
		material.grid = $("#myTable").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?php echo base_url('settings/Con_BidangStudi/getData') ?>",
				"type": "POST",
				"data": function(d){ 
					d['filtervalue'] = material.FilterValue();
					d['filtertext'] = material.FilterText();
					return d; 
				} ,
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
			{"data": "namaBidangStudi"},
			{"data": "kategoriStudi"},
			{"data": "jenjang"},
			{"data": "hargaperSesi"}, 
			{
				"data": "id_bidangStudi",
				"render": function( data, type, full, meta){
					return "<button class='btn btn-sm btn-info' onClick='material.selectdata(\""+data+"\")'><i class='fa fa-pencil'></i></button> &nbsp; <button  id='sa-warning' class='btn btn-sm btn-danger' onClick='material.remove(\""+data+"\")' id='sa-warning' ><i class='fa fa-trash'></i></button>"; 
				}
			}
			],
		});
		model.Processing(false);
	});
</script>