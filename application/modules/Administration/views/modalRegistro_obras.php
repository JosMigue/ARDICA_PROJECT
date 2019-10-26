<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span><div class="modal fade bd-example-modal-lg" id="modalRegistroObra" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Obra</h5>
                <button type="button" onclick="resetModalObras()" class="close" data-dismiss="modal" aria-label="Close" id="close_modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <div>
                    <div class="container-registration">
                        <form method="post" action="" id="form_registro_obras">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="Code">Codigo<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <span id="CodeTittle" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Código</span>
                                    <input type="text" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="Code" name="Code"  placeholder="Código" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="nameObre">Nombre de la obra<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <span id="nameObreTittle" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Nombre</span>
                                    <input type="text" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="nameObre" name="nameObre" placeholder="Nombre" required>              
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="tipoObra">Tipo de obras<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <span id="tipoObraTittle" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Tipo</span>
                                    <select class="form-control" name="tipoObra" id="tipoObra" required>
                                    <!-- Here will be the options inserted with Javascript -->
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" onclick="resetModalObras()" type="button" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success" type="submit">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>