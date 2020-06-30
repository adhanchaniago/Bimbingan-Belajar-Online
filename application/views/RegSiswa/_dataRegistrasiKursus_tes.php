<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url(); ?>Home">
                    Home</a>
                </li>
                <li class="breadcrumb-item active capital">
                    <?= $this->uri->segment(1); ?>
                </li>
                <li class="breadcrumb-item active capital">
                    <?php $uri_Bcrumb = $this->uri->segment(2);
                    $cek = substr($uri_Bcrumb, 0, 2);
                    if ($cek == 'C_') {
                        echo "data " . substr($uri_Bcrumb, 2, 15) . "";
                    } ?>
                </li>
                <!-- <li class="breadcrumb-item active">Table editable</li> -->
            </ol>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
        <div class="col-md-12">
            <div class="card card-body p-b-0" >  
                <div class="col-md-5 align-self-left">
                   <h3 class="text-themecolor"><?= $title ?></h3>
                   <!-- <h1><?= $namaperusahaan ?></h1> -->
               </div>
               <!-- Nav tabs -->
               <ul class="nav nav-tabs customtab" id="tabnavform">
                <!-- <li class="active nav-item"><a class="nav-link" href="#tabform" data-toggle="tab">Form</a></li> -->
                <!-- <li class="nav-item"><a class="nav-link" href="#tablist" data-toggle="tab">List</a></li> -->
            </ul>
            <div class="content tab-content" id="tabnavform-content">
                <div class="tab-pane active" id="tabform">
                    <div class="card-body p-20 animated fadeIn m">
                        <div class="row p-t-23 margMin" >
                            <div class="col-md-12 margMin">
                                <div class="form-group ">
                                    <!-- <button class="btn btn-sm btn-primary" data-bind="click:back, visible: Mode() == 'Update'" data-toggle="tooltip" data-placement="top" data-original-title="Kembali"><span class="glyphicon glyphicon-chevron-left" ></span><< Kembali</button> -->
                                    <button class="btn btn-sm btn-info"  data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span ><i class="fa fa-save"></i> Simpan</span></button>
                                    <!-- <button class="btn btn-sm btn-info" data-bind="click:function(){material.back(0);}, visible:material.ModeInsert()=='show'" data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Add New</span></button> -->
                                    <!-- <button class="btn btn-sm btn-danger" data-bind="click:remove"><span class="glyphicon glyphicon-trash"></span><i class="fa fa-trash"></i></button> -->
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-23 " >

                         <div class="col-md-4 margMin">
                            <label class="control-label">ID ANGGOTA</label>
                            <div class="form-group">
                                <input type="text" name="idsiswa" value="" id="idsiswa" onkeyup="showSiswa()" class="form-control form-token">
                            </div>
                        </div>
                        <div class="col-md-8 margMin"></div>

                        <div class="col-md-4 margMin">
                            <label class="control-label">NAMA DEPAN</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">ND</span>
                                <input type="text" name="namaDepanSiswa" value="" id="namaDepan" readonly="" class="form-control form-token">
                            </div>
                        </div>
                        <div class="col-md-4 margMin">
                            <label class="control-label">NAMA BELAKANG</label>
                            <div class="input-group ">
                                <span class="input-group-addon" id="basic-addon1">NB</span>
                                <input type="text" name="namaBelakangSiswa" value="" id="namaBelakang" readonly="" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-8 margMin">
                            <label class="control-label">LOKASI KURSUS</label>
                            <div class="input-group ">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-map-marker"></i> </span>
                                <input type="text" name="tempatKursus" value=""  id="" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 margMin">
                        </div>

                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-sm btn-info form-bt" style="margin-bottom: 10px;" data-bind="click:material.add, visible: material.ModeInsert()==''"><i class="fa fa-plus"></i> Tambah Data</button>
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-hover color-bordered-table muted-bordered-table">
                                <thead> <!-- TABLE UNTUK INVOICE  -->
                                    <tr id="head-transksi">
                                        <!-- <th class="text-center g form-bt" width="5%">NO</th> -->
                                        <th width="20%" class="text-left g form-bt">KURSUS</th>
                                        <th class="text-left g form-bt" width="15%">JUMLAH SESI</th>
                                        <th class="text-right g form-bt" width="20%">HARGA</th>
                                        <th class="text-right g form-bt" width="20%">TOTAL</th>
                                        <th class="text-right g form-bt" width="5%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="margTinv" >
                                    <tr>
                                        <!-- <td class="text-center fbt" ></td> -->
                                        <td class="fbt"><input type="text" onkeyup="showBidStudi()" id="bidangStudi" class="form-control" maxlength="50" /></td>
                                        <td class="text-left fbt">
                                            <input type="text" class="form-control" id="jumlahsesi" name="txtJUMLAH" maxlength="50"/>
                                            <div class="form-control-feedback" style="color:orange" >Minimal 4 sesi</div>
                                        </td>
                                        <td class="text-right fbt"><input type="text" class="form-control" name="txtHarga" id="hargaperSesi" maxlength="50"  readonly="" /></td>
                                        <td ></td>
                                        <td class="text-center fbt"><button class="btn btn-sm btn-danger" ><i class="fa fa-trash-o"></i></button></td>
                                    </tr>
                                </tbody> 

                                <tfoot class="bdr_tfoot"> 
                                    <tr>
                                        <th class="text-left" width="15%" colspan="2">TERBILANG</th>
                                        <th class="text-left terbilangnya" width="55%" colspan="2" ></th>
                                        <th class="text-right" width="30%" colspan="2" ></th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr> 

                </div>
            </div>

        </div>
        <!-- End Nav tabs -->

    </div>
</div>
</div>
</div>

<script type="text/javascript">
    function showSiswa(){
        var idsiswa = $("#idsiswa").val();
        $.ajax({
            url : "<?php echo base_url('master/Con_regKursus/getidSiswa') ?>",
            data : 'idsiswa='+idsiswa,
            success : function(data) {
                var json = data,
                res = JSON.parse(json);
                $("#namaDepan").val(res.namaDepan);
                $("#namaBelakang").val(res.namaBelakang);
            }
        });
    }
    function showBidStudi(){
        var bidangStudi = $("#bidangStudi").val();
        $.ajax({
            url : "<?php echo base_url('master/Con_regKursus/getBidStudi') ?>",
            data : 'bidangStudi='+bidangStudi,
            success : function(data) {
                var json = data,
                res = JSON.parse(json);
                $("#hargaperSesi").val(res.hargaperSesi);
            }
        });
    }

    function Total(){
        var sesi = $("#jumlahsesi").val();
        
    }


    $(document).ready(function () {

    });
</script>