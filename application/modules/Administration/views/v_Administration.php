<?php defined('BASEPATH') OR exit('No direct script access allowed');
$cacheSaver =  new DateTime();
?>
<title>Administration</title>
<button class="show-btn btn btn-primary text-right" id="btn-filtros">Filtros</button>
<button class="hide-btn btn btn-danger" id="btn-ocultar-filtros">Ocultar filtros</button>
<div class="Filter text-center">
    <p>Filtros</p>
    <div class="container-filter" id="filter">
    <form>
        <label for="nameFilter"></label>
        <input type="text" id="nameFilter" class="form-control" placeholder="Nombre">
    </form>
        <label for="nameUserFilter"></label>
        <input type="text" id="nameUserFilter" class="form-control" placeholder="Nombre de usuario">
    </div>
    <button class="btn btn-outline-info">Filtrar</button>
    <br>
</div>
<div class="table-responsive-sm">
    <table class="table table-bordered" id="users_table">
        <thead class="thead-dark text-center">
            <tr>
                <th scope="col">ID</th>
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
        <?php $contador = 0?>
        <?php foreach($data as $user){?>
            <tr class="text-center">
                <th scope="row"><?php echo $contador+=1?></th>
                <td><?php echo $user->name?></td>
                <td><?php echo $user->nickname?></td>
                <td><?php if($user->phone != null){echo $user->phone;}else{echo 'No cuenta con número';} ?></td>
                <td><?php if($user->email != null){echo $user->email;}else{echo 'No cuenta con correo';} ?></td>
                <td><?php echo $user->dateSave?></td>
                <td><?php echo $user->timeStamp?></td>
                <th><button class="btn btn-warning" value="<?php echo $user->ID?>" onclick="bringDataUser(this)"> editar</button>   <button onclick="Eliminar_usurario(this)"class="btn btn-danger" value="<?php echo $user->ID?>" name="<?php echo $user->name?>">Eliminar</button></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
