<title>Caja chica - gastos</title>
<h1 class="text-center">Caja Chica - Conceptos</h1>
<div class="alert alert-danger" role="alert" id="warning_alert" style="display:none;"><h4 class="alert-heading">ADVERTENCIA!</h4><p> Los campos están vacios, debe ingresar texto en al menos un campo para poder filtrar</p></div>
<div class="text-center">
<button class="show-btn btn btn-primary" id="btn-filtros">Filtros</button>
<button class="hide-btn btn btn-danger" id="btn-ocultar-filtros" style="display: none;" onclick="cleanFiltrosPettyCash()">Ocultar filtros</button>
</div>
<section class="Filter text-center" style="display: none;">
    <div class="row">
    <div class="col-md-3">
        <label for="numberDetailFilter">Número de caja</label>
        <select class="form-control" name="numberDetailFilter" id="numberDetailFilter"></select>
    </div>
    <div class="col-md-3">
        <label for="locationFilterDetail">Localización</label>
        <select name="locationFilterDetail" id="locationFilterDetail" class="form-control"></select>
    </div>
    <div class="col-md-3 ">
        <label for="deductibleFilterDetail">Tipo de deducible</label>
        <select name="deductibleFilterDetail" id="deductibleFilterDetail" class="form-control">
        </select>
    </div>
    <div class="col-md-3">
        <label for="teamFilterDetail">Equipo</label>
        <select name="teamFilterDetail" id="teamFilterDetail" class="form-control"></select>
    </div>
    </div>
    <div class="text-center">
        <button class="btn btn-outline-info" id="btn_Filtrar_Petty_Cash_Detail">Filtrar</button>
    </div>
    <div class="text-center">
        <button class="btn btn-outline-dark" id="btn-reset-filtrar-PettyCash-Detail" onclick="cleanFiltrosPettyCash()" style=" display:none; margin-top: 5px;">Resetear filtros</button>
    </div>
    <br>
</section>
<div class="col-lg-12 table-responsive ancho_alto">
        <table  id="petty_Cash_Table-detail"  class="table table-bordered text-center" >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">caja</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Equipo</th>
                    <th scope="col">Concepto del Pago</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">IVA</th>
                    <th scope="col">Total</th>
                    <th scope="col">Deducible</th>
                    <th scope="col">Observaciónes</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="row justify-content-end" id = "total_table"style="display: none;">
        <div class="alert alert-primary" role="alert" style="overflow: auto; height: 100px; width: 250px !important;">Message here!</div>
  </div>
  <a href="#" class="float" id="btnAddSpend">
    <i class="material-icons fa fa-plus my-float">add</i>
</a>