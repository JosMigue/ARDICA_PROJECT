<?php 
      /* Variable usada para evitar la constante limpia de caché (en el caso de chrome), este con el fin de hacer 
      'Creer' al servidor de que el archivo al que se hace referencia es uno deferente cada vez que se recarga la pagina,
      lo que evitará que en foturas modificaciones  (en el caso del uso del Chrome) no será necesario limpiar la cache 
      una vez que el sistema esté en producción */
      $cacheSaver =  new DateTime();
      ?>
<script type="text/javascript" src="assets/Bootstrap/js/jquery-3.3.1.slim.min.js"></script>
<script type="text/javascript" src="assets/jQuery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/Bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/Bootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="assets/jQuery/jquery-ui.js"></script>
<script src="assets/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js"></script> 
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="js/Administration/checkInput.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/Administration/Administrationjs_users.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/Administration/AdministrationObras.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/Files/Files.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
</body>

</html>