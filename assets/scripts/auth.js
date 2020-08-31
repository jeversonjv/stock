$(document).ready(() => {

    $("#logar").click(() => login());

    const login = () => {
        let email = $("#email").val();
        let senha = $("#senha").val();

        if(!email) {
            toastr.error('Digite seu e-mail');
            return;
        }

        if(!senha) {
            toastr.error('Digite sua senha');
            return;
        }

        $.post("/login/executar_login", {
            nome,  
            senha
        }, (retorno) => {
            console.log(retorno);
        }, "JSON");
    }

    $("#cadastrar").click(() => cadastrar());

    const cadastrar = () => {
        let nome = $("#nome").val();
        let email = $("#email").val();
        let senha = $("#senha").val();
        let confirmar_senha = $("#confirmar_senha").val();

        if(!nome) {
            toastr.error('Digite seu nome');
            return;
        }

        if(!email) {
            toastr.error('Digite seu e-mail');
            return;
        }

        if(!senha) {
            toastr.error('Digite sua senha');
            return;
        }

        if(!confirmar_senha) {
            toastr.error('Digite a confirmação da senha');
            return;
        }

        if(senha !== confirmar_senha) {
            toastr.error('As senhas não coincidem');
            return;
        }

        $.post("/login/salvar_cadastro", {
            nome,
            email,  
            senha,
            confirmar_senha
        }, (retorno) => {
            console.log(retorno);
        }, "JSON");
    }

});