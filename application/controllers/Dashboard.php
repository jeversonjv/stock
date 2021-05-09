<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private $data = [];

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata("usuario_id")){
            redirect("/login");
        }

        $this->load->model("vendaModel", "", TRUE);
    }

    public function index() {
        $this->montaDadosKpi("faturamento");
        $this->montaDadosKpi("lucro");

        $this->template->setTitulo("Dashboard");
        $this->template->loadView("template/layout", "Dashboard/dashboard", $this->data);
    }

    public function getDadosGraficoLinhas () {
        $this->montaDadosGraficoLinhas("faturamento");
        $this->montaDadosGraficoLinhas("lucro");

        echo json_encode($this->data);
    }

    private function montaDadosKpi($tipo) {
        $inicio_ano_atual = date("Y-01-01 00:00:00");
        $inicio_mes_atual = date("Y-m-01 00:00:00");
        $hoje = date("Y-m-d H:i:s");

        if($tipo == "faturamento") {    
            $this->data["faturamento_mes_atual"] = $this->vendaModel->get_faturamento_periodo($inicio_mes_atual, $hoje)->row()->total;
            $this->data["faturamento_ano_atual"] = $this->vendaModel->get_faturamento_periodo($inicio_ano_atual, $hoje)->row()->total;
        } else {
            $this->data["lucro_mes_atual"] = $this->vendaModel->get_lucro_periodo($inicio_ano_atual, $hoje)->row()->total;
            $this->data["lucro_ano_atual"] = $this->vendaModel->get_lucro_periodo($inicio_ano_atual, $hoje)->row()->total;
        }
    }

    private function montaDadosGraficoLinhas($tipo) {
        for($idx = 5; $idx >= 0; $idx--) {
            $inicio_mes = date("Y-m-01 00:00:00", strtotime("-$idx months"));
            $final_mes = date("Y-m-t 23:59:59", strtotime("-$idx months"));

            if($tipo == "faturamento") {
                $total = $this->vendaModel->get_faturamento_periodo($inicio_mes, $final_mes)->row()->total;
            } else {
                $total = $this->vendaModel->get_lucro_periodo($inicio_mes, $final_mes)->row()->total;
            }

            $this->data[$tipo == "faturamento" ? "graficoFaturamento" : "graficoLucro"]["dados"][] = (float) $total;
            $this->data[$tipo == "faturamento" ? "graficoFaturamento" : "graficoLucro"]["labels"][] = getMesesAbreviado()[ltrim(date("m", strtotime($inicio_mes)), "0") - 1];
        }
    }
}