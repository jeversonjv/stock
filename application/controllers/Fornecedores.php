<?php

class Fornecedores extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // $this->data["clientes"] = $this->clienteModel->get_all()->result();
        $this->template->setTitulo("Clientes");
        $this->template->loadView("template/layout", "Fornecedores/Listagem", $this->data);
    }

}