$(document).ready(()=>{
    var msg = 'Campo obligatorio';
    $("#form_registro_obras").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
            Code: { required: true},
            nameObre: { required: true },
            tipoObra: { required: true},
        },
        messages: {
            Code: {
                required: msg
            },
            nameObre: {
                required: msg
            },
            tipoObra: {
                required: msg
            },
        },
        submitHandler: function (form) {
            obj = new Object;
            obj.codigoObra = $('#Code').val();
            obj.nombreObra = $('#nameObre').val();
            obj.tipoObra = $('#tipoObra').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "Administration/saveObra",
                data: { obj: obj },
                success: function (data) {
                    /* alert(data); */
                    if (data == 'error obra') {
                        Swal.fire({
                            type: 'Error',
                            title: 'Oops...',
                            text: 'No se pudo insertar la obra, intentelo de nuevo.',
                          })
                        }else if(data == 'success obra'){
                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'La obra ha sido registrada',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            $('#modalRegistroObra').modal('hide');
                            /* $('#users_table').load(" #users_table"); */
                            setTimeout(function () {
                                location.reload('/administration.obra');
                          }, 1200);
                        }else if(data == 'obra exist'){
                            Swal.fire({
                                title: 'La obra que intenta registrar ya existe en la base de datos...',
                                animation: false,
                                customClass: {
                                  popup: 'animated tada'
                                }
                              })
                        }
                },
                erro:function(error){
                    alert.error("HA OCURRIDO UN ERROR: "+error);
                },
            });
        }


        
    });


    $("#form_editar_obra").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
            nameObra: { required: true },
            typeEdit: { required: true},
        },
        messages: {
            nameObra: {
                required: msg
            },
            typeEdit: {
                required: msg
            },
        },
        submitHandler: function (form) {
            obj = new Object;
            obj.id = $('#idObra').val();
            obj.nombreObraEdit = $('#nameObra').val();
            obj.tipoObraEdit = $('#typeEdit').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "Administration/editObra",
                data: { obj: obj },
                success: function (data) {
                    if (data == 'error Obra Edit') {
                        Swal.fire({
                            type: 'Error',
                            title: 'Oops...',
                            text: 'No se pudo actualizar la obra, intentelo de nuevo.',
                          })
                        }else if(data == 'success Obra Edit'){
                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'La obra ha sido actualizada',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            $('#modalEditarObra').modal('hide');
                            /* $('#users_table').load(" #users_table"); */
                            setTimeout(function () {
                                location.reload('/administration.obra');
                          }, 1200);
                        }else if(data == 'no changes'){
                            Swal.fire({
                                title: 'No se encontraron cambios...',
                                animation: false,
                                customClass: {
                                  popup: 'animated tada'
                                }
                              })
                        }else if(data == 'name exist'){
                            Swal.fire({
                                type: 'Error',
                                title: '¡El nombre de la obra ya existe!',
                                text: 'Verifique que la obra que está ingresando no exista en la tabla..',
                              })
                        }
                },
                erro:function(error){
                    alert.error("HA OCURRIDO UN ERROR: "+error);
                },
            });
        }   
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "Administration/getTypesObres",
        success: function(response)
        {
            $('#tipoObra').html(response).fadeIn();
            $('#typeEdit').html(response).fadeIn();
        }
});

});
function resetModalObras(){
    /* This clean the modal if the user let some inputs with data and decides cancel the registration with it and setTimeout for the use don't see the porcess when it works*/
    setTimeout(() => {
        $('#Code').val('');
        $('#nameObre').val('');
        $('#tipoObra').val(0);
    }, 500);
}
function resetModalObrasEdit(){
    /* This clean the modal if the user let some inputs with data and decides cancel the registration with it and setTimeout for the use don't see the porcess when it works*/
    setTimeout(() => {
        $('#nameObra').val('');
        $('#typeEdit').val(0);
    }, 500);
}

function bringDataObra(obra){
    var id =  obra.value;

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "Administration/getObraData",
        data: { id: id },
        success: function (data) {
            $('#modalEditarObra').modal("show");
            var obj = $.parseJSON(data);
            $('#idObra').val(obj["data"]["ID"]);
            $('#nameObra').val(obj["data"]["name"]);
            $('#typeEdit').val(obj["data"]["type"]);
        },
        erro:function(error){
            alert.error("HA OCURRIDO UN ERROR: "+error);
        },
    });

}

function Eliminar_Obra(obra){
    var idObra = obra.value;
    var nombre = obra.name;
    Swal.fire({
        title: '¿Está seguro que desea eliminar la obra "'+nombre+'"?',
        text: "Esta acción no se puede corregir!",
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
                url: "Administration/deleteObra",
                data: { obra: idObra },
                success: function (data) {
                    if (data == 'Obra has been deleted') {
                        Swal.fire(
                            'Borrado!',
                            'El registro ha sido borrado.',
                            'success'
                          )
                          setTimeout(function () {
                              location.reload('/administration');
                        }, 1500);
                        }else if(data == 'Obra has not been deleted'){
                            Swal.fire({
                                type: 'Error',
                                title: 'Oops...',
                                text: 'La obra no se ha podido borrar',
                            })
                            setTimeout(function () {
                                location.reload('/administration');
                            }, 1200);
                    }
                },
                erro:function(error){
                    alert.error("HA OCURRIDO UN ERROR: "+error);
                },
            });

        }
      })
}