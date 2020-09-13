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

    $("#cep").blur((e) => {
        let cep = $(e.target).val();

        if (cep) {
            cep = cep.replace(/[^\d]/g, "");
            if (cep.length === 8) {
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("AC");
                $("#complemento").val("");

                $.get(`https://viacep.com.br/ws/${cep}/json/`, (retorno) => {
                    if (retorno.logradouro) $("#endereco").val(retorno.logradouro);
                    if (retorno.bairro) $("#bairro").val(retorno.bairro);
                    if (retorno.localidade) $("#cidade").val(retorno.localidade);
                    if (retorno.uf) $("#estado").val(retorno.uf);
                    if (retorno.complemento) $("#complemento").val(retorno.complemento);
                }, "JSON");
            }
        }
    });

    const aplicaMascaras = () => {
        $("#telefone").mask("(99) 9999-9999");
        $("#celular").mask("(99) 99999-9999");
        $("#cnpj").mask("99.999.999/9999-99");
        $("#cep").mask("99999-999");
    }

    aplicaMascaras();
});