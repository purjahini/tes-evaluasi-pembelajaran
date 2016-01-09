<?php

class Login_model extends CI_Model{

    function validasi($pengguna,$password){
        $this->db->where('pengguna',$pengguna);
        $this->db->where('password',md5($password));
        $this->db->where('status','Aktif');
        $query=$this->db->get('pengguna');
        return $query;
    }
}
