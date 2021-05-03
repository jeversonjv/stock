$(document).ready(() => {

    $(".btn-deletar").click((evt) => {
        let venda_id = $(evt.target).data("venda_id") || $(evt.target).parent().data("venda_id");
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
                Swal.fire({
                    title: 'Deseja voltar com o produto para o estoque?',
                    text: 'O produto será adicionado ao estoque novamente',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, pode adicionar no estoque!',
                    cancelButtonText: 'Não adicionar!',
                    reverseButtons: true
                }).then((result) => {
                    window.location.href = `/vendas/excluir/${venda_id}/${result.value ? 1 : 0}`;
                });
            }
        });

    });


});