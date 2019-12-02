<!-- Modal -->
<div class="modal fade" id="modalRenameFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Renombrar archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="alert alert-info" id="alertNewNameFile" role="alert" style="display:none;">
        Mensaje: Solo se permiten <strong>letras y números</strong> en los nombres.
        </div>
        <label for="newNameFile">Ingrese el nuevo nombre</label>
        <input class="form-control"onkeyup="checkNewNameFile(this)" id="newNameFile" type="text" placeholder="Nuevo nombre">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnRenameFile">Renombrar archivo</button>
      </div>
    </div>
  </div>
</div>