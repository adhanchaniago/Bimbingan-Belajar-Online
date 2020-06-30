<script>
	model.masterModel={
		userid:"",
		username:"",
		password:"",
		repassword:"",

		penggunaId:"",
		namaDepan:"",
		namaBelakang:"",
		role:"",
		tb_pengguna_penggunaid:"",
		imgUrl:"",
		foto:'',
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
		ko.mapping.fromJS(model.masterModel, material.Recordmaterial);
		$("input[name=txtpenggunaId]").tokenInput('destroy');
		material.drawUserPengguna();
		model.activetab(tab);
	}

	material.Check = function(){
		if (material.Recordmaterial.password() == material.Recordmaterial.repassword()) {
			swal({ title: "Warning!",
				text: "Password Cocok!",
				icon: "warning",
			});
		}
		swal({ title: "Warning!",
			text: "Password tidak Cocok!",
			icon: "warning",
		});

	}

	material.selectdata = function(id) {
		material.back(0);
		material.Mode("Update");
		$.ajax({
			url: "<?php echo site_url('master/Con_dataUsersLogin/getDataSelectForAddFoto') ?>",
			type: 'post',
			dataType: 'json',
			data : {id: id},
			success : function(res) {
				ko.mapping.fromJS(res[0], material.Recordmaterial);
				var itemSelect = {
					namaDepan: res[0].namaDepan,
					penggunaId: res[0].penggunaId,
				}
				$("input[name=txtpenggunaId]").tokenInput("add", itemSelect);
				// $("input[name=txtpenggunaId]").attr("disabled", true);
			}
		});
	}


	material.selectdataToAddFoto = function(id) {
		// material.back(0);
		// material.Mode("Update");
		// material.modal();
		$.ajax({
			url: "<?php echo site_url('master/Con_dataUsersLogin/getDataSelect') ?>",
			type: 'post',
			dataType: 'json',
			data : {id: id},
			success : function(res) {
				ko.mapping.fromJS(res[0], material.Recordmaterial);
				var itemSelect = {
					namaDepan: res[0].namaDepan,
					penggunaId: res[0].penggunaId,
				}
				$("input[name=txtpenggunaId]").tokenInput("add", itemSelect);
				// $("input[name=txtpenggunaId]").attr("disabled", true);
			}
		});
	}

	material.save = function(){
		model.Processing(true);
		var url = "<?php echo base_url('master/Con_dataUsersLogin/save') ?>";
		if(material.Mode() === 'Update')
			url = "<?php echo base_url('master/Con_dataUsersLogin/update') ?>";

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
				ajaxPost("<?php echo base_url('master/Con_dataUsersLogin/delete') ?>", {id: id}, function (res) {
					material.back(1);
					swal("Deleted!", "Deleted <?= $title; ?>", "success");
				});
			}
		});
	}

	material.drawUserPengguna = function(){
		$("input[name=txtpenggunaId]").tokenInput("<?= base_url('master/Con_dataUsersLogin/filterUserPengguna') ?>", {
			zindex: 700,
			allowFreeTagging: false,
			placeholder: '',
			tokenValue: 'penggunaId',
			propertyToSearch: "namaDepan",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.namaDepan(item.namaDepan);
				po.penggunaId(item.penggunaId);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.namaDepan("");
				po.penggunaId("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.namaDepan+" "+item.namaBelakang+" - "+item.role+"</li>"
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
					<li class="nav-item"><a class="nav-link active" href="#tablist" data-toggle="tab">List</a></li>
				</ul>
				<!-- End Nav tabs -->
				<div class="content tab-content" id="tabnavform-content">
					<div class="tab-pane" id="tabform">
						<div class="card-body p-20 animated fadeIn m">
							<div class="row p-t-23 margMin" >
								<div class="col-md-12 margMin">
									<div class="form-group ">
										<button class="btn btn-sm btn-primary" data-bind="click:function(){back(1);}, visible: Mode() == 'Update'" data-toggle="tooltip" data-placement="top" data-original-title="Kembali"><span class="glyphicon glyphicon-chevron-left" ></span><< Kembali</button>
										<button class="btn btn-sm btn-info" data-bind="click:save" data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Simpan</span></button>
										<button class="btn btn-sm btn-danger" data-bind="click:function(){remove(Recordmaterial.userid());}, visible: Mode() == 'Update'"><span class="glyphicon glyphicon-trash"></span><i class="fa fa-trash"></i> Hapus</button>
										<button class="btn btn-sm btn-default" data-bind="visible: Mode() == 'Update'"><span class="glyphicon glyphicon-trash"></span>Nama: <span data-bind="text: material.Recordmaterial.namaDepan()"></span></button>
									</div>
								</div>
							</div>
							<div class="row p-t-23 " data-bind="with:Recordmaterial" >


								<div class="form-group margMin col-md-6 " data-bind="if: material.Mode() !== 'Update' ">
									<label class="control-label">Nama Pengguna </label>
									<div class="form-group ">
										<input type="text" name="txtpenggunaId" data-bind="value:penggunaId" id="" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 " data-bind="if: material.Mode() === 'Update' "></div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">
										<label class="control-label">Username app</label>
										<input type="text" name="txtusername" data-bind="value:username" id="username" required="" class="form-control">
									</div>
								</div>

								<div class="form-group margMin col-md-6 ">
									<div class="form-group ">  
										<label class="control-label">Password</label>
										<input  name="txtpassword" data-bind="value: password" id="password" onkeyup="document.getElementById('password').type = 'password'" required="" class="form-control">
									</div>
								</div>

								<!-- <div class="form-group margMin col-md-4 ">
									<div class="form-group ">  
										<label class="control-label">Image</label>
										<input type="file" name="txtimgUrl" data-bind="value: imgUrl" id="" required="" class="form-control">
									</div>
								</div> -->


								<!-- <div class="form-group margMin col-md-4 ">
									<form method="post" enctype="multipart/form-data">
										<div class="form-group ">  
											<label class="control-label">Image</label>
											<input type="file" name="txtfoto" id="file" data-bind="file: {data: fileInput, reader: someReader}" class="form-control">
										</div>
									</form>
								</div> -->

							</div>
						</div>
					</div>
					<div class="tab-pane active" id="tablist">
						<div class="card-body p-20" data-bind="with:material">
							<div class="row p-t-23" >
								<!-- BUTTON ADD -->
								<div class="col-md-12 margMin">
									<div class="form-group m">
										<button class="btn btn-sm btn-info" type="button" class="btn btn-info" data-toggle="modal" data-target="#tambah-User">
											<span>ADD DATA</span>
										</button>
									</div>
								</div>
								<!-- END ./BUTTON ADD -->

								<div class="col-md-12 ">
									<div class="table-responsive m-t-40 animated fadeIn">
										<table id="myTable" width="100%" class="table table-bordered table-striped ">
											<thead>
												<tr class="text-center">
													<th width="15%">NAMA</th>
													<th width="20%">USERNAME</th>
													<th width="10%">ROLE</th>
													<th width="15%">ACTION</th>
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
		material.drawUserPengguna();
		material.grid = $("#myTable").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?php echo base_url('master/Con_dataUsersLogin/getData') ?>",
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
			{"data": "namaDepan"},
			{"data": "username"},
			{"data": "role"},
			{
				"data": "userid",
				"render": function( data, type, full, meta){
					return "<button class='btn btn-sm btn-info' onClick='material.selectdata(\""+data+"\")'><i class='fa fa-pencil'></i> Ubah User</button> &nbsp; <button  id='sa-warning' class='btn btn-sm btn-danger' onClick='material.remove(\""+data+"\")' id='sa-warning' ><i class='fa fa-trash'></i></button>"; 
				}
			}
			],
		});
	});
</script>

<!-- mengambil data modal -->
<?php echo $modal_tambah_data; ?>

<div id="tempat-modal"></div>

<?php $this->load->view('modals/modal_update_user');?>