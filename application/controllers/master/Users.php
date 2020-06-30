<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper(array(
            'login',
            'configsession')); cek_login();
        $this->load->model('Mod_users', 'moddul');
    }
    function index(){
        $data['title'] = "Data User Login Aplikasi";
        // print session = $session['sessionName']; sessionname in configsession_helper file.
        $data['session']= session();

         // modal tambah data
        $data['title_modal'] = "Tambah data User";
        $data['modal_tambah_data'] = show_my_modal('modals/modal_tambah_user', 'tambah-User', $data);
        // end------

        $data['recordUpdate'] = $this->moddul->select_all();

        $data['record']=  $this->moddul->select_all()->result();
        $this->template->load('_template', 'pengguna/users/_dataUserLogin', $data);
    }

    function prosesPost_dataUser(){

      $idpengguna = $this->input->post('penggunaId');
      $pengguna = $this->db->query("SELECT tb_pengguna.email, tb_pengguna.namaDepan, tb_pengguna.namaBelakang FROM tb_pengguna where penggunaId='$idpengguna' ")->row_array();


      /* kirim data username, password ke kontak email pengguna yang telah mendaftar */
        $email      = $pengguna['email']; // kepada
        $subject    = "USER LOGIN BILIKILMU.COM"; // JUDUL PESAN

        $message    = "
        <img src='http://bilikilmu.com/wp-content/uploads/2019/10/bilikilmu.png' width='20%' />
        <P>
        Dear ".$pengguna['namaDepan']." ".$pengguna['namaBelakang']." (<i>".$pengguna['email']."</i>),<br/><br/>

        Terima kasih telah menggunakan layanan Bilik Ilmu. Kami beritahukan bahwa akun anda telah aktif. Berikut informasi detailnya : <br/><br/>

        Download aplikasi : bilikilmu<br/>
        username : <b>".$this->input->post('username')."</b><br/>
        password : <b>".$this->input->post('password')."</b><br/><br/><br/>

        Anda dapat login ke Aplikasi Bilik Ilmu dengan akun tersebut. Password tersebut hanya anda yang mengetahuinya, jangan berikan password anda kepada siapapun.<br/>
        Demikian informasi dari kami mengenai User Login Aplikasi Bilik Ilmu Anda. Terima kasih telah menggunakan layanan bilikilmu.com<br/>
        Jabat erat,<br/><br/><br/>
        Customer Service<br/>
        -------------------------<br/><br/>
        Sales & Customer Service : info@bilikilmu.com<br/>
        Website : bilikilmu.com<br/>
        </P> "; /*ISI PESAN*/

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://articuno.rapidplex.com',
            'smtp_port' => 465,
            'smtp_user' => 'info@bilikilmu.com',
            'smtp_pass' => 'abffsjljwxq7',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('info@bilikilmu.com'); // dari
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        // $this->email->attach($logobilik);
        if($pengguna['email'] != "")
        {
            $this->email->send();
            echo 'Email send.';
            $this->moddul->simpan();
        }
        else
        {
            // show_error($this->email->print_debugger());
            $this->session->set_flashdata('notfoundEmail', 'Gagal mengirim data user login!, Silahkan Check Email Pengguna yang di maksud!');
            redirect('master/Users');
        }

        $this->session->set_flashdata('msg1', 'Data berhasil diinput!');
        redirect('master/Users');
    }


    function prosesUpdate_FotoUser(){
        $id = $this->input->post('idpengguna');

        $config['upload_path']='./images/';
        $config['file_name']=$id; 
        $config['allowed_types']='jpg|png';
        $this->load->library('upload',$config);
        $this->upload->do_upload();
        $data=  $this->upload->data();

        $this->moddul->updateFoto($data['file_name']);        

        $this->session->set_flashdata('msg1', 'Data berhasil diUpdate!');
        redirect('master/Users');
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
        $this->db->where('userid',$this->uri->segment(4));
        $this->db->delete('app_users');
        redirect('master/Users');
    }
}