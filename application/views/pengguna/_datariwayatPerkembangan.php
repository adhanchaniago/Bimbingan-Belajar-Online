<script>
	model.masterModel = {
		idDperkembangan: "",
		kodeKursus_detailKursus: "",
		bidangStudi: "",
		indikator: "",
		nilai: "",
		tglinserts: "",
	}
	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		DataFilter: ko.observableArray(['idDperkembangan']),
		FilterValue: ko.observable('idDperkembangan'),
	}
	material.back = function(tab){
		material.Mode('');
		material.grid.ajax.reload( null, false );
		$("input[name=idDperkembangan]").attr("disabled", false);
		ko.mapping.fromJS(model.masterModel, material.Recordmaterial);
		model.activetab(tab);
	}
	material.selectdata = function(id) {
		ajaxPost("<?php echo site_url('master/Con_riwayatBelajarSiswa/getDataSelect') ?>", {id: id}, function (res) {
			material.back(0); /* */
			$("input[name=idDperkembangan]").attr("disabled", true); /* fungsi disable sebuah field inputan berdasarkan 'name' nya .*/
			ko.mapping.fromJS(res[0], material.Recordmaterial);
			material.Mode("Update");
		});
	}
	material.save = function(){
		model.Processing(true);
		var url = "<?php echo base_url('master/Con_riwayatBelajarSiswa/save') ?>";
		if(material.Mode() === 'Update')
			url = "<?php echo base_url('master/Con_riwayatBelajarSiswa/update') ?>";
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
					text: "Data Field Kode Sama!",
					icon: "warning",
				});
			}
			model.Processing(false);
		});
	}
	material.remove = function(id){
		model.Processing(true);
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
				ajaxPost("<?php echo base_url('master/Con_riwayatBelajarSiswa/delete') ?>", {id: id}, function (res) {
					material.back(1);
					swal("Deleted!", "Deleted <?= $title; ?>", "success");
				});
			}
			model.Processing(false);
		});
	}

</script>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
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
					<a href="<?= base_url(); ?>Adminz">
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
		<div class="col-2 ">
			<?php $this->load->view('template/_sidebar'); ?>
		</div>
		<!-- ============================================================== -->
		<!-- Right sidebar -->
		<!--   -   -->
		<!-- End Right sidebar -->
		<!-- ============================================================== -->
		<div class="col-md-10">
			<div class="card card card-body p-b-0" data-bind="with:material">  
				<div class="col-md-5 align-self-left">
					<h3 class="text-themecolor"><?= $title ?></h3>
				</div>          
				<!-- Nav tabs -->
				<ul class="nav nav-tabs customtab" id="tabnavform">
				
					<li class="nav-item"><a class="nav-link" href="#tablist" data-toggle="tab">List</a></li>
				</ul>
				<!-- End Nav tabs -->
				<div class="content tab-content" id="tabnavform-content">
					<div class="tab-pane active" id="tabform">
						
						<!-- list data  -->
						<div class="tab-pane" id="tablist">
							<div class="card-body p-20" data-bind="with:material">
								<div class="row p-t-23 " >
								<!-- <div class="col-md-4 margFilter">
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
								</div> -->
								<div class="col-md-12 ">
									<div class="table-responsive m-t-40 animated fadeIn">
										<table id="myTable" width="100%" class="table table-bordered table-striped ">
											<thead>
												<tr> 
													<th>Indikator</th>
													<th>Kategori Indikator</th>
													<th>Tentor</th>
													<th>Siswa</th>
													<th>ACTION</th>
												</tr>
											</thead><!-- ./ head or list data  -->
										</table>
									</div>
								</div>
							</div>
						</div> <!--  ./ end material -->
					</div><!-- ./ end list data  -->
				</div><!-- ./ end tab-content -->

			</div><!-- ./ end material -->
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
				"url": "<?php echo base_url('master/Con_riwayatBelajarSiswa/getData') ?>",
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
			{"data": "indikator"}, 
			{"data": "KategoriIndikator"}, 
			{"data": "Tentor"}, 
			{"data": "siswa"}, 

			{
				"data": "idDperkembangan", /*-- isikan Id primary_key dari data yang di sebutkan di model --*/
				"render": function( data, type, full, meta){
					return "<button class='btn btn-sm btn-info' onClick='material.selectdata(\""+data+"\")'><i class='fa fa-eye'></i></button> &nbsp; "; 
				}
			}
			],
		});
		model.Processing(false);
	});
</script>