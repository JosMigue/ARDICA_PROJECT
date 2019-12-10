<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<title>Administration</title>
<h1 class="text-center">Lista de usuarios</h1>
<div class="alert alert-danger" role="alert" id="warning_alert" style="display:none;"><h4 class="alert-heading">ADVERTENCIA!</h4><p> Los campos están vacios, debe ingresar texto en al menos un campo para poder filtrar</p></div>
<div class="text-center">
<button class="show-btn btn btn-primary" id="btn-filtros">Filtros</button>
<button class="hide-btn btn btn-danger" id="btn-ocultar-filtros" style="display: none;" onclick="cleanFiltros()">Ocultar filtros</button>
</div>
<section class="Filter text-center" style="display: none;">
    <div class="row">
    <div class="col-md-3">
        <label for="nameFilter">Nombre</label>
        <input type="text" id="nameFilter" class="form-control" placeholder="Nombre">
    </div>
    <div class="col-md-3">
        <label for="nameUserFilter">Nombre de usuario</label>
        <input type="text" id="nameUserFilter" class="form-control" placeholder="Nombre de usuario">
    </div>
    <div class="col-md-3 ">
        <label for="dateFilter">Fecha de registro</label>
        <input type="date" id="dateFilter" class="form-control" placeholder="fecha de registro">
    </div>
    <div class="col-md-3">
        <label for="idFilter">Identificador</label>
        <input type="text" id="idFilter"  class="form-control" placeholder="idetificador">
    </div>
    <div class="col-md-3">
        <label for="userStatusFilter">Estado</label>
        <select class="form-control" id="userStatusFilter">
            <option value="0">seleccionar...</option>
            <option value="1">Activo</option>
            <option value="2">No activo</option>
        </select>
    </div>
    </div>
    <div class="text-center">
        <button class="btn btn-outline-info" id="btnfiltrar">Filtrar</button>
    </div>
    <div class="text-center">
        <button class="btn btn-warning" id="btn-reset-filtrar" onclick="cleanFiltros()" style=" display:none; margin-top: 5px;">Resetear filtros</button>
    </div>
    <br>
</section>
    <div class="col-lg-12 table-responsive ancho_alto">
        <table  id="users_table"  class="table table-bordered text-center" >
            <thead class="thead-dark ">
                <tr>
                    <th scope="col">E</th>
                    <th scope="col">ID</th>
                    <th scope="col">ID(DB)</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nombre de usuario</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Fecha de registro</th>
                    <th scope="col">último acceso</th>
                    <th scope="col">Rol que desempeña</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>




