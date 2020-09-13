<?php

class Fornecedores extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();

        $this->load->model("fornecedorModel", "", TRUE);
    }

    public function index() {
        $this->data["fornecedores"] = $this->fornecedorModel->get_all()->result();
        $this->template->setTitulo("Fornecedores");
        $this->template->loadView("template/layout", "Fornecedores/Listagem", $this->data);
    }

    public function adicionar() {
        if($this->session->flashdata("fornecedor")) {
            $this->data["fornecedor"] = $this->session->flashdata("fornecedor");
        }
        $this->template->setTitulo("Fornecedores - Adicionar");
        $this->template->loadView("template/Layout", "Fornecedores/Formulario", $this->data);
    }

    public function visualizar($cliente_id) {
        $cliente = $this->clienteModel->get_by_id($cliente_id);

        if($cliente->num_rows() === 0) redirect("/clientes");

        $this->data["cliente"] = $cliente->row();
        $this->data["somente_visualizar"] = true;
        $this->template->setTitulo("Clientes - Visualizar");
        $this->template->loadView("template/Layout", "Clientes/Formulario", $this->data);
    }

    public function editar($cliente_id) {
        $cliente = $this->clienteModel->get_by_id($cliente_id);

        if($cliente->num_rows() === 0) redirect("/clientes");

        $this->data["cliente"] = $cliente->row();
        $this->data["cliente_id"] = $cliente_id;
        $this->template->setTitulo("Clientes - Editar");
        $this->template->loadView("template/Layout", "Clientes/Formulario", $this->data);
    }

    public function excluir($cliente_id) {
        $res = $this->clienteModel->delete($cliente_id);

        if($res) {
            $this->session->set_flashdata("mensagemSucesso", "Cliente excluído Com Sucesso!");
        } else {
            $this->session->set_flashdata("mensagemErro", "Ocorreu um erro ao excluir o cliente!");
        }

        redirect("/clientes");
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

}