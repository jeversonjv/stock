<?php

class Vendas extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata("usuario_id")){
            redirect("/login");
        }

        $this->load->model("vendaModel", "", TRUE);
        $this->load->model("clienteModel", "", TRUE);
        $this->load->model("produtoModel", "", TRUE);
    }

    public function index() {
        $this->data["vendas"] = $this->vendaModel->get_all(TRUE)->result();

        $this->template->setTitulo("Vendas");
        $this->template->loadView("template/layout", "Vendas/Listagem", $this->data);
    }

    public function adicionar() {
        if($this->session->flashdata("venda")) {
            $this->data["venda"] = $this->session->flashdata("venda");
        }

        $this->data["clientes"] = $this->clienteModel->get_all()->result();
        $this->data["produtos"] = $this->produtoModel->get_all(true)->result();
        
        $this->template->setTitulo("Vendas - Adicionar");
        $this->template->loadView("template/Layout", "Vendas/Formulario", $this->data);
    }

    public function visualizar($venda_id) {
        $venda = $this->vendaModel->get_by_id($venda_id);

        if($venda->num_rows() === 0) redirect("/vendas");

        $this->data["clientes"] = $this->clienteModel->get_all()->result();
        $this->data["produtos_venda"] = $this->produtoModel->get_produto_by_venda_id($venda_id)->result();
        $this->data["venda"] = $venda->row();
        $this->data["somente_visualizar"] = true;

        $this->template->setTitulo("Vendas - Visualizar");
        $this->template->loadView("template/Layout", "Vendas/Formulario", $this->data);
    }

    public function editar($venda_id) {
        $venda = $this->vendaModel->get_by_id($venda_id);

        if($venda->num_rows() === 0) redirect("/vendas");

        $this->data["clientes"] = $this->clienteModel->get_all()->result();
        $this->data["produtos"] = $this->produtoModel->get_all(true)->result();
        $this->data["produtos_venda"] = $this->produtoModel->get_produto_by_venda_id($venda_id)->result();
        $this->data["venda"] = $venda->row();
        $this->data["venda_id"] = $venda_id;

        $this->template->setTitulo("Vendas - Editar");
        $this->template->loadView("template/Layout", "Vendas/Formulario", $this->data);
    }

    public function excluir($venda_id, $voltar_para_estoque) {
        // Verificando se a venda é mesmo desse user
        $venda = $this->vendaModel->get_by_id($venda_id);
        if($venda->num_rows() === 0) redirect("/vendas");

        $this->vendaModel->delete_venda_produto($venda_id, NULL, $voltar_para_estoque);
        $this->vendaModel->delete($venda_id);

        $this->session->set_flashdata("mensagemSucesso", "Venda excluída Com Sucesso!");

        redirect("/vendas");
    }

    public function excluir_venda_produto($venda_id, $produto_id, $voltar_para_estoque) {
        $produtos_venda = $this->vendaModel->get_venda_produto($venda_id, NULL, TRUE);
        if($produtos_venda->num_rows() <= 1) {
            die(json_encode([
                "erro" => true,
                "mensagem" => "Não é possível excluir todas os produtos de uma venda"
            ]));    
        }

        $this->vendaModel->delete_venda_produto($venda_id, $produto_id, $voltar_para_estoque);
        echo json_encode([
            "erro" => false,
            "mensagem" => "Produto da venda excluído com sucesso"
        ]);
    }

    public function salvar() {
        try {
            $venda_id = $this->input->post("venda_id");
            $venda = carregarDadosPost($this->input->post(), ["venda_id"]);
            $produtos = $this->input->post("produtos");
            
            $venda_id = $this->vendaModel->salvar_venda($venda, $produtos, $venda_id);
            
            echo json_encode([
                "erro" => false,
                "mensagem" => "Venda salva com sucesso.",
                "venda_id" => $venda_id
            ]);

        } catch(Exception $e) {
            echo json_encode([
                "erro" => true,
                "mensagem" => $e->getMessage()
            ]);
        }
    }

}