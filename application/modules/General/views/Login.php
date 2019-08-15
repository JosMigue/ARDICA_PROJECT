      <?php 
      /* Variable usada para evitar la constante limpia de caché (en el caso de chrome), este con el fin de hacer 
      'Creer' al servidor de que el archivo al que se hace referencia es uno deferente cada vez que se recarga la pagina,
      lo que evitará que en foturas modificaciones  (en el caso del uso del Chrome) no será necesario limpiar la cache 
      una vez que el sistema esté en producción */
      $cacheSaver =  new DateTime();
      $opciones = [
        'cost' => 12,
    ];
      ?>
      <!DOCTYPE html>
      <html lang="es">

      <head>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="description" content="">
          <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
          <meta name="generator" content="Jekyll v3.8.5">
          <title>Login</title>
          <link rel="stylesheet" href="assets/Bootstrap/css/bootstrap.min.css">
          <link rel="stylesheet" href="css/Administration/singin.css?<?php echo $cacheSaver->getTimestamp()?>">
          <link rel="stylesheet" href="assets/bulma-0.7.5/css/bulma.min.css">
      </head>

      <body>
          <div class="text-center shadow p-3 mb-5 bg-white rounded" id="form-signin" name="form-signin">
              <form class="form-signin">
                  <img class="mb-4" src="img/Ardica_Construcciones_SA_de__CV_Logo.png" alt="" width="150"
                      height="100">
                  <h1 class="h3 mb-3 font-weight-normal">Escriba sus credenciales</h1>
                  <label for="inputEmail" class="sr-only">Nombre de usuario</label>
                  <input type="text" id="inputEmail" class="form-control" placeholder="Usuario" required=""
                      autofocus="">
                  <label for="inputPassword" class="sr-only">Contraseña</label>
                  <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required="">
                  <div class="checkbox mb-3">
                      <label>
                          <input type="checkbox" value="remember-me"> Recordarme
                      </label>
                  </div>
                  <button class="btn btn-lg button is-info is-rounded btn-block" type="submit" id="submit-button">Ingresar</button>

                  <p class="mt-5 mb-3 text-muted">ARDICA Construcciones S.A de C.V © <?php echo date("Y");?></p>
              </form>
          </div>
          <!--Block of javascripts files start -->
          <script type="text/javascript"
              src="assets/Bootstrap/js/jquery-3.3.1.slim.min.js"></script>
          <script type="text/javascript"
              src="assets/Bootstrap/js/bootstrap.min.js"></script>
          <script type="text/javascript"
              src="assets/Bootstrap/js/popper.min.js"></script>
          <script type="text/javascript" src="js/Administration/example.js?<?php echo $cacheSaver->getTimestamp()?>">
          </script>
      </body>

      </html>