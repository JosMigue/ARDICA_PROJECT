<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<title>Administration</title>
<input type="hidden" id="forMessage">
<div class="text-center">
<button class="show-btn btn btn-primary" id="btn-filtros">Filtros</button>
<button class="hide-btn btn btn-danger" id="btn-ocultar-filtros" onclick="cleanFiltros()">Ocultar filtros</button>
</div>
<section class="Filter text-center">
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
        <button class="btn btn-outline-info" id="btn-filtrar">Filtrar</button>
    </div>
    <br>
</section>
<div class="table-responsive-sm">
    <table class="table table-bordered" id="users_table">
        <thead class="thead-dark text-center">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Código</th>
                <th scope="col">Nombre de la obra</th>
                <th scope="col">Tipo</th>
                <th scope="col">Fecha de registro</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php $contador = 0;?>
        <?php foreach($data as $obra){?>
            <tr class="text-center">
                <th scope="row"><?php echo $contador+=1?></th>
                <td><?php echo $obra->cc?></td>
                <td><?php echo $obra->name?></td>
                <td><?php echo $obra->nameType?></td>
                <td><?php echo $obra->dateSave?></td>
                <td><?php 
                if($obra->status == 1){
                    echo "<img src='img/botonesactivo.png' width='30' height='30'>";
                }else{
                    echo "<img src='img/botonesdesactivo.png' width='30' height='30'>";
                }
                ?>
                </td>
                <th><button class="btn btn-warning" value="<?php echo $obra->ID?>" onclick="bringDataObra(this)"> editar</button><button onclick="Eliminar_Obra(this)" class="btn btn-danger" value="<?php echo $obra->ID?>" name="<?php echo $obra->name?>">Eliminar</button></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
