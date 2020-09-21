<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class ProdutoModel extends CI_Model {

    private $tbl;
    private $usuario_id;

    public function __construct() {
        parent::__construct();

        $this->tbl = "produto";
        $this->usuario_id = $this->session->userdata("usuario_id");
    }

    public function get_all() {
        $this->db->select("produto.*");
        $this->db->select("fornecedor.nome as fornecedor_nome");
        $this->db->select("categoria.nome as categoria_nome");

        $this->db->join("fornecedor", "fornecedor.fornecedor_id = produto.fornecedor_id", "left");
        $this->db->join("categoria", "categoria.categoria_id = produto.categoria_id", "left");

        $this->db->where("produto.usuario_id", $this->usuario_id);
        return $this->db->get($this->tbl);
    }

    public function get_by_id($produto_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("produto_id", $produto_id);
        return $this->db->get($this->tbl);
    }

    private function salvar($data) { 
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

    private function update($produto_id, $data) {
        $this->db->where("produto_id", $produto_id);
        return $this->db->update($this->tbl, $data);
    }

    public function delete($produto_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("produto_id", $produto_id);
        return $this->db->delete($this->tbl);
    }

    function salvar_produto($data, $produto_id = NULL) {
        $this->form_validation->set_rules("nome", "Nome", "trim|required");

        if($this->form_validation->run()){
            if($produto_id) {
                $this->update($produto_id, $data);
            } else {
                $data["data_cadastro"] = date("Y-m-d H:i:s");
                $data["usuario_id"] = $this->usuario_id;
                $produto_id = $this->salvar($data);
            }

            return $produto_id;

        } else {
            throw new Exception("Preencha os campos corretamente!");
        }
    }

}