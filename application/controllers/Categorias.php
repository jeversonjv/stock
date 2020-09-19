<?php

class Categorias extends CI_Controller {

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
        if($this->session->flashdata("categoria")) {
            $this->data["categoria"] = $this->session->flashdata("categoria");
        }
        $this->template->setTitulo("Fornecedores - Adicionar");
        $this->template->loadView("template/Layout", "Fornecedores/Formulario", $this->data);
    }

    public function visualizar($fornecedor_id) {
        $categoria = $this->fornecedorModel->get_by_id($fornecedor_id);

        if($categoria->num_rows() === 0) redirect("/fornecedores");

        $this->data["categoria"] = $categoria->row();
        $this->data["somente_visualizar"] = true;
        $this->template->setTitulo("Clientes - Visualizar");
        $this->template->loadView("template/Layout", "Fornecedores/Formulario", $this->data);
    }

    public function editar($fornecedor_id) {
        $categoria = $this->fornecedorModel->get_by_id($fornecedor_id);

        if($categoria->num_rows() === 0) redirect("/fornecedores");

        $this->data["categoria"] = $categoria->row();
        $this->data["fornecedor_id"] = $fornecedor_id;
        $this->template->setTitulo("Clientes - Editar");
        $this->template->loadView("template/Layout", "Fornecedores/Formulario", $this->data);
    }

    public function excluir($fornecedor_id) {
        $res = $this->fornecedorModel->delete($fornecedor_id);

        if($res) {
            $this->session->set_flashdata("mensagemSucesso", "Categoria excluído Com Sucesso!");
        } else {
            $this->session->set_flashdata("mensagemErro", "Ocorreu um erro ao excluir o categoria!");
        }

        redirect("/fornecedores");
    }

    public function salvar() {
        try {
            $data = carregarDadosPost($this->input->post());
            unset($data["fornecedor_id"]);
            $fornecedor_id = $this->input->post("fornecedor_id");
            $this->fornecedorModel->salvar_fornecedor($data, $fornecedor_id);
            $this->session->set_flashdata("mensagemSucesso", "Categoria " . ($fornecedor_id ? "Editado" : "Criado") . " Com Sucesso!");
            redirect("/fornecedores");
        } catch(Exception $e) {
            $this->session->set_flashdata("categoria", (object) $data);
            $this->session->set_flashdata("mensagemErro", $e->getMessage());
            redirect($fornecedor_id ? "/fornecedores/editar/{$fornecedor_id}" : "/fornecedores/adicionar");
        }
    }

}