$(document).ready(function(){
    settings= {
        "language": {
                     "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
                  },
                  "searching": false,
                  "ordering": false,
        "processing":true,
          "serverSide":true, 
          "ajax":{
                  "url":"Administration/getAllUsers", 
                  "type":"POST",
                  "data": function (d) {
                    d.nombre = $('#nameFilter').val();
                    d.nombreUsuario = $('#nameUserFilter').val();
                    d.fecha = $('#dateFilter').val();
                    d.idUsuario = $('#idFilter').val();
                  }
          },
          "columns": [
                {data: "status"},
                {data: "Id"},
                {data: "Id_db"},
                {data: "name"},
                {data: "nickname"},
                {data: "phone"},
                {data: "email"},
                {data: "fechaRegistro"},
                {data: "lastLogin"},
                {data: "Id_db"}
              ], 
              "lengthMenu": [[50,100,200], [50,100,200]],
              "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

                        {"render": function ( data, type, row ) {
                              return '<label class="codigo">'+row.Id+'</label>';
                              },
                              "targets": 1
      
                      },
                      {"render": function ( data, type, row ) {
                        if (row.phone==null || row.phone=='') {
                          return 'sin número';
                        }else{
                            return row.phone;
                        }
                              },
                              "targets": 5
                      },
                      {"render": function ( data, type, row ) {
                        if (row.email==null || row.email=='') {
                          return 'Sin correo';
                        }else{
                            return row.email;
                        }
                              },
                              "targets": 6
                      },

                      {"render": function ( data, type, row ) {
                        if (row.status==1) {
                          return '<img src="img/botonesactivo.png" width="20px" heigth="20px">';
                        }else{
                          return '<img src="img/botonesdesactivo.png" width="20px" heigth="20px">';
                        }
                              },
                              "targets": 0
                      },
                      {"render": function ( data, type, row ) {
                       return '<button class="btn btn-warning" value="'+row.Id_db+'" onclick="bringDataUser(this)"> editar</button>   <button onclick="Eliminar_usurario(this)"class="btn btn-danger" value="'+row.Id_db+'" name="'+row.name+'">Eliminar</button>'
                              },
                              "targets": 9
                      }
              ]
          };  
    var tabla =$('#users_table').DataTable();
    tabla.destroy();
    table= $('#users_table').DataTable(settings)
});

$('#btn-filtrar').click(function(){
    if($("#nameFilter").val() ==  '' && $("#nameUserFilter").val() == '' && $("#dateFilter").val() ==  '' && $("#idFilter").val()== ''){
        document.getElementById("forMessage").outerHTML = '<div class="alert alert-danger" role="alert" id="warning_alert"><h4 class="alert-heading">ADVERTENCIA!</h4><p> Los campos están vacios, debe ingresar texto en al menos un campo para poder filtrar</p></div>'
        setTimeout(() => {
            $("#warning_alert").hide("fast")
            setTimeout(() => {
                document.getElementById("warning_alert").outerHTML = '<input type="hidden" id="forMessage">'
            }, 1000);
        }, 4500);
    }else{
    var tabla =$('#users_table').DataTable();
    tabla.destroy();
  table= $('#users_table').DataTable(settings);
    }
  });

