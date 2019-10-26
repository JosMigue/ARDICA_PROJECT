<title>Caja chica</title>
<h1 class="text-center">Caja Chica</h1>
<div class="alert alert-danger" role="alert" id="warning_alert" style="display:none;"><h4 class="alert-heading">ADVERTENCIA!</h4><p> Los campos están vacios, debe ingresar texto en al menos un campo para poder filtrar</p></div>
<div class="text-center">
<button class="show-btn btn btn-primary" id="btn-filtros">Filtros</button>
<button class="hide-btn btn btn-danger" id="btn-ocultar-filtros" style="display: none;" onclick="cleanFiltrosPettyCash()">Ocultar filtros</button>
</div>
<section class="Filter text-center" style="display: none;">
    <div class="row">
    <div class="col-md-3">
        <label for="numberFilter">Número</label>
        <input type="text" id="numberFilter" class="form-control" placeholder="Número">
    </div>
    <div class="col-md-3">
        <label for="dateFilter">fecha</label>
        <input type="text" id="dateFilter" name="dateFilter" class="form-control">
        <input type="hidden" name="dateOne" id="dateOne" value="">
        <input type="hidden" name="dateTwo" id="dateTwo" value="">
    </div>
    <div class="col-md-3">
        <label for="responsableFilter">Encargado</label>
        <input type="text" id="responsableFilter"  class="form-control" placeholder="Encargado">
        <input type="hidden" name="selected_responsable" id="selected_responsable">
    </div>
    <div class="col-md-3">
        <label for="statusPettyCashFilter">Estado</label>
        <select class="form-control" id="statusPettyCashFilter">
            <option value="" selected>seleccionar...</option>
            <option value="1">Activo</option>
            <option value="2">No activo</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="autorizationPettyCashFilter">Autorización</label>
        <select class="form-control" id="autorizationPettyCashFilter">
            <option value="" selected>seleccionar...</option>
            <option value="1">Autorizada</option>
            <option value="2">No autorizada</option>
        </select>
    </div>
    </div>
    <div class="text-center">
        <button class="btn btn-outline-info" id="btn_Filtrar_Petty_Cash">Filtrar</button>
    </div>
    <div class="text-center">
        <button class="btn btn-outline-dark" id="btn-reset-filtrar-PettyCash" onclick="cleanFiltrosPettyCash()" style=" display:none; margin-top: 5px;">Resetear filtros</button>
    </div>
    <br>
</section>
<div class="col-lg-12 table-responsive ancho_alto">
        <table  id="petty_Cash_Table"  class="table table-bordered text-center" >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">E</th>
                    <th scope="col">ID</th>
                    <th scope="col">ID_DB</th>
                    <th scope="col">Número</th>
                    <th scope="col">Fecha de incio</th>
                    <th scope="col">Fecha de terminación</th>
                    <th scope="col">Encargado</th>
                    <th scope="col">Fecha de registro</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
  