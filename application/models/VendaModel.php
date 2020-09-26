<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class VendaModel extends CI_Model {

    private $tbl;
    private $usuario_id;

    public function __construct() {
        parent::__construct();

        $this->tbl = "venda";
        $this->usuario_id = $this->session->userdata("usuario_id");
    }

    public function get_all() {
        $this->db->where("usuario_id", $this->usuario_id);
        return $this->db->get($this->tbl);
    }

    public function get_by_id($venda_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("venda_id", $venda_id);
        return $this->db->get($this->tbl);
    }

    private function salvar($data) { 
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

    private function update($venda_id, $data) {
        $this->db->where("venda_id", $venda_id);
        return $this->db->update($this->tbl, $data);
    }

    public function delete($venda_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("venda_id", $venda_id);
        return $this->db->delete($this->tbl);
    }

    function salvar_venda($data, $venda_id = NULL) {
        $this->form_validation->set_rules("nome", "Nome", "trim|required");

        if($this->form_validation->run()){
            if($venda_id) {
                $this->update($venda_id, $data);
            } else {
                $data["data_cadastro"] = date("Y-m-d H:i:s");
                $data["usuario_id"] = $this->usuario_id;
                $venda_id = $this->salvar($data);
            }

            return $venda_id;

        } else {
            throw new Exception("Preencha os campos corretamente!");
        }
    }

}