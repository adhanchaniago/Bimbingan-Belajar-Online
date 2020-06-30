<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class SetIcons extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper(array(
            'login','my',
            'configsession')); cek_login();
        $this->load->model('Mod_setIcons', 'moddul');
    }
    function index(){
        $data['title'] = "Data Setup Icons";
        // print session = $session['sessionName']; sessionname in configsession_helper file.
        $data['session']= session();

         // modal tambah data
        $data['title_modal'] = "Tambah data Icons";
        $data['modal_tambah_data'] = show_my_modal('modals/modal_tambah_setIcons', 'tambah-Icons', $data);
        // end------

        $data['recordUpdate'] = $this->moddul->select_all();

        $data['record']=  $this->moddul->select_all()->result();
        $this->template->load('_template', 'pengguna/setIcons/_dataSetIcons', $data);
    }

    function prosesPost_dataIcons(){
      $namaIcon = $this->input->post('namaIcon');

      if (isset($_POST['save'])) {

        $config['upload_path']          = './assets/icons/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = seo_title($namaIcon);
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image'))
        {
            $data = $this->upload->data("file_name");
            $this->moddul->simpan($data);
        }
        $this->session->set_flashdata('msg1', 'Data berhasil diinput!');
        redirect('master/SetIcons');
    }
}


function prosesUpdate_Icons(){
   $namaIcon = $this->input->post('namaIcon');

   if (isset($_POST['update'])) {

    $config['upload_path']          = './assets/icons/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = seo_title($namaIcon);
    $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image'))
        {
            $data = $this->upload->data("file_name");
            $this->moddul->update($data);
        } else {
            $this->moddul->update();
        }
        $this->session->set_flashdata('msg1', 'Data berhasil diinput!');
        redirect('master/SetIcons');
    }
}





    // function getData(){
    //     $data = array('start' => $_POST['start'],
    //         'length' => $_POST['length'],
    //         'filtervalue' => $_POST['filtervalue'],
    //         'filtertext' => $_POST['filtertext']);
    //     $res = $this->moddul->getDataUserLogin($data); echo json_encode($res);
    // }


    // function post(){
    //     if(isset($_POST['submit'])){
    //         $config['upload_path']='./gambar_product/';
    //         $config['allowed_types']='jpg|png';
    //         $this->load->library('upload',$config);
    //         $this->upload->do_upload();
    //         $data=  $this->upload->data();
    //         $this->mod_product->simpan($data['file_name']);
    //         redirect('admin/product');
    //     }else{
    //         $data['kategori']=  $this->mod_kategori->select_all()->result();
    //         $this->template->load('templateadmin','admin/product/post',$data);
    //     }
    // }



function delete(){
    $this->db->where('idIcons',$this->uri->segment(4)); 
    $this->db->delete('tb_icons');
    redirect('master/SetIcons');
}

}