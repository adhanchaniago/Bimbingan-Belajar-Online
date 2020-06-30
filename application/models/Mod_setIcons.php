<?php
class Mod_setIcons extends ci_model{

    function select_all(){
        $query=" SELECT
        tb_icons.idIcons,
        tb_icons.namaIcon,
        tb_icons.src,
        tb_pathprojek.folProjek
        FROM tb_icons
        inner join tb_pathprojek on tb_icons.folProjekId=tb_pathprojek.id";
        return $this->db->query($query);
    }

    // function getAll()
    // {
    //     $this->db->order_by('userid', 'ASC');
    //     $data = $this->db->get('app_users'); return $data;
    // }
    

    function simpan($gambar){
        $data=array(
            'namaIcon'      =>  $this->input->post('namaIcon'),
            'src'           =>  $gambar,
            'folProjekId'   => '1',
        );

        // print_r($data);die();
        $this->db->insert('tb_icons',$data);
    }

// 610010087113319

    function update($gambar=""){
        if ($gambar == "") {
            $data=array(
                'namaIcon'      =>  $this->input->post('namaIcon')
            );
        } else {
            $data=array(
                'namaIcon'      =>  $this->input->post('namaIcon'),
                'src'           =>   $gambar,
            );
        }
        $this->db->where('idIcons',$this->input->post('idIcons'));
        $this->db->update('tb_icons',$data);
    }
    
    
    // function update(){
    //     $data=array(
    //         'username'      =>  $this->input->post('username'),
    //         'password'      =>  $this->input->post('password'),
    //         'tb_pengguna_penggunaid' =>  $this->input->post('penggunaId'),
    //     );
    //     $this->db->where('userid',$this->input->post('userid'));
    //     $this->db->update('tabel_product',$data);
    // }



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