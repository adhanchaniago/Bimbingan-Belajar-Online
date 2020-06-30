<script>
    model.masterModel = { 
        KODEKATEGORI: "",
        NAMAKATEGORI:""

        name:"",
        src:"",
    }
    var material = {
        Recordmaterial: ko.mapping.fromJS(model.masterModel), 
        Listmaterial: ko.observableArray([]),
        Mode: ko.observable(''),
        FilterText: ko.observable(''),
        DataFilter: ko.observableArray(['NAMAKATEGORI']),
        FilterValue: ko.observable('NAMAKATEGORI'),
        files: ko.observableArray([]);
    }
    material.drawKategori = function(){
        $("input[name=txtKategori]").tokenInput("<?= base_url('master/Coba/filterKategori') ?>", { 
            zindex: 700,
            allowFreeTagging: false,
            placeholder: 'Input Type Here!!',
            tokenValue: 'KODEKATEGORI',
            propertyToSearch: "NAMAKATEGORI",
            tokenLimit: 1,
            theme: "facebook",
            onAdd: function (item) {
                var po = material.Recordmaterial;
                po.NAMAKATEGORI(item.NAMAKATEGORI);
                po.KODEKATEGORI(item.KODEKATEGORI);
            },
            onDelete: function(item){
                var po = material.Recordmaterial;
                po.NAMAKATEGORI("");
                po.KODEKATEGORI('');
            },
            resultsFormatter: function(item){
                return "<li>"+item.NAMAKATEGORI+"</li>"
            },
            onResult: function (results) {
                return results;
            },
            onCachedResult: function(res){
                return res;
            }
        });
    } 


    function loadMakun()
    {
        var bspl = $("#bspl").val();
        $.ajax({
            type:'GET',
            url:"<?php echo base_url(); ?>index.php/master/C_masterakun/selectAkun",
            data:"id=" + bspl,
            success: function(html)
            { 
                $("#makunArea").html(html);
            }
        }); 
    }



