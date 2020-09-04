<?php

class Template {

    private $titulo;
    private $scripts;
    private $conteudo;
    private $CI;

    public function __construct(){
        $this->titulo = "Stock - Controle de Estoque";
        $this->scripts = [];
        $this->conteudo = "";
        $this->CI =& get_instance();
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
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

    public function loadView($layout, $view, $data = NULL) {
        $this->loadScriptPrincipal($view);
        $this->loadConteudo($view, $data);

        $data = array(
            "titulo" => $this->titulo,
            "scripts" => $this->scripts,
            "conteudo" => $this->conteudo
        );

        $this->CI->load->view($layout, $data);
    }
}