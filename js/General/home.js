
$("#destroySession").click(function(){
        Swal.fire({
            title: 'Estás seguro que quieres cerrar sesión?',
            text: "Se procesderá a cerrar la sesión!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, estoy seguro!'
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "General/cerrar_sesion",
                    success: function (response) {
                        location.reload('/');
                    },
                    error:function(jqXHR, textStatus, errorThrown){
                        if (jqXHR.status === 0) {

                            alert('Sin conexión internet: Verificar tu conexion.');
                
                          } else if (jqXHR.status == 404) {
                
                            alert('Página o función no encontrada [404]');
                
                          } else if (jqXHR.status == 500) {
                            $.confirm({
                                title: 'Error interno del servidor [500]',
                                content: 'Algo ocurrió, intente más tarde o contacte al administrador del sistema',
                                type: 'red',
                                typeAnimated: true,
                                buttons: {
                                    cerrar:{
                                        text: 'Cerrar',
                                        close: function () {
                                        }
                                    }
                                }
                            });
                
                          } else if (textStatus === 'parsererror') {
                
                            alert('Fallo al solicitar el JSON.');
                
                          } else if (textStatus === 'timeout') {
                
                            alert('Tiempo agotado.');
                
                          } else if (textStatus === 'abort') {
                
                            alert('Petición Ajax abortada.');
                
                          } else {
                
                            alert('Error desconocido: ' + jqXHR.responseText);
                
                          }
                    },
                }); 
            }
          })
    });

    /* Set the width of the side navigation to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}