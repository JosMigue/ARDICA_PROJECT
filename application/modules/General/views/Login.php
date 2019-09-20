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
          <title>ARDICA Construcciones</title>
          <!--==========================CSS BLOCK STRAT==========================-->
          <link rel="stylesheet" href="assets/Bootstrap/css/bootstrap.min.css">
          <link rel="stylesheet" href="css/Administration/singin.css?<?php echo $cacheSaver->getTimestamp()?>">
          <link rel="stylesheet" href="assets/bulma-0.7.5/css/bulma.min.css">
          <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css" />
          <!-- Default theme -->
          <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/themes/default.min.css" />
          <!-- Semantic UI theme -->
          <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/themes/semantic.min.css" />
          <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
          <!--==========================CSS BLOCK END==========================-->
      </head>

      <body>
          <div class="text-center shadow p-3 mb-5 bg-white rounded" id="form-signin" name="form-signin">
              <form class="form-signin" id="form_Login" name="form_Login" method="POST" role="form">
                  <img class="mb-4" src="img/Ardica_Construcciones_SA_de__CV_Logo.png" alt="" width="150" height="100">
                  <h1 class="h3 mb-3 font-weight-normal">Escriba sus credenciales</h1>
                  <label for="nickName" class="sr-only">Nombre de usuario</label>
                  <input type="text" id="nickName" name="nickName" class="form-control text-center"
                      placeholder="Usuario" required="" autofocus="">
                  <label for="inputPassword" class="sr-only">Contraseña</label>
                  <input type="password" id="inputPassword" name="inputPassword" class="form-control text-center"
                      placeholder="Contraseña" required="">
                  <div class="row">

                      <div class="col-lg-6">
                          <center>
                              <label style="font-size: 20px; margin-top: 20px;">Captcha</label>
                          </center>
                      </div>
                      <div class="col-lg-6">
                          <?php echo $captcha['image'] ?>
                      </div>
                  </div>
                      <div class="text-center">
                        <p id="contadorCaptcha">Tiempo disponible de captcha: 120 segundos</p>
                      </div>
                  <div style="margin-top: 10px;" class="row">
                      <div class="col-lg-12">
                          <input type="text" name="captcha" id="captcha" class="form-control center-text"
                              autocomplete="off" placeholder="Captcha" required autofocus>
                      </div>
                  </div>
                  <button class="btn btn-lg button is-info is-rounded btn-block" type="submit"
                      id="submit-button">Ingresar</button>
                  <p class="mt-5 mb-3 text-muted">ARDICA Construcciones S.A de C.V © <?php echo date("Y");?></p>
              </form>
          </div>
          <!--==========================JAVASCRIPT BLOCK STRAT==========================-->
          <script type="text/javascript" src="assets/Bootstrap/js/jquery-3.3.1.slim.min.js"></script>
          <script type="text/javascript" src="assets/Bootstrap/js/bootstrap.min.js"></script>
          <script type="text/javascript" src="assets/Bootstrap/js/popper.min.js"></script>
          <script type="text/javascript" src="assets/jQuery/jquery-3.2.1.min.js"></script>
          <script type="text/javascript" src="js/jquery.validate.js"></script>
          <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>
          <script type="text/javascript" src="js/General/Login.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
          <!--==========================JAVASCRIPT BLOCK END==========================-->
      </body>

      </html>