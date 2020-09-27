$(document).ready(() => {
    
    $("#produto_id").change((e) => {
        let produto_id = $(e.target).val();
        $("#box_loading").removeClass("hide");
        $("#box_info_produto").addClass("hide");

        $.get(`/produtos/get_info_produto/${produto_id}`, (retorno) => {
            $("#box_loading").addClass("hide");

            if(retorno.produto.estoque > 0) {
                $("#box_info_produto").removeClass("hide");

                $("#estoque").val(retorno.produto.estoque);
                $("#valor_unitario").val(retorno.produto.preco_venda);
                $("#quantidade").attr({
                    max: retorno.produto.estoque
                });
                $("#valor_total").val($("#quantidade").val() * retorno.produto.preco_venda);
            } else {
                toastr.error("Produto fora do estoque");
            }

        }, "JSON")
    });

    
    $("#salvar").click(() => $("#formulario").submit());

});