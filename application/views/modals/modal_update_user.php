<!-- data modal add data -->
<?php foreach($recordUpdate->result_array() as $i): ?>
	<!-- data modal add data -->
	<div class="modal fade" id="modal_editUser<?php echo $i['userid'];?>" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Update Foto Pengguna</h4> 
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
				</div>
				<div class="modal-body ">

					<form action="<?= base_url('master/Users/prosesUpdate_FotoUser'); ?>"  enctype="multipart/form-data" method="POST" class="form-horizontal form-material"  >
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">

									 <div class="col-xl-12 m-b-20 pad-btm">  
										<div class="form-group row">
											<label for="example-text-input" class="col-md-4 col-form-label pad-left">Nama Pengguna</label>
											<div class="col-md-8">
												<input type="hidden" name="idpengguna" value="<?php echo $i['penggunaId'] ?>" id="input" class="form-control">
											</div>
										</div>
									</div>  

									<div class="col-xl-12 m-b-20">  
										<div class="form-group row">
											<label for="example-text-input" class="col-md-4 col-form-label pad-left">Foto</label>
											<div class="col-md-8">
												<input type="file" name="userfile" id="input" class="form-control">
											</div>
										</div> 
									</div>


									<div class="form-group marg-btm"> 
										<!-- <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button> -->
										<button type="submit" class="btn btn-info waves-effect">Save</button>
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