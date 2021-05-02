<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class VendaModel extends CI_Model {

    private $tbl;
    private $tbl_venda_produto;
    private $usuario_id;

    public function __construct() {
        parent::__construct();

        $this->tbl = "venda";
        $this->tbl_venda_produto = "venda_produto";
        $this->usuario_id = $this->session->userdata("usuario_id");

        $this->load->model("produtoModel", "", TRUE);
    }

    public function get_all() {
        $this->db->where("usuario_id", $this->usuario_id);
        return $this->db->get($this->tbl);
    }

    public function get_by_id($venda_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("venda_id", $venda_id);
        return $this->db->get($this->tbl);
    }

    private function salvar($data) { 
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

    private function update($venda_id, $data) {
        $this->db->where("venda_id", $venda_id);
        return $this->db->update($this->tbl, $data);
    }

    public function delete($venda_id) {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("venda_id", $venda_id);
        return $this->db->delete($this->tbl);
    }

    public function salvar_venda_produto($data) {
        $this->db->insert($this->tbl_venda_produto, $data);
        return $this->db->insert_id();
    }

    public function delete_venda_produto($venda_id) {
        $this->db->where("venda_id", $venda_id);
        return $this->db->delete($this->tbl_venda_produto);
    }

    function salvar_venda($data, $venda_id = NULL) {
        $produtos = $data["produtos"];
        unset($data["produtos"]);

        if($venda_id) {
            $this->update($venda_id, $data);
        } else {
            $data["data_venda"] = date("Y-m-d H:i:s");
            $data["usuario_id"] = $this->usuario_id;
            $venda_id = $this->salvar($data);
        }

        if(!empty($produtos) && count($produtos) > 0)  {
            $this->delete_venda_produto($venda_id);

            foreach($produtos as $produto) {
                $produtoSalvo = $this->produtoModel->get_by_id($produto["produto_id"])->row();

                if($produtoSalvo->estoque < $produto["quantidade"]) {
                    $produto["quantidade"] = $produtoSalvo->estoque;
                }

                for($i = 0; $i < $produto["quantidade"]; $i++) {
                    $this->salvar_venda_produto([
                        "venda_id" => $venda_id,
                        "produto_id" => $produto["produto_id"]
                    ]);
                }
            }
        }

        return $venda_id;
    }

}