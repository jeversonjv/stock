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

}