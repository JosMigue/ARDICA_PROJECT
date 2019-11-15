<style>
    .fila {
  color: black;
  background-color:  #e6e6e6;
}

.columna{
    border: 1px solid black;
    border-collapse: collapse;
    text-align: center;
}
 .tabla{
    border: 1px solid black;
    border-collapse: collapse;
     width: 100%;
 }
</style>
        <table class="tabla" >
            <thead>
                <tr>
                    <th class="fila" scope="col">Id</th>
                    <th class="fila" scope="col">Código</th>
                    <th class="fila" scope="col">Nombre de la obra</th>
                    <th class="fila" scope="col">Tipo</th>
                    <th class="fila" scope="col">Fecha de registro</th>
                    <th class="fila" scope="col">estado</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $datos){?>
            <tr>
                <th class="columna" scope="row"><?php echo $datos->ID?></th>
                <td class="columna"><?php echo $datos->cc?></td>
                <td class="columna"><?php echo $datos->name?></td>
                <td class="columna"><?php echo $datos->nameType?></td>
                <td class="columna"><?php echo $datos->dateSave?></td>
                <td class="columna"><?php echo $datos->status?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>