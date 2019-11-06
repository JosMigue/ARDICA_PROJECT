<div class="col-lg-12 table-responsive ancho_alto">
        <table  id="users_table"  class="table table-bordered text-center" >
            <thead class="thead-dark ">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Nombre de usuario</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Fecha de registro</th>
                    <th scope="col">último acceso</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $datos){?>
            <tr>
                <th scope="row"><?php echo $datos->ID?></th>
                <td><?php echo $datos->name?></td>
                <td><?php echo $datos->nickname?></td>
                <td><?php echo $datos->phone?></td>
                <td><?php echo $datos->email?></td>
                <td><?php echo $datos->dateSave?></td>
                <td><?php echo $datos->timeStamp?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>