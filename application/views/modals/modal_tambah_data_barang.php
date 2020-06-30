
<!-- data modal add data -->

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title_modal ?></h4> </div>
            <div class="modal-body ">



  <form action="<?= base_url('master/C_barang/prosesPost_dataBarang'); ?>" method="POST" class="form-horizontal form-material"  >

    <div class="form-group">
        <div class="col-xl-12 m-b-20">  
           <div class="input-group">
             
             <input type="text" name="kodeBarang" id="input" class="form-control" placeholder="Input kode barang" required="required">
             
           </div>
        </div> 

         <div class="col-xl-12 m-b-20">  
           <div class="input-group">
             
             <input type="text" name="namaBarang" id="input" class="form-control" placeholder="Input nama barang" required="required">
             
           </div>
        </div> 
        
        <div class="col-xl-12 m-b-20"> 
           <div class="input-group"> 
                <select name="idmerk" class="form-control">
                <option value="">Select Merk</option>
                    <!-- looping data menu from menu_id --> 
                    <?php foreach ($merk as $m) { ?>
                    
                    <option value="<?= $m->IDMERK; ?>"><?= $m->NAMAMERK; ?></option>
                    
                    <?php } ?> 
                </select>   
           </div>
        </div> 
        <div class="col-xl-12 m-b-20">  
           <div class="input-group">
                <select name="idsatuan" class="form-control">
                    <option value="">Select Satuan</option>
                        <!-- looping data menu from menu_id --> 
                        <?php foreach ($satuan as $s) { ?>
                        
                        <option value="<?= $s->IDSATUAN; ?>"><?= $s->NAMASATUAN; ?></option>
                        
                        <?php 
                    } ?> 
                </select>  
           </div>
        </div> 
         <div class="col-xl-12 m-b-20">  
           <div class="input-group">
                <select name="kodekategori" class="form-control">
                    <option value="">Select Kategori</option>
                        <!-- looping data menu from menu_id --> 
                        <?php foreach ($kategori as $k) { ?>
                        
                        <option value="<?= $k->KODEKATEGORI; ?>"><?= $k->NAMAKATEGORI; ?></option>
                        
                        <?php 
                    } ?> 
                </select>
           </div>
        </div> 
         <div class="col-xl-12 m-b-20">  
           <div class="input-group">
             
             <input type="number" name="saldoAwal" id="input" class="form-control" placeholder="Input harga awal" required="required">
             
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