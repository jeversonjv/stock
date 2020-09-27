$(document).ready(() => {
    
    let produtos = [];

    $("#produto_id").change((e) => {
        let produto_id = $(e.target).val();
        if(produto_id > 0) {
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
    
            }, "JSON");
        } else {
            resetarModal();
        }
    });

    $("#quantidade").on("change keyup", (evt) => {
        let quantidade = $(evt.target).val();
        let estoque = $("#estoque").val();

        if(parseInt(quantidade) > parseInt(estoque)) quantidade = estoque;
        if(parseInt(quantidade) == 0) quantidade = 1;

        $("#valor_total").val(quantidade * $("#valor_unitario").val());
        $("#quantidade").val(quantidade);
    });


    $("#add_produto").click(() => {
        let produto = {
            nome: $("#produto_id :selected").text(),
            quantidade: $("#quantidade").val(),
            valor_unitario: $("#valor_unitario").val(),
            valor_total: $("#valor_total").val()
        };

        produtos.push(produto);
        listarProdutos();

        $("#modal_produto").modal("hide");
        resetarModal();
    });

    const listarProdutos = () => {
        $("#tabela_produtos tbody").empty();

        if(produtos.length > 0) {
            let valor_total_compra = 0;
            produtos.forEach(produto => {
                $("#tabela_produtos tbody").append(`
                    <tr>
                        <td> ${produto.nome} </td>
                        <td> ${produto.quantidade} </td>
                        <td> R$ ${produto.valor_unitario} </td>
                        <td> R$ ${produto.valor_total} </td>
                        <td> <a class="btn btn-danger text-white btn-deletar"> <i class="fas fa-trash"></i></i> </a> </td>
                    </tr>
                `);

                valor_total_compra += parseInt(produto.valor_total);
            });

            $("#tabela_produtos tbody").append(`
                <tr>
                    <td colspan="1"> <strong> Total </strong> </td>
                    <td colspan="4"> <strong> R$ ${valor_total_compra} </strong> </td>
                </tr>
            `);
        } else {
            $("#tabela_produtos tbody").append(`
                <tr>
                    <td class="text-center" colspan="5"> Sem Produtos Cadastrados </td>
                </tr>
            `);
        }
    }

    $("#abrir_modal_add_produto").click(() => resetarModal());

    const resetarModal = () => {
        $("#box_loading").addClass("hide");
        $("#box_info_produto").addClass("hide");
        $("#quantidade").val(1);
        $("#produto_id").val(0).trigger("chosen:updated");
    }
    
    $("#salvar").click(() => $("#formulario").submit());
});