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
    "processing":true,
      "serverSide":true, 
      "ajax":{
              "url":"Administracion/getAllUsuarios", 
              "type":"POST",
              "data": function (d) {
                    d.idempresa = $('#idempresa').val();
                  d.nombre = $('#nombre').val();
                  d.siglas = $('#siglas').val();
                  d.rfc = $('#rfc').val();
              }
      },
      "columns": [
            {data: "estatus_row"},
            {data: "id"},
            {
               "className":      'details-control',
               "orderable":      false,
               "data":           null,
               "defaultContent": ''
            },
            {data: "nombre"},
            {data: "siglas"},
            {data: "tipo"},
            {data: "rfc"}
          ], 
          "lengthMenu": [[50,100,200], [50,100,200]],
          "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 
                          {"render": function ( data, type, row ) {
                          return '<label class="codigo">'+row.id+'</label>';
                          },
                          "targets": 1
  
                  },
                  {"render": function ( data, type, row ) {
                    if (row.estatus_row==1) {
                      return '<img src="img/aceptada.png" width="20px" heigth="20px">';
                    }else{
                      return '<img src="img/rechazado.png" width="20px" heigth="20px">';
                    }
                          },
                          "targets": 0
                  }
          ]
      };  

$('#filtrar').click(function(){
    var tabla =$('#consultaRelaciones').DataTable();
    tabla.destroy();
  table= $('#consultaRelaciones').DataTable(settings);
  });
