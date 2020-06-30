<script>
	model.masterModel = {
		Tentor: "",
		Siswa: "",
		BidangStudi: "",
		noPenggajian: "",
		jumlahGaji: "",
		jumlahBonus: "",
		metodeBayar: "",
		noRek: "",
		tglBayar : moment().format("YYYY-MM-DD"),
	}
	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		DataFilter: ko.observableArray(['tglBayar']),
		FilterValue: ko.observable('tglBayar'),
		
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
		ajaxPost("<?php echo site_url('settings/Con_riwayatPenggajian/getDataSelect') ?>", {id: id}, function (res) {
			material.back(0);
			// $("input[name=txtKODEBidangStudi]").attr("disabled", true);
			ko.mapping.fromJS(res[0], material.Recordmaterial);
			material.Mode("Update");
		});
	}
	material.save = function(){
		model.Processing(true);
		var url = "<?= base_url('settings/Con_riwayatPenggajian/save') ?>";
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
					url = "<?= base_url('settings/Con_riwayatPenggajian/update') ?>";
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
				ajaxPost("<?php echo base_url('settings/Con_riwayatPenggajian/delete') ?>", {id: id}, function (res) {
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
		<div class="col-md-2 ">
			<?php $this->load->view('template/_sidebar'); ?>
		</div>
		<div class="col-md-10">
			<div class="card card card-body p-b-0" data-bind="with:material">  
				<div class="col-md-5 align-self-left">
					<h3 class="text-themecolor"><?= $title ?></h3>
				</div>          
				<!-- Nav tabs -->

				<!-- End Nav tabs -->
				<div class="content tab-content" id="tabnavform-content">

					<div class="tab-pane active" id="tablist">
						<div class="card-body p-20" data-bind="with:material">
							<div class="row p-t-23 " >
								<!-- filter -->
								<div class="col-md-3 margFilter">
									<div class="form-group ">
										<input type="date" data-bind="value:FilterText" id="" placeholder="Filter by name" class="form-control">
									</div>
								</div>
								<div class="col-md-5 margFilter">
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
													<th>NOMOR</th>
													<th>Tentor</th>
													<th>Siswa</th>
													<th>BidangStudi</th>
													<th>GAJI</th>
													<th>BONUS</th>
													<th>METODE</th>
													<th>REK</th>
													<th>DIBAYAR</th>
													<!-- <th>ACTION</th> -->
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
				"url": "<?php echo base_url('master/Con_riwayatPenggajian/getData') ?>",
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
			{"data": "noPenggajian"},
			{"data": "Tentor"},
			{"data": "Siswa"},
			{"data": "BidangStudi"},
			{"data": "jumlahGaji"},
			{"data": "jumlahBonus"},
			{"data": "metodeBayar"},
			{"data": "noRek"},
			{"data": "tglBayar"},
			],
		});
		model.Processing(false);
	});
</script>