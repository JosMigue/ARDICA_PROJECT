<?php defined('BASEPATH') OR exit('No direct script access allowed');
$cacheSaver =  new DateTime();
?>
<title>Administration</title>
<h1 class="text-center">Lista de usuarios</h1>
<div class="alert alert-danger" role="alert" id="warning_alert" style="display:none;"><h4 class="alert-heading">ADVERTENCIA!</h4><p> Los campos están vacios, debe ingresar texto en al menos un campo para poder filtrar</p></div>
<div class="text-center">
<button class="show-btn btn btn-primary" id="btn-filtros">Filtros</button>
<button class="hide-btn btn btn-danger" id="btn-ocultar-filtros" onclick="cleanFiltros()">Ocultar filtros</button>
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
    </div>
    <div class="text-center">
        <button class="btn btn-outline-info" id="btn-filtrar">Filtrar</button>
    </div>
    <br>
</section>
<div class="row">
    <div class="col-lg-12 table-responsive ancho_alto">
        <table  id="users_table" width="100%"  class="table table-hover color-tablas" >
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">E</th>
                    <th scope="col">ID</th>
                    <th scope="col">Identificador (BD)</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nombre de usuario</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Fecha de registro</th>
                    <th scope="col">último acceso</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>



