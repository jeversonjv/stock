<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class ClienteModel extends CI_Model {

    private $tbl;
    private $usuario_id;

    public function __construct() {
        parent::__construct();

        $this->tbl = "cliente";
        $this->usuario_id = $this->session->userdata("usuario_id");
    }

    public function get_all() {
        $this->db->where("usuario_id", $this->usuario_id);
        return $this->db->get($this->tbl);
    }

    public function get_by_id($cliente_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("cliente_id", $cliente_id);
        return $this->db->get($this->tbl);
    }

    public function get_by_cpf($cpf) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("cpf", $cpf);
        return $this->db->get($this->tbl);
    }

    public function get_by_email($email) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("email", $email);
        return $this->db->get($this->tbl);
    }

    public function get_aleatorio() {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->order_by("RAND()");
        return $this->db->get($this->tbl);
    }

    private function salvar($data) { 
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

    private function update($cliente_id, $data) {
        $this->db->where("cliente_id", $cliente_id);
        return $this->db->update($this->tbl, $data);
    }

    public function delete($cliente_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("cliente_id", $cliente_id);
        return $this->db->delete($this->tbl);
    }

    function salvar_cliente($data, $cliente_id = NULL) {
        $this->form_validation->set_rules("nome", "Nome", "trim|required");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
        $this->form_validation->set_rules("data_nascimento", "Data de Nascimento", "required");
        $this->form_validation->set_rules("sexo", "Sexo", "required");
        $this->form_validation->set_rules("celular", "Celular", "trim|required");
        $this->form_validation->set_rules("rg", "RG", "trim|required");
        $this->form_validation->set_rules("cpf", "CPF", "trim|required");
        $this->form_validation->set_rules("cep", "CEP", "trim|required");
        $this->form_validation->set_rules("endereco", "Endereço", "trim|required");
        $this->form_validation->set_rules("bairro", "Bairro", "trim|required");
        $this->form_validation->set_rules("numero", "Número", "trim|required");
        $this->form_validation->set_rules("cidade", "Cidade", "trim|required");
        $this->form_validation->set_rules("estado", "Estado", "trim|required");

        if($this->form_validation->run()){
            $cliente = $this->get_by_cpf($data["cpf"]);
            if($cliente->num_rows() > 0) {
                if($cliente_id) {
                    $cliente = $cliente->row();
                    if($cliente->cliente_id != $cliente_id) {
                        throw new Exception("CPF já cadastrado na base!");
                    }
                } else {
                    throw new Exception("CPF já cadastrado na base!");
                }
            }

            $cliente = $this->get_by_email($data["email"]);
            if($cliente->num_rows() > 0) {
                if($cliente_id) {
                    $cliente = $cliente->row();
                    if($cliente->cliente_id != $cliente_id) {
                        throw new Exception("E-mail já cadastrado na base!");
                    }
                } else {
                    throw new Exception("E-mail já cadastrado na base!");
                }
            }

            if($cliente_id) {
                $this->update($cliente_id, $data);
            } else {
                $data["data_cadastro"] = date("Y-m-d H:i:s");
                $data["usuario_id"] = $this->usuario_id;
                $cliente_id = $this->salvar($data);
            }

            return $cliente_id;

        } else {
            throw new Exception("Preencha os campos corretamente!");
        }
    }

}