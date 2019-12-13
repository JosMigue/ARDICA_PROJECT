<div class="modal fade" id="modalAuthorizePersonal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Autorizar personas a caja chica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="authorizedPettyCash"> Caja chica </label>
                <select class="form-control" name="authorizedPettyCash" id="authorizedPettyCash">
                </select>
                <label for="authorizedUser"> Usuario autorizado </label>
                <select class="form-control" name="authorizedUser" id="authorizedUser">
                </select>
                <input id="owner" type="hidden" value="<?php echo $this->session->userdata('idUser')?>">
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="getAllAuthorizedPeople(this)" id="btnSeeAuthorizedPeople"
                        value="<?php echo $this->session->userdata('idUser')?>">Ver usuarios autorizados</buttton>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button id="btnAuthorizePersonal" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>