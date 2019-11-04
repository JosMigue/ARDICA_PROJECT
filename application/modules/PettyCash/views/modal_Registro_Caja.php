<?php $fecha = date("Y")."-". date("m")."-".date("d")?>
<div class="modal fade bd-example-modal-lg" id="modalAddPettyCash" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de caja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <div>
                    <div class="container-registration">
                        <form method="post" action="" id="form_registro_caja">
                            <div class="row">
                                <input type="hidden" id="idUser" value="">
                                <div class="col-md-6 mb-4">
                                    <label for="numberPettyCash">Número<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <input type="text" class="form-control" id="numberPettyCash" name="numberPettyCash" placeholder="número" readonly required>
                                </div>
                                <div class="col-md-6 mb-4">                    
                                    <label for="datePettyCashBegin">Fecha de inicio<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <input type="date" id="beginDate" name="beginDate" onchange="valideDates()"class="form-control" value="<?php echo $fecha?>" >
                                </div>
<!--                                 <div class="col-md-6 mb-4">
                                    <label for="datePettyCashBegin">Fecha de terminación<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <input type="date" id="finishDate" name="finishDate" onchange="valideDates()" class="form-control" >
                                    <span id="dateMessage" style="font-size: 12px; display: none;  float: right;" class="text-danger my-2 font-weight-bold">Las fecha de terminación es menor que la de inicio</span>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="responsablePettyCash">Responsable<span style="font-size: 20px;  float: center;" class="text-danger my-2 font-weight-bold">*</span></label>
                                    <select  id="responsablePettyCash" name="responsablePettyCash" class="form-control"></select>
                                </div> -->
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success" type="submit" id="submit_petty_cash">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
