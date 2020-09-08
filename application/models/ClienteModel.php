<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClienteModel extends CI_Model {

    private $tbl = "cliente";

    function get_all() {
        return $this->db->get($this->tbl);
    }

    function get_by_id($cliente_id) {
        $this->db->where("cliente_id", $cliente_id);
        return $this->db->get($this->tbl);
    }

    function salvar($data) { 
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

    function update($cliente_id, $data) {
        $this->db->where("cliente_id", $cliente_id);
        return $this->db->update($this->tbl, $data);
    }

    function delete($cliente_id) {
        $this->db->where("cliente_id", $cliente_id);
        return $this->db->delete($this->tbl);
    }

}