$(document).ready(() => {

    $(".btn-deletar").click((evt) => {
        let fornecedor_id = $(evt.target).data("fornecedor_id") || $(evt.target).parent().data("fornecedor_id");
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
                window.location.href = `/fornecedores/excluir/${fornecedor_id}`;
            }
        })

    });

});