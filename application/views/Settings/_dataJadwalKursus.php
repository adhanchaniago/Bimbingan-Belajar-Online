<script>

	model.masterModel = {
		idUnix: "",
		kodeDetailKursus_detailKursus: "",
		JumlahSesi: "",
		kodeKursus: "",
		idBidangStudi_bidangStudi: "",
		BidangStudi: "",
		idTentor_detailKursus: "",
		Tentor: "",
		idSiswa_appKursus: "",
		Siswa: "",
		// namaDepan:"", /* for filter by nama siswa*/

		jam: "",
		hari: "",
		selectHari:model.Resource.Hari,

		id_bidangStudi:0,
		namaBidangStudi:"",
		jenjang:"",
		hargaperSesi:0,
		kategoriStudi:"",

		/* for filter siswa dengan bidang kursusnya */
		kodeKursus: "",
		kodeDetailKursus: "",
		idSiswa: "",
		Siswa: "",
		BidangStudi: "",
		idBidangStudi: "",

		/* for filter select tentor */
		idTentor:"",
		Tentor:"",
		guruMapel:"",
		namaBelakangTentor:"",
		noWa: "",
	}
	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		FilterValue: ko.observable(''),
		DataFilter: ko.observableArray(['']),
		FilterValue: ko.observable('hari'),
	}
	material.back = function(tab){
		material.Mode('');
		material.grid.ajax.reload( null, false );
		material.Recordmaterial.hari("-");
		material.Recordmaterial.jam("-");
		$("input[name=txtsiswaKursus]").tokenInput("destroy");
		$("input[name=txtSelectTentor]").tokenInput("destroy");
		material.drawSiswafromKursus();
		material.drawSelectTentor();

		ko.mapping.fromJS(model.masterModel, material.Recordmaterial);
		model.activetab(tab);
	}

	material.selectdata = function(id) {
		material.back(0);
		material.Mode("Update"); 
		// $("input[name=txtKODEBARANG]").attr("disabled", true);
		$.ajax({
			url: "<?php echo site_url('settings/Con_JadwalKursus/getDataSelect') ?>",
			type: 'post',
			dataType: 'json',
			data : {id: id},
			success : function(res) {
                // console.log(res);
                ko.mapping.fromJS(res[0], material.Recordmaterial);
                var item = {
                	idSiswa: res[0].idSiswa,
                	namaBelakangSiswa: res[0].namaBelakangSiswa,
                	Siswa: res[0].Siswa,
                	BidangStudi:res[0].BidangStudi,
                	idBidangStudi:res[0].idBidangStudi,
                	idTentor:res[0].idTentor,
                	Tentor:res[0].Tentor,
                	kodeKursus:res[0].kodeKursus,
                }
                $("input[name=txtsiswaKursus]").tokenInput("add", item);
                $("input[name=txtSelectTentor]").tokenInput("add", item);
            }
        });
	}


	material.save = function(){
		model.Processing(true);
		var url = "<?= base_url('settings/Con_JadwalKursus/save') ?>";
		swal({
			title: "Sebelum data disimpan.",
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
				material.Recordmaterial.hari("-");
				material.Recordmaterial.jam("-");
				$("input[name=txtsiswaKursus]").tokenInput("destroy");
				$("input[name=txtSelectTentor]").tokenInput("destroy");
				material.back(0);
			}, 500);

			if (showLoaderOnConfirm=true) {
				if(material.Mode() === 'Update')
					url = "<?= base_url('settings/Con_JadwalKursus/update') ?>";
				ajaxPost(url, material.Recordmaterial, function (res) {
					if (material.Mode() == "Update"){
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

		if (material.Recordmaterial.idTentor()=="") {
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
				ajaxPost("<?php echo base_url('settings/Con_JadwalKursus/delete') ?>", {id: id}, function (res) {
					material.back(1);
					swal("Deleted!", "Deleted <?= $title; ?>", "success");
				});
			} // model.Processing(false);
		});
	}

	material.drawSiswafromKursus = function(){
		$("input[name=txtsiswaKursus]").tokenInput("<?php echo base_url('settings/Con_JadwalKursus/filterJadwal') ?>", { 
			zindex: 700,
			allowFreeTagging: false,
			placeholder: 'Input Type Here!!',
			tokenValue: 'idSiswa',
			propertyToSearch: "Siswa",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.kodeKursus(item.kodeKursus);
				po.kodeDetailKursus(item.kodeDetailKursus);
				po.idSiswa(item.idSiswa);
				po.Siswa(item.Siswa);
				po.BidangStudi(item.BidangStudi);
				po.idBidangStudi(item.idBidangStudi);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.kodeKursus("");
				po.kodeDetailKursus("");
				po.idSiswa("");
				po.Siswa("");
				po.BidangStudi("");
				po.idBidangStudi("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.Siswa+" "+item.namaBelakangSiswa+" - "+item.BidangStudi+"</li>"
			},
			onResult: function (results) {
				return results;
			},
			onCachedResult: function(res){
				return res;
			}
		});
	}

	material.drawSelectTentor = function(){
		$("input[name=txtSelectTentor]").tokenInput("<?php echo base_url('settings/Con_JadwalKursus/filterTentor') ?>", { 
			zindex: 700,
			allowFreeTagging: false,
			placeholder: 'Input Type Here!!',
			tokenValue: 'idTentor',
			propertyToSearch: "Tentor",
			tokenLimit: 1,
			theme: "facebook",
			onAdd: function (item) {
				var po = material.Recordmaterial;
				po.idTentor(item.idTentor);
				po.Tentor(item.Tentor);
				po.guruMapel(item.guruMapel);
			},
			onDelete: function(item){
				var po = material.Recordmaterial;
				po.idTentor("");
				po.Tentor("");
				po.guruMapel("");
			},
			resultsFormatter: function(item){
				return "<li>"+item.Tentor+" "+item.namaBelakangTentor+" - <i>"+item.guruMapel+"</i> No: "+item.noWa+"</li>"
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

								<div class="col-md-6 margMin">
									<label class="control-label">SESWA</label>
									<div class="form-group ">
										<input type="text" name="txtsiswaKursus" data-bind="value:idSiswa" id="" required="" class="form-control tokensupplier">
									</div>
								</div>

								<div class="col-md-6 margMin">
									<label class="control-label">BIDANG STUDI</label>
									<div class="form-group ">
										<input type="text" data-bind="value:BidangStudi" id="" readonly="" class="form-control tokensupplier">
									</div>
								</div>

								<div class="col-md-4 margMin">
									<label class="control-label">TENTOR</label>
									<div class="form-group ">
										<input type="text" name="txtSelectTentor" data-bind="value:idTentor" id="" required="" class="form-control">
									</div>
								</div>

								<div class="col-md-4 margMin">
									<div class="form-group ">
										<label class="control-label">HARI</label>
										<select name="txthari" data-bind="
										options: selectHari,
										optionsText: 'name',
										optionsValue: 'value',
										value:hari"
										class="custom-select col-3" id="inlineFormCustomSelect">
									</select>
								</div>
							</div>

							<div class="col-md-4 margMin">
								<div class="form-group ">
									<label class="control-label">JAM</label>
									<select name="txtjam" data-bind="
									options: model.Resource.Jam,
									optionsText: 'name',
									optionsValue: 'value',
									value:jam"
									class="custom-select col-3" id="inlineFormCustomSelect">
								</select>
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
								<input data-bind="value:FilterText" id="" placeholder="Search Hari" class="form-control">
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
											<th>SISWA</th>
											<th>BIDANG STUDI</th>
											<th>TENTOR</th>
											<th>HARI</th>
											<th>JAM</th>
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
	material.filtermaterial = function() {
		material.grid.ajax.reload();
	}
	material.filterreset = function() {
		material.FilterText('');
		material.grid.ajax.reload();
	}

	$(document).ready(function () {
		model.Processing(true);
		material.drawSiswafromKursus();
		material.drawSelectTentor();
		material.grid = $("#myTable").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?php echo base_url('settings/Con_JadwalKursus/getData') ?>",
				"type": "POST",
				"data": function(d){ 
					d['filtervalue'] = material.FilterValue();
					// d['filtersiswa'] = material.FilterSiswa();
					d['filtertext'] = material.FilterText();
					// d['filtertext'] = material.DataFilter();

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
			{"data": "Siswa"},
			{"data": "BidangStudi"},
			{"data": "Tentor"},
			{"data": "hari"},
			{"data": "jam"},
			{
				"data": "idUnix",
				"render": function( data, type, full, meta){
					return "<button class='btn btn-sm btn-info' onClick='material.selectdata(\""+data+"\")'><i class='fa fa-pencil'></i></button> &nbsp; <button  id='sa-warning' class='btn btn-sm btn-danger' onClick='material.remove(\""+data+"\")' id='sa-warning' ><i class='fa fa-trash'></i></button>"; 
				}
			}
			],
		});
		model.Processing(false);
	});
</script>