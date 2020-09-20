<?php

class Categorias extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();

        $this->load->model("categoriaModel", "", TRUE);
    }

    public function index() {
        $this->data["fornecedores"] = $this->fornecedorModel->get_all()->result();
        $this->template->setTitulo("Categorias");
        $this->template->loadView("template/layout", "Categorias/Listagem", $this->data);
    }

    public function adicionar() {
        if($this->session->flashdata("categoria")) {
            $this->data["categoria"] = $this->session->flashdata("categoria");
        }
        $this->template->setTitulo("Categorias - Adicionar");
        $this->template->loadView("template/Layout", "Categorias/Formulario", $this->data);
    }

    public function visualizar($categoria_id) {
        $categoria = $this->fornecedorModel->get_by_id($categoria_id);

        if($categoria->num_rows() === 0) redirect("/categorias");

        $this->data["categoria"] = $categoria->row();
        $this->data["somente_visualizar"] = true;
        $this->template->setTitulo("Categorias - Visualizar");
        $this->template->loadView("template/Layout", "Categorias/Formulario", $this->data);
    }

    public function editar($categoria_id) {
        $categoria = $this->fornecedorModel->get_by_id($categoria_id);

        if($categoria->num_rows() === 0) redirect("/categorias");

        $this->data["categoria"] = $categoria->row();
        $this->data["categoria_id"] = $categoria_id;
        $this->template->setTitulo("Categorias - Editar");
        $this->template->loadView("template/Layout", "Categorias/Formulario", $this->data);
    }

    public function excluir($categoria_id) {
        $res = $this->fornecedorModel->delete($categoria_id);

        if($res) {
            $this->session->set_flashdata("mensagemSucesso", "Categoria excluído Com Sucesso!");
        } else {
            $this->session->set_flashdata("mensagemErro", "Ocorreu um erro ao excluir o categoria!");
        }

        redirect("/categorias");
    }

    public function salvar() {
        try {
            $data = carregarDadosPost($this->input->post());
            unset($data["categoria_id"]);
            $categoria_id = $this->input->post("categoria_id");
            $this->fornecedorModel->salvar_fornecedor($data, $categoria_id);
            $this->session->set_flashdata("mensagemSucesso", "Categoria " . ($categoria_id ? "Editado" : "Criado") . " Com Sucesso!");
            redirect("/categorias");
        } catch(Exception $e) {
            $this->session->set_flashdata("categoria", (object) $data);
            $this->session->set_flashdata("mensagemErro", $e->getMessage());
            redirect($categoria_id ? "/categorias/editar/{$categoria_id}" : "/categorias/adicionar");
        }
    }

}