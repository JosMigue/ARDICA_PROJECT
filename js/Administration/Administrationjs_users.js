$(document).ready(function () {
    var msg = 'Campo obligatorio';
    $(".Filter").hide("fast");
    $("#btn-ocultar-filtros").hide();
    $("#form_registro_usuario").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
            firstName: { required: true},
            apellidoP: { required: true },
            apellidoM: { required: true},
            user: { required:true},
            email: { required:false},
            password: {required:true, maxlength:20, minlength:8},
            address: { required:false, minlength:10}
        },
        messages: {
            firstName: {
                required: msg
            },
            apellidoP: {
                required: msg
            },
            apellidoM: {
                required: msg
            },
            email: {
                required: msg
            },
            password:{
                required: msg,
                maxlength: "Contraseña debe ser maximo 20 caracteres",
                minlength: "Contraseña debe ser mínimo 8 caracteres"
            },
            address:{
                required: msg,
                minlength: "El telefono debe contra con 10 digitos"
            },

            user: msg,
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
                    if (data == 'user is not null') {
                        Swal.fire({
                            type: 'error',
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
                    alert("HA OCURRIDO UN ERROR: "+error);
                },
            });
        }
    });

    $("#form_editar_usuario").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
            FullName: { required:true},
            userEdit: { required:true},
            emailEdit: { required:false},
            addressEdit: { required:false, minlength:10}
        },
        address:{
            minlength: "El telefono debe contra con 10 digitos"
        },
        messages: {
            fullName: msg,
            userEdit: msg,
        },
        submitHandler: function (form) {
            obj = new Object;
            obj.id = $('#idUser').val();
            obj.Nombre = $('#fullName').val();
            if($('#emailEdit').val()==""){
                obj.email = null;
            }else{
                obj.email = $('#emailEdit').val();
            }
            obj.user = $('#userEdit').val();
            if($('#addressEdit').val() == ""){
                obj.telefono = null;
            }else{
                obj.telefono = $('#addressEdit').val();
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "Administration/editUser",
                data: { obj: obj },
                success: function (data) {
                    if (data == 'error') {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'El usuario no se ha podido actualizar...',
                        })
                    }else if(data == 'success'){
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'El usuario ha sido actualizado correctamente',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#modalEditarUsuario').modal('hide');
                        setTimeout(function () {
                            location.reload('/administration');
                        }, 1200);
                    }else if(data == 'no changes'){
                        Swal.fire({
                            title: 'No se encontraron cambios...',
                            animation: false,
                            customClass: {
                              popup: 'animated tada'
                            }
                          })
                    }
                },
                error:function(error){
                    alert("HA OCURRIDO UN ERROR: "+error);
                },
            });
        }
    });

    /*============================= FILTROS SECTION BEGIN============================= */
// Oculta los filtros y cambia boton al momento de dar clic en el botón 'Ocultar filtros'
    $(".hide-btn").click(function(){
        $(".Filter").hide("slow", function(){
            $("#btn-ocultar-filtros").hide("slow");
            $("#btn-filtros").show("slow");
        });
    });
    
    // Muestra los filtros y cambia boton al momento de dar clic en el botón 'Filtros'
    $(".show-btn").click(function(){
        $(".Filter").show("slow",function(){
            $("#btn-filtros").hide("slow");
            $("#btn-ocultar-filtros").show("slow");
        });
    });

    /*============================= FILTROS SECTION END============================= */
    });


function Eliminar_usurario(usuario){
    var user = usuario.value;
    var userName = usuario.name;
    Swal.fire({
        title: '¿Está seguro que desea eliminar el usuario '+userName+'?',
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
                url: "Administration/deleteUser",
                data: { user: user },
                success: function (data) {
                    if (data == 'user has been deleted') {
                        Swal.fire(
                            'Borrado!',
                            'El registro ha sido borrado.',
                            'success'
                          )
                          setTimeout(function () {
                              location.reload('/administration');
                        }, 1500);
                        }else if(data == 'user has not been deleted'){
                            Swal.fire({
                                type: 'Error',
                                title: 'Oops...',
                                text: 'El usuario no se ha podido borrar',
                            })
                            setTimeout(function () {
                                location.reload('/administration');
                            }, 1200);
                    }
                },
                error:function(error){
                    alert("HA OCURRIDO UN ERROR: "+error);
                },
            });

        }
      })
   
}


 function bringDataUser(usuario){
    var id =  usuario.value;
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "Administration/getUserData",
        data: { id: id },
        success: function (data) {
            $('#modalEditarUsuario').modal("show");
            var obj = $.parseJSON(data);
            $('#idUser').val(obj["data"]["ID"]);
            $('#fullName').val(obj["data"]["name"]);
            $('#emailEdit').val(obj["data"]["email"]);
            $('#userEdit').val(obj["data"]["nickname"]);
            $('#addressEdit').val(obj["data"]["phone"]);
        },
        error:function(error){
            alert("HA OCURRIDO UN ERROR: "+error);
        },
    });

}

function cleanFiltros(){
    setTimeout(() => {
        $("#nameFilter").val('');
        $("#nameUserFilter").val('');
        $("#dateFilter").val('');
        $("#idFilter").val('');
    }, 1000);
}

$("#btn-filtrar").click(()=>{
    obj = new Object;
    obj.name = $("#nameFilter").val();
    obj.userName = $("#nameUserFilter").val();
    obj.fecha = $("#dateFilter").val();
    obj.id = $("#idFilter").val();
    if(obj.name ==  '' && obj.userName == '' && obj.fecha ==  '' && obj.id== ''){
        document.getElementById("forMessage").outerHTML = '<div class="alert alert-danger" role="alert" id="warning_alert"><h4 class="alert-heading">ADVERTENCIA!</h4><p> Los campos están vacios, debe ingresar texto en al menos un campo para poder filtrar</p></div>'
        setTimeout(() => {
            $("#warning_alert").hide("fast")
            setTimeout(() => {
                document.getElementById("warning_alert").outerHTML = '<input type="hidden" id="forMessage">'
            }, 1000);
        }, 7000);
    }else{
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "Administration/filtrar_usuario",
            data: { obj: obj },
            success: function (data) {
                if (data == 'Error'){
                    Swal.fire({
                        type: 'Error',
                        title: 'Oops...',
                        text: 'Se esperaban datos',
                    })
                    location.reload('/administration');
                }
            },
            error:function(error){
                alert("HA OCURRIDO UN ERROR: "+error);
            },
        });
    }
});


