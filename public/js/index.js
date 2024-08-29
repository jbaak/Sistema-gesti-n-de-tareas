
$(document).ready(function(){
    //al hace click en el boton de eliminar , sale una modal de confirmancio
    // si se confirma ejecuta una peticion ajax que elimina en la bd y mediante jquery se
    //elimina la fila
    $(".delete").on('click',function(event) {
        event.preventDefault();

        let url= $(this).attr('href');
        let id= $(this).attr('data-id');

        Swal.fire({
            icon: 'warning',
            title: '¿Estás seguro/a de eliminar a esta tarea?',
            showConfirmButton: true,
            confirmButtonText: 'ELIMINAR',
            confirmButtonColor: '#3085d6',
            showCancelButton: true,
            cancelButtonText: 'CANCELAR',
            cancelButtonColor: '#d33',
            buttonsStyling: true,

        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {},
                    success: function(data) {
                        $('#td-'+id).remove();
                        Swal.fire({
                            icon: 'success',
                            title: 'Tarea eliminada correctamente.',
                            showConfirmButton: false,
                            timer: 1500,
                        })
                    }
                });
            }

        });
    });
});