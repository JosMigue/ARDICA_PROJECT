    <style>
    .fila {
        color: black;
        background-color:  #e6e6e6;
    }
    
    table{
    border-collapse: collapse;
     width: 100%;
    }
    </style>
    
        <table  id="petty_Cash_Table"  border="1" >
            <thead class="thead-dark">
                <tr>
                    <th class="fila" scope="col">ID</th>
                    <th class="fila" scope="col">Número</th>
                    <th class="fila" scope="col">Fecha de incio</th>
                    <th class="fila" scope="col">Fecha de terminación</th>
                    <th class="fila" scope="col">Encargado</th>
                    <th class="fila" scope="col">Fecha de registro</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $datos){?>
            <tr>
                <th class="columna"><?php echo $datos->ID?></th>
                <td class="columna" ><?php echo $datos->numero?></td>
                <td class="columna" ><?php echo $datos->fecha_inicio?></td>
                <td class="columna" ><?php echo $datos->fecha_terminacion?></td>
                <td class="columna" ><?php echo $datos->encargado?></td>
                <td class="columna" ><?php echo $datos->fecha_registro?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>

    <div class="text-center">
        <h3>Detalle</h3>
    </div>
        <table  id="petty_Cash_Table-detail" border="1"  class="table table-bordered text-center" >
            <thead class="thead-dark">
                <tr>
                    <th class="fila" scope="col">ID</th>
                    <th class="fila" scope="col">caja</th>
                    <th class="fila" scope="col">Ubicación</th>
                    <th class="fila" scope="col">Equipo</th>
                    <th class="fila" scope="col">Concepto del Pago</th>
                    <th class="fila" scope="col">Subtotal</th>
                    <th class="fila" scope="col">IVA</th>
                    <th class="fila" scope="col">Total</th>
                    <th class="fila" scope="col">Deducible</th>
                    <th class="fila" scope="col">Observaciónes</th>
                    <th class="fila" scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($detail as $detalle){?>
            <tr>
                <th class="columna"><?php echo $detalle->ID?></th>
                <td class="columna" ><?php echo $detalle->numero?></td>
                <td class="columna" ><?php echo $detalle->ubicacion?></td>
                <td class="columna" ><?php echo $detalle->equipo?></td>
                <td class="columna" ><?php echo $detalle->concepto?></td>
                <td class="columna" ><?php echo $detalle->subtotal?></td>
                <td class="columna" ><?php echo $detalle->IVA?></td>
                <td class="columna" ><?php echo $detalle->total?></td>
                <td class="columna" ><?php echo $detalle->deducible?></td>
                <td class="columna" ><?php echo $detalle->observacion?></td>
                <td class="columna" ><?php echo $detalle->registro?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>


