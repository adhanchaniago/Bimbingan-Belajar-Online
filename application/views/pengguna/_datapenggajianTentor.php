<script>
	model.masterModel = {
		idUnix: "",
		kodeKursus : "",
		idSiswa : "",
		Siswa : "",
		idTentor : "",
		Tentor : "",
		idBidangStudi : "",
		bidangStudi : "",
		statusKursus : "",
		noRek:"",
		NoTentor : "",
		metode:"",
		bonus:"",
		jumlahGaji: "",
		jumlahBonus: "",
		jumlahSesi:"",
		noRek:"",
		namaBank:"",
	}
	var material = {
		Recordmaterial: ko.mapping.fromJS(model.masterModel),
		Listmaterial: ko.observableArray([]),
		Mode: ko.observable(''),
		FilterText: ko.observable(''),
		DataFilter: ko.observableArray(['kodeKursus']),
		FilterValue: ko.observable('kodeKursus'),
	}
	material.back = function(tab){
		material.Mode('');
		material.grid.ajax.reload( null, false );
		ko.mapping.fromJS(model.masterModel, material.Recordmaterial);
		model.activetab(tab);
	}

	material.selectdata = function(id) {
		ajaxPost("<?php echo site_url('master/Con_penggajianTentor/getDataSelect') ?>", {id: id}, function (res) {
			material.back(0);
			ko.mapping.fromJS(res[0], material.Recordmaterial);
			material.Recordmaterial.metode("CASH");
			material.Recordmaterial.bonus("TB");
			$("input[id=readonly]").attr("disabled", true);
			material.Mode("InsertDetailBayar");
		});
	}


	material.bayarGaji = function(id){
		swal({ title: "Bayar Gaji!",
			text: "Data Penggajian Tentor ",
			icon: "success",
		});
	}
	material.save = function(){
		model.Processing(true);
		// var url = "<?php echo base_url('master/C_kategori/save') ?>";
		if(material.Mode() === 'InsertDetailBayar')
			url = "<?php echo base_url('master/Con_penggajianTentor/InsertDetailBayar') ?>";
		ajaxPost(url, material.Recordmaterial, function (res) {
			// if (material.Mode() == "InsertDetailBayar"){
				if (material.Mode() == "InsertDetailBayar") { 
					// material.back("");
					swal({ title: "Good job!",
						text: "Data Penggajian berhasil dilakukan..!  ",
						icon: "success",
					});
				}
			// }
			model.Processing(false);
			material.back(1);
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
		<div class="col-md-2 ">
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
					<div class="tab-pane" id="tabform">
						<div class="card-body p-20 animated fadeIn m">
							<div class="row p-t-23 margMin" >
								<div class="col-md-12 margMin">
									<div class="form-group ">
										<button class="btn btn-sm btn-primary" data-bind="click:function(){back(1);}, visible: Mode() == 'InsertDetailBayar'" data-toggle="tooltip" data-placement="top" data-original-title="Kembali"><span class="glyphicon glyphicon-chevron-left" ></span><< Kembali</button>
										<button class="btn btn-sm btn-info" data-bind="click:save" data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Simpan</span></button>
									</div>
								</div>
							</div>
							<div class="row p-t-23 " data-bind="with:Recordmaterial" >  
								<div class="col-md-3 margMin">
									<div class="form-group ">
										<label class="control-label">KODE KURSUS</label>
										<input type="text" name="txtkodeKursus" data-bind="value:kodeKursus" id="readonly" class="form-control">
									</div> 
								</div>  
								<div class="col-md-3 margMin">
									<div class="form-group ">
										<label class="control-label">NAMA SISWA</label>
										<input type="text" name="txtSiswa" data-bind="value:Siswa" id="readonly" class="form-control">
									</div> 
								</div>
								<div class="col-md-3 margMin">
									<div class="form-group ">
										<label class="control-label">NAMA BIDANG STUDI</label>
										<input type="text" name="txtbidangStudi" data-bind="value:bidangStudi" id="readonly" class="form-control">
									</div> 
								</div>
								<div class="col-md-3 margMin">
									<div class="form-group ">
										<label class="control-label">JUMLAH SESI</label>
										<input type="text" name="txtjumlahSesi" data-bind="value:jumlahSesi" id="readonly" class="form-control">
									</div> 
								</div>
								<!-- <div class="col-md-4 margMin"></div> -->

								<div class="form-group col-md-6 margList ">
									<div class="form-group ">
										<label class="control-label">METODE</label> 
										<div class="demo-radio-button"> 
											<input name="txtmetode" type="radio" value="CASH" data-bind="checked: metode" id="radio_40" class="with-gap radio-col-light-blue">
											<label for="radio_40">CASH</label>
											<input name="txtmetode" type="radio" value="TF" data-bind="checked: metode" id="radio_39" class="with-gap radio-col-light-blue">
											<label for="radio_39">TF</label>
										</div>
									</div>
								</div>

								<div class="form-group col-md-6 margList ">
									<div class="form-group ">
										<label class="control-label">BONUS</label> 
										<div class="demo-radio-button">
											<input name="txtbonus" type="radio" value="TB" data-bind="checked: bonus" id="radio_42" class="with-gap radio-col-light-blue">
											<label for="radio_42">TIDAK</label>
											<input name="txtbonus" type="radio" value="B" data-bind="checked: bonus" id="radio_41" class="with-gap radio-col-light-blue">
											<label for="radio_41">BERI</label>
										</div>
									</div>
								</div>

								<div class="col-md-3 margMin" >
									<label class="control-label">GAJI</label>
									<div class="input-group ">
										<input type="number" name="txtjumlahGaji" data-bind="value:jumlahGaji" placeholder="Jumlah Gaji..!" id="" required="" class="form-control"> 
									</div>
								</div>

								<div class="col-md-3 margMin" data-bind=" visible: material.Recordmaterial.bonus() == 'B' ">
									<div class="form-group ">
										<label class="control-label">JUMLAH BONUS</label>
										<input type="number" name="jumlahBonus" data-bind="value:jumlahBonus" placeholder="Jumlah Bonus..!" id="" class="form-control">
									</div>
								</div>



								<div class="col-md-3 margMin" data-bind="visible: material.Recordmaterial.metode() == 'TF' ">
									<div class="form-group ">
										<label class="control-label">KODE BANK</label>
										<input type="text" name="txtnamaBank" data-bind="value:namaBank" placeholder="Nomor Rekening...!" id="readonly" class="form-control">
									</div>
								</div>

								<div class="col-md-3 margMin" data-bind="visible: material.Recordmaterial.metode() == 'TF' ">
									<div class="form-group ">
										<label class="control-label">NO. REK</label>
										<input type="number" name="noRek" data-bind="value:noRek" placeholder="Nomor Rekening...!" id="readonly" class="form-control">
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
													<th>KODE KURSUS</th>
													<th>TENTOR</th>
													<th>SISWA</th>
													<th>BIDANG STUDI</th>
													<th>NOMOR</th>
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
				"url": "<?php echo base_url('master/Con_penggajianTentor/getData') ?>",
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
			{"data" : "kodeKursus"},
			{"data" : "Tentor"},
			{"data" : "Siswa"},
			{"data" : "bidangStudi"},
			{"data" : "NoTentor"},
			{
				"data": "idUnix",
				"render": function( data, type, full, meta){
					return "<button class='btn btn-sm btn-info' onClick='material.selectdata(\""+data+"\")'><i class='fa fa-cur'></i> Bayar Gaji </button>";
				}
			}
			],
		});
		model.Processing(false);
	});
</script>

<!-- <button class='btn btn-sm btn-warning' onClick='material.selectdata(\""+data+"\")'><i class='fa fa-cur'></i> Edit</button> -->