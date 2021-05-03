$(document).ready(() => {

    $(".btn-deletar").click((evt) => {
        let produto_id = $(evt.target).data("produto_id") || $(evt.target).parent().data("produto_id");
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
                window.location.href = `/produtos/excluir/${produto_id}`;
            }
        })

    });


});