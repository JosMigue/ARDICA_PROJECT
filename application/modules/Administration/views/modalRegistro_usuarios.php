<div class="modal fade bd-example-modal-lg" id="modalRegistro" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar usuario</h5>
                <button type="button" onclick="resetModalRegistro()" class="close" data-dismiss="modal" aria-label="Close" id="close_modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <div>
                    <div class="container-registration">
                        <form method="post" action="" id="form_registro_usuario">
                            <div class="row">
                                <div class="col-md-6 mb-4" id="name">
                                    <label for="name">Nombre</label>
                                    <span id="nombreCheck" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Nombre</span>
                                    <input type="text" onkeyup="checkName(this)" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="firstName" name="firstName" pattern="/^[a-zA-ZÁÉÍÓÚáéíóúÑñ]+(\s*[a-zA-ZÁÉÍÓÚáéíóúÑñ])[a-zA-ZÁÉÍÓÚáéíóúÑñ]+$/" placeholder="Nombre" required>
                                </div>
                                <div class="col-md-6 mb-4" id="lastName">
                                    <label for="apellidoP">Apellido Paterno</label>
                                    <span id="apellidoPCheck" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Apellido paterno</span>
                                    <input type="text" onkeyup="checkLastName(this)" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="apellidoP" name="apellidoP" pattern="/^[a-zA-ZÁÉÍÓÚáéíóúÑñ]+(\s*[a-zA-ZÁÉÍÓÚáéíóúÑñ])[a-zA-ZÁÉÍÓÚáéíóúÑñ]+$/" placeholder="Apellido paterno" required>
                                </div>
                                <div class="col-md-6 mb-4" id="secondLastName">
                                    <label for="apellidoM">Apellido Materno</label>
                                    <span id="apellidoMCheck" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Apellido materno</span>
                                    <input type="text" onkeyup="checkSLastName(this)" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="apellidoM" name="apellidoM" pattern="/^[a-zA-ZÁÉÍÓÚáéíóúÑñ]+(\s*[a-zA-ZÁÉÍÓÚáéíóúÑñ])[a-zA-ZÁÉÍÓÚáéíóúÑñ]+$/" placeholder="Apellido materno" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="email">Correo</label>
                                    <span id="correoCheck" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Introduzca un correo valido</span>
                                    <input type="text" onkeyup="checkEmail(this)" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="email" name="email" pattern="[A-Z,a-z,-,_,.,0-9]+@[a-z]+\.[a-z]+" placeholder="Example@Example.com" >
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="email">Usuario</label>
                                    <span id="correoCheck" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Nombre de usuario</span>
                                    <input type="text" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="user" name="user" pattern="[A-Z,a-z,-,_,.,0-9]+@[a-z]+\.[a-z]+" placeholder="Usuario" required>
                                </div>
                                <div class="col-md-6 mb-4" id="password">
                                    <label for="password">Contraseña</label>
                                    <span id="contadorPassword" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Mínimo 8 caracteres</span>
                                    <input type="password" onkeyup="contadorPassword(this)" minlength="8" maxlength="20" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="password" pattern="/^[0-9a-zA-Z]+$/" name="password" placeholder="Tu contraseña" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="address">Teléfono</span>
                                    <span id="contadorTelefono" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">10 restantes</span>
                                    <input type="tel" onkeyup="contadorTelefono(this)" class="form-control shadow-sm p-3 mb-2 bg-white rounded" name="address" maxlength="10" id="address" placeholder="1234567890"  pattern="[0-9]+">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" onclick="resetModal()" type="button" id="cancela_modal_Registro"data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success" id="button_sumbit_modal" type="submit">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>