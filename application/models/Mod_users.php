<?php
class Mod_users extends ci_model{

    function select_all(){
        $query="SELECT
        app_users.userid,
        tb_pengguna.namaDepan,
        tb_pengguna.namaBelakang,
        tb_pengguna.foto,
        app_users.username,
        app_users.password,
        tb_role.nama as role, tb_role.roleId, tb_pengguna.penggunaId
        FROM app_users, tb_role, tb_pengguna WHERE tb_pengguna.tb_role_roleId = tb_role.roleId AND app_users.tb_pengguna_penggunaid = tb_pengguna.penggunaId";
        return $this->db->query($query);
    }

    // function getAll()
    // {
    //     $this->db->order_by('userid', 'ASC');
    //     $data = $this->db->get('app_users'); return $data;
    // }
    

    function simpan(){
        $data=array(
            'userid'        => uniqid(),
            'username'      =>  $this->input->post('username'),
            'password'      =>  md5($this->input->post('password')),
            'tb_pengguna_penggunaid' =>  $this->input->post('penggunaId'),
        );

        // print_r($data);die();
        $this->db->insert('app_users',$data);
    }

    function updateFoto($gambar){
        $data=array(
            'foto'           =>   $gambar,
        );
        $this->db->where('penggunaId',$this->input->post('idpengguna'));
        $this->db->update('tb_pengguna',$data);
    }
    
    
    function update(){
        $data=array(
            'username'      =>  $this->input->post('username'),
            'password'      =>  $this->input->post('password'),
            'tb_pengguna_penggunaid' =>  $this->input->post('penggunaId'),
        );
        $this->db->where('userid',$this->input->post('userid'));
        $this->db->update('tabel_product',$data);
    }



    function selectRole(){
        $query="SELECT tb1.roleId, tb1.nama as role FROM tb_role as tb1 ";
        return $this->db->query($query);
    }

    function selectData($id){
        $query = " SELECT
        app_users.userid,
        tb_pengguna.namaDepan,
        tb_pengguna.namaBelakang,
        app_users.username,
        app_users.password,
        tb_role.nama as role, tb_role.roleId, tb_pengguna.penggunaId
        FROM app_users, tb_role, tb_pengguna WHERE tb_pengguna.tb_role_roleId = tb_role.roleId AND app_users.tb_pengguna_penggunaid = tb_pengguna.penggunaId AND app_users.userid='$id' ";
        return $this->db->query($query);
    }

    function selectPengguna(){
        $query = "SELECT
        tb_pengguna.penggunaId,
        tb_pengguna.tb_role_roleId,
        tb_role.nama as role,
        tb_pengguna.namaDepan,
        tb_pengguna.namaBelakang
        FROM tb_pengguna
        INNER JOIN tb_role on tb_pengguna.tb_role_roleId=tb_role.roleId";
        return $this->db->query($query);
    }

}