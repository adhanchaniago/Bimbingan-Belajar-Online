
<!-- data modal add data -->

<div class="modal-header">
	<h4 class="modal-title" id="myModalLabel"><?php echo $title_modal ?></h4> 
	<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
</div>
<div class="modal-body ">

		<form action="<?= base_url('master/SetIcons/prosesPost_dataIcons'); ?>"  enctype="multipart/form-data" method="POST" class="form-horizontal form-material"  >

			<div class="form-group">

				<div class="col-xl-12 m-b-20 pad-btm">
					<div class="form-group row">
						<label for="example-text-input" class="col-md-4 col-form-label pad-left">NAMA ICON</label>
						<div class="col-md-8">
							<input type="text" name="namaIcon" id="input" class="form-control" placeholder="Type..." required="required">
						</div>
					</div>
				</div>

				<div class="col-xl-12 m-b-20 pad-btm">  
					<div class="form-group row">
						<label for="example-text-input" class="col-md-4 col-form-label pad-left">ICON</label>
						<div class="col-md-8">
							<input type="file" name="image" id="input" class="form-control" required="required">
						</div>
					</div>
				</div>

				<div class="form-group marg-btm"> 
					<!-- <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button> -->
					<button type="submit" name="save" class="btn btn-info waves-effect">Save</button>
					<button type="button" class=" btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
				</div>
			</div>



		</form>
	</div>