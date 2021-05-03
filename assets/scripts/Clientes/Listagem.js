$(document).ready(() => {

    $(".btn-deletar").click((evt) => {
        let cliente_id = $(evt.target).data("cliente_id") || $(evt.target).parent().data("cliente_id");
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
                window.location.href = `/clientes/excluir/${cliente_id}`;
            }
        })

    });


});