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
        $this->data["clientes"] = $this->clienteModel->get_all()->result();
        $this->template->setTitulo("Clientes");
        $this->template->loadView("template/layout", "Clientes/Listagem", $this->data);
    }

    public function adicionar() {
        if($this->session->flashdata("cliente")) {
            $this->data["cliente"] = $this->session->flashdata("cliente");
        }
        $this->template->setTitulo("Clientes - Adicionar");
        $this->template->loadView("template/Layout", "Clientes/Formulario", $this->data);
    }

    public function editar($cliente_id) {
        $this->data["cliente"] = $this->clienteModel->get_by_id($cliente_id)->row();
        $this->data["cliente_id"] = $cliente_id;
        $this->template->setTitulo("Clientes - Editar");
        $this->template->loadView("template/Layout", "Clientes/Formulario", $this->data);
    }

    public function salvar() {
        try {
            $data = carregarDadosPOST($this->input->post());
            unset($data["cliente_id"]);
            $cliente_id = $this->input->post("cliente_id");
            $this->clienteModel->salvar_cliente($data, $cliente_id);
            $this->session->set_flashdata("mensagemSucesso", "Cliente " . ($cliente_id ? "Editado" : "Criado") . " Com Sucesso!");
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