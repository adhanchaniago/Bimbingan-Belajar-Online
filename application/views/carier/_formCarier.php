<script>
    model.transaksiModel = {
        LISTCARIER: "",
        nomor:'',
        id_bidangStudi:'',
        namaBidangStudi:'',

        pengguna_idPengguna:"",
        penggunaId:"",
        namaDepan:"",
        namaBelakang:"",
        noWa:"",
        email:"",

        alamat:"",
        tempatTinggal:"",
        tempatLahir:"",
        tglLahir:"",
        umur:0,

        pendidikanTerakir:"",
        pendidikanSekarang:"",
        nomorKtp:"",
        kategori:"",
        IDKOTA:0,
        NAMAKOTA:"",
        namaDepan:"",
        kategoriid:"",
        namaBank:"",
        noRek:"",
    }
    model.subModel = {
        id_bidangStudi:"",
        namaBidangStudi:"",
        kategoriStudi:"",
        jenjang:"",
        // hargaperSesi:0,
    }

    var material = {
        Recordmaterial: ko.mapping.fromJS(model.transaksiModel),
        RecordSubmaterial: ko.mapping.fromJS(model.subModel),
        ListSubmaterial: ko.observableArray([]),
        Listmaterial: ko.observableArray([]),
        Mode: ko.observable(''),
        FilterText: ko.observable(''),
        // TotalRupiah: ko.observable(""),
        // Terbilang: ko.observable(""),
        ModeInsert: ko.observable(""),
    }

    material.filterHarga = function(id, index){
        ajaxPost("<?php echo site_url('reg/Con_regKursus/filterHarga') ?>", {id_bidangStudi: id}, function (res) {
            po = material.ListSubmaterial()[index];
            po.hargaperSesi(parseInt(res[0].hargaperSesi));
            po.id_bidangStudi(parseInt(res[0].id_bidangStudi));
        });
    }
    material.drawKursus = function(index, status){
        $("input[idtoken=txtkursus"+index+"]").tokenInput("<?= base_url('reg/Con_regKursus/filterKursus') ?>", { 
            zindex: 700,
            allowFreeTagging: false,
            placeholder: 'Ketikkan Nama Bidang Studi!',
            tokenValue: 'id_bidangStudi',
            propertyToSearch: "namaBidangStudi",
            tokenLimit: 1,
            theme: "facebook",
            onAdd: function (item) {
                var index = $(this).attr('indextoken'), po = material.ListSubmaterial()[index];
                po.id_bidangStudi(item.id_bidangStudi);
                po.namaBidangStudi(item.namaBidangStudi);
                po.jenjang(item.jenjang);
                po.kategoriStudi(item.kategoriStudi);
                // material.filterHarga(item.id_bidangStudi, index);
                // po.jumlahSesi(item.jumlahSesi);
            },
            onDelete: function(item){
                var index = $(this).attr('indextoken'), po = material.ListSubmaterial()[index];
                po.namaBidangStudi("");
                // po.hargaperSesi(0);
                po.id_bidangStudi(0);
                // po.jumlahSesi(0);
                // po.TOTALPENJUALAN(0);
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
            url: "<?php echo site_url('transaksi/C_transaksiPenjualan/getDataSelect') ?>",
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
                    url: "<?php echo site_url('transaksi/C_transaksiPenjualan/getDataDetilPembelian') ?>",
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
                                // hargaperSesi: res[i].hargaperSesi,
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
        // material.calculateTotal();  
    }
    // material.calculateTotal = function(){
    //     // material.Recordmaterial.TOTAL_ALPENJUALAN(0);
    //     for(var i in material.ListSubmaterial()){
    //         // material.ListSubmaterial()[i].jumlahSesi(parseInt(material.ListSubmaterial()[i].jumlahSesi()))
    //         // material.ListSubmaterial()[i].hargaperSesi(parseInt(material.ListSubmaterial()[i].hargaperSesi()))
    //         // material.ListSubmaterial()[i].PPN((material.ListSubmaterial()[i].jumlahSesi()*material.ListSubmaterial()[i].hargaperSesi())*0.1);

    //         // material.ListSubmaterial()[i].TOTALPENJUALAN((material.ListSubmaterial()[i].jumlahSesi()*material.ListSubmaterial()[i].hargaperSesi()));

    //         // material.Recordmaterial.TOTAL_ALPENJUALAN((material.Recordmaterial.TOTAL_ALPENJUALAN()+material.ListSubmaterial()[i].TOTALPENJUALAN()));

    //          // material.Recordmaterial.TOTAL_SESI((material.ListSubmaterial()[i].jumlahSesi()*1));

    //      }
    //     // material.Recordmaterial.PPN(material.Recordmaterial.TOTAL_ALPENJUALAN()+0);
    //     // material.Recordmaterial.TOTALKESELURUHAN(material.Recordmaterial.PPN()+material.Recordmaterial.TOTAL_ALPENJUALAN());
    //     // material.TotalRupiah(changeRupiah(material.Recordmaterial.TOTAL_ALPENJUALAN()));
    //     // material.Terbilang(terbilang(material.Recordmaterial.TOTAL_ALPENJUALAN().toString()));
    // }
    // ko.bindingHandlers.sumtotal = {
    //     init: function (element, valueAccessor) {
    //         $(element).on("keyup", function (e) {
    //             var indexTr = $(this).closest('tr').index();
    //             if($(this).attr('name')=='txtjumlahSesi'){
    //                 var txtjumlahSesi = $(this).attr('name', 'txtjumlahSesi').val();
    //                 if (txtjumlahSesi==''){
    //                     txtjumlahSesi = '0';
    //                 }
    //                 var jumlah = parseInt(txtjumlahSesi);
    //                 material.ListSubmaterial()[indexTr].jumlahSesi(jumlah);
    //             }
    //             material.calculateTotal();
    //         });
    //     }
    // }

    material.drawKota = function(){
        $("input[name=txtNAMAKOTA]").tokenInput("<?= base_url('reg/Con_regAnggSiswa/filterKota') ?>", {
            zindex: 700,
            allowFreeTagging: false,
            placeholder: 'Ketikkan nama kota!',
            tokenValue: 'NAMAKOTA',
            propertyToSearch: "NAMAKOTA",
            tokenLimit: 1,
            theme: "facebook",
            onAdd: function (item) {
                var po = material.Recordmaterial;
                po.NAMAKOTA(item.NAMAKOTA);
                po.IDKOTA(item.IDKOTA);
            },
            onDelete: function(item){
                var po = material.Recordmaterial;
                po.NAMAKOTA("");
                po.IDKOTA("");
            },
            resultsFormatter: function(item){
                return "<li>"+item.NAMAKOTA+"</li>"
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
            <div class="card card-body p-b-0" data-bind="with:material">  
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

                        <div class="row p-t-23 " data-bind="with:Recordmaterial" >

                            <div class="col-md-4 margBottom">
                                <div class="form-group ">
                                    <label class="control-label">NIK</label>
                                    <input type="number" name="txtnomorKtp" data-bind="value:nomorKtp, checkId: 'carier/Con_carier/checkKtp'" max="16" id="" required="" class="form-control">
                                    <div class="form-control-feedback" data-bind="visible: model.CheckId()==true">Nomor ktp sudah ada!</div>
                                </div>
                            </div>

                            <div class="col-md-9 margBottom">
                                <div class="input-group">
                                </div>
                            </div>

                            <div class="form-group margMin col-md-6 ">
                                <div class="form-group ">
                                    <label class="control-label">NAMA DEPAN</label>
                                    <input type="text" name="txtnamaDepan" data-bind="value:namaDepan" id="" required="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group margMin col-md-6 ">
                                <div class="form-group ">
                                    <label class="control-label">NAMA BELAKANG</label>
                                    <input type="text" name="txtnamaBelakang" data-bind="value:namaBelakang" id="" required="" class="form-control">
                                </div>
                            </div>

                            <div class="form-group margMin col-md-6 ">
                                <div class="form-group ">
                                    <label class="control-label">ALAMAT RUMAH</label>
                                    <input type="text" name="txtalamat" data-bind="value:alamat" id="" required="" class="form-control">
                                </div>
                            </div>

                            <div class="form-group margMin col-md-6 ">
                                <div class="form-group ">
                                    <label class="control-label">ALAMAT TEMPAT TINGGAL</label>
                                    <input type="text" name="txttempatTinggal" data-bind="value:tempatTinggal" id="" required="" class="form-control">
                                </div>
                            </div>

                            <div class="form-group margMin col-md-2 ">
                                <div class="form-group ">
                                    <label class="control-label">UMUR</label>
                                    <input type="text" name="txtumur" data-bind="value:umur" id="" required="" class="form-control">
                                </div>
                            </div>

                            <div class="form-group margMin col-md-4 ">
                                <div class="form-group ">
                                    <label class="control-label">TEMPAT LAHIR</label>
                                    <input type="text" name="txtNAMAKOTA" data-bind="value:tempatLahir" class="form-control">
                                    <small>Ketikkan nama Kota.</small>
                                </div>
                            </div> 

                            <div class="form-group margMin col-md-6 ">
                                <div class="form-group ">
                                    <label class="control-label">TANGGAL LAHIR</label>
                                    <input type="date" name="txttglLahir" data-bind="value:tglLahir" id="" required="" class="form-control">
                                </div>
                            </div>

                            <div class="form-group margMin col-md-6 ">
                                <div class="form-group ">
                                    <label class="control-label">EMAIL</label>
                                    <input type="email" name="txtemail" data-bind="value:email" id="" required="" class="form-control">
                                </div>
                            </div>

                            <div class="form-group margMin col-md-6 ">
                                <div class="form-group ">
                                    <label class="control-label">NO WHATSAPP</label>
                                    <input type="text" name="txtnoWa" data-bind="value:noWa" class="form-control">
                                </div>
                            </div>

                            <div class="form-group margMin col-md-3 ">
                                <div class="form-group ">
                                    <label class="control-label">NAMA BANK</label>
                                    <select name="txtnamaBank" data-bind="
                                    options: model.Resource.selectBank,
                                    optionsText: 'name',
                                    optionsValue: 'value',
                                    value:namaBank"
                                    class="custom-select col-3" id="inlineFormCustomSelect">
                                </select>
                            </div>
                        </div>

                        <div class="form-group margMin col-md-7 ">
                            <div class="form-group ">
                                <label class="control-label">NO REK</label>
                                <input type="number" name="txtnoRek" data-bind="value:noRek" class="form-control">
                                <small>Isikan dengan nomor rekening anda</small>
                            </div>
                        </div>

                        <div class="form-group margMin col-md-6 ">
                            <div class="form-group ">
                                <label class="control-label">PENDIDIKAN TERAKIR</label>
                                <input type="text" name="txtpendidikanTerakir"  data-bind="value:pendidikanTerakir" id="" required="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group margMin col-md-6 ">
                            <div class="form-group ">
                                <label class="control-label">PENDIDIKAN /PEKERJAAN SEKARANG</label>
                                <input type="text" name="txtpendidikanSekarang"  data-bind="value:pendidikanSekarang" id="" required="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group col-md-7 margList ">
                            <div class="form-group ">
                                <label class="control-label">MENDAFTAR SEBAGAI </label> 
                                <div class="demo-radio-button"> 
                                    <input name="txtkategoriid" type="radio" value="1" data-bind="checked: kategoriid " id="radio_40" class="with-gap radio-col-light-blue">
                                    <label for="radio_40">GURU UMUM</label>
                                    <input name="txtkategoriid" type="radio" value="2" data-bind="checked: kategoriid" id="radio_39" class="with-gap radio-col-light-blue">
                                    <label for="radio_39">GURU QURAN</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 form-rgkrs _20">
                        <button class="btn btn-xl btn-primary form-bt" style="margin-bottom: 10px;" data-bind="click:material.add, visible: material.ModeInsert()==''"><i class="fa fa-plus"></i> Tambah Data</button>
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-hover color-bordered-table muted-bordered-table">
                                <thead> <!-- TABLE UNTUK INVOICE  -->
                                    <tr id="head-transksi">
                                        <th class="text-center g form-bt" width="2%">NO</th>
                                        <th width="55%" class="text-left g form-bt">SEBAGAI TENTOR BIDANG STUDI : </th>
                                        <th class="text-right g form-bt" width="5%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="margTinv" data-bind="foreach: material.ListSubmaterial">
                                    <tr>
                                        <td class="text-center fbt" data-bind="html: ($index()+1)"></td>
                                        <td class="fbt"><input type="text" class="form-control" maxlength="50" data-bind="attr:{'idtoken':'txtkursus'+$index(), 'indextoken': $index()}" /></td>
                                        <td class="text-center fbt"><button class="btn btn-sm btn-danger" data-bind="click: material.removeItem, visible: material.ModeInsert()==''"><i class="fa fa-trash-o"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- ./ end col-md-12 -->
                    <div class="clearfix"></div>
                    <hr>

                    <!-- button save -->
                    <div class="row p-t-23 margMin" >
                        <div class="col-md-12 margMin">
                            <div class="form-group ">
                                <button class="btn btn-xl btn-info" data-bind="click:save, visible:material.ModeInsert()==''" data-toggle="tooltip" data-placement="top" data-original-title="simpan" ><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="data-original-title:Mode"><i class="fa fa-save"></i> Simpan</span></button>
                            </div>
                        </div>
                    </div>
                    <!-- ./ end button save -->

                </div>
            </div>
            <div class="tab-pane" id="tablist">
                <div class="card-body p-20" data-bind="with:material">
                    <div class="row p-t-23 " >
                        <div class="col-md-12 ">
                            <div class="table-responsive m-t-40 animated fadeIn" data-bind="visible:Mode() === ''">
                                <table id="myTable" class="table table-bordered table-striped ">
                                    <thead>
                                        <tr> 
                                            <th>KODE</th> 
                                            <th>CUSTOMER</th> 
                                            <th>TANGGAL</th> 
                                            <th>TOTAL</th> 
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
        if( material.Recordmaterial.nomorKtp() == ""){
            swal({ title: "Warning!",
                text: "Anda wajib mengisi nomor KTP anda!",
                icon: "warning",
            });
            material.ModeInsert('');
            model.Processing(false);
        
        } else{
            var url = "<?php echo base_url('carier/Con_carier/saveRegCarier') ?>";
        }

        // if(material.Mode() === 'Update')
        //     url = "<?php echo base_url('transaksi/C_transaksiPenjualan/update') ?>";

        material.Recordmaterial.LISTCARIER(ko.toJSON(material.ListSubmaterial()));
        ajaxPost(url, material.Recordmaterial, function (res) {
            material.ModeInsert("show");
            material.grid.ajax.reload( null, false );
            material.Recordmaterial.pengguna_idPengguna(res.KODE);
            if (material.Mode() == "Update") {
                material.back(0);
                swal({ title: "Good job!",
                    text: "Updated <?= $title ?>!",
                    icon: "success",
                });
            } 
            else {
                swal({ title: "Good job!",
                    text: "Data anda telah kami terima!",
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
                url: "<?php echo base_url('transaksi/C_transaksiPenjualan/delete') ?>",
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
        material.drawKota();
        material.checkListData();
        // material.drawSuplier();
        // material.drawSiswa();
        material.grid = $("#myTable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url('reg/Con_regKursus/getData') ?>",
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
            {"data": "idSiswa"},
            {
                "data": "idapp_kursus",
                "render": function( data, type, full, meta){
                    return "<button class='btn btn-sm btn-info' onClick='material.selectdata(\""+data+"\")'><i class='fa fa-pencil'></i></button> &nbsp; <button id='sa-warning' class='btn btn-sm btn-danger' onClick='material.remove(\""+data+"\")' id='sa-warning' ><i class='fa fa-trash'></i></button>"; 
                } 
            }
            ],
        });
    });
</script>