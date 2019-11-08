<style>
    .fila {
  color: black;
  background-color:  #e6e6e6;
}
.tabla ,.fila, .columna {
    border-collapse: collapse;
  border: .1mm solid black;
}
</style>
<div class="">
        <table class="tabla" >
            <thead>
                <tr>
                    <th class="fila" scope="col">ID</th>
                    <th class="fila" scope="col">Nombre</th>
                    <th class="fila" scope="col">Nombre de usuario</th>
                    <th class="fila" scope="col">Teléfono</th>
                    <th class="fila" scope="col">Correo</th>
                    <th class="fila" scope="col">Fecha de registro</th>
                    <th class="fila" scope="col">último acceso</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $datos){?>
            <tr>
                <th class="columna" scope="row"><?php echo $datos->ID?></th>
                <td class="columna"><?php echo $datos->name?></td>
                <td class="columna"><?php echo $datos->nickname?></td>
                <td class="columna"><?php echo $datos->phone?></td>
                <td class="columna"><?php echo $datos->email?></td>
                <td class="columna"><?php echo $datos->dateSave?></td>
                <td class="columna"><?php echo $datos->timeStamp?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>