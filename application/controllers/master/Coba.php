<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Coba extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper(array('login','my','configsession'));
        $this->load->library('Pdf');
        $this->load->model('master/BarangModel');
        cek_login();
    }
    function index(){
        $data['title'] = "Data Documentation-Source";
        // print session = $session['sessionName']; sessionname in configsession_helper file.
        $data['session']= session();
        // fungsi input 2 
        $data['kategori'] = $this->db->query('SELECT * FROM tb_kategori')->result();
        $data['record']    = $this->db->get('tb_bs_pl'); 

        // fungsi terbilang.
        $data['nilai'] = toRupiah(2120355000);
        $data['terbilang'] = terbilang(hapusKarakter($data['nilai']));
        

        // fungsi generate ID
        $sql = 'SELECT * from tb_urut';
        $queryUrutran = $this->db->query($sql); 

        foreach ($queryUrutran->result() as $v) {
            $kode = $v->noUrut;
            $namaForm = $v->namaForm; 
        }

        // fungsi generate ID
        $data['generateID'] = generateId($kode,$namaForm);

        // fungsi generate AI 
        $number = $kode;
        $data['generateAI'] = generateAI($number);
        
        // fungsi pemisah tanggal sekarang.
        $data['bulan'] = splitTgl();
        $data['tgl'] = splitBulan();
        $data['tahun'] = splitTahun(); 

        // fungsi manual date form input form
        $tanggal = '13/04/2021'; 
        $data['manualDate']=splitDate($tanggal);

        $kode= 'JO';
        $status = 'get';
        $data['generate'] = generateKodeForm($kode,$status);
        $data['uid'] = uniqid('kurs');


        $this->template->load('_template', '_coba', $data); 
    }
    function cobaGenerateKode(){
        echo generateKodeForm('KK', 'get');
        echo generateKodeForm('KK', 'tambah');
    }
    function filterKategori(){
        $res = $this->BarangModel->getFilterKategori($_GET['q']);
        echo json_encode($res);
    }
    public function masterAkun()
    {
        $bsplID     = $_GET['id'];
        $makun      = $this->db->get_where('tb_makun',array('id_bs_pl'=>$bsplID));
        echo " <div class='form-group'>
        <label>Pilih Akun</label>";
        echo "<select name='makun' id='makun' class='form-control'>";
        foreach ($makun->result() as $d)
        {
            echo "<option value='$d->idmakun'>$d->nama_makun</option>";
        }
        echo"</select></div>";
    }

    public function downloadpdf(){
        $data['tgl'] = date("d/m/Y");
        $this->load->view('admin/master/_dataPdf',$data);
    }





}