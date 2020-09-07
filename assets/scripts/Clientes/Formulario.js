$(document).ready(() => {

    $("#formulario").validate({
        rules: {
            nome: { required: true },
            email: { required: true, email: true },
            data_nascimento: { required: true },
            sexo: { required: true },
            telefone: { required: false, minlength: 14 },
            celular: { required: true, minlength: 15 },
            rg: { required: true },
            cpf: { required: true, minlength: 14 },
            cep: { required: true, minlength: 9 },
            endereco: { required: true },
            bairro: { required: true },
            numero: { required: true, number: true },
            cidade: { required: true },
            estado: { required: true },
        },
        messages: {
            nome: { required: "Campo obrigatório" },
            email: { required: "Campo é obrigatório", email: "Digite um formato válido" },
            data_nascimento: { required: "Campo é obrigatório" },
            sexo: { required: "Campo é obrigatório" },
            telefone: { minlength: "Preencha Corretamente" },
            celular: { required: "Campo é obrigatório", minlength: "Preencha Corretamente" },
            rg: { required: "Campo é obrigatório" },
            cpf: { required: "Campo é obrigatório", minlength: "Preencha Corretamente" },
            cep: { required: "Campo é obrigatório", minlength: "Preencha Corretamente" },
            endereco: { required: "Campo é obrigatório" },
            bairro: { required: "Campo é obrigatório" },
            numero: { required: "Campo é obrigatório" },
            cidade: { required: "Campo é obrigatório" },
            estado: { required: "Campo é obrigatório" },
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
        $("#cpf").mask("999.999.999-99");
        $("#cep").mask("99999-999");
    }

    aplicaMascaras();
});