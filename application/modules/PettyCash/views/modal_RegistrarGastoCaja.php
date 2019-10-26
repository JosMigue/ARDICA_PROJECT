<div class="modal fade bd-example-modal-lg" id="modalAddSellPettyCash" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de gasto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modal" onclick="cleanModalAddSpend()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <div>
                    <div class="container-registration">
                        <form method="post" action="" id="form_registro_caja_gasto">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="numberPettyCashSell">Número de caja elegida<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <input type="text" class="form-control" id="numberPettyCashSell" name="numberPettyCashSell" readonly>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="locationPettyCash">Ubicación<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <select id="locationPettyCash" name="locationPettyCash" class="form-control"></select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="deductiblePettyCash">Tipo deducible<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <select id="deductiblePettyCash" onchange="iva_sub_total()" name="deductiblePettyCash" class="form-control"></select>
                                </div>
                                <div class="col-md-6 mb-4">
                                        <label for="conceptPettyCash">Concepto<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <div class="input-group">
                                        <select  id="conceptPettyCash" name="conceptPettyCash" class="form-control"></select>
                                        <button type="button" id="btnAddConceptOnModal"><i class="material-icons">add_circle</i></button>
                                    </div>
                                    <div class="form-group shadow p-3 mb-2 bg-white rounded" id="sectionAddConceptOnModal" style="display: none;">
                                        <input type="text" class="form-control" id="inputConceptOnModal" placeholder="Concepto">
                                        <button class="btn btn-danger" id="btnCancelOnModal" type="button" >Cancelar</button>
                                        <button class="btn btn-success" id="btnAddOnModalConcept" type="button" >Agregar</button>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="subtotalPettyCash">Subtotal<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <input class="form-control" onkeyup="subTotal()" type="text" id="subtotalPettyCash" name="subtotalPettyCash">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="ivaPettyCash">IVA<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <input type="hidden" id="ivaPettyCashHide" value="<?php echo IVA?>">
                                    <input class="form-control" type="text" id="ivaPettyCash" name="ivaPettyCash" readonly>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="totalPettyCash">Total <span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <input class="form-control" type="text" id="totalPettyCash" name="totalPettyCash" readonly>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="teamPettyCash">Equipo<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <select id="teamPettyCash" name="teamPettyCash" class="form-control"></select>
                                </div>
                                <div class="col-md-12 mb-12">
                                    <label for="observationPettyCash">Observaciones</label>
                                    <textarea class="form-control" id="observationPettyCash" name="observationPettyCash"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" type="button" onclick="cleanModalAddSpend()" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success" type="submit">Agregar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>