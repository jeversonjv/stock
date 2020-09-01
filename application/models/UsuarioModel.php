<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioModel extends CI_Model {

    private $tbl = "usuario";

    function get_by_email($email, $ativo = true){
        if($ativo) {
            $this->db->where("ativo", $ativo);    
        }

        $this->db->where("email", $email);
        return $this->db->get($this->tbl);
    }

    function salvar($data){
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

}