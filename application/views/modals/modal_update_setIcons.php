<!-- data modal add data -->
<?php foreach($recordUpdate->result_array() as $i): ?>
	<!-- data modal add data -->
	<div class="modal fade" id="modal_editsetIcons<?php echo $i['idIcons'];?>" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Update Icon </h4> 
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
				</div>
				<div class="modal-body ">

					<form action="<?= base_url('master/SetIcons/prosesUpdate_Icons'); ?>"  enctype="multipart/form-data" method="POST" class="form-horizontal form-material"  >
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">

									<input type="hidden" name="idIcons" value="<?php echo $i['idIcons'] ?>">

									<div class="col-xl-12 m-b-20 pad-btm">  
										<div class="form-group row">
											<label for="example-text-input" class="col-md-4 col-form-label pad-left">NAMA ICON</label>
											<div class="col-md-8">
												<input type="text" name="namaIcon" value="<?= $i['namaIcon'] ?> " id="input" class="form-control" placeholder="Type..." required="required">
											</div>
										</div>
									</div>

									<div class="col-xl-12 m-b-20 pad-btm">
										<div class="form-group row">
											<label for="example-text-input" class="col-md-4 col-form-label pad-left">ICON</label>
											<p></p>
											<div class="col-md-8">
												<input type="file" name="image" id="input" class="form-control">
											</div>
										</div>
									</div>


									<div class="form-group marg-btm">
										<button type="submit" name="update" class="btn btn-info waves-effect">Save</button>
										<button type="button" class=" btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
									</div>

								</div>  

							</div><!-- col-12 -->

						</div>
					</form>

				</div>

			</div>
		</div>
	</div>
<?php endforeach;?>