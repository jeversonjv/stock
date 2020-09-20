$(document).ready(() => {

    $("#formulario").validate({
        rules: {
            nome: { required: true }
        },
        messages: {
            nome: { required: "Campo obrigatório" }
        }
    });

    $("#salvar").click(() => $("#formulario").submit());
});