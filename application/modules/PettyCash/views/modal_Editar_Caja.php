<div class="modal fade bd-example-modal-lg" id="modalEditPettyCash" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar gasto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <div>
                    <div class="container-registration">
                        <form method="post" action="" id="form_registro_editar_caja">
                            <div class="row">
                                <input type="hidden" id="idDetail">
                                <div class="col-md-6 mb-4">
                                    <label for="locationPettyCashEdit">Ubicación<span
                                            style="font-size: 20px;  float: center;"
                                            class="text-danger my-2 font-weight-bold">*</span></label>
                                    <select id="locationPettyCashEdit" name="locationPettyCashEdit"
                                        class="form-control"></select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="deductiblePettyCashEdit">Tipo deducible<span
                                            style="font-size: 20px;  float: center;"
                                            class="text-danger my-2 font-weight-bold">*</span></label>
                                    <select id="deductiblePettyCashEdit" name="deductiblePettyCashEdit"
                                        onchange="iva_sub_total_edit()" class="form-control"></select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="conceptPettyCashEdit">Concepto<span
                                            style="font-size: 20px;  float: center;"
                                            class="text-danger my-2 font-weight-bold">*</span></label>
                                    <select id="conceptPettyCashEdit" name="conceptPettyCashEdit"
                                        class="form-control"></select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="teamPettyCashEdit">Equipo<span style="font-size: 20px;  float: center;"
                                            class="text-danger my-2 font-weight-bold">*</span></label>
                                    <select id="teamPettyCashEdit" name="teamPettyCashEdit"
                                        class="form-control"></select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="subtotalPettyCashEdit">Subtotal<span
                                            style="font-size: 20px;  float: center;"
                                            class="text-danger my-2 font-weight-bold">*</span></label>
                                    <input type="text" id="subtotalPettyCashEdit" name="subtotalPettyCashEdit"
                                        class="form-control" onkeyup="subTotal_edit()">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="IVAPettyCashEdit">IVA<span style="font-size: 20px;  float: center;"
                                            class="text-danger my-2 font-weight-bold">*</span></label>
                                    <input type="hidden" id="ivaEdit" value="<?php echo IVA?>">
                                    <input type="text" id="IVAPettyCashEdit" name="IVAPettyCashEdit" readonly
                                        class="form-control">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="totalPettyCashEdit">Total<span style="font-size: 20px;  float: center;"
                                            class="text-danger my-2 font-weight-bold">*</span></label>
                                    <input type="text" id="totalPettyCashEdit" name="totalPettyCashEdit" disabled
                                        class="form-control">
                                </div>
                                <div class="col-md-12 mb-12">
                                    <label for="observationPettyCashEdit">Observaciones</label>
                                    <textarea class="form-control" id="observationPettyCashEdit"
                                        name="observationPettyCashEdit"></textarea>
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