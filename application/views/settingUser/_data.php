<!-- ./end -->
<div class="content">
    <div class="container-fluid">
        <!-- Bread crumb and right sidebar toggle -->
        <div class="row page-titles"> 
            <div class="col-md-12 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>home">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card data-tables">
                    <div class="card-body table-striped table-no-bordered table-hover dataTable dtr-inline table-full-width">
                        <div class="toolbar">
                            <!-- modal button -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tambah-User">Add New</button>  
                            <!--Here you can write extra buttons/actions -->
                        </div>
                        <div class="fresh-datatables">
                            <!-- notif -->
                            <?php $msg = $this->session->flashdata('msg_sukses');
                            if ((isset($msg)) && (!empty($msg)))
                            { 
                                ?>
                                <div class="alert alert-success">
                                    <?php print_r($msg); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                </div> 
                                <?php } ?> 
                                <?php $msg = $this->session->flashdata('msg_delete');
                                if ((isset($msg)) && (!empty($msg)))
                                { 
                                    ?>
                                    <div class="alert alert-warning">
                                        <?php print_r($msg); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                    </div> 
                                    <?php } ?>
                                    <!-- end notif -->
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Ruangan</th>
                                                <th>Status Pegawai</th>
                                                <th class="disabled-sorting text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Ruangan</th>
                                                <th>Status Pegawai</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                            $no=1; 
                                            foreach ($record->result() as $r) { ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $r->namaDepan.' '.$r->namaBelakang; ?></td> 
                                                <td><?= $r->namajabatan?></td> 
                                                <td><?= $r->namaruangan; ?></td> 
                                                <td><?= $r->statusPegawai; ?></td> 
                                                <td class="text-right"> 
                                                    <button type="button" class="btn btn-link btn-info" data-toggle="modal" data-target="#modal_view<?= $r->idUser; ?>"><i class="fa fa-eye fa-1x"></i></button>
                                                    <button type="button" class="btn btn-link btn-warning" data-toggle="modal" data-target="#modal_editUser<?= $r->idUser; ?>"><i class="fa fa-edit fa-1x"></i></button>    
                                                    <a href="javascript:void(0);" onclick="del(<?= $r->idUser;?>);" class="btn btn-link btn-danger remove"><i class="fa fa-times fa-1x"></i></a>
                                                </td>
                                            </tr>
                                            <?php $no++; } ?> 

                                        </tbody>
                                    </table>
                                    <span id="demo"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <!-- footer -->
        <?php $this->load->view('template/_footer'); ?>


        <!-- Data modal view-->
        <?php $this->load->view('modals/modal_view_user');?>
        <!-- Data modal update -->
        <?php $this->load->view('modals/modal_update_user');?>
        <!-- Data modal add -->
        <?php echo $modal_tambah_data; ?>
        <div id="tempat-modal"></div>


        <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js" type="text/javascript"></script> 



        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatables').DataTable();
            });

            var url="<?php echo base_url();?>";
            function del(idUser){
               var r = confirm("Do you want to delete this?")
               if (r==true)
                  window.location = url+"setting/C_user/delete/"+idUser;
              else
                  return false;
          } 

      </script>