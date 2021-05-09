<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class ProdutoModel extends CI_Model {

    private $tbl;
    private $usuario_id;

    public function __construct() {
        parent::__construct();

        $this->tbl = "produto";
        $this->usuario_id = $this->session->userdata("usuario_id");
    }

    public function get_all($somente_com_estqoue = FALSE) {
        $this->db->select("produto.*");
        $this->db->select("fornecedor.fornecedor_id");
        $this->db->select("fornecedor.nome as fornecedor_nome");
        $this->db->select("categoria.categoria_id");
        $this->db->select("categoria.nome as categoria_nome");

        $this->db->join("fornecedor", "fornecedor.fornecedor_id = produto.fornecedor_id", "left");
        $this->db->join("categoria", "categoria.categoria_id = produto.categoria_id", "left");

        if($somente_com_estqoue) {
            $this->db->where("produto.estoque > 0");
        }

        $this->db->where("produto.usuario_id", $this->usuario_id);
        return $this->db->get($this->tbl);
    }

    public function get_by_id($produto_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("produto_id", $produto_id);
        return $this->db->get($this->tbl);
    }

    public function salvar($data) { 
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

    public function update($produto_id, $data) {
        $this->db->where("produto_id", $produto_id);
        $this->db->where("produto.usuario_id", $this->usuario_id);
        return $this->db->update($this->tbl, $data);
    }

    public function delete($produto_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("produto_id", $produto_id);
        return $this->db->delete($this->tbl);
    }

    public function get_produto_by_venda_id($venda_id) {
        $this->db->select("produto.produto_id");
        $this->db->select("produto.nome");
        $this->db->select("COUNT(*) as quantidade");
        $this->db->select("produto.preco_venda as valor_unitario");
        $this->db->select("(COUNT(*) * produto.preco_venda) as valor_total");

        $this->db->join("venda_produto", "produto.produto_id = venda_produto.produto_id");
        $this->db->where("venda_produto.venda_id", $venda_id);
        $this->db->where("produto.usuario_id", $this->usuario_id);

        $this->db->group_by("venda_produto.produto_id");

        return $this->db->get($this->tbl);
    }

    function salvar_produto($data, $produto_id = NULL) {
        $this->form_validation->set_rules("nome", "Nome", "trim|required");
        $this->form_validation->set_rules("preco_venda", "Preço de Venda", "required");
        $this->form_validation->set_rules("preco_custo", "Preço de Custo", "required");
        $this->form_validation->set_rules("estoque", "Estoque", "required");

        if($this->form_validation->run()){
            $data["preco_venda"] = trataDinheiro($data["preco_venda"]);
            $data["preco_custo"] = trataDinheiro($data["preco_custo"]);

            if($produto_id) {
                $this->update($produto_id, $data);
            } else {
                $data["data_cadastro"] = date("Y-m-d H:i:s");
                $data["usuario_id"] = $this->usuario_id;
                $produto_id = $this->salvar($data);
            }

            return $produto_id;

        } else {
            throw new Exception("Preencha os campos corretamente!");
        }
    }

}