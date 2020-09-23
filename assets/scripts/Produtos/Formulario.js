$(document).ready(() => {

    $("#formulario").validate({
        rules: {
            nome: { required: true },
            email: { required: true, email: true },
            telefone: { required: false, minlength: 14 },
            celular: { required: true, minlength: 15 },
            cnpj: { required: true, minlength: 17 }
        },
        messages: {
            nome: { required: "Campo obrigatório" },
            email: { required: "Campo é obrigatório", email: "Digite um formato válido" },
            telefone: { minlength: "Preencha Corretamente" },
            celular: { required: "Campo é obrigatório", minlength: "Preencha Corretamente" },
            cnpj: { required: "Campo é obrigatório", minlength: "Preencha Corretamente" }
        }
    });

    $("#salvar").click(() => $("#formulario").submit());
});