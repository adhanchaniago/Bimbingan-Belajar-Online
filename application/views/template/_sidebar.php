<!-- Column -->
<div class="card stickyside"> 
	<img class="card-img-top" src="<?= base_url()?>assets/images/background/profile-bg2.jpg" alt="Card image cap" style="max-height: 165px;">
	<div class="card-body ribbon-wrapper little-profile text-center">
		<div class="pro-img">
			<img class="" data-whatever="@mdo" src="<?= base_url()?>assets/images/logoBI.jpg" alt="user" /> 

			<!-- <a href="<?= base_url();?>setting/C_notif" data-toggle="tooltip" data-placement="right" data-original-title="Notifications" class="btn btn-circle btn-sm btn-danger mybtn"><span class="text-notif">12</span></a> -->
		</div>
		<h4 class="m-b-0 uppercase"><?= $session['namaDepan'];  ?></h4><br>
		<ul class="list-group">
			<li class="list-group-item Cinfo text-center"><span class="capital"><?= $session['namaDepan'].' '.$session['namaBelakang']; ?></span></li>
			<li class="list-group-item Cinfo2 "><span class="capital"><i><?= $session['role']; ?></i></span></li> 
			<li class="list-group-item Cinfo2 "> 
				<button onclick="window.location.replace('Admin');" type="button" class="btn btn-sm btn-success btnLogout">Dashboard</button>
				<button onclick="window.location.replace('Auth/logout');" data-toggle="tooltip" data-placement="right" data-original-title="Log Out" type="button" class="btn btn-sm btn-danger btnLogout"><i class="fa fa-power-off"></i></button> 
			</li> 
		</ul>
	</div> 
</div>
<!-- Column -->  
<div class="card stickyside">  
	<div class="ribbon-wrapper ">
		<div class="ribbon ribbon-right full ribbon-info" id="getbulan"></div><!-- bulan sekarang -->
		<div class="card-body ribbon-wrapper little-profile text-center"> 
			<br><h1 class="m-b-0 uppercase" id="gettanggal"></h1>  <!-- tanggal sekarang -->
			<br><h5 class="m-b-0 uppercase" id="gethari"></h5> <!-- hari sekarang --> 
		</div> 
	</div>
</div> 
<!-- modal ubah foto -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel1">SILAHKAN UBAH FOTO ANDA</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form> 
					<div class="form-group">
						<img class="d-flex mr-3" src="<?= base_url();?>assets/images/users/1.jpg" width="100" alt="Generic placeholder image">
					</div>
					<fieldset class="form-group">
						<label>Upload Foto</label>
						<label class="custom-file d-block">
							<input type="file" id="file" class="custom-file-input">
							<span class="custom-file-control"></span>
						</label>
					</fieldset> 
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">SAVE</button>
			</div>
		</div>
	</div>
</div>
<!-- /.modal --> 
<script type="text/javascript" >
			var d = new Date();
			// get bulan 
			var month = new Array();
			month[0] = "January";
			month[1] = "Februari";
			month[2] = "Maret";
			month[3] = "April";
			month[4] = "Mai";
			month[5] = "Juni";
			month[6] = "Juli";
			month[7] = "Agustus";
			month[8] = "September";
			month[9] = "October";
			month[10] = "Nopember";
			month[11] = "Desember"; 
			var b = month[d.getMonth()];
			document.getElementById("getbulan").innerHTML = b;
			// get tanggal 
			var t = d.getDate()
			document.getElementById("gettanggal").innerHTML = t; 
			// get hari 
			var weekday = new Array();
			weekday[0] = "Minggu";
			weekday[1] = "Senin";
			weekday[2] = "Selasa";
			weekday[3] = "Rabu";
			weekday[4] = "Kamis";
			weekday[5] = "Jumat";
			weekday[6] = "Sabtu";
			var h = weekday[d.getDay()];
			document.getElementById("gethari").innerHTML = h;
		</script>