<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<title>Administration</title>
<h1 class="text-center">Lista de obras</h1>
<div class="alert alert-danger" role="alert" id="warning_alert" style="display:none;"><h4 class="alert-heading">ADVERTENCIA!</h4><p> Los campos están vacios, debe ingresar texto en al menos un campo para poder filtrar</p></div>
<div class="text-center">
<button class="show-btn btn btn-primary" id="btn-filtros">Filtros</button>
<button class="hide-btn btn btn-danger" id="btn-ocultar-filtros" onclick="cleanFiltros()">Ocultar filtros</button>
</div>
<section class="Filter text-center" style="display: none;">
    <div class="row">
    <div class="col-md-3">
        <label for="codeObraFilter">Código</label>
        <input type="text" id="codeObraFilter" class="form-control" placeholder="Código">
    </div>
    <div class="col-md-3">
        <label for="nameObraFilter">Nombre de obra</label>
        <input type="text" id="nameObraFilter" class="form-control" placeholder="Nombre de la obra">
    </div>
    <div class="col-md-3">
        <label for="dateFilterObra">Fecha de registro</label>
        <input type="date" id="dateFilterObra" class="form-control" placeholder="fecha de registro">
    </div>
    <div class="col-md-3">
        <label for="typeFilterObra">Tipo</label>
        <select id="typeFilterObra" class="form-control">
        </select>
    </div>
    <div class="col-md-3">
        <label for="statusFilterObra">Estado</label>
        <select id="statusFilterObra" class="form-control">
            <option value="0">seleccionar...</option>
            <option value="1">Activo</option>
            <option value="2">No Activo</option>
        </select>
    </div>
    </div>
    <div class="text-center">
        <button class="btn btn-outline-info" id="btn-filtrar_obra">Filtrar</button>
    </div>
    <br>
</section>
<div class="col-lg-12 table-responsive ancho_alto">
    <table class="table table-bordered text-center" id="obras_table">
        <thead class="thead-dark ">
            <tr>
                <th scope="col">E</th>
                <th scope="col">Id</th>
                <th scope="col">Id_DB</th>
                <th scope="col">Código</th>
                <th scope="col">Nombre de la obra</th>
                <th scope="col">Tipo</th>
                <th scope="col">Fecha de registro</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
