<?php defined('BASEPATH') OR exit('No direct script access allowed');
$cacheSaver =  new DateTime();
?>
<title>Administration</title>
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
                <th><button class="btn btn-warning" value="<?php echo $user->ID?>" onclick="bringDataUser(this)"> editar</button><br><button onclick="Eliminar_usurario(this)"class="btn btn-danger" value="<?php echo $user->ID?>" name="<?php echo $user->name?>">Eliminar</button></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