</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <!-- Bread crumb and right sidebar toggle -->
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
                    $cek = ' ';
                    if ($cek == ' ') { 
                        echo "data " . substr($uri_Bcrumb, 0, 15) . "";
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


        
        <div class="col-10">


            <div class="card"> 
            
                <!-- Sidebar scroll-->
                        <div class="scroll-sidebar">
                                <!-- Sidebar navigation-->
                                <nav class="sidebar-nav">
                                        <ul id="sidebarnav">
                                                <li class="nav-small-cap">PERSONAL</li> 
                                                <li> <a href="<?= base_url('Home'); ?>"  class=" waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-gauge"></i>Dashboard</a> 
                                                </li>
                                                <?php  
                                                $idjabatan = $session['JABATANID']; 

                                                // $parent = $this->db->get_where('tb_menu', array('menuparentid' => 0));
                                                $parent = "
                                                SELECT m1.menuparentid, m1.menuname, m1.menuid, (select m2.menuname from tb_menu m2 where m2.menuid=m1.menuparentid) AS menuparentname, tmj.`status`, tj.JABATAN, m1.menulink, m1.menuicon
                                                FROM tb_menu AS m1
                                                LEFT JOIN tb_menu AS m2 ON m1.menuid = m2.menuparentid
                                                INNER JOIN tb_menujabatan as tmj on tmj.menuid = m1.menuid
                                                INNER JOIN tb_jabatan as tj on tj.JABATANID = tmj.JABATANID

                                                WHERE tmj.`status`= 'YES' AND m1.menuparentid=m1.menuparentid
                                                AND tj.JABATANID = '$idjabatan' AND m1.menuparentid='0'

                                                GROUP BY m1.menuid ORDER BY m1.menuname ASC";
                                                $parent = $this->db->query($parent);
                                                        // print_r($parent->result());die();
                                                foreach ($parent->result() as $p) {
                                                        // chek dulu
                                                    $child = "SELECT
                                                    m1.menuid, m1.menuparentid, m1.menuname, m1.menuid, (select m2.menuname from tb_menu m2 where m2.menuid=m1.menuparentid) AS menuparentname, tmj.`status`, tj.JABATAN, m1.menulink, m1.menuicon
                                                    FROM tb_menu AS m1
                                                    LEFT JOIN tb_menu AS m2 ON m1.menuid = m2.menuparentid
                                                    INNER JOIN tb_menujabatan as tmj on tmj.menuid = m1.menuid
                                                    INNER JOIN tb_jabatan as tj on tj.JABATANID = tmj.JABATANID

                                                    WHERE tmj.`status`= 'YES' AND m1.menuparentid=m1.menuparentid
                                                    AND tj.JABATANID = '$idjabatan' AND m1.menuparentid='$p->menuid'

                                                    GROUP BY m1.menuid ORDER BY m1.menuname ASC
                                                    ";

                                                    $subChild = "
                                                    SELECT m1.menuid, m1.menuparentid, m1.menuname, m1.menuid, (select m2.menuname from tb_menu m2 where m2.menuid=m1.menuparentid) AS menuparentname, (select m22.menuname from tb_menu m22 where m22.menuid=m1.submenuparentid) AS submenuparentname, tmj.`status`, tj.JABATAN, m1.menulink, m1.menuicon
                                                    FROM tb_menu AS m1
                                                    LEFT JOIN tb_menu AS m2 ON m1.menuid = m2.menuparentid
                                                    INNER JOIN tb_menujabatan as tmj on tmj.menuid = m1.menuid
                                                    INNER JOIN tb_jabatan as tj on tj.JABATANID = tmj.JABATANID

                                                    WHERE tmj.`status`= 'YES'
                                                    AND tj.JABATANID = '$idjabatan' and m1.submenuparentid=m1.menuid and m1.menuparentid=m1.menuparentid
                                                    GROUP BY m1.menuid ORDER BY m1.menuname ASC

                                                    ";


                                                        $child = $this->db->query($child);
                                                        $subChild = $this->db->query($subChild);
                                                        // print_r($p->menuparentid);die();
                                                        // print_r($subChild->num_rows());die();

                                                        // $child = $this->db->get_where('tb_menu', array('menuparentid' => $p->menuid));
                                                        // print_r($child->num_rows());die();
                                                        if ($child->num_rows() > 0) {
                                                        // tampilkan submenu
                                                        ?> 
                                                                <li><a href="#"  class=" has-arrow waves-effect waves-dark" ><i class="<?= $p->menuicon;?>" ></i><?= $p->menuname;?></a>
                                                        <?php
                                                                echo " <ul aria-expanded='false' class='collapse'>"; 

                                                                foreach ($child->result() as $c) {
                                                                    echo "<li>" . anchor($c->menulink, $c->menuname, array('class' => '')) . "</li>";
                                                                    if ($subChild->num_rows() > 0 ) {

                                                                     echo "" . anchor($c->menulink, $c->menuname, array('class' => '')) . "";
                                                                     echo "<ul aria-expanded='false' class='collapse'>";
                                                                     foreach ($subChild->result() as $sc) {
                                                                           echo "<li>" . anchor($sc->menulink, $sc->menuname, array('class' => '')) . "</li>";
                                                                       }
                                                                       echo "</ul>";
                                                                    } 
                                                                }

                                                                echo "</ul></li>";
                                                                } else {
                                                                        echo "<li>" . anchor($p->menulink, $p->menuname, array('class' => 'has-arrow waves-effect waves-dark')) . "<i class='mdi mdi - gauge'></i></li>";
                                                                }
                                                        } 
                                                ?> 
                                                <!-- contoh navbar 2 submenu -->
                                                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Contoh Navbar</span></a>
                                                        <ul aria-expanded="false" class="collapse">
                                                                <li><a href="app-calendar.html">Calendar</a></li>
                                                                <li>
                                                                        <a class="has-arrow" href="#" aria-expanded="false">Inbox</a>
                                                                        <ul aria-expanded="false" class="collapse">
                                                                                <li><a href="app-email.html">Mailbox</a></li>
                                                                                <li><a href="app-email-detail.html">Mailbox Detail</a></li>
                                                                                <li><a href="app-compose.html">Compose Mail</a></li>
                                                                        </ul>
                                                                </li>
                                                                <li><a href="app-chat.html">Chat app</a></li>
                                                                <li><a href="app-ticket.html">Support Ticket</a></li>
                                                                <li><a href="app-contact.html">Contact / Employee</a></li>
                                                                <li><a href="app-contact2.html">Contact Grid</a></li>
                                                                <li><a href="app-contact-detail.html">Contact Detail</a></li>
                                                        </ul>
                                                </li> 
                                        </ul>
                                </nav>
                                <!-- End Sidebar navigation -->
                        </div>
                        <!-- End Sidebar scroll-->

                <div class="card-body">
                    <?php $msg = $this->session->flashdata('msg1');
                    if ((isset($msg)) && (!empty($msg))) { ?>
                    <div class="alert alert-success">
                        <?php print_r($msg); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div> 
                    <?php } ?>
                    <!-- title -->
                    <div class="col-md-5 align-self-left">
                        <h3 class="text-themecolor"><?= $title ?></h3>
                    </div>

                    <?= form_open('master/Coba') ?> 
                    <div class="form-group">
                        <!-- <legend>Form title</legend> -->
                    </div>

                    <div class="col-md-6 margMin"> <!-- grid col-6 -->
                        <div class="col-md-12 margMin">
                            <div class="form-group ">
                                <label class="control-label"> Kategori</label>
                                <input type="text" name="txtKategori" value="NAMAKATEGORI" id="inputtag" class="form-control">
                            </div>
                        </div>  

                        <div class="col-md-12 margMin">
                            <div class="form-group "> 
                                <label class="control-label"> Select BS / PL</label>  
                                <select name="bspl" id="bspl"  class="select2 form-control custom-select select2-hidden-accessible" onchange="loadMakun()" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                                    <option>Select</option> 
                                    <?php
                                    foreach ($record->result() as $r) {
                                        echo "<option name='nama_bspl' value='$r->id'>$r->nama_bspl</option>";
                                    }
                                    ?>
                                </select>  
                            </div>
                        </div> 
                        <div class="col-md-12 margMin">
                          <p><div name="bspl" id="bsplArea"></div></p>
                          <p><div name="makun" id="makunArea"></div> </p>
                      </div>  

                  </form> 
                  <div class="col-md-12 margMin">
                    <div class="alert">
                        <h4 id="fungsi">Fungsi auto currency detection : </h4> <hr>
                        <strong><?= $nilai.',00';  ?></strong><br>
                        <strong><i><?= $terbilang; ?></i></strong>
                    </div>
                </div>

                <div class="col-md-12 margMin">
                    <div class="alert">
                        <h4 id="fungsi">Fungsi Generate ID : </h4> <hr>
                        <strong><?php 
                        echo $generateID;
                        // print_r($generateID);
                        ?></strong><br>
                    </div>
                </div>

                <div class="col-md-12 margMin">
                    <div class="alert">
                        <h4 id="fungsi">Fungsi Generate AI : <?php 
                        ?></h4> <hr>
                        <strong><?php 
                        print_r('jo/'.$generateAI);
                        ?></strong><br>
                    </div>
                </div>

                <div class="col-md-12 margMin">
                    <div class="alert">
                        <h4 id="fungsi">Fungsi Generate KODE : <?php 
                        ?></h4> <hr>
                        <strong><?php 
                        print_r($generate);
                        ?></strong><br>
                    </div>
                </div>

                <div class="col-md-12 margMin">
                    <div class="alert">
                        <h4 id="fungsi">Fungsi auto Date-splitter detection: </h4> <hr>
                        <strong><?php  
                        echo $tgl.'-'.$bulan.'-'.$tahun;
                        ?></strong><br>
                    </div>
                </div>

                <div class="col-md-12 margMin">
                    <div class="alert">
                        <h4 id="fungsi">Fungsi Manual Date-splitter detection: </h4> <hr>
                        <strong><?php  
                        echo $manualDate;
                        ?></strong><br>
                    </div>
                </div>

                <div class="col-md-12 margMin">
                    <div class="alert">
                        <h4 id="fungsi">Fungsi uniqid : </h4> <hr>
                        <strong><?php
                        echo $uid.'<br>';
                        ?></strong><br>
                    </div>
                </div>




            </div>
 


        </div>
    </div>














    <script>
        $(document).ready(function () { 
            material.drawKategori();
            model.Processing(true);
        });
    </script>