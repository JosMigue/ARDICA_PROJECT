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
        <label for="locationFilter">Localización</label>
        <input type="text" id="locationFilter" class="form-control" placeholder="Localización">
        <input type="hidden" name="selected_location" id="selected_location">
    </div>
    <div class="col-md-3 ">
        <label for="deductibleFilter">Tipo de deducible</label>
        <select name="deductibleFilter" id="deductibleFilter" class="form-control">
        <option value="" selected>Seleccionar...</option>
        <option value="1" >Deducible</option>
        <option value="2" >No deducible</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="reportrange">fecha</label>
        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
        </div>
    </div>
    <div class="col-md-3">
        <label for="responsableFilter">Encargado</label>
        <input type="text" id="responsableFilter"  class="form-control" placeholder="encargado">
        <input type="hidden" name="selected_responsable" id="selected_responsable">
    </div>
    <div class="col-md-3">
        <label for="teamFilter">Equipo</label>
        <input type="text" id="teamFilter"  class="form-control" placeholder="equipo">
        <input type="hidden" name="selected_team" id="selected_team">
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
                    <th scope="col">Localización</th>
                    <th scope="col">Fecha de incio</th>
                    <th scope="col">Fecha de terminación</th>
                    <th scope="col">Deducible</th>
                    <th scope="col">Concepto</th>
                    <th scope="col">Encargado</th>
                    <th scope="col">Equipo</th>
                    <th scope="col">Fecha de registro</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>