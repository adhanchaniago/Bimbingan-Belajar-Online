
<!-- data modal add data -->

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title_modal2 ?></h4> </div>
            <div class="modal-body ">



  <form action="<?= base_url('setting/C_setting/prosesPost_dataLevel'); ?>" method="POST" class="form-horizontal form-material"  >

    <div class="form-group">
        <div class="col-xl-12 m-b-20">  
           <div class="input-group">
             
             <input type="text" name="level" id="input" class="form-control" placeholder="Input nama level" required="required">
             
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