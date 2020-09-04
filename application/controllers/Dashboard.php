<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata("usuario_id")){
            redirect("/login");
        }
    }

    public function index() {
        $this->data["conteudo"] = $this->load->view("dashboard", NULL, TRUE);
        $this->load->view("template/layout", $this->data);
    }

}