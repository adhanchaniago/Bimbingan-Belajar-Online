<script>
    model.transaksiModel = {
        KODEPEMBELIAN: "",
        IDSUPPLIER: 0,
        IDJENISPEMBAYARAN: 0,
        DESKRIPSI_PEMBELIAN: "",
        STATUS_PEMBELIAN: "",
        DIBUATOLEH_PEMBELIAN: "",
        DISETUJUIOLEH_PEMBELIAN: "",
        DITERIMAOLEH_PEMBELIAN: "",
        DIKETAHUIOLEH_PEMBELIAN: "",
        TGLDIBUAT_PEMBELIAN: "",
        TGLDITERIMA_PEMBELIAN:"",
        TGLDISETUJUI_PEMBELIAN:"",
        TGLDIKETAHUI_PEMBELIAN:"",
        TOTAL_PEMBELIAN:0,
        NAMASUPPLIER:"",
        IDCABANG:0,
        LISTMANYDATA: "",
        FAKTUR:"",


        /* detailJadwal */
        BidangStudi: "",
        Tentor: "",
        Siswa: "",
        hari: "",
        jam: "",
        idUnix: "",



        /* FROM DATA KURSUS */
        idUnix:"",
        kodeDetailKursus: "",
        kodeKursus: "",
        idBidangStudi: "",
        BidangStudi: "",
        idTentor: "",
        Tentor: "",
        idSiswa: "",
        Siswa: "",
        jumlahSesi: "",
        statusKursus: "",


        /* for filter kode untuk jadwal */
        kodeDetailKursus: "",
        BidangStudi:"",
        Siswa: "",
        namaBelakangSiswa:"",
        idBidangStudi:"",
        kodeKursus: "",

        /* filter tentor */
        idTentor: "",
        Tentor: "",
        namaBelakang: "",
        role: "",
        guruMapel:"",
    }
    model.subModel = {
        KODEDETAILPEMBELIAN: "",
        KODEPEMBELIAN:"",
        kodeDetailKursus:"",
        kodeDetailKursus:"",
        // HARGABELI:0,
        // JUMLAHPEMBELIAN:0,
        TOTALPEMBELIAN:0,
        JUMLAHDITERIMAPEMBELIAN:0,
        PPN: 0,

        /* FOR DETAIL JADWAL BY KODEDETAILKURSUS */
        kodeDetailKursus_detailKursus: "",
        hari: "",
        jam: "",
        kodeKursus: "",
        idBidangStudi: "",
        idTentor: "",
        idSiswa: "",

    }

    var material = {
        Recordmaterial: ko.mapping.fromJS(model.transaksiModel),
        RecordSubmaterial: ko.mapping.fromJS(model.subModel),
        ListSubmaterial: ko.observableArray([]),
        Listmaterial: ko.observableArray([]),
        Mode: ko.observable(''),
        FilterText: ko.observable(''),
        TotalRupiah: ko.observable(""),
        Terbilang: ko.observable(""),
        ModeInsert: ko.observable(""),
    }

    material.back = function(tab){
        material.Mode('');
        for (var i in material.ListSubmaterial()){
            $("input[idtoken=txtjadwal"+i+"]").tokenInput("clear");
            $("input[idtoken=txtjadwal"+i+"]").tokenInput("destroy");
        }
        $("input[name=txtSuplier]").tokenInput("clear");
        $("input[name=txtSuplier]").tokenInput("destroy");
        material.drawSuplier();
        material.ListSubmaterial([]);
        ko.mapping.fromJS(model.transaksiModel,material.Recordmaterial);
        material.checkListData();
        model.activetab(tab);
        material.grid.ajax.reload( null, false );
        material.ModeInsert("");
    }
    material.add = function(){
        var datayo = $.extend(true, {}, ko.mapping.fromJS(model.subModel));
        material.ListSubmaterial.push(datayo);
        // material.drawJadwal((material.ListSubmaterial().length-1),"");
    }
    material.save = function(){
        model.Processing(true);
        var url = "<?php echo base_url('transaksi/C_transaksiPembelian/saveJadwalKursus') ?>";

        if(material.Mode() === 'Update')
            url = "<?php echo base_url('transaksi/C_transaksiPembelian/update') ?>";

        material.Recordmaterial.LISTMANYDATA(ko.toJSON(material.ListSubmaterial()));
        ajaxPost(url, material.Recordmaterial, function (res) {
            // material.back(0);
            material.ModeInsert("show");
            material.grid.ajax.reload( null, false );
            material.Recordmaterial.idUnix(res.KODE);
            if (material.Mode() == "Update") { 
                material.back(0);
                swal({ title: "Good job!",
                    text: "Updated <?= $title ?>!",
                    icon: "success",
                });
            } else {
                swal({ title: "Good job!",
                    text: "Added new <?= $title ?>!",
                    icon: "success",
                });
            }
            model.Processing(false);
        });
    }
    material.remove = function(id){ 
        swal({
            title: "Are you sure?",
            text: "Delete <?= $title; ?>!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            cancelButtonText: "No!",
            closeOnConfirm: false,
        }, function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url: "<?php echo base_url('transaksi/C_transaksiPembelian/delete') ?>",
                    type: 'post',
                    dataType: 'json',
                    data: {id: id},
                    success : function(res) {
                        material.grid.ajax.reload( null, false );
                        material.Mode("");
                        swal("Deleted!", "Deleted <?= $title; ?>", "success");
                        material.back();
                    },
                });
            }
        });  
    }
    material.filtermaterial = function() {
        material.grid.ajax.reload();
    }

    material.drawSuplier = function(){
        $("input[name=txtSuplier]").tokenInput("<?php echo base_url('transaksi/C_transaksiPembelian/filterSuplier') ?>", { 
            zindex: 700,
            allowFreeTagging: false,
            placeholder: 'Input Type Here!!',
            tokenValue: 'IDSUPPLIER',
            propertyToSearch: "NAMASUPPLIER",
            tokenLimit: 1,
            theme: "facebook",
            onAdd: function (item) {
                var po = material.Recordmaterial;
                po.NAMASUPPLIER(item.NAMASUPPLIER);
                po.IDSUPPLIER(item.IDSUPPLIER);
            },
            onDelete: function(item){
                var po = material.Recordmaterial;
                po.NAMASUPPLIER("");
                po.IDSUPPLIER(0);
            },
            resultsFormatter: function(item){
                return "<li>"+item.NAMASUPPLIER+"</li>"
            },
            onResult: function (results) {
                return results;
            },
            onCachedResult: function(res){
                return res;
            }
        });
    }

    material.drawTentor = function(){
        $("input[name=txtTentor]").tokenInput("<?php echo base_url('transaksi/C_transaksiPembelian/filterTentor') ?>", { 
            zindex: 700,
            allowFreeTagging: false,
            placeholder: 'Input Type Here!!',
            tokenValue: 'idTentor',
            propertyToSearch: "Tentor",
            tokenLimit: 1,
            theme: "facebook",
            onAdd: function (item) {
                var po = material.Recordmaterial;
                po.idTentor(item.idTentor);
                po.Tentor(item.Tentor);
            },
            onDelete: function(item){
                var po = material.Recordmaterial;
                po.idTentor("");
                po.Tentor("");
            },
            resultsFormatter: function(item){
                return "<li>"+item.Tentor+" "+item.namaBelakang+" - :  <i>"+item.guruMapel+"</i></li>"
            },
            onResult: function (results) {
                return results;
            },
            onCachedResult: function(res){
                return res;
            }
        });
    }

    material.drawSiswafromKursus = function(){
        $("input[name=txtsiswaKursus]").tokenInput("<?php echo base_url('transaksi/C_transaksiPembelian/filterJadwal') ?>", { 
            zindex: 700,
            allowFreeTagging: false,
            placeholder: 'Input Type Here!!',
            tokenValue: 'idSiswa',
            propertyToSearch: "Siswa",
            tokenLimit: 1,
            theme: "facebook",
            onAdd: function (item) {
                var po = material.Recordmaterial;
                po.kodeKursus(item.kodeKursus);
                po.kodeDetailKursus(item.kodeDetailKursus);
                po.idSiswa(item.idSiswa);
                po.Siswa(item.Siswa);
                po.BidangStudi(item.BidangStudi);
                po.idBidangStudi(item.idBidangStudi);
            },
            onDelete: function(item){
                var po = material.Recordmaterial;
                po.kodeKursus("");
                po.kodeDetailKursus("");
                po.idSiswa("");
                po.Siswa("");
                po.BidangStudi("");
                po.idBidangStudi("");
            },
            resultsFormatter: function(item){
                return "<li>"+item.Siswa+" "+item.namaBelakangSiswa+" - "+item.BidangStudi+"</li>"
            },
            onResult: function (results) {
                return results;
            },
            onCachedResult: function(res){
                return res;
            }
        });
    }







    material.drawJapppppppdwal = function(index, status){
        $("input[idtoken=txtjadwal"+index+"]").tokenInput("<?php echo base_url('transaksi/C_transaksiPembelian/filterJadwal') ?>", { 
            zindex: 700,
            allowFreeTagging: false,
            placeholder: 'Input Type Here!!',
            tokenValue: 'kodeDetailKursus',
            propertyToSearch: "Siswa",
            tokenLimit: 1,
            theme: "facebook",
            onAdd: function (item) {
                var index = $(this).attr('indextoken'), po = material.ListSubmaterial()[index];
                po.kodeDetailKursus(item.kodeDetailKursus);
                po.kodeDetailKursus(item.kodeDetailKursus);
            },
            onDelete: function(item){
                var index = $(this).attr('indextoken'), po = material.ListSubmaterial()[index];
                po.kodeDetailKursus("");
                po.kodeDetailKursus("");
                // po.HARGABELI(0);
                // po.JUMLAHPEMBELIAN(0);
                // po.TOTALPEMBELIAN(0);
            },
            resultsFormatter: function(item){
                return "<li>"+item.Siswa+" "+item.namaBelakangSiswa+" - "+item.BidangStudi+"</li>"
            },
            onResult: function (results) {
                var resyo = [], boolyo = true;
                for (var i in results){
                    boolyo = true;
                    for (var a in material.ListSubmaterial()){
                        if (results[i].kodeDetailKursus == material.ListSubmaterial()[a].kodeDetailKursus())
                            boolyo = false;
                    }
                    if(boolyo)
                        resyo.push(results[i]);
                }
                return resyo;

            },
            onCachedResult: function(results){
                var resyo = [], boolyo = true;
                for (var i in results){
                    boolyo = true;
                    for (var a in material.ListSubmaterial()){
                        if (results[i].kodeDetailKursus == material.ListSubmaterial()[a].kodeDetailKursus())
                            boolyo = false;
                    }
                    if(boolyo)
                        resyo.push(results[i]);
                }
                return resyo;
            },
        })
    }

    material.removeItem = function(data){
        material.ListSubmaterial.remove(data);
    }

    material.selectdata = function(id) {
        material.back(0);
        $.ajax({
            url: "<?php echo site_url('transaksi/C_transaksiPembelian/getDataSelectKursus') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                // console.log(res);
                material.ModeInsert("show");
                ko.mapping.fromJS(res[0], material.Recordmaterial);
                var itemSelect = {
                    IDSUPPLIER: res[0].IDSUPPLIER,
                    NAMASUPPLIER: res[0].NAMASUPPLIER,
                }
                $("input[name=txtSuplier]").tokenInput("add", itemSelect);
                $.ajax({
                    url: "<?php echo site_url('transaksi/C_transaksiPembelian/getDataDetilJadwal') ?>",
                    type: 'post',
                    dataType: 'json',
                    data : {id: id},
                    success : function(res) {
                        for (var i in res){
                            var datayo = $.extend(true, {}, ko.mapping.fromJS(res[i]));
                            material.ListSubmaterial.push(datayo);
                            // material.drawJadwal((material.ListSubmaterial().length-1),"");
                            var itemSelectDetil = {
                                kodeDetailKursus: res[i].kodeDetailKursus,
                                kodeDetailKursus: res[i].kodeDetailKursus,
                            }
                            $("input[idtoken=txtjadwal"+i+"]").tokenInput("add", itemSelectDetil);
                        }
                        material.Mode("Update");
                    },
                });

            },
        });
    }
    material.checkListData = function(){
        var lengthsub = material.ListSubmaterial().length, i = 0 - lengthsub;
        if (i > 0) {
            for(var a=0;a<i;a++){
                material.add();
            }
        }
        material.calculateTotal();  
    }
    material.calculateTotal = function(){
        material.Recordmaterial.TOTAL_PEMBELIAN(0);
        for(var i in material.ListSubmaterial()){
            // material.ListSubmaterial()[i].JUMLAHPEMBELIAN(parseInt(material.ListSubmaterial()[i].JUMLAHPEMBELIAN()))
            // material.ListSubmaterial()[i].HARGABELI(parseInt(material.ListSubmaterial()[i].HARGABELI()))
            // material.ListSubmaterial()[i].PPN((material.ListSubmaterial()[i].JUMLAHPEMBELIAN()*material.ListSubmaterial()[i].HARGABELI())*0.1);
            // material.ListSubmaterial()[i].TOTALPEMBELIAN((material.ListSubmaterial()[i].JUMLAHPEMBELIAN()*material.ListSubmaterial()[i].HARGABELI())+material.ListSubmaterial()[i].PPN());
            material.Recordmaterial.TOTAL_PEMBELIAN((material.Recordmaterial.TOTAL_PEMBELIAN()+material.ListSubmaterial()[i].TOTALPEMBELIAN()));
        }
        material.TotalRupiah(changeRupiah(material.Recordmaterial.TOTAL_PEMBELIAN()));
        material.Terbilang(terbilang(material.Recordmaterial.TOTAL_PEMBELIAN().toString()));
    }
    ko.bindingHandlers.sumtotal = {
        init: function (element, valueAccessor) {
            $(element).on("keyup", function (e) {
                var indexTr = $(this).closest('tr').index();
                if($(this).attr('name')=='txtJUMLAH'){
                    var txtjumlah = $(this).attr('name', 'txtJUMLAH').val();
                    if (txtjumlah==''){
                        txtjumlah = '0';
                    }
                    var jumlah = parseInt(txtjumlah);
                    // material.ListSubmaterial()[indexTr].JUMLAHPEMBELIAN(jumlah);
                } else {
                    var txtharga = $(this).attr('name', 'txtHARGA').val();
                    if (txtharga==''){
                        txtharga = '0';
                    }
                    var jumlah = parseInt(txtharga);
                    // material.ListSubmaterial()[indexTr].HARGABELI(jumlah);
                }
                material.calculateTotal();
            });
        }
    }
    
