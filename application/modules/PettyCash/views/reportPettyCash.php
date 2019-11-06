    <div class="col-lg-12 table-responsive ancho_alto">
        <table  id="petty_Cash_Table"  class="table table-bordered text-center" >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Número</th>
                    <th scope="col">Fecha de incio</th>
                    <th scope="col">Fecha de terminación</th>
                    <th scope="col">Encargado</th>
                    <th scope="col">Fecha de registro</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $datos){?>
            <tr>
                <th scope="row"><?php echo $datos->ID?></th>
                <td><?php echo $datos->numero?></td>
                <td><?php echo $datos->fecha_inicio?></td>
                <td><?php echo $datos->fecha_terminacion?></td>
                <td><?php echo $datos->encargado?></td>
                <td><?php echo $datos->fecha_registro?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
detalle

    <div class="col-lg-12 table-responsive ancho_alto">
        <table  id="petty_Cash_Table-detail"  class="table table-bordered text-center" >
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">caja</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Equipo</th>
                    <th scope="col">Concepto del Pago</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">IVA</th>
                    <th scope="col">Total</th>
                    <th scope="col">Deducible</th>
                    <th scope="col">Observaciónes</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($detail as $detalle){?>
            <tr>
                <th scope="row"><?php echo $detalle->ID?></th>
                <td><?php echo $detalle->numero?></td>
                <td><?php echo $detalle->ubicacion?></td>
                <td><?php echo $detalle->equipo?></td>
                <td><?php echo $detalle->concepto?></td>
                <td><?php echo $detalle->subtotal?></td>
                <td><?php echo $detalle->IVA?></td>
                <td><?php echo $detalle->total?></td>
                <td><?php echo $detalle->deducible?></td>
                <td><?php echo $detalle->observacion?></td>
                <td><?php echo $detalle->registro?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>