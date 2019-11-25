<title>Administrador de archivos</title>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<!-- Include our stylesheet -->
	<link href="css/Files/styles.css" rel="stylesheet"/>

<style>
.ulmenu{
      list-style: none;
      list-style-type: none;
      list-style-position: outside;
}
 
.limenu{
      line-height: 30px;
      font-size: 16px;
      cursor:pointer;
}
.limenu2{
      line-height: 30px;
      font-size: 16px;
      cursor:pointer;
}
 .ulmenu2{
      list-style: none;
      list-style-type: none;
      list-style-position: outside;
}
#menu{
      width:250px;
      position:absolute;      
      border:1px solid black;
      border-radius: 5px;
      background-color: white;
      -moz-box-shadow: 0 0 5px #888;
      -webkit-box-shadow: 0 0 5px#888;
      box-shadow: 0 0 5px #888;
}
</style>
<body>

	<div id="menu" style="display: none">
    <table>
      <tr>
        <td style="padding-left: 7px; padding-right: 7px;">
         <ul class="ulmenu2">
          <li class="limenu2"><i class="fas fa-copy"></i></li> 
          <li class="limenu2"><i class="fas fa-expand-arrows-alt"></i></li>
          <li class="limenu2"><i class="fas fa-edit" ></i></li>
          <li class="limenu2"><i class="fas fa-trash-alt" ></i></li>
        </ul>
      </td>
      <td>
         <ul class="ulmenu">
            <li class="limenu" data-clipboard-text="" id="copiar" >Copiar</li> 
            <li class="limenu" id="mover">Mover</li>
            <li class="limenu" id="renombrar">Renombrar</li>
            <li class="limenu" id="eliminar">Eliminar</li>
        </ul>
      </td>
      </tr>
    </table>
</div>
	<div class="container">
		<br>
		<div class="row">
			<div class="col-lg-12">
				<button id="createFolder" class="btn btn-primary">Nueva carpeta</button>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="filemanager">
					<div class="search">
						<input type="search" placeholder="Buscar archivo..." />
					</div>
					<div class="breadcrumbs"></div>
					<ul class="data"></ul>
					<div class="nothingfound">
						<div class="nofiles"></div>
						<span>Sin archivos</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo directorio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<p style="font-size: 11px; color: blue" id="pathNewFolder"></p>
      	<label>Nombre</label>
       <input id="nameFolder" name="nameFolder" type="text" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="saveFolder" name="saveFolder" class="btn btn-primary">Crear carpeta</button>
      </div>
    </div>
  </div>
</div>
<!-- Target -->
<input type="hidden" id="pathSelected">

	<!-- Include our script files -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

	<script src="js/Files/script.js"></script>
  <script src="js/Files/clipboard.min.js"></script>
<script>
	$(document).ready(function(){
    var filemanager2 = $('.filemanager'),fileList2 = filemanager2.find('.data');
    fileList2.on('mousedown', 'li.folders', function(e){
      e.preventDefault();
      switch (event.which) {
            case 3:
                $('li.folders').bind("contextmenu", function(e2){
                   var ruta=$(this).find('a').attr('href');
                    $('#pathSelected').val(ruta);
                    $("#menu").css({'display':'block', 'left':e2.pageX, 'top':e2.pageY});
                    return false;
          });
              break;
       
        }

    });
    fileList2.on('mousedown', 'li.files', function(e){
      e.preventDefault();
      switch (event.which) {
            case 3:
                $('li.files').bind("contextmenu", function(e2){
                  var ruta=$(this).find('a').attr('href');
                    $('#pathSelected').val(ruta);
                    $("#menu").css({'display':'block', 'left':e2.pageX, 'top':e2.pageY});
                    return false;
          });
              break;
       
        }

    });
    $('#copiar').click(function(){
      var ruta=$('#pathSelected').val();
      if (ruta!=null && ruta!='') {
         $(this).attr('data-clipboard-text',ruta);
      }else{
        alert("Error al obtener la ruta");
      }
      
    });


    new ClipboardJS('.limenu');
		$(document).click(function(e){
                  if(e.button == 0){
                        $("#menu").css("display", "none");
                  }
            });
             
            //si pulsamos escape, el menú desaparecerá
            $(document).keydown(function(e){
                  if(e.keyCode == 27){
                        $("#menu").css("display", "none");
                  }
            });
            

	});
	 
</script>

