<?php
defined("BASEPATH") or exit("No direct script access allowed");

class VendaModel extends CI_Model
{

    private $tbl;
    private $tbl_venda_produto;
    private $usuario_id;

    public function __construct()
    {
        parent::__construct();

        $this->tbl = "venda";
        $this->tbl_venda_produto = "venda_produto";
        $this->usuario_id = $this->session->userdata("usuario_id");

        $this->load->model("produtoModel", "", true);
    }

    public function get_all($detalhado = FALSE)
    {
        $this->db->select("venda.*");
        
        if($detalhado) {
            $this->add_detalhes_venda();
        }

        $this->db->where("venda.usuario_id", $this->usuario_id);
        return $this->db->get($this->tbl);
    }

    public function get_by_id($venda_id, $detalhado = FALSE)
    {
        $this->db->select("venda.*");

        if($detalhado) {
            $this->add_detalhes_venda();
        }

        $this->db->where("venda.usuario_id", $this->usuario_id);
        $this->db->where("venda.venda_id", $venda_id);
        return $this->db->get($this->tbl);
    }

    private function add_detalhes_venda() {
        $this->db->select("IFNULL(cliente.nome, 'Sem cliente vinculado') as nome_cliente");
        $this->db->select("get_valor_total_venda(venda.venda_id) as valor_total_venda");
        $this->db->select("get_qtd_produto_venda(venda.venda_id) as qtd_produto_venda");
        $this->db->join("cliente", "cliente.cliente_id = venda.cliente_id", "LEFT");
    }

    private function salvar($data)
    {
        $this->db->insert($this->tbl, $data);
        return $this->db->insert_id();
    }

    private function update($venda_id, $data)
    {
        $this->db->where("venda_id", $venda_id);
        return $this->db->update($this->tbl, $data);
    }

    public function delete($venda_id)
    {
        $this->db->where("usuario_id", $this->usuario_id);
        $this->db->where("venda_id", $venda_id);
        return $this->db->delete($this->tbl);
    }

    public function get_venda_produto($venda_id, $produto_id = NULL, $agrupar_produtos = FALSE) 
    {
        if($agrupar_produtos) {
            $this->db->select("venda_produto.*");
            $this->db->select("COUNT(*) as qtd");
            $this->db->group_by("produto_id");
        }

        if($produto_id) {
            $this->db->where("produto_id", $produto_id);
        }

        $this->db->join("venda", "venda_produto.venda_id = venda.venda_id");

        $this->db->where("venda_produto.venda_id", $venda_id);
        $this->db->where("venda.usuario_id", $this->usuario_id);

        return $this->db->get($this->tbl_venda_produto);
    }

    public function salvar_venda_produto($data)
    {
        $this->db->insert($this->tbl_venda_produto, $data);
        return $this->db->insert_id();
    }

    public function delete_venda_produto($venda_id, $produto_id = NULL, $voltar_produto_estoque = FALSE)
    {
        if($voltar_produto_estoque) {
            $produtos = $this->get_venda_produto($venda_id, $produto_id, TRUE)->result();
            foreach($produtos as $produto) {
                $produtoSalvo = $this->produtoModel->get_by_id($produto->produto_id)->row();
                $att_produto["estoque"] = $produtoSalvo->estoque + $produto->qtd;
                $this->produtoModel->update($produto->produto_id, $att_produto);
            }
        }

        if($produto_id) {
            $this->db->where("produto_id", $produto_id);
        }

        $this->db->where("venda_produto.venda_id", $venda_id);

        return $this->db->delete($this->tbl_venda_produto);
    }

    public function salvar_venda($data, $produtos, $venda_id = null)
    {
        try {
            if (empty($produtos)) {
                throw new Exception("Nenhum produto selecionado");
            }

            $this->db->trans_strict(FALSE);
            $this->db->trans_begin();

            if ($venda_id) {
                $this->update($venda_id, $data);
            } else {
                $data["data_venda"] = date("Y-m-d H:i:s");
                $data["usuario_id"] = $this->usuario_id;
                $venda_id = $this->salvar($data);
            }

            $this->salvar_produtos($venda_id, $produtos);
            $produtos_venda = $this->get_venda_produto($venda_id);

            if ($this->db->trans_status() === FALSE) {
                throw new Exception("Ocorreu um erro na efetivação da venda, entre em contato com o suporte.");
            } else if($produtos_venda->num_rows() == 0) {
                throw new Exception("Nenhum produto foi salvo na venda, verifique o estoque.");
            }
            
            $this->db->trans_commit();
            return $venda_id;

        } catch (Error $e) {
            $this->db->trans_rollback();
            throw new Exception("Ocorreu um erro interno, contate o suporte!");
        } catch (Exception $e) {
            $this->db->trans_rollback();
            throw $e;
        }
    }

    public function salvar_produtos($venda_id, $produtos) {
        if (isset($produtos) && count($produtos) > 0) {
            $this->delete_venda_produto($venda_id, NULL, TRUE);

            foreach ($produtos as $produto) {
                $produtoSalvo = $this->produtoModel->get_by_id($produto["produto_id"]);

                if ($produtoSalvo->num_rows()) {
                    $produtoSalvo = $produtoSalvo->row();

                    if ($produtoSalvo->estoque > 0) {
                        if ($produtoSalvo->estoque < $produto["quantidade"]) {
                            $produto["quantidade"] = $produtoSalvo->estoque;
                        }

                        for ($i = 0; $i < $produto["quantidade"]; $i++) {
                            $this->salvar_venda_produto([
                                "venda_id" => $venda_id,
                                "produto_id" => $produto["produto_id"],
                            ]);
                        }

                        $att_produto["estoque"] = $produtoSalvo->estoque - $produto["quantidade"];
                        $this->produtoModel->update($produtoSalvo->produto_id, $att_produto);
                    } else {
                        throw new Exception("O produto: " . $produtoSalvo->nome . ", cod: " . $produtoSalvo->produto_id . ". Está fora de estoque");
                    }
                } else {
                    throw new Exception("O produto: " . $produtoSalvo->nome . ", cod: " . $produtoSalvo->produto_id . ". Não foi encontrado na base de dados.");
                }
            }
        }
    }
}
