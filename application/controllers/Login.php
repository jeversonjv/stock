<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function index() {
        $this->load->view("login");
    }
    
    public function cadastro() {
        $this->load->view("cadastro");
    }

    public function executar_login() {

    }

    public function salvar_cadastro() {
    
    }
}
