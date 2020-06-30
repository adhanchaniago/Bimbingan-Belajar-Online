
<!-- data modal add data -->

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title_modal ?></h4> </div>
            <div class="modal-body ">



  <form action="<?= base_url('master/C_customer/prosesPost_dataCustomer'); ?>" method="POST" class="form-horizontal form-material"  >

    <div class="form-group">
        <div class="col-xl-12 m-b-20">  
            <div class="form-group row">
              <label for="example-text-input" class="col-md-4 col-form-label">Customer</label>
              <div class="col-md-8">
                  <input type="text" name="nama" id="input" class="form-control" placeholder="Input nama customer" required="required">
              </div>
            </div>
        </div> 

         <div class="col-xl-12 m-b-20">  
            <div class="form-group row">
              <label for="example-text-input" class="col-md-4 col-form-label">Alamat</label>
              <div class="col-md-8">
                  <input type="text" name="alamat" id="input" class="form-control" placeholder="Input Alamat" required="required">
              </div>
            </div> 
        </div> 
           
         <div class="col-xl-12 m-b-20">  
           <div class="form-group row">
              <label for="example-text-input" class="col-md-4 col-form-label">Nama Kota</label>
              <div class="col-md-8">
                <input type="text" name="kota" id="input" class="form-control" placeholder="Input kota" required="required">
              </div>
            </div> 
        </div> 

        <div class="col-xl-12 m-b-20">  
           <div class="form-group row">
              <label for="example-text-input" class="col-md-4 col-form-label">Kode Pos</label>
              <div class="col-md-8">
                <input type="number" name="post" id="input" class="form-control" placeholder="Input kode pos" required="required">
              </div>
            </div> 
        </div> 
 
         
 
        <div class="form-group"> 
          <!-- <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button> -->
          <button type="submit" class="btn btn-info waves-effect">Save</button>
          <button type="button" class=" btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
        </div>
    </div>






  </form>
</div>
</