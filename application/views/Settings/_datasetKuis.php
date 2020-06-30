<script>

	model.masterModel = { 
		id_kuis: "",
		kuis_kategoriKuisId: 0,
		namaKuis: "",
		keterangan: "",
		icon: "",
		src: "",
		kategoriKuisId: 0,
		kategoriKuis: "",
		folProjek:"1",

		id_kategori_kuis:1,
		nama:"",
		idIcons:"",
		namaIcon:"",
		src:"",
	}

	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel), 
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		DataFilter: ko.observableArray(['namaKuis']),
		FilterValue: ko.observable('namaKuis'),
		url: ko.observable("src"),
	}
	

	material.drawIcons = function(){
		$("input[name=txtIcons]").tokenInput("<?= base_url('master/Con_setKuis/filterIcons') ?>", { 
			zindex: 700,
			allowFreeTagging: false, 
			placeholder: '', 
			tokenValue: 'idIcons',
			propertyToSearch: "namaIcon",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.idIcons(item.idIcons);
				po.namaIcon(item.namaIcon);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.idIcons("");
				po.namaIcon("");
				po.src("");
			},
			resultsFormatter: function(item){
				var url = '<?= base_url();?>';
				return "<li><img src='"+url+"/assets/icons/"+item.src+"' width='5%' />"+item.namaIcon+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}  

	material.back = function(tab){
		material.Mode('');
		material.grid.ajax.reload( null, false );
		$("input[name=txtKODEBARANG]").attr("disabled", false);
		ko.mapping.fromJS(model.masterModel, material.Recordmaterial);
		$("input[name=txtIcons]").tokenInput('clear');
		$("input[name=txtIcons]").tokenInput('destroy');
		material.drawIcons();
		model.activetab(tab);
	}  

	material.selectdata = function(id) {
		material.back(0);
		material.Mode("Update"); 
		// $("input[name=txtKODEBARANG]").attr("disabled", true);
		$.ajax({
			url: "<?= site_url('master/Con_setKuis/getDataSelect') ?>",
			type: 'post',
			dataType: 'json',
			data : {id: id},
			success : function(res) {
                // console.log(res);
                ko.mapping.fromJS(res[0], material.Recordmaterial);
                var itemSelect = {
                	idIcons: res[0].idIcons,
                	namaIcon: res[0].namaIcon
                }
                $("input[name=txtIcons]").tokenInput("add", itemSelect);
            }
        });
	}

	material.save = function(){
		model.Processing(true);
		var url = "<?= base_url('master/Con_setKuis/save') ?>";
		if(material.Mode() === 'Update')
			url = "<?= base_url('master/Con_setKuis/update') ?>";

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
					text: "Data Field Kode Barang Sudah Ada!",
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
				ajaxPost("<?= base_url('master/Con_setKuis/delete') ?>", {id: id}, function (res) {
					material.back(1);
					swal("Deleted!", "Deleted <?= $title; ?>", "success");
				});
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
										<button class="btn btn-sm btn-danger" data-bind="click:function(){remove(Recordmaterial.KODEBARANG());}, visible: Mode() == 'Update'"><span class="glyphicon glyphicon-trash"></span><i class="fa fa-trash"></i> Hapus</button>
									</div>
								</div>
							</div>
							<div class="row p-t-23 " data-bind="with:Recordmaterial" >    
								<div class="col-md-6 margMin">
									<div class="form-group ">
										<!-- <label class="control-label">id</label> -->
										<!-- <input type="test" name="txtid_kuis" data-bind="value:id_kuis, checkData: 'Con_supports/checkData'" id="" required="" class="form-control">  -->
										<!-- <div class="form-control-feedback" data-bind="visible: model.CheckId()==true">ID Sama</div>  -->
									</div>
								</div>
								<div class="col-md-12 margMin">
									<label class="control-label">JUDUL</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon3"><i class="ti ti-text"></i></span>
										<input type="text" name="txtnamaKuis" data-bind="value:namaKuis" id="" required="" class="form-control">
									</div>
								</div>

								<div class="col-md-6 margBottom">
									<div class="form-group ">
										<input type="hidden" name="txtid_kategori_kuis" data-bind="value:id_kategori_kuis" id="" required="" class="form-control">
									</div>
								</div>
								<div class="col-md-6 margBottom">
								</div>

								<div class="col-md-9 margBottom">
									<label class="control-label">KETERANGAN</label>
									<div class="input-group ">
										<span class="input-group-addon" id="basic-addon3"><i class="ti ti-align-justify"></i></span>
										<textarea type="text" name="txtketerangan" data-bind="value:keterangan" id="" rows="10" required="" class="form-control"></textarea> 
									</div>
								</div>

								<div class="col-md-6 margMin">
									<label class="control-label"><span class="form-group-addon" id="basic-addon1"></span> ICONS</label>
									<div class="form-group">
										<input type="text" name="txtIcons" data-bind="value:idIcons " id="" class="form-control form-token">
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
													<th>JUDUL</th>  
													<th>KATEGORI</th>  
													<th>KETERANGAN</th>  
													<!-- <th>ICON</th> -->
													<th class="action">ACTION</th>
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
		material.drawIcons();
		material.grid = $("#myTable").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= base_url('master/Con_setKuis/getData') ?>",
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
			{"data": "namaKuis"},
			{"data": "kategoriKuis"},
			{"data": "keterangan"},
			// {
			// 	"data": "src",
			// 	"render": function( data, type, full, meta){
			// 		return "<img width='16px' height='16px' src='http://localhost/cm-bilikilmu/assets/icons/material.Recordmaterial.src()' />";
			// 	}
			// },
			{
				"data": "id_kuis",
				"render": function( data, type, full, meta){
					return "<button class='btn btn-sm btn-info' onClick='material.selectdata(\""+data+"\")'><i class='fa fa-pencil'></i></button> &nbsp; <button  id='sa-warning' class='btn btn-sm btn-danger' onClick='material.remove(\""+data+"\")' id='sa-warning' ><i class='fa fa-trash'></i></button>"; 
				}
			}
			],
		});
	});
</script>