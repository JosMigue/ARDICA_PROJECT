<title>Archivos</title>
<div class="table-responsive-sm">
    <table class="table table-bordered" id="users_table">
        <thead class="thead-dark text-center">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre del archivo</th>
                <th scope="col">Previsualizar</th>
                <th scope="col">Descargar</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php $contador = 0?>
        <?php foreach ($data as $archivos){?>
            <tr class="text-center">
                <th scope="row"><?php echo $contador+=1?></th>
                <td><?php echo $archivos->name?></td>
                <td><button id="btn_preview_Modal" value="<?php echo $archivos->name?>" onclick="fileView(this)" class="btn btn-success">Vista previa</button></td>
                <td><a href="">Descargar</a></td>
                <th><button class="btn btn-warning" value="" onclick=""> editar</button>   <button onclick=""class="btn btn-danger" value="" name="">Eliminar</button></th>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
