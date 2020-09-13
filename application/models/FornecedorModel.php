<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class FornecedorModel extends CI_Model {

    private $tbl;
    private $usuario_id;

    public function __construct() {
        parent::__construct();

        $this->tbl = "fornecedor";
        $this->usuario_id = $this->session->userdata("usuario_id");
    }

    public function get_all() {
        $this->db->where("usuario_id", $this->usuario_id);
        return $this->db->get($this->tbl);
    }

    public function get_by_id($fornecedor_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("fornecedor_id", $fornecedor_id);
        return $this->db->get($this->tbl);
    }

    private function get_by_cnpj($cnpj) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("cnpj", $cnpj);
        return $this->db->get($this->tbl);
    }

    private function get_by_email($email) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("email", $email);
        return $this->db->get($this->tbl);
    }

    private function salvar($data) { 
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

    private function update($fornecedor_id, $data) {
        $this->db->where("fornecedor_id", $fornecedor_id);
        return $this->db->update($this->tbl, $data);
    }

    public function delete($fornecedor_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("fornecedor_id", $fornecedor_id);
        return $this->db->delete($this->tbl);
    }

    function salvar_fornecedor($data, $fornecedor_id = NULL) {
        $this->form_validation->set_rules("nome", "Nome", "trim|required");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
        $this->form_validation->set_rules("celular", "Celular", "trim|required");
        $this->form_validation->set_rules("cnpj", "CNPJ", "trim|required");

        if($this->form_validation->run()){
            $fornecedor = $this->get_by_cnpj($data["cnpj"]);
            if($fornecedor->num_rows() > 0) {
                if($fornecedor_id) {
                    $fornecedor = $fornecedor->row();
                    if($fornecedor->fornecedor_id != $fornecedor_id) {
                        throw new Exception("CNPJ já cadastrado na base!");
                    }
                } else {
                    throw new Exception("CNPJ já cadastrado na base!");
                }
            }

            $fornecedor = $this->get_by_email($data["email"]);
            if($fornecedor->num_rows() > 0) {
                if($fornecedor_id) {
                    $fornecedor = $fornecedor->row();
                    if($fornecedor->fornecedor_id != $fornecedor_id) {
                        throw new Exception("E-mail já cadastrado na base!");
                    }
                } else {
                    throw new Exception("E-mail já cadastrado na base!");
                }
            }

            if($fornecedor_id) {
                $this->update($fornecedor_id, $data);
            } else {
                $data["data_cadastro"] = date("Y-m-d H:i:s");
                $data["usuario_id"] = $this->usuario_id;
                $fornecedor_id = $this->salvar($data);
            }

            return $fornecedor_id;

        } else {
            throw new Exception("Preencha os campos corretamente!");
        }
    }

}