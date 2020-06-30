
<!-- data modal add data -->

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title_modal ?></h4> </div>
            <div class="modal-body ">



  <form action="<?= base_url('setting/C_setting/prosesPost_menuAcces'); ?>" method="POST" class="form-horizontal form-material"  >

        <div class="form-group">
        
        <div class="col-xl-12 m-b-20"> 
          <select name="menuid" class="form-control">
            <option value="">Select Menu</option>
             <!-- looping data menu from menu_id -->
            <?php foreach ($menu as $m) { ?>
            
            <option value="<?= $m->menuid; ?>"><?= $m->menuname; ?></option>
            
            <?php } ?>

          </select>   
        </div> 
        <div class="col-xl-12 m-b-20">  
          <select name="idlevel" class="form-control">
            <option value="">For Level</option>
             <!-- looping data menu from menu_id -->
            <?php foreach ($level as $lev) { ?>
                                               
            <option value="<?= $lev->idlevel; ?>"><?= $lev->level; ?></option>
                                             
            <?php } ?>

          </select>   
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