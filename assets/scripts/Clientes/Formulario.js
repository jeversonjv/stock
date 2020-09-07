$(document).ready(() => {

    $("#cep").blur((e) => {
        let cep = $(e.target).val();

        if(cep) {
            cep = cep.replace(/[^\d]/g, "");
            if(cep.length === 8) {
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                // if(retorno.uf) $("#estado").val(retorno.uf);
                $("#complemento").val("");

                $.get(`https://viacep.com.br/ws/${cep}/json/`, (retorno) => {

                    if(retorno.logradouro) $("#endereco").val(retorno.logradouro);
                    if(retorno.bairro) $("#bairro").val(retorno.bairro);
                    if(retorno.localidade) $("#cidade").val(retorno.localidade);
                    // if(retorno.uf) $("#estado").val(retorno.uf);
                    if(retorno.complemento) $("#complemento").val(retorno.complemento);

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