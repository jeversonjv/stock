<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    private $data = [];

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata("usuario_id")){
            redirect("/login");
        }

        $this->load->model("clienteModel", "", TRUE);
    }

    public function index() {
        $this->template->setTitulo("Clientes");
        $this->template->loadView("template/layout", "Clientes/Listagem");
    }

    public function adicionar() {
        if($this->session->flashdata("cliente")) {
            $this->data["cliente"] = $this->session->flashdata("cliente");
        }

        $this->template->setTitulo("Clientes");
        $this->template->loadView("template/Layout", "Clientes/Formulario", $this->data);
    }

    public function editar($cliente_id) {

    }

    public function salvar() {
        try {
            $data = carregarDadosPOST($this->input->post());
            unset($data["cliente_id"]);
            $cliente_id = $this->input->post("cliente_id");
            $this->clienteModel->salvar_cliente($data, $cliente_id);
            $this->session->set_flashdata("mensagemSucesso", "Cliente " . ($cliente_id ? "editado" : "criado") . "com sucesso!");
            redirect("/clientes");
        } catch(Exception $e) {
            $this->session->set_flashdata("cliente", (object) $data);
            $this->session->set_flashdata("mensagemErro", $e->getMessage());
            redirect($cliente_id ? "/clientes/editar/{$cliente_id}" : "/clientes/adicionar");
        }
    }

    public function excluir($cliente_id) {

    }

}