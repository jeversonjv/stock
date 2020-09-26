<?php

class Vendas extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();

        $this->load->model("vendaModel", "", TRUE);
    }

    public function index() {
        $this->data["vendas"] = $this->vendaModel->get_all()->result();
        $this->template->setTitulo("Vendas");
        $this->template->loadView("template/layout", "Vendas/Listagem", $this->data);
    }

    public function adicionar() {
        if($this->session->flashdata("venda")) {
            $this->data["venda"] = $this->session->flashdata("venda");
        }
        $this->template->setTitulo("Vendas - Adicionar");
        $this->template->loadView("template/Layout", "Vendas/Formulario", $this->data);
    }

    public function visualizar($venda_id) {
        $venda = $this->vendaModel->get_by_id($venda_id);

        if($venda->num_rows() === 0) redirect("/vendas");

        $this->data["venda"] = $venda->row();
        $this->data["somente_visualizar"] = true;
        $this->template->setTitulo("Vendas - Visualizar");
        $this->template->loadView("template/Layout", "Vendas/Formulario", $this->data);
    }

    public function editar($venda_id) {
        $venda = $this->vendaModel->get_by_id($venda_id);

        if($venda->num_rows() === 0) redirect("/vendas");

        $this->data["venda"] = $venda->row();
        $this->data["venda_id"] = $venda_id;
        $this->template->setTitulo("Vendas - Editar");
        $this->template->loadView("template/Layout", "Vendas/Formulario", $this->data);
    }

    public function excluir($venda_id) {
        $res = $this->vendaModel->delete($venda_id);

        if($res) {
            $this->session->set_flashdata("mensagemSucesso", "Venda excluída Com Sucesso!");
        } else {
            $this->session->set_flashdata("mensagemErro", "Ocorreu um erro ao excluir o venda!");
        }

        redirect("/vendas");
    }

    public function salvar() {
        try {
            $data = carregarDadosPost($this->input->post());
            unset($data["venda_id"]);
            $venda_id = $this->input->post("venda_id");
            $this->vendaModel->salvar_categoria($data, $venda_id);
            $this->session->set_flashdata("mensagemSucesso", "Venda " . ($venda_id ? "Editado" : "Criado") . " Com Sucesso!");
            redirect("/vendas");
        } catch(Exception $e) {
            $this->session->set_flashdata("venda", (object) $data);
            $this->session->set_flashdata("mensagemErro", $e->getMessage());
            redirect($venda_id ? "/vendas/editar/{$venda_id}" : "/vendas/adicionar");
        }
    }

}