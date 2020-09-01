<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("usuarioModel", "", TRUE);
    }

	public function index() {
        $this->load->view("login");
    }
    
    public function cadastro() {
        $this->load->view("cadastro");
    }

    public function executar_login() {
        $retorno = array(
            "erro" => false,
            "mensagem" => "Logado com sucesso!",
            "codigo_erro" => 0
        );

        $email = $this->input->post("email");
        $senha = $this->input->post("senha");

        if($email && $senha) {
            $usuario = $this->usuarioModel->get_by_email($email);
            if($usuario->num_rows() > 0) {
                $usuario = $usuario->row();
                if(password_verify($senha, $usuario->senha)){
                    $sessao = array(
                        "usuario_id" => $usuario->usuario_id,
                        "nome" => $usuario->nome,
                        "email" => $usuario->email,
                        "ativo" => $usuario->ativo
                    );
                    $this->session->set_userdata($sessao);
                } else {
                    $retorno["erro"] = true;
                    $retorno["mensagem"] = "Senha incorreta!";
                    $retorno["codigo_erro"] = 1;
                }
            } else {
                $retorno["erro"] = true;
                $retorno["mensagem"] = "E-mail não registrado ou inativo no sistema!";
                $retorno["codigo_erro"] = 2;
            }
        } else {
            $retorno["erro"] = true;
            $retorno["mensagem"] = "Preencha todos os campos corretamente!";
        }

        echo json_encode($retorno);
    }

    public function salvar_cadastro() {
        $retorno = array(
            "erro" => false,
            "mensagem" => "Cadastro realizado com sucesso!"
        );

        $nome = $this->input->post("nome");
        $email = $this->input->post("email");
        $senha = $this->input->post("senha");
        $confirmar_senha = $this->input->post("confirmar_senha");

        if($nome && $email && $senha && $confirmar_senha) {
            $usuario = $this->usuarioModel->get_by_email($email);
            if($senha === $confirmar_senha) {
                if($usuario->num_rows() === 0) {
                    $usuario = array(
                        "nome" => $nome,
                        "email" => $email,
                        "senha" => password_hash($senha, PASSWORD_BCRYPT),
                        "data_cadastro" => date("Y-m-d H:i:s"),
                        "ativo" => 1
                    );
                    $this->usuarioModel->salvar($usuario);
                } else {
                    $retorno["erro"] = true;
                    $retorno["mensagem"] = "E-mail já cadastrado!";
                } 
            } else {
                $retorno["erro"] = true;
                $retorno["mensagem"] = "As senhas não coincidem!";
            }
        } else {
            $retorno["erro"] = true;
            $retorno["mensagem"] = "Preencha todos os campos corretamente!";
        }

        echo json_encode($retorno);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect("/login");
    }
}
