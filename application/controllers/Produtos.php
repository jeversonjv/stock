<?php

class Produtos extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();

        $this->load->model("produtoModel", "", TRUE);
        $this->load->model("categoriaModel", "", TRUE);
    }

    public function index() {
        $this->data["produtos"] = $this->produtoModel->get_all()->result();
        $this->template->setTitulo("Produtos");
        $this->template->loadView("template/layout", "Produtos/Listagem", $this->data);
    }

    public function adicionar() {
        if($this->session->flashdata("produto")) {
            $this->data["produto"] = $this->session->flashdata("produto");
        }

        $this->data["categorias"] = $this->categoriaModel->get_all()->result();
        $this->template->setTitulo("Produtos - Adicionar");
        $this->template->loadView("template/Layout", "Produtos/Formulario", $this->data);
    }

    public function visualizar($produto_id) {
        $produto = $this->produtoModel->get_by_id($produto_id);

        if($produto->num_rows() === 0) redirect("/produtos");

        $this->data["produto"] = $produto->row();
        $this->data["somente_visualizar"] = true;
        $this->template->setTitulo("Produtos - Visualizar");
        $this->template->loadView("template/Layout", "Produtos/Formulario", $this->data);
    }

    public function editar($produto_id) {
        $produto = $this->produtoModel->get_by_id($produto_id);

        if($produto->num_rows() === 0) redirect("/produtos");

        $this->data["categorias"] = $this->categoriaModel->get_all()->result();
        $this->data["produto"] = $produto->row();
        $this->data["produto_id"] = $produto_id;
        $this->template->setTitulo("Produtos - Editar");
        $this->template->loadView("template/Layout", "Produtos/Formulario", $this->data);
    }

    public function excluir($produto_id) {
        $res = $this->produtoModel->delete($produto_id);

        if($res) {
            $this->session->set_flashdata("mensagemSucesso", "Produto excluída Com Sucesso!");
        } else {
            $this->session->set_flashdata("mensagemErro", "Ocorreu um erro ao excluir o produto!");
        }

        redirect("/produtos");
    }

    public function salvar() {
        try {
            $data = carregarDadosPost($this->input->post());
            unset($data["produto_id"]);
            $produto_id = $this->input->post("produto_id");
            $this->produtoModel->salvar_categoria($data, $produto_id);
            $this->session->set_flashdata("mensagemSucesso", "Produto " . ($produto_id ? "Editado" : "Criado") . " Com Sucesso!");
            redirect("/produtos");
        } catch(Exception $e) {
            $this->session->set_flashdata("produto", (object) $data);
            $this->session->set_flashdata("mensagemErro", $e->getMessage());
            redirect($produto_id ? "/produtos/editar/{$produto_id}" : "/produtos/adicionar");
        }
    }

}