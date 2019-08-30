<div class="modal fade bd-example-modal-lg" id="modalEditarUsuario" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <div>
                    <div class="container-registration">
                        <form method="post" action="" id="form_editar_usuario">
                            <div class="row">
                                <input type="hidden" id="idUser" value="hola">
                                <div class="col-md-6 mb-4">
                                    <label for="fullName">Nombre completo</label>
                                    <span id="nombreCheckEdit" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Nombre</span>
                                    <input type="text" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="fullName" name="fullName" pattern="/^[a-zA-ZÁÉÍÓÚáéíóúÑñ]+(\s*[a-zA-ZÁÉÍÓÚáéíóúÑñ])[a-zA-ZÁÉÍÓÚáéíóúÑñ]+$/" placeholder="Nombre" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="emailEdit">Correo</label>
                                    <span id="correoCheckEdit" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">correo</span>
                                    <input type="text" onkeyup="checkEmailEdit(this)" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="emailEdit" name="emailEdit" pattern="[A-Z,a-z,-,_,.,0-9]+@[a-z]+\.[a-z]+" placeholder="Example@Example.com" >
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="email">Usuario</label>
                                    <span id="correoCheckEdit" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Nombre de usuario</span>
                                    <input type="text" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="userEdit" name="userEdit" pattern="[A-Z,a-z,-,_,.,0-9]+@[a-z]+\.[a-z]+" placeholder="Usuario" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="addressEdit">Teléfono</span>
                                    <span id="contadorTelefonoEdit" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">número telefonicp</span>
                                    <input type="tel" onkeyup="contadorTelefonoEdit(this)" class="form-control shadow-sm p-3 mb-2 bg-white rounded" name="addressEdit" maxlength="10" id="addressEdit" placeholder="1234567890"  pattern="[0-9]+">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success" type="submit">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>