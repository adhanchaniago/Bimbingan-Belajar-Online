<script>
    model.transaksiModel = {
        KODEPENJUALAN: moment().unix(),
        kodeKursus: moment().unix(),
        IDCUSTOMER: 0,
        DESKRIPSI_PENJUALAN: "",
        STATUS_PENJUALAN: "",
        DIBUATOLEH_PENJUALAN: "",
        DISETUJUIOLEH_PENJUALAN: "",
        DITERIMAOLEH_PENJUALAN: "",
        DIKETAHUIOLEH_PENJUALAN: "",
        TGLDIBUAT_PENJUALAN: "",
        TGLDITERIMA_PENJUALAN:"",
        TGLDISETUJUI_PENJUALAN:"",
        TGLDIKETAHUI_PENJUALAN:"",
        TOTAL_ALPENJUALAN:0,
        PPN: 0,
        JATUHTEMPO_PENJUALAN: moment().format("YYYY-MM-DD"),
        TOTALKESELURUHAN: 0,
        NAMACUSTOMER:"",
        IDCABANG:0,

        statusKursus:'',

        // LISTKURSUS: "",
        // nomor:'',
        // idSiswa:'',
        // Siswa:'',
        // namaDepan:'',
        // namaBelakangSiswa:'',
        // tempatKursus:'',
        // id_bidangStudi:'',
        // namaBidangStudi:'',
        // hargaperSesi:'',
        // idapp_kursus: moment().unix(),
        // idUnix: "",

        // role: "",
        // statusKursus: "",
        // idTentor: "",
        // Tentor: "",
        // tglSelesai: moment().format("YYYY-MM-DD"),

        idUnix:"",
        idSiswa:"",
        Siswa:"",
        UsiaSiswa:"",
        PendidikanSiswa:"",
        AlamatSiswa:"",
        idTentor:"",
        Tentor:"",
        idBidangStudi:"",
        bidangStudi:"",
        kategoriBidangstudi:"",
        statusKursus:"",
    }
    model.subModel = {
        KODEDETAILPENJUALAN: "",
        kodeKursus:"",
        KODEPENJUALAN:"",
        idapp_kursus:"",
        KODEBARANG:"",
        NAMABARANG:"",
        IDHARGABELI:0,

        id_bidangStudi:"",
        namaBidangStudi:"",
        kategoriStudi:"",
        jenjang:"",
        hargaperSesi:0,

        idTentor:'',
        Tentor:'',

        tglKursus:'',
        durasiKursus:'',
        statusKursus:'',
        pertemuanKe:0,
        tglselesai:'',
        waktuKursus:'',

        idSiswa:"",
        Siswa:"",
        
        HARGAJUAL:0,
        jumlahSesi:0,
        JUMLAH:0,
        TOTALPENJUALAN:0,
        JUMLAHDIKIRIM:0,
    }

    var material = {
        Recordmaterial: ko.mapping.fromJS(model.transaksiModel),
        RecordSubmaterial: ko.mapping.fromJS(model.subModel),
        ListSubmaterial: ko.observableArray([]),
        Listmaterial: ko.observableArray([]),
        Mode: ko.observable(''),
        FilterText: ko.observable(""),
        TotalRupiah: ko.observable(""),
        Terbilang: ko.observable(""),
        ModeInsert: ko.observable(""),
    }

    material.countTotal = function(){
        for (var i in material.ListSubmaterial()){
            material.ListSubmaterial()[i].TOTALPENJUALAN(material.ListSubmaterial()[i].hargaperSesi()*material.ListSubmaterial()[i].jumlahSesi());
        }
    }
    material.drawSuplier = function(){
        $("input[name=txtSuplier]").tokenInput("<?php echo base_url('transaksi/C_transaksiPenjualan/filterCustomer') ?>", { 
            zindex: 700,
            allowFreeTagging: false,
            placeholder: '',
            tokenValue: 'IDCUSTOMER',
            propertyToSearch: "NAMACUSTOMER",
            tokenLimit: 1,
            theme: "facebook",
            onAdd: function (item) {
                var po = material.Recordmaterial;
                po.NAMACUSTOMER(item.NAMACUSTOMER);
                po.IDCUSTOMER(item.IDCUSTOMER);
            },
            onDelete: function(item){
                var po = material.Recordmaterial;
                po.NAMACUSTOMER("");
                po.IDCUSTOMER(0);
            },
            resultsFormatter: function(item){
                return "<li>"+item.NAMACUSTOMER+"</li>"
            },
            onResult: function (results) {
                return results;
            },
            onCachedResult: function(res){
                return res;
            }
        });
    }
    material.filterHarga = function(id, index){
        ajaxPost("<?php echo site_url('master/Con_regKursus/filterHarga') ?>", {id_bidangStudi: id}, function (res) {
            po = material.ListSubmaterial()[index];
            po.hargaperSesi(parseInt(res[0].hargaperSesi));
            po.id_bidangStudi(parseInt(res[0].id_bidangStudi));
        });
    }
    material.drawKursus = function(index, status){
        $("input[idtoken=txtkursus"+index+"]").tokenInput("<?= base_url('master/Con_regKursus/filterKursus') ?>", { 
            zindex: 700,
            allowFreeTagging: false,
            placeholder: '',
            tokenValue: 'id_bidangStudi',
            propertyToSearch: "namaBidangStudi",
            tokenLimit: 1,
            theme: "facebook",
            onAdd: function (item) {
                var index = $(this).attr('indextoken'), po = material.ListSubmaterial()[index];
                po.id_bidangStudi(item.id_bidangStudi);
                po.namaBidangStudi(item.namaBidangStudi);
                po.hargaperSesi(item.hargaperSesi);
                material.filterHarga(item.id_bidangStudi, index);
                // po.jumlahSesi(item.jumlahSesi);
            },
            onDelete: function(item){
                var index = $(this).attr('indextoken'), po = material.ListSubmaterial()[index];
                po.namaBidangStudi("");
                po.hargaperSesi(0);
                po.id_bidangStudi(0);
                po.jumlahSesi(0);
                po.TOTALPENJUALAN(0);
            },
            resultsFormatter: function(item){
                return "<li>"+item.namaBidangStudi+" - Jenjang "+item.jenjang+"</li>"
            },
            onResult: function (results) {
                var resyo = [], boolyo = true;
                for (var i in results){
                    boolyo = true;
                    for (var a in material.ListSubmaterial()){
                        if (results[i].id_bidangStudi == material.ListSubmaterial()[a].id_bidangStudi())
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
                        if (results[i].id_bidangStudi == material.ListSubmaterial()[a].id_bidangStudi())
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
            url: "<?php echo site_url('master/Con_jadwal/getDataSelect') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                // console.log(res);
                material.ModeInsert("show");
                ko.mapping.fromJS(res[0], material.Recordmaterial);
                var itemSelect = {
                    IDCUSTOMER: res[0].IDCUSTOMER,
                    NAMACUSTOMER: res[0].NAMACUSTOMER,
                }
                $("input[name=txtSuplier]").tokenInput("add", itemSelect);
                $.ajax({
                    url: "<?php echo site_url('master/Con_jadwal/getDataDetilJadwal') ?>",
                    type: 'post',
                    dataType: 'json',
                    data : {id: id},
                    success : function(res) {
                        for (var i in res){
                            var datayo = $.extend(true, {}, ko.mapping.fromJS(res[i]));
                            material.ListSubmaterial.push(datayo);
                            material.drawKursus((material.ListSubmaterial().length-1),"");
                            var itemSelectDetil = {
                                KODEBARANG: res[i].KODEBARANG,
                                namaBidangStudi: res[i].namaBidangStudi,
                                hargaperSesi: res[i].hargaperSesi,
                                id_bidangStudi: res[i].id_bidangStudi,
                            }
                            $("input[idtoken=txtkursus"+i+"]").tokenInput("add", itemSelectDetil);
                        }
                        material.Mode("Update");
                    },
                });
            },
        });
    }

    material.checkListData = function(){
        var lengthsub = material.ListSubmaterial().length, i = 1 - lengthsub;
        if (i > 0) {
            for(var a=0;a<i;a++){
                material.add();
            }
        }
        material.calculateTotal();  
    }
    material.calculateTotal = function(){
        material.Recordmaterial.TOTAL_ALPENJUALAN(0);
        for(var i in material.ListSubmaterial()){
            material.ListSubmaterial()[i].jumlahSesi(parseInt(material.ListSubmaterial()[i].jumlahSesi()))
            material.ListSubmaterial()[i].hargaperSesi(parseInt(material.ListSubmaterial()[i].hargaperSesi()))
            // material.ListSubmaterial()[i].PPN((material.ListSubmaterial()[i].jumlahSesi()*material.ListSubmaterial()[i].hargaperSesi())*0.1);
            
            material.ListSubmaterial()[i].TOTALPENJUALAN((material.ListSubmaterial()[i].jumlahSesi()*material.ListSubmaterial()[i].hargaperSesi()));

            material.Recordmaterial.TOTAL_ALPENJUALAN((material.Recordmaterial.TOTAL_ALPENJUALAN()+material.ListSubmaterial()[i].TOTALPENJUALAN()));

             // material.Recordmaterial.TOTAL_SESI((material.ListSubmaterial()[i].jumlahSesi()*1));

         }
         material.Recordmaterial.PPN(material.Recordmaterial.TOTAL_ALPENJUALAN()+0);
         material.Recordmaterial.TOTALKESELURUHAN(material.Recordmaterial.PPN()+material.Recordmaterial.TOTAL_ALPENJUALAN());
         material.TotalRupiah(changeRupiah(material.Recordmaterial.TOTAL_ALPENJUALAN()));
         material.Terbilang(terbilang(material.Recordmaterial.TOTAL_ALPENJUALAN().toString()));
     }
     ko.bindingHandlers.sumtotal = {
        init: function (element, valueAccessor) {
            $(element).on("keyup", function (e) {
                var indexTr = $(this).closest('tr').index();
                if($(this).attr('name')=='txtjumlahSesi'){
                    var txtjumlahSesi = $(this).attr('name', 'txtjumlahSesi').val();
                    if (txtjumlahSesi==''){
                        txtjumlahSesi = '0';
                    }
                    var jumlah = parseInt(txtjumlahSesi);
                    material.ListSubmaterial()[indexTr].jumlahSesi(jumlah);
                }
                material.calculateTotal();
            });
        }
    }

    material.drawSiswa = function(){
        $("input[name=txtsiswa]").tokenInput("<?= base_url('master/Con_regAnggSiswa/filterSiswa') ?>", {
            zindex: 700,
            allowFreeTagging: false, 
            placeholder: 'Ketikkan nomor belakang id_pengguna anda!', 
            tokenValue: 'idSiswa',
            propertyToSearch: "idSiswa",
            tokenLimit: 1,
            theme: "facebook",
            onAdd: function (item) {
                var po = material.Recordmaterial;
                po.Siswa(item.Siswa);
                po.namaBelakangSiswa(item.namaBelakangSiswa);
                po.idSiswa(item.idSiswa);
            },
            onDelete: function(item){
                var po = material.Recordmaterial;
                po.Siswa("");
                po.namaBelakangSiswa("");
                po.idSiswa("");
            },
            resultsFormatter: function(item){
                return "<li>"+item.Siswa+" "+item.namaBelakangSiswa+" - "+item.idSiswa+"</li>"
            },
            onResult: function (results) {
                return results;
            },
            onCachedResult: function(res){
                return res;
            }
        });
    }
</script>

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
        <div class="col-2 ">
            <?php $this->load->view('template/_sidebar'); ?>
        </div>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
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

                           <!--  <div class="col-md-2 margMin">
                                <label class="control-label">ID SISWA</label>
                                <div class="form-group">
                                    <input type="text" name="txtsiswa" id="" required="" class="form-control form-token">
                                </div>
                            </div>
                            <div class="col-md-3 margMin">
                                <label class="control-label">NAMA SISWA</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">NS</span>
                                    <input type="text" name="txtnamaDepan" data-bind="value: Siswa" id="" disabled="" class="form-control form-token" readonly="">
                                </div>
                            </div>
                            <div class="col-md-3 margMin">
                                <label class="control-label">BIDANG STUDI</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">BS</span>
                                    <input type="text" name="txtnamaDepan" data-bind="value: Siswa" id="" disabled="" class="form-control form-token" readonly="">
                                </div>
                            </div> -->
                            <div class="col-md-5 margMin">
                                <label class="control-label">NAMA TENTOR</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">NT</span>
                                    <input type="text" name="txtTentor" data-bind="value: Tentor" id="" class="form-control form-token">
                                </div>
                            </div>

                           <!--  <div class="form-group col-md-7 margList ">
                                <div class="form-group ">
                                    <label class="control-label">STATUS</label> 
                                    <div class="demo-radio-button"> 
                                        <input name="txtstatusKursus" type="radio" value="aktif" data-bind="checked: statusKursus " id="radio_40" class="with-gap radio-col-light-blue">
                                        <label for="radio_40">Aktif</label>
                                        <input name="txtstatusKursus" type="radio" value="mendaftar" data-bind="checked: statusKursus" id="radio_39" class="with-gap radio-col-light-blue">
                                        <label for="radio_39">Mendaftar</label>
                                        <input name="txtstatusKursus" type="radio" value="tuntas" data-bind="checked: statusKursus" id="radio_38" class="with-gap radio-col-light-blue">
                                        <label for="radio_38">tuntas</label>
                                    </div>
                                </div>
                            </div> -->
                        <!--     <div class="col-md-5 margMin">
                                <label class="control-label">TANGGAL SELESAI</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">NT</span>
                                    <input type="date" name="txtnamaDepan" data-bind="value: Siswa" id="" class="form-control form-token">
                                </div>
                            </div> -->


                            <div class="col-md-8 margMin"></div>



                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-sm btn-info form-bt" style="margin-bottom: 10px;" data-bind="click:material.add, visible: material.ModeInsert()==''"><i class="fa fa-plus"></i> Tambah Data</button>
                            <div class="table-responsive m-t-40" style="clear: both;">
                                <table class="table table-hover color-bordered-table muted-bordered-table">
                                    <thead> <!-- TABLE UNTUK INVOICE  -->
                                        <tr id="head-transksi">
                                            <th class="text-center g form-bt" width="5%">NO</th>
                                            <th class="text-left g form-bt" width="19%" >JAM</th>
                                            <th class="text-left g form-bt" width="35%">HARI KURSUS</th>
                                            <!-- <th class="text-right g form-bt" width="20%">HARGA</th> -->
                                            <!-- <th class="text-right g form-bt" width="20%">TOTAL</th> -->
                                            <th class="text-right g form-bt" width="5%">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody class="margTinv" data-bind="foreach: material.ListSubmaterial">
                                        <tr>
                                            <td class="text-center fbt" data-bind="html: ($index()+1)"></td>
                                            <!-- <td class="fbt"><input type="time" class="form-control" maxlength="50" data-bind="attr:{'idtoken':'txtkursus'+$index(), 'indextoken': $index()}" /></td> -->
                                            <td class="fbt"><input type="time" class="form-control" maxlength="50" data-bind="attr:{'idtoken':'txtkursus'+$index(), 'indextoken': $index()}" /></td>
                                            <td class="text-left fbt">
                                                <input type="date" class="form-control" name="txtjumlahSesi" maxlength="50" data-bind="value:jumlahSesi, numeric: number, sumtotal: number, readonly: material.ModeInsert()"/>
                                            </td>
                                            <!-- <td class="text-right fbt"><input type="text" class="form-control" name="txtHarga" maxlength="50" data-bind="value:hargaperSesi, numeric: number, sumtotal: number" readonly="" /></td> -->
                                            <!-- <td data-bind="html:changeRupiah(TOTALPENJUALAN())"></td> -->
                                            <td class="text-center fbt"><button class="btn btn-sm btn-danger" data-bind="click: material.removeItem, visible: material.ModeInsert()==''"><i class="fa fa-trash-o"></i></button></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>


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
                                             <th>SISWA</th>
                                             <th>ALAMAT SISWA</th> 
                                             <th>TENTOR</th> 
                                             <th>BIDANG STUDI</th>
                                             <th>KATEGORI</th>
                                             <th>STATUS</th>
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
    material.back = function(tab){
        material.Mode('');
        for (var i in material.ListSubmaterial()){
            $("input[idtoken=txtkursus"+i+"]").tokenInput("clear");
            $("input[idtoken=txtkursus"+i+"]").tokenInput("destroy");
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
        material.drawKursus((material.ListSubmaterial().length-1),"");
    }
    material.save = function(){
        model.Processing(true);
        var url = "<?php echo base_url('master/Con_regKursus/saveRegKursus') ?>";
        if(material.Mode() === 'Update')
            url = "<?php echo base_url('transaksi/C_transaksiPenjualan/update') ?>";

        material.Recordmaterial.LISTKURSUS(ko.toJSON(material.ListSubmaterial()));
        ajaxPost(url, material.Recordmaterial, function (res) {
            material.ModeInsert("show");
            material.grid.ajax.reload( null, false );
            material.Recordmaterial.kodeKursus(res.KODE);
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
                    url: "<?php echo base_url('master/Con_jadwal/delete') ?>",
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
    $(document).ready(function () {
        material.checkListData();
        material.drawSuplier();
        material.drawSiswa();
        material.grid = $("#myTable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('master/Con_jadwal/getData') ?>",
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
            {"data": "Siswa"},
            {"data": "AlamatSiswa"},
            {"data": "Tentor"},
            {"data": "bidangStudi"},
            {"data": "kategoriBidangStudi"},
            {"data": "statusKursus"},
            {
                "data": "idUnix",
                "render": function( data, type, full, meta){
                    return "<button class='btn btn-sm btn-info' onClick='material.selectdata(\""+data+"\")'><i class='fa fa-callender'></i>Jadwal</button>";
                } 
            }
            ],
        });
    });
</script>