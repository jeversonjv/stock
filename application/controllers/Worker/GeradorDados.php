<?php

class GeradorDados extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->criarSessao();

        $this->load->model("clienteModel", "", true);
        $this->load->model("produtoModel", "", true);
        $this->load->model("vendaModel", "", true);
    }

    public function gerarVendaPeriodo($data_base)
    {
        $qtd_dias = floor((time() - strtotime($data_base)) / (60 * 60 * 24));

        $contador = 0;
        while ($contador <= $qtd_dias) {
            $time = getTimeAleatorio();
            $data = date("Y-m-d H:i:s", strtotime("$data_base $time" . " +$contador days"));

            $this->gerarVenda($data);

            echo $contador . "/" . $qtd_dias . PHP_EOL;
            $contador++;
        }
    }

    public function gerarVenda($data = NULL) {
        if(!$data) {
            $data = date("Y-m-d H:i:s");
        }

        $cliente = $this->clienteModel->get_aleatorio()->row();
        $produto = $this->produtoModel->get_aleatorio()->row();

        $venda = [
            "cliente_id" => $cliente->cliente_id,
            "descricao" => "Venda Gerada automaticamente para teste em: " . date("d/m/Y H:i:s", strtotime($data)),
            "data_venda" => $data
        ];

        $produto = [[
            "produto_id" => $produto->produto_id,
            "quantidade" => random_int(1, 5)
        ]];

        $this->vendaModel->salvar_venda($venda, $produto);
    }

    private function criarSessao() {
        $this->session->set_userdata([
            "usuario_id" => 1,
        ]);
    }
}
