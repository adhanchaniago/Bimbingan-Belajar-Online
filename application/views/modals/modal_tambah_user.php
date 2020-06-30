
<!-- data modal add data -->

<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel"><?php echo $title_modal ?></h4> 
  <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
</div>
<div class="modal-body ">


  <form action="<?= base_url('master/Users/prosesPost_dataUser'); ?>" method="POST" class="form-horizontal form-material"  >

    <div class="form-group">

      <div class="col-xl-12 m-b-20">  
        <div class="form-group row">
          <label for="example-text-input" class="col-md-4 col-form-label pad-left">Pengguna</label>
          <div class="col-md-8">
            <select name="penggunaId" required="" class="form-control select2" style="width: 100%;">
             <option>--Pilih Nama Pengguna--</option> 
             <?php 
             $data   = $this->db->query('SELECT * from tb_pengguna');
             foreach ($data->result() as $r) {
              echo "<option value='$r->penggunaId'>$r->namaDepan $r->namaBelakang</option>";
            } ?>
          </select>
        </div>
      </div>
    </div>

  <!--   <div class="col-xl-12 m-b-20 pad-btm">  
      <div class="form-group row">
        <label for="example-text-input" class="col-md-4 col-form-label pad-left">FOTO</label>
        <div class="col-md-8">
          <input type="file" name="user_file" id="input" class="form-control" required="required">
        </div>
      </div>
    </div>
 -->
    <div class="col-xl-12 m-b-20 pad-btm">  
      <div class="form-group row">
        <label for="example-text-input" class="col-md-4 col-form-label pad-left">USER NAME</label>
        <div class="col-md-8">
          <input type="text" name="username" onfocus="this.value='' " id="input" class="form-control" required="required">
        </div>
      </div> 
    </div> 

    <div class="col-xl-12 m-b-20 pad-btm">  
     <div class="form-group row">
      <!-- <label for="example-text-input" class="col-md-4 col-form-label pad-left">PASSWORD</label> -->
      <div class="col-md-8">
        <input type="hidden" name="password" value="<?php echo substr(uniqid(),0,4);  ?>" maxlength="4" id="input" class="form-control" required="required">
      </div>
    </div> 
  </div>

  <p style="color:orange">Password di generate secara acak, sejumlah 4 karakter dan dikirimkan ke email pengguna oleh sistem</p>

  <div class="form-group marg-btm"> 
    <!-- <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button> -->
    <button type="submit" class="btn btn-info waves-effect">Save</button>
    <button type="button" class=" btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
  </div>
</div>



</form>
</div>