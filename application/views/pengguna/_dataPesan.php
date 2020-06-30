<script>
	model.masterModel = {
		id_kritiksaran:"",
		role:"",
		namaDepan:"",
		noWa:0,
		isikritiksaran:"",
		setatus:"",
	}
	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		DataFilter: ko.observableArray(['','New','Arsip']),
		FilterValue: ko.observable('setatus'),
	}
	material.back = function(tab){
		material.Mode('');
		material.grid.ajax.reload( null, false );
		$("input[name=txtid]").attr("disabled", false);
		ko.mapping.fromJS(model.masterModel, material.Recordmaterial);
		model.activetab(tab);
	}
	material.selectdata = function(id) {
		ajaxPost("<?php echo site_url('master/Con_kritikSaran/getDataSelect') ?>", {id: id}, function (res) {
			material.back(0);
			// $("input[name=txtid_kritiksaran]").attr("disabled", true);
			ko.mapping.fromJS(res[0], material.Recordmaterial);
			material.Mode("Update");
		});
	}
	material.save = function(){
		model.Processing(true);
		var url = "<?php echo base_url('master/Con_kritikSaran/save') ?>";
		if(material.Mode() === 'Update')
			url = "<?php echo base_url('master/Con_kritikSaran/update') ?>";
		ajaxPost(url, material.Recordmaterial, function (res) {
			if (res.result == "OK" || material.Mode() == "Update"){
				if (res.result == "OK") { 
					material.back(0);
					swal({ title: "Good job!",
						text: "Added new <?= $title ?>!",
						icon: "success",
					});
				} 
				if (material.Mode() == "Update") { 
					material.back(0);
					swal({ title: "Good job!",
						text: "Updated <?= $title ?>!",
						icon: "success",
					});
				}
			} else {
				swal({ title: "Warning!",
					text: "Data sudah ada!",
					icon: "warning",
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
				ajaxPost("<?php echo base_url('master/Con_kritikSaran/delete') ?>", {id: id}, function (res) {
					material.back(1);
					swal("Deleted!", "Deleted <?= $title; ?>", "success");
				});
			} // model.Processing(false);
		});
	}
	material.filtermaterial = function(){
		material.grid.ajax.reload();
	}
	material.filterreset = function(){
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
					<li class="nav-item"><a class="nav-link" href="#tabform" data-toggle="tab">Form</a></li>
					<li class="nav-item"><a class="nav-link active" href="#tablist" data-toggle="tab">List</a></li>
				</ul>
				<!-- End Nav tabs -->
				<div class="content tab-content" id="tabnavform-content">
					<div class="tab-pane " id="tabform">
						<div class="card-body p-20 animated fadeIn m">
							<div class="row p-t-23 margMin" >
								<div class="col-md-12 margMin">
									<div class="form-group ">
										<button class="btn btn-sm btn-primary" data-bind="click:function(){back(1);}, visible: Mode() == 'Update'" data-toggle="tooltip" data-placement="top" data-original-title="Kembali"><span class="glyphicon glyphicon-chevron-left" ></span><< Kembali</button>
										<button class="btn btn-sm btn-info" data-bind="click:save" data-toggle="tooltip" data-placement="top" data-original-title="arsip" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Arsipkan</span></button>
										<button class="btn btn-sm btn-danger" data-bind="click:function(){remove(Recordmaterial.id_kritiksaran());}, visible: Mode() == 'Update'"><span class="glyphicon glyphicon-trash"></span><i class="fa fa-trash"></i> Hapus</button>
									</div>
								</div>
							</div>
							<div class="row p-t-23 " data-bind="with:Recordmaterial" >  

								<div class="col-md-5 margMin">
									<label class="control-label">NAMA</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon3"><i class="ti ti-email"></i></span>
										<input type="text" name="txtnamaDepan" data-bind="value:namaDepan" id="" readonly="" class="form-control">
									</div>
								</div>

								<div class="col-md-8 margMin">
									<label class="control-label">Kritik Saran</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon3"><i class="icon icon-size-fullscreen"></i></span>
										<textarea type="text" name="txtisikritiksaran" data-bind="value:isikritiksaran" rows="7" readonly="" class="form-control"></textarea> 
									</div>
								</div>

								<div class="col-md-6 margBottom">
									<label class="control-label">NO WHATSAPP 02</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon3"><i class="icon icon-screen-smartphone"></i></span>
										<input type="number" name="txtnoWa" data-bind="value:noWa" id="" readonly="" class="form-control"> 
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="tab-pane active" id="tablist">
						<div class="card-body p-20" data-bind="with:material">
							<div class="row p-t-23">
								<!-- Filter -->
								<div class="col-md-4 margFilter">
									<div class="input-group ">
										<label class="col-sm-4 text-left control-label col-form-label lstat">Status : </label>
										<select style="width:150px;" class="form-input form-control filter-textinline" data-bind="value: FilterText, foreach:DataFilter ">
											<option data-bind="html:$data,attr:{'value':$data}"></option>
										</select>
									</div>
								</div>
								<div class="col-md-2 margFilter" style="padding-left: -20px">
									<div class="form-group ">
										<button class="btn btn-xl btn-primary" data-bind="click:filtermaterial"><span class="glyphicon glyphicon-search"></span> Filter</button>
										<button class="btn btn-xl btn-warning" data-bind="click:filterreset"><span class="glyphicon glyphicon-search"></span> Reset</button>
									</div>
								</div>
								<!-- ./Filter -->
								<div class="col-md-12 ">
									<div class="table-responsive m-t-40 animated fadeIn">
										<table id="myTable" width="100%" class="table table-bordered table-striped ">
											<thead>
												<tr> 
													<th>PENGIRIM</th>
													<th>ROLE</th>
													<th>NOMOR</th>
													<th>STATUS</th>
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
				"url": "<?php echo base_url('master/Con_kritikSaran/getData') ?>",
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
			{"data": "namaDepan"},
			{"data": "role"},
			{"data": "noWa"},
			{"data": "setatus"},
			{
				"data": "id_kritiksaran",
				"render": function( data, type, full, meta){
					return "<button class='btn btn-sm btn-info' onClick='material.selectdata("+data+")'><i class='fa fa-eye'></i></button> &nbsp; <button  id='sa-warning' class='btn btn-sm btn-danger' onClick='material.remove("+data+")' id='sa-warning' ><i class='fa fa-trash'></i></button>";
				}
			}
			],
		});
		model.Processing(false);
	});
</script>