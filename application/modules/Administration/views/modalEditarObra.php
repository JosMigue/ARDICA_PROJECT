<div class="modal fade bd-example-modal-lg" id="modalEditarObra" tabindex="-1" role="dialog"
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
                        <form method="post" action="" id="form_editar_obra">
                            <div class="row">
                            <input type="hidden" id="idObra" value="">
                                <div class="col-md-6 mb-4">
                                    <label for="nameObra">Nombre de la obra</label>
                                    <span id="nombreCheckEdit" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Nombre</span>
                                    <input type="text" class="form-control shadow-sm p-3 mb-2 bg-white rounded" id="nameObra" name="nameObra" placeholder="Nombre" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="typeEdit">Tipo</label>
                                    <span id="" style="font-size: 12px; float: right;" class="text-success my-2 font-weight-bold">Tipo</span>
                                    <select class="form-control" name="typeEdit" id="typeEdit" required>

                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" type="button" onclick="resetModalObrasEdit()" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success" type="submit">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>