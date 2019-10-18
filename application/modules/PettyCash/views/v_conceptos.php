<title>Catálogo: Conceptos</title>
<h1 class="text-center">Catálogo de conceptos</h1>

<div class="col-lg-12 table-responsive tablas_catalogos">
        <table id="catalogeConceptTable" class="table table-bordered text-left" >
            <thead class="thead-dark">
                <tr>
                    <th style="height: 10px; width: 100px; padding: 1px" scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th style="height: 10px; width: 100px; padding: 1px" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($data as $datos){?>
            <tr>
                <th scope="row"><?php echo $datos->ID?></th>
                <td><?php echo $datos->nombre?></td>
                <td><button class="btn btn-danger" onclick="deleteConcept(this)" value="<?php echo $datos->ID ?>"name="<?php echo $datos->nombre?>"><i class="material-icons">delete_sweep</i></button></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
    <a href="#" class="float" id="btnAddConcept">
    <i class="material-icons fa fa-plus my-float">add</i>
</a>