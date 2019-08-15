<?php 
      /* Variable usada para evitar la constante limpia de caché (en el caso de chrome), este con el fin de hacer 
      'Creer' al servidor de que el archivo al que se hace referencia es uno deferente cada vez que se recarga la pagina,
      lo que evitará que en foturas modificaciones  (en el caso del uso del Chrome) no será necesario limpiar la cache 
      una vez que el sistema esté en producción */
      $cacheSaver =  new DateTime();
      ?>
<script type="text/javascript" src="assets/Bootstrap/js/jquery-3.3.1.slim.min.js"></script>
<script type="text/javascript" src="assets/Bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/Administration/checkInput.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
</body>

</html>