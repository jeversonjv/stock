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

        $("#logar").prop("disabled", 1);
        $("#logar").text("Entrando..."); 

        $.post("/login/executar_login", {
            email,  
            senha
        }, (retorno) => {
            if(!retorno.erro) {
                toastr.success(retorno.mensagem);
                setTimeout(() => {
                    location.href = "/dashboard";
                }, 300);
            } else {
                if(retorno.codigo_erro == 1) {
                    $("#senha").val("");
                    $("#senha").focus();
                } else if(retorno.codigo_erro == 2) {
                    $("#email").val("");
                    $("#email").focus();
                }

                toastr.error(retorno.mensagem);
            }

            $("#logar").prop("disabled", 0);
            $("#logar").text("Entrar");

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

        if(senha && senha.length < 8) {
            toastr.error('Digite uma senha de pelo menos 8 caracteres!');
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

        $("#cadastrar").prop("disabled", 1);
        $("#cadastrar").text("Cadastrando..."); 

        $.post("/login/salvar_cadastro", {
            nome,
            email,  
            senha,
            confirmar_senha
        }, (retorno) => {
            if(retorno.erro) {
                toastr.error(retorno.mensagem);
                $("#email").focus();
            } else {
                toastr.success(retorno.mensagem);
                setTimeout(() => {
                    location.href = "/login";
                }, 300);
            }

            $("#cadastrar").prop("disabled", 0);
            $("#cadastrar").text("Criar Conta"); 

        }, "JSON");
    }

    $("#formulario_login input").keyup((evt) => {
        console.log("evt", evt)
        let code = evt.keyCode || evt.which;
        if(code == 13) {
            login();
        }
    });

    $("#formulario_cadastro input").keyup((evt) => {
        console.log("evt", evt)
        let code = evt.keyCode || evt.which;
        if(code == 13) {
            cadastrar();
        }
    });
});