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
<script type="text/javascript" src="assets/dataTables/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>


<script type="text/javascript" src="js/Administration/autocomplete.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/Administration/checkInput.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/Administration/Administrationjs_users.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/Administration/AdministrationObras.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/Administration/filtroUsuarios.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/Administration/filtroObra.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/PettyCash/pettyCash.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/PettyCash/filtroPettyCash.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/PettyCash/checkInputPettyCash.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/PettyCash/autocomplete.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/PettyCash/cataloges.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/PettyCash/filtroPettyCashDetail.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/PettyCash/resetsInputs.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
<script type="text/javascript" src="js/PettyCash/reportes.js?<?php echo $cacheSaver->getTimestamp()?>"></script>

<script type="text/javascript" src="js/Files/Files.js?<?php echo $cacheSaver->getTimestamp()?>"></script>
</body>

</html>