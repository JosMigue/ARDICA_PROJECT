<title>Log activity</title>
<h1 class="text-center">Actividad en el sistema</h1>
<div class="col-lg-12 table-responsive ancho_alto">
<table class="table table-bordered text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Tabla</th>
      <th scope="col">Acción</th>
      <th scope="col">Fecha</th>
      <th scope="col">IP</th>
      <th scope="col">Usuario</th>
      <th scope="col">Registro</th>
      <th scope="col">Campo</th>
      <th scope="col">Descripción</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($data as $datos){?>
    <tr>
      <th scope="row"><?php echo $datos->id?></th>
      <td><?php echo $datos->tabla?></td>
      <td><?php echo $datos->accion?></td>
      <td><?php echo $datos->fecha?></td>
      <td><?php echo $datos->ip?></td>
      <td><?php echo $datos->usuario?></td>
      <td><?php echo $datos->registro?></td>
      <td><?php echo $datos->campo?></td>
      <td><?php echo $datos->descripcion?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
</div>