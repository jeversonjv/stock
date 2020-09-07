<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata("usuario_id")){
            redirect("/login");
        }
    }

    public function index() {
        $this->template->setTitulo("Clientes");
        $this->template->loadView("template/layout", "clientes/listagem");
    }

    public function adicionar() {
        $this->template->setTitulo("Clientes");
        $this->template->loadView("template/layout", "clientes/formulario");
    }

    public function editar($cliente_id) {

    }

    public function salvar() {

    }

    public function excluir($cliente_id) {

    }

}