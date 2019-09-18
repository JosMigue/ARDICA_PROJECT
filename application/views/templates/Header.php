<?php 
      /* Variable usada para evitar la constante limpia de caché (en el caso de chrome), este con el fin de hacer 
      'Creer' al servidor de que el archivo al que se hace referencia es uno deferente cada vez que se recarga la pagina,
      lo que evitará que en foturas modificaciones  (en el caso del uso del Chrome) no será necesario limpiar la cache 
      una vez que el sistema esté en producción */
      $cacheSaver =  new DateTime();
      if($this->session->userData('logueado')==False){
        header('Location: /ARDICA');
        exit;
    }
      ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Administration/animate.css">
    <link rel="stylesheet" href="css/Administration/administrationStyle.css?<?php echo $cacheSaver->getTimestamp()?>">
    <link rel="stylesheet" href="css/Files/files_css.css?<?php echo $cacheSaver->getTimestamp()?>">
    
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
                    <a class="nav-link" href="<?php echo site_url('/') ?>">Inicio<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Administración
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo site_url('/administration')?>">Lista de usuarios</a>
                        <button class="dropdown-item" id="button_add_user"  data-toggle="modal" onclick="resetModal()" data-target="#modalRegistro" >Registrar usuario</button>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo site_url('/administration.obras')?>">Lista de obras</a>
                        <button class="dropdown-item" id="button_add_user" onclick=""  data-toggle="modal" onclick="resetModalObras()" data-target="#modalRegistroObra" >Registrar obra</button>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Caja chica
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Lista de facturas</a>
                        <a class="dropdown-item" href="#"></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Archivos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo site_url('/files')?>">Lista de archivos Archivos</a>
                        <button class="dropdown-item" data-toggle="modal" data-target="#modalSubirArchivo">Subir archivos</button>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span class="caret"><?php echo $this->session->userdata('nameUser')?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo site_url('General/cerrar_sesion') ?>">Cerrar Sesión
                        </a>
                    </div>
                </li>
            </ul>

        </div>
    </nav>