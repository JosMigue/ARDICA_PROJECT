      <?php 
      $Hola =  new DateTime();
      ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Floating labels example · Bootstrap</title>
    <link rel="stylesheet" href="assets/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Administration/singin.css?<?php echo $Hola->getTimestamp()?>">
    <link rel="stylesheet" href="bulma-0.7.5/css/bulma.min.css">
</head>

<body>
    <div class="text-center shadow p-3 mb-5 bg-white rounded" id="form-signin" name="form-signin">
        <form class="form-signin">
            <img class="mb-4 rounded-circle" src="img/Ardica_Construcciones_SA_de__CV_Logo.jpg" alt="" width="150"
                height="100">
            <h1 class="h3 mb-3 font-weight-normal">Escriba sus credenciales</h1>
            <label for="inputEmail" class="sr-only">Dirección de correo</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Correo" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Contraseña</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required="">
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Recordarme
                </label>
            </div>
            <button class="btn btn-lg button is-info is-rounded btn-block" type="submit">Ingresar</button>

            <p class="mt-5 mb-3 text-muted">ARDICA Construcciones S.A de C.V © <?php date("y");?></p>
        </form>
    </div>
    <script type="text/javascript" src="assets/Bootstrap/js/bootstrap.min.js?<?php echo $Hola->getTimestamp()?>"></script>
    <script type="text/javascript" src="assets/Bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="assets/Bootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="js/Administration/example.js?<?php echo $Hola->getTimestamp()?>"></script>
</body>

</html>