$(document).ready(function () {
    var msg = 'Campo obligatorio';
    document.getElementById("button_add_user").outerHTML = ' <button class="dropdown-item" onclick="resetModalRegistro()"  data-toggle="modal" data-target="#modalRegistro" >Registrar usuario</button>'
    $("#form_registro_usuario").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
            firstName: { required: true},
            lastName: { required: true },
            secondLastName: { required: true},
            user: { required:true},
            email: { required:false},
            password: {required:true, maxlength:20, minlength:8},
            address: { required:false, minlength:10}
        },
        messages: {
            firstName: {
                required: msg
            },
            lastName: {
                required: msg
            },
            secondLastName: {
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
            obj.ApellidoM = $('#lastName').val();
            obj.ApellidoP = $('#secondLastName').val();
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
                erro:function(error){
                    alert.error("HA OCURRIDO UN ERROR: "+error);
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
            obj.email = $('#emailEdit').val();
            obj.user = $('#userEdit').val();
            obj.telefono = $('#addressEdit').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "Administration/editUser",
                data: { obj: obj },
                success: function (data) {
                    /* alert(data); */
                    if (data == 'error') {
                        Swal.fire({
                            type: 'Error',
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
                    }
                },
                erro:function(error){
                    alert.error("HA OCURRIDO UN ERROR: "+error);
                },
            });
        }
    });
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
                erro:function(error){
                    alert.error("HA OCURRIDO UN ERROR: "+error);
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
        erro:function(error){
            alert.error("HA OCURRIDO UN ERROR: "+error);
        },
    });

}

/* function modificarModal(){
    $('#name').remove();
    $('#lastName').remove();
    $('#secondLastName').remove();
    $('#password').remove();
    document.getElementById("modal_option").outerHTML = '<div class="col-md-6 mb-4" id="fullName"><label for="fullName">Nombre completo</label><span id="name " style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Nombre completo</span><input type="text" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="fullName" name="fullName" pattern="[A-Z,a-z,-,_,.,0-9]+@[a-z]+\.[a-z]+" placeholder="nombre"></div>'
    document.getElementById("button_sumbit_modal").outerHTML = '<button class="btn btn-success" id="button_sumbit_modal" type="submit">Actualizar</button>'
    document.getElementById("exampleModalLabel").innerHTML = '<h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>'
    document.getElementById("cancela_modal_Registro").outerHTML = '<button class="btn btn-danger" onclick="resetModalRegistro()"type="button" id="cancela_modal_Registro" data-dismiss="modal">Cancelar edición</button>'
    document.getElementById("")

}

function resetModalRegistro(){
    $('#modalRegistro').modal('hide');
    setTimeout(function(){
        document.getElementById("fullName").outerHTML=' <div class="col-md-6 mb-4" id="name"><span>Nombre</span><span id="nombreCheck" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Nombre</span><input type="text" onkeyup="checkName(this)" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="firstName" name="firstName" pattern="/^[a-zA-ZÁÉÍÓÚáéíóúÑñ]+(\s*[a-zA-ZÁÉÍÓÚáéíóúÑñ])[a-zA-ZÁÉÍÓÚáéíóúÑñ]+$/" placeholder="Nombre" required></div><div class="col-md-6 mb-4" id="lastName"><span>Apellido Paterno</span><span id="apellidoPCheck" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Apellido paterno</span><input type="text" onkeyup="checkLastName(this)" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="lastName" name="lastName" pattern="[a-zA-ZÁÉÍÓÚáéíóúÑñ]+(\s*[a-zA-ZÁÉÍÓÚáéíóúÑñ])[a-zA-ZÁÉÍÓÚáéíóúÑñ]+" placeholder="Apellido paterno" required></div><div class="col-md-6 mb-4" id="secondLastName"><span>Apellido Materno</span><span id="apellidoMCheck" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Apellido materno</span><input type="text" onkeyup="checkSLastName(this)" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="secondLastName" name="secondLastName" pattern="[a-zA-ZÁÉÍÓÚáéíóúÑñ]+(\s*[a-zA-ZÁÉÍÓÚáéíóúÑñ])[a-zA-ZÁÉÍÓÚáéíóúÑñ]+" placeholder="Apellido materno" required></div><input type="hidden" id="modal_option"><div class="col-md-6 mb-4" id="password"><span>Contraseña</span><span id="contadorPassword" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Mínimo 8 caracteres</span><input type="password" onkeyup="contadorPassword(this)" minlength="8" maxlength="20" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="password" pattern="[0-9a-zA-Z]+" name="password" placeholder="Tu contraseña" required></div>'
        document.getElementById("exampleModalLabel").innerHTML = '<h5 class="modal-title" id="exampleModalLabel">Registrar usuario</h5>'
        document.getElementById("button_sumbit_modal").outerHTML = '<button class="btn btn-success" id="button_sumbit_modal" type="submit">Registrar</button>'
        document.getElementById("cancela_modal_Registro").outerHTML = '<button class="btn btn-danger" onclick="resetModal()" type="button" id="cancela_modal_Registro" data-dismiss="modal">Cancelar</button>'
    }, 1000)
} */

function editarUsuario(){

}

