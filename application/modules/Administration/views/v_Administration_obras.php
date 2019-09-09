<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
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
                <th><button class="btn btn-warning" value="<?php echo $obra->ID?>" onclick="bringDataObra(this)"> editar</button><br><button onclick="Eliminar_Obra(this)" name="<?php echo $obra->name?>" class="btn btn-danger" value="<?php echo $obra->ID?>" >Eliminar</button></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
