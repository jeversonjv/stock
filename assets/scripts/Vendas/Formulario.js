$(document).ready(() => {

    let produtos = [];
    // editando
    if ($("#produtos").val() != 0) {
        produtos = JSON.parse($("#produtos").val()).map(p => ({ ...p, validarEstoque: false }));
    }

    $("#produto_id").change((e) => {
        let produto_id = $(e.target).val();
        if (produto_id > 0) {
            $("#box_loading").removeClass("hide");
            $("#box_info_produto").addClass("hide");

            $.get(`/produtos/get_info_produto/${produto_id}`, (retorno) => {
                $("#box_loading").addClass("hide");

                if (retorno.produto.estoque > 0) {
                    $("#box_info_produto").removeClass("hide");

                    let desconto_estoque = 0;
                    produtos.forEach(produto => {
                        if (produto.produto_id == retorno.produto.produto_id && produto.validarEstoque !== false) {
                            desconto_estoque += produto.quantidadeValidarEstoque;
                        }
                    });

                    $("#estoque").val(retorno.produto.estoque - desconto_estoque);
                    $("#valor_unitario").val(formataDinheiro(retorno.produto.preco_venda));
                    $("#quantidade").attr({
                        max: retorno.produto.estoque
                    });

                    $("#valor_total").val(formataDinheiro($("#quantidade").val() * retorno.produto.preco_venda));
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

        if (parseInt(quantidade) > parseInt(estoque)) quantidade = estoque;
        if (parseInt(quantidade) == 0) quantidade = 1;

        $("#valor_total").val(formataDinheiro(quantidade * trataValor($("#valor_unitario").val())));
        $("#quantidade").val(quantidade);
    });


    $("#add_produto").click(() => {
        let produto_id = $("#produto_id").val();
        let estoque = $("#estoque").val();

        if (produto_id == 0) {
            toastr.error("Selecione um produto.");
            return;
        }

        let nome = $("#produto_id :selected").text();
        let quantidade = $("#quantidade").val();
        let valor_unitario = trataValor($("#valor_unitario").val());
        let valor_total = trataValor($("#valor_total").val());
        let achou_produto = false;

        if (parseInt(estoque) < parseInt(quantidade)) {
            toastr.error("Produto fora do estoque.");
            return;
        }

        produtos.forEach(produto => {
            if (produto.produto_id == produto_id) {
                produto.quantidade = parseInt(produto.quantidade) + parseInt(quantidade);
                produto.valor_total = trataValor(produto.valor_total) + valor_total;
                produto.validarEstoque = true;
                produto.quantidadeValidarEstoque = produto.quantidadeValidarEstoque ? parseInt(produto.quantidadeValidarEstoque) + parseInt(quantidade) : parseInt(quantidade);
                achou_produto = true;
            }
        });

        if (!achou_produto) {
            let produto = {
                produto_id,
                nome,
                quantidade,
                valor_unitario,
                valor_total,
                validarEstoque: true,
                quantidadeValidarEstoque: quantidade,
                removerSomenteFront: true
            };

            produtos.push(produto);
        }

        listarProdutos();

        $("#modal_produto").modal("hide");
        resetarModal();
    });

    const listarProdutos = () => {
        $("#tabela_produtos tbody").empty();

        if (produtos.length > 0) {
            let valor_total_compra = 0;
            produtos.forEach(produto => {
                $("#tabela_produtos tbody").append(`
                    <tr>
                        <td> ${produto.nome} </td>
                        <td> ${produto.quantidade} </td>
                        <td> ${formataDinheiro(produto.valor_unitario)} </td>
                        <td> ${formataDinheiro(produto.valor_total)} </td>
                        <td> <a class="btn btn-danger text-white btn-deletar" data-produto_id="${produto.produto_id}"> <i class="fas fa-trash icone_deletar"></i></i> </a> </td>
                    </tr>
                `);

                valor_total_compra += parseFloat(produto.valor_total);
            });

            $("#tabela_produtos tbody").append(`
                <tr>
                    <td colspan="1"> <strong> Total </strong> </td>
                    <td colspan="4"> <strong> ${formataDinheiro(valor_total_compra)} </strong> </td>
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

    $(document).on("click", "a.btn-deletar", (evt) => {
        deletarProduto($(evt.target).data("produto_id"));
    });

    $(document).on("click", "i.icone_deletar", (evt) => {
        deletarProduto($(evt.target).parent().data("produto_id"));
    });

    const deletarProduto = (produto_id) => {
        if (produto_id) {
            const venda_id = $("#venda_id").val();

            Swal.fire({
                title: 'Tem certeza?',
                text: 'Não será possível recuperar o registro',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, pode deletar!',
                cancelButtonText: 'Cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    const produto = produtos.find(p => p.produto_id == produto_id && p.removerSomenteFront !== true);

                    if (venda_id != 0 && produto) {
                        Swal.fire({
                            title: 'Deseja voltar com o produto para o estoque?',
                            text: 'O produto será adicionado ao estoque novamente',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Sim, pode adicionar no estoque!',
                            cancelButtonText: 'Não adicionar!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.value) {
                                $.get(`/vendas/excluir_venda_produto/${venda_id}/${produto_id}/${result.value ? 1 : 0}`, (retorno) => {
                                    if (!retorno.erro) {
                                        toastr.success("Produto adicionado ao estoque.");
                                        removerProdutoPeloId(produto_id);
                                        listarProdutos();
                                    } else {
                                        toastr.error(retorno.mensagem);
                                    }
                                }, "JSON");
                            }
                        });
                    } else {
                        removerProdutoPeloId(produto_id);
                        listarProdutos();
                    }
                }
            });
        }

    }

    const removerProdutoPeloId = (produto_id) => {
        produtos = produtos.filter(produto => produto.produto_id != produto_id);
    }

    $("#salvar").click(() => {
        if (produtos.length == 0) {
            toastr.error("Adicione pelo menos um produto!");
            return;
        }

        const venda_id = $("#venda_id").val();
        const cliente_id = $("#cliente_id").val();
        const descricao = $("#descricao").val();

        $.post("/vendas/salvar", {
            venda_id,
            cliente_id,
            descricao,
            produtos: produtos.map(p => ({ produto_id: p.produto_id, quantidade: p.quantidade }))
        }, (retorno) => {
            if (retorno.erro) {
                toastr.error(retorno.mensagem);
            } else {
                toastr.success(retorno.mensagem);
                window.location.href = "/vendas";
            }
        }, "JSON");
    });

    $("#abrir_modal_add_produto").click(() => resetarModal());

    const resetarModal = () => {
        $("#box_loading").addClass("hide");
        $("#box_info_produto").addClass("hide");
        $("#quantidade").val(1);
        $("#produto_id").val(0).trigger("chosen:updated");
        $("#valor_unitario").val("");
        $("#valor_total").val("");
    }

    const formataDinheiro = (valor, com_cifrao = true) => {
        if (com_cifrao) {
            return parseFloat(valor).toLocaleString('pt-br', { style: 'currency', currency: 'BRL' });
        }

        return parseFloat(valor).toLocaleString('pt-br', { minimumFractionDigits: 2 });
    }

    const trataValor = (valorStr) => {
        return parseFloat(valorStr.toString().replace(/\R\$/g, "").replace(/\./g, "").replace(/\,/g, "."));
    }

});