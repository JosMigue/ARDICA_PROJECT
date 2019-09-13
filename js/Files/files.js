$(document).ready(function () {
    var msg = 'Campo obligatorio';
    $("#form_subir_archivo").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
            archivo: { required: true}
        },
        messages: {
            archivo: {
                required: msg
            }
        },
        submitHandler: function (form) {
            obj = new Object;
            obj.Nombre = $('#firstName').val();
            obj.ApellidoM = $('#apellidoM').val();
            obj.ApellidoP = $('#apellidoP').val();
            obj.email = $('#email').val();
            obj.user = $('#user').val();
            obj.contrasena = $('#password').val();
            obj.telefono = $('#address').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "Administration/saveUser",
                data: { obj: obj },
                success: function (data) {
                    /* alert(data); */
                    if (data == 'user is not null') {
                        Swal.fire({
                            type: 'Error',
                            title: 'Oops...',
                            text: 'El usuario que intenta ingresar ya existe en base de datos',
                          })
                        }else if(data == 'user is null'){
                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'El usuario ha sido registrado',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            $('#modalRegistro').modal('hide');
                            /* $('#users_table').load(" #users_table"); */
                            setTimeout(function () {
                                location.reload('/administration');
                          }, 1200);
                    }else if(data == 'user fail'){
                        Swal.fire({
                            type: 'Error',
                            title: 'Oops...',
                            text: 'No se pudo insertar en la base de datos',
                          })
                    }
                },
                error:function(error){
                    alert.error("HA OCURRIDO UN ERROR: "+error);
                },
            });
        }
    });
});


