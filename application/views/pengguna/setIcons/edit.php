 
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Quick Example</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php
    print_r($row['password']);die();
    echo form_open_multipart('master/Users/edit');
    ?>
    
    <input type="hidden" name="id" value="<?php echo $row['userid'];?>"">
    <form role="form">
        <div class="box-body">

            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <?php foreach ($selectPengguna as $v){
                        echo "<option value='$v->penggunaId' ";
                        echo $v->penggunaId==$row['penggunaId']?'selected':'';
                        echo">$v->namaDepan ".$v->namaBelakang."</option>";
                    }
                    ?>
                </select>
            </div>


            <div class="form-group">
                <label>User Name</label>
                <input type="text" value="<?php echo $row['username'];?>"  class="form-control" placeholder="username" name="username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" value="<?php echo md5($row['username']);?>" placeholder="Password" name="password">
            </div>

            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="userfile">
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <?php
                    foreach ($selectRole as $v){
                        echo "<option value='$v->roleId' ";
                        echo $v->roleId==$row['roleId']?'selected':'';
                        echo">$v->role</option>";
                    }
                    ?>
                </select>
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <?php
            echo anchor('master/Users','Kembali',array('class'=>'btn btn-primary'));
            ?>
        </div>
    </form>
</div><!-- /.box -->


