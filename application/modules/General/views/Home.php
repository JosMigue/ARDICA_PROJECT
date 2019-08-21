<?php 
      /* Variable usada para evitar la constante limpia de caché (en el caso de chrome), este con el fin de hacer 
      'Creer' al servidor de que el archivo al que se hace referencia es uno deferente cada vez que se recarga la pagina,
      lo que evitará que en foturas modificaciones  (en el caso del uso del Chrome) no será necesario limpiar la cache 
      una vez que el sistema esté en producción */
      $cacheSaver =  new DateTime();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menú principal</title>
    <link rel="stylesheet" href="css/General/menuStyle.css?<?php echo $cacheSaver->getTimestamp()?>">
    <link rel="stylesheet" href="assets/Bootstrap/css/bootstrap.min.css?<?php echo $cacheSaver->getTimestamp()?>">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="<?php echo site_url('/') ?>">
            <img src="img/Ardica_Construcciones_SA_de__CV_Logo.png" width="100" height="30"
                class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Más
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Reportar un problema</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Contacto</a>
                    </div>
                </li>
            </ul>
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    <span class="caret"><?php echo $this->session->userdata('nameUser')?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo site_url('General/cerrar_sesion') ?>">Cerrar Sesión </a>
                </div>
            </li>
        </div>
    </nav>
    <div id="titulo">
        <p id="subheader">Menú principal</p>
    </div>
    <!--============Menu Options start ============-->
    <header>
        <div class="contenedor" id="uno">
            <img class="icon" src="img/Icons/Admin_Icon.png">
            <p class="texto">Adminsitración</p>
        </div>

        <div class="contenedor" id="dos">
            <img class="icon" src="img/Icons/Petty_Cash_Icon.png">
            <p class="texto">Caja chica</p>
        </div>

        <div class="contenedor" id="tres">
            <img class="icon" src="img/Icons/Files_Icon.png">
            <p class="texto">Archivos</p>
        </div>
    </header>
    <!--============Menu Options end ============-->

    <!-- Footer -->
    <footer class="page-footer font-small blue">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© <?php echo date("Y")?> Copyright:
            <a href="http://ardicaconstrucciones.com/" target="__blank"> ARDICA Construcciones S.A De C.V</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
    <!--===========Javascript block start===========-->
    <script type="text/javascript" src="assets/Bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="assets/Bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/Bootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="js/General/home.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
    <!--===========Javascript block end===========-->
</body>

</html>