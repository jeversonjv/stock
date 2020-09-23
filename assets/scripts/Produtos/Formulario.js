$(document).ready(() => {

    $("#formulario").validate({
        rules: {
            nome: { required: true },
            preco_venda: { required: true },
            preco_custo: { required: true },
            estoque: { required: true }
        },
        messages: {
            nome: { required: "Campo obrigatório" },
            preco_venda: { required: "Campo obrigatório" },
            preco_custo: { required: "Campo obrigatório" },
            estoque: { required: "Campo obrigatório" },
        }
    });

    $("#salvar").click(() => $("#formulario").submit());
});