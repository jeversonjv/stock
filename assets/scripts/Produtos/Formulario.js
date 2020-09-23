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

    $("#salvar").click(() =>  {
        let produto_id = $("#produto_id").val();

        if(produto_id == 0) {
            Swal.fire({
                title: 'Deseja inserir produto no contas a pagar?',
                text: 'O produto será inserido no controle de contas a pagar ',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, pode inserir!',
                cancelButtonText: 'Não quero!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $("#incluir_contas_a_pagar").val(1);
                } else {
                    $("#incluir_contas_a_pagar").val(0);
                }
    
                $("#formulario").submit();
            });
        } else {
            $("#formulario").submit();
        }
    });
});