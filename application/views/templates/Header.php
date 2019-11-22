<?php 
      /* Variable usada para evitar la constante limpia de caché (en el caso de chrome), este con el fin de hacer 
      'Creer' al servidor de que el archivo al que se hace referencia es uno deferente cada vez que se recarga la pagina,
      lo que evitará que en foturas modificaciones  (en el caso del uso del Chrome) no será necesario limpiar la cache 
      una vez que el sistema esté en producción */
      $cacheSaver =  new DateTime();
      if($this->session->userdata('logueado')==False){
        header('Location: /ARDICA');
        exit;
    }
    $rol  =  array(
        "1" => 'Administrador',
        "2" => 'Caja chica',
        "3" => 'Archivos',
        "4" => 'Capturador de gastos',
        "5" => 'Reportes'   
    );
      ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Administration/animate.css">
    <link rel="stylesheet" href="assets/EasyAutocomplete-1.3.5/easy-autocomplete.min.css"> 
    <link rel="stylesheet" href="assets/EasyAutocomplete-1.3.5/easy-autocomplete.themes.min.css"> 
    <link rel="stylesheet" href="assets/dataTables/jquery.dataTables.css"> 
    <link rel="stylesheet" href="css/Administration/administrationStyle.css?<?php echo $cacheSaver->getTimestamp()?>">
    <link rel="stylesheet" href="css/Files/files_css.css?<?php echo $cacheSaver->getTimestamp()?>">
    <link rel="stylesheet" href="css/PettyCash/stylePettyCash.css?<?php echo $cacheSaver->getTimestamp()?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css" />

    
</head>

<body>
    <div class="line">
        <img src="img/Ardica_Construcciones_SA_de__CV_Logo.png" width="100" height="30">
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
<!--         <a class="navbar-brand" href="<?php echo site_url('/') ?>">
            <img src="img/Ardica_Construcciones_SA_de__CV_Logo.png" width="100" height="30"
                class="d-inline-block align-top" alt="">
        </a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo site_url('/') ?>">Inicio<span class="sr-only">(current)</span></a>
                </li>
                    <?php echo $header?>
            </ul>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span class="caret"><?php echo $this->session->userdata('nameUser')?></span>
                    </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" id="destroySession">Cerrar Sesión</a>
                        </div>
                </li>
            </ul>
        </div>
    </nav>
    <p class="text-right" style="margin-right: 50px;" >Usted ha ingresado como: <?php echo $rol[$this->session->userdata('userType')]; ?></p>