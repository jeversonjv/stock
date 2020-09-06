<?php

class Template {

    private $titulo;
    private $scripts;
    private $conteudo;
    private $sidebarActive;
    private $CI;

    public function __construct(){
        $this->titulo = "Stock - Controle de Estoque";
        $this->scripts = [];
        $this->conteudo = "";
        $this->sidebarActive = NULL;
        $this->CI =& get_instance();
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setSidebarActive($sidebarActive) {
        $this->sidebarActive = $sidebarActive;
    }

    public function addScript($caminho, $arquivo) {
        $caminhoArquivo = $caminho . "/" . $arquivo .  ".js";
        if(file_exists($caminhoArquivo)) {
            $this->scripts[] = $caminhoArquivo;
        }
    }

    // A ideia desse método é carregar um script para cada view
    // portanto o carregamento do script vai seguir a mesma lógica de pasta que a view se encontra
    private function loadScriptPrincipal($view) {
        $view = explode("/", $view);

        // caminho base para os scripts
        $caminho = "assets/scripts";

        if(count($view) > 1) {
            $viewSemFinal = $view;
            unset($viewSemFinal[count($view) - 1]);
            
            // caso a view esteja dentro de uma pasta
            $caminho .= "/" . implode("/", $viewSemFinal);
            $arquivo = end($view);
        } else {
            $arquivo = $view[0];
        }

        $this->addScript($caminho, $arquivo);
    }

    private function loadConteudo($view, $data = NULL) {
        $this->conteudo = $this->CI->load->view($view, $data, TRUE);
    }

    private function trySetSidebarActive($view) {
        if(strpos(strtolower($view), "dashboard") !== FALSE) {
            $this->setSidebarActive(SIDEBAR_DASHBOARD_ACTIVE);
        } else if(strpos(strtolower($view), "clientes") !== FALSE) {
            $this->setSidebarActive(SIDEBAR_CLIENTES_ACTIVE);
        } else if(strpos(strtolower($view), "fornecedores") !== FALSE) {
            $this->setSidebarActive(SIDEBAR_FORNECEDORES_ACTIVE);
        } else if(strpos(strtolower($view), "produtos") !== FALSE) {
            $this->setSidebarActive(SIDEBAR_PRODUTOS_ACTIVE);
        } else if(strpos(strtolower($view), "vendas") !== FALSE) {
            $this->setSidebarActive(SIDEBAR_VENDAS_ACTIVE);
        }
    }

    public function loadView($layout, $view, $data = NULL, $setSideBarActive = TRUE) {
        $this->loadScriptPrincipal($view);
        $this->loadConteudo($view, $data);

        if($setSideBarActive) {
            $this->trySetSidebarActive($view);
        }

        $data = array(
            "titulo" => $this->titulo,
            "scripts" => $this->scripts,
            "conteudo" => $this->conteudo,
            "sidebarActive" => $this->sidebarActive
        );

        $this->CI->load->view($layout, $data);
    }
}