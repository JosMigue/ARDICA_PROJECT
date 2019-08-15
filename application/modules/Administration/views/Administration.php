<!-- <div class="container">
    <div class="row">
        <div class="col-lg-12">
          </div>
        </div>
      </div> -->
      
<table class="table shadow-lg p-3 mb-5 bg-white rounded">
    <thead class="thead-dark text-center">
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
    
    <?php foreach($data as $user){?>
        <tr>
            <th scope="row">1</th>
            <td><?php echo $user->ID?></td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<a class="btn btn-outline-primary" href="#modalRegistro" data-toggle="modal" data-target="#modalRegistro">Registrar usuario</a>