</script>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Container fluid  -->
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
        <div class="col-2 ">
         <?php $this->load->view('template/_sidebar'); ?>
     </div>


     <div class="col-md-10">
        <div class="card card-body p-b-0" data-bind="with:material">  
            <div class="col-md-5 align-self-left">
               <h3 class="text-themecolor"><?= $title ?></h3>
               <!-- <h1><?= $namaperusahaan ?></h1> -->
           </div>
           <!-- Nav tabs -->
           <ul class="nav nav-tabs customtab" id="tabnavform">
            <li class="active nav-item"><a class="nav-link" href="#tabform" data-toggle="tab">Form</a></li>
            <li class="nav-item"><a class="nav-link" href="#tablist" data-toggle="tab">List</a></li>
        </ul>
        <div class="content tab-content" id="tabnavform-content">
            <div class="tab-pane active" id="tabform">
                <div class="card-body p-20 animated fadeIn m">
                    <div class="row p-t-23 margMin" >
                        <div class="col-md-12 margMin">
                            <div class="form-group ">
                                <button class="btn btn-sm btn-primary" data-bind="click:back, visible: Mode() == 'Update'" data-toggle="tooltip" data-placement="top" data-original-title="Kembali"><span class="glyphicon glyphicon-chevron-left" ></span><< Kembali</button>
                                <button class="btn btn-sm btn-info" data-bind="click:save, visible:material.ModeInsert()==''" data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Simpan</span></button>
                                <button class="btn btn-sm btn-info" data-bind="click:function(){material.back(0);}, visible:material.ModeInsert()=='show'" data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Add New</span></button>
                                <!-- <button class="btn btn-sm btn-danger" data-bind="click:remove"><span class="glyphicon glyphicon-trash"></span><i class="fa fa-trash"></i></button> -->
                            </div>
                        </div>
                    </div>
                    <div class="row p-t-23 " data-bind="with:Recordmaterial" >  
                        <div class="col-md-6 margMin" data-bind="visible:material.ModeInsert()=='show'">
                            <div class="form-group ">
                                <label class="control-label">KODE</label>
                                <input type="text" name="txtNAMASUPIR" data-bind="value:KODEPEMBELIAN, readonly: material.ModeInsert()" id="" required="" class="form-control"> 
                            </div>
                        </div>
                        <!-- <div class="col-md-6 margMin">
                            <div class="form-group ">
                                <label class="control-label">SUPLIER</label>
                                <input type="text" name="txtSuplier" data-bind="value:NAMASUPPLIER" id="" required="" class="form-control tokensupplier"> 
                            </div>
                        </div>
                    -->
                    <div class="col-md-4 margMin">
                        <div class="form-group ">
                            <label class="control-label">SESWA</label>
                            <input type="text" name="txtsiswaKursus" data-bind="value:idSiswa" id="" required="" class="form-control tokensupplier">
                        </div>
                    </div>

                    <div class="col-md-4 margMin">
                        <label class="control-label">BIDANG STUDI</label>
                        <div class="form-group ">
                            <input type="text" data-bind="value:BidangStudi" id="" readonly="" class="form-control tokensupplier">
                        </div>
                    </div>

                    <div class="col-md-4 margMin">
                        <div class="form-group ">
                            <label class="control-label">TENTOR</label>
                            <input type="text" name="txtTentor" data-bind="value:idTentor" id="" required="" class="form-control tokensupplier">
                        </div>
                    </div>

                      <!--   <div class="col-md-6 margMin">
                            <div class="form-group ">
                                <label class="control-label">STATUS KURSUS</label>
                                <select type="text" name="statusKursus" data-bind="value:statusKursus" id="" required="" class="form-control">
                                    <option value="-">-</option>
                                    <option value="Mendaftar">Mendaftar</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Selesai">Selesai</option>
                                </select> 
                            </div>
                        </div> -->


                    <!--     <div class="col-md-6 margMin">
                            <div class="form-group ">
                                <label class="control-label">JENIS PEMBAYARAN</label> 
                                <select class="form-control" data-bind="value:IDJENISPEMBAYARAN, readonly: material.ModeInsert()">
                                    <?php foreach ($pembayaran as $data) { ?>
                                    <option value="<?php echo $data->IDJENISPEMBAYARAN; ?>"><?php echo $data->JENISPEMBAYARAN; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> -->
                       <!--  <div class="col-md-6 margMin">
                            <div class="form-group ">
                                <label class="control-label">DESKRIPSI</label>
                                <textarea class="form-control" data-bind="value:DESKRIPSI_PEMBELIAN, readonly: material.ModeInsert()"></textarea> 
                            </div>
                        </div>  -->
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-sm btn-info form-bt" style="margin-bottom: 10px;" data-bind="click:material.add, visible: material.ModeInsert()==''"><i class="fa fa-plus"></i> Tambah Data</button>
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-hover color-bordered-table muted-bordered-table">
                                <thead> <!-- TABLE UNTUK INVOICE  -->
                                    <tr id="head-transksi">
                                        <th class="text-center g form-bt" width="5%">NO</th>
                                        <!-- <th class="text-right g form-bt" width="20%">SISWA</th> -->
                                        <!-- <th class="text-right g form-bt" width="20%">TENTOR</th> -->
                                        <!-- <th class="text-right g form-bt" width="20%">Bidang Studi</th> -->
                                        <th width="20%" class="text-left g form-bt">HARI</th>
                                        <th class="text-left g form-bt" width="15%">JAM</th>
                                        <!-- <th class="text-right g form-bt" width="20%">TOTAL</th> -->
                                        <th class="text-right g form-bt" width="5%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="margTinv" data-bind="foreach: material.ListSubmaterial">
                                    <tr>
                                        <td class="text-center fbt" data-bind="html: ($index()+1)"></td>
                                        <!-- <td class="fbt"><input type="text" class="form-control tokenbarang" maxlength="50" data-bind="attr:{'idtoken':'txtjadwal'+$index(), 'indextoken': $index()}" /></td> -->

                                        <!--  <td class="fbt"><input type="text" class="form-control tokenbarang" maxlength="50" data-bind="attr:{'idtoken':'txtSiswa'+$index(), 'indextoken': $index()}" /></td> -->

                                       <!--  <td>
                                            <input type="text" class="form-control" name="txtBidang" maxlength="50" data-bind="value:bidangStudi" readonly="" />
                                        </td> -->



                                        <td class="text-left fbt"> 

                                            <!-- <input type="text" class="form-control" name="txthari" maxlength="50" data-bind="value:hari, readonly: material.ModeInsert()"/> -->
                                            <select type="text" name="txthari" data-bind="value:hari, readonly: material.ModeInsert()" id="" required="" class="form-control">
                                                <option value="-">-</option>
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selasa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Kamis">Kamis</option>
                                                <option value="Jumat">Jumat</option>
                                                <option value="Sabtu">Sabtu</option>
                                                <option value="Minggu">Minggu</option>
                                            </select>
                                        </td>

                                        <td class="text-right fbt"><input type="time" class="form-control" name="txtjam" maxlength="50" data-bind="value:jam, readonly: material.ModeInsert()"/></td>

                                        <td class="text-center fbt"><button class="btn btn-sm btn-danger" data-bind="click: material.removeItem, visible: material.ModeInsert()==''"><i class="fa fa-trash-o"></i></button></td>
                                    </tr>
                                </tbody> 

                               <!--  <tfoot class="bdr_tfoot"> 
                                    <tr>
                                        <th class="text-left" width="15%" colspan="2">TERBILANG</th>
                                        <th class="text-left terbilangnya" width="55%" colspan="3" data-bind='html:material.Terbilang()'></th>
                                        <th class="text-right" width="30%" colspan="2" data-bind='html: material.TotalRupiah()'></th>
                                    </tr> 
                                </tfoot> -->

                            </table>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- <hr>  -->

                </div>
            </div>
            <div class="tab-pane" id="tablist">
                <div class="card-body p-20" data-bind="with:material">
                    <div class="row p-t-23 " >
                        <div class="col-md-12 ">
                            <div class="table-responsive m-t-40 animated fadeIn" data-bind="visible:Mode() === ''">
                                <table id="myTable" width="100%" class="table table-bordered table-striped ">
                                    <thead>
                                        <tr>
                                            <th>KODE KURSUS</th>
                                            <th>TENTOR</th>
                                            <th>SISWA</th>
                                            <th>BIDANG STUDI</th>
                                            <th>HARI</th>
                                            <th>JAM</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead> 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Nav tabs -->

    </div>
</div>
</div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<script>
    $(document).ready(function () {
        material.checkListData();
        material.drawSuplier();
        material.drawTentor();
        material.drawSiswafromKursus();
        material.grid = $("#myTable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('transaksi/C_transaksiPembelian/getDataJadwalKursus') ?>",
                "type": "POST",
                "data": function(d){ 
                    // d['filtervalue'] = material.FilterValue();
                    // d['filtertext'] = material.FilterText();
                    return d; 
                } ,
                "dataSrc": function (json) {
                    // json.draw = 1;
                    json.recordsTotal = json.RecordsTotal;
                    json.recordsFiltered = json.RecordsFiltered;
                    
                    if (json.Data)
                        return json.Data;
                    else
                        return [];
                },
            },
            "searching": false,
            "columns": [
            {"data": "kodeKursus"},
            {"data": "Tentor"},
            {"data": "Siswa"},
            {"data": "BidangStudi"},
            {"data": "hari"},
            {"data": "jam"},
            {
                "data": "idUnix",
                "render": function( data, type, full, meta){
                    return "<button id='sa-warning' class='btn btn-sm btn-danger' onClick='material.remove(\""+data+"\")' id='sa-warning' ><i class='fa fa-trash'></i></button>"; 
                } 
            }
            ],
        });
    });
</script>