<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class CategoriaModel extends CI_Model {

    private $tbl;
    private $usuario_id;

    public function __construct() {
        parent::__construct();

        $this->tbl = "categoria";
        $this->usuario_id = $this->session->userdata("usuario_id");
    }

    public function get_all() {
        $this->db->where("usuario_id", $this->usuario_id);
        return $this->db->get($this->tbl);
    }

    public function get_by_id($categoria_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("categoria_id", $categoria_id);
        return $this->db->get($this->tbl);
    }

    private function salvar($data) { 
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

    private function update($categoria_id, $data) {
        $this->db->where("categoria_id", $categoria_id);
        return $this->db->update($this->tbl, $data);
    }

    public function delete($categoria_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("categoria_id", $categoria_id);
        return $this->db->delete($this->tbl);
    }

    function salvar_categoria($data, $categoria_id = NULL) {
        $this->form_validation->set_rules("nome", "Nome", "trim|required");

        if($this->form_validation->run()){
            if($categoria_id) {
                $this->update($categoria_id, $data);
            } else {
                $data["data_cadastro"] = date("Y-m-d H:i:s");
                $data["usuario_id"] = $this->usuario_id;
                $categoria_id = $this->salvar($data);
            }

            return $categoria_id;

        } else {
            throw new Exception("Preencha os campos corretamente!");
        }
    }

}