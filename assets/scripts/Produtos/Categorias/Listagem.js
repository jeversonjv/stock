$(document).ready(() => {

    $(".btn-deletar").click((evt) => {
        let categoria_id = $(evt.target).data("categoria_id") || $(evt.target).parent().data("categoria_id");;
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
                window.location.href = `/categorias/excluir/${categoria_id}`;
            }
        })

    });

});