$(document).ready(function(){
    settings= {
        "language": {
        "sProcessing":     "Procesando datos...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontarón considencias",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando _END_ registros de un total de _TOTAL_ registros", /* "Mostrando _END_ registros del _START_ al _END_ de un total de _TOTAL_ registros" */
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
                  "url":"Administration/getAllObras", 
                  "type":"POST",
                  "data": function (d) {
                    d.codigoObra = $('#codeObraFilter').val();
                    d.nombreObra = $('#nameObraFilter').val();
                    d.fechaObra = $('#dateFilterObra').val();
                    d.tipoObra  = $('#typeFilterObra').val();
                    d.estadoObra = $('#statusFilterObra').val();
                  }
          },
          "columns": [
                {data: "status"},
                {data: "contador"},
                {data: "ID"},
                {data: "cc"},
                {data: "name"},
                {data: "type"},
                {data: "dateSave"}
              ], 
              "lengthMenu": [[50,100,200], [50,100,200]],
              "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

                        {"render": function ( data, type, row ) {
                              return '<label class="codigo">'+row.contador+'</label>';
                              },
                              "targets": 1
      
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
                       return '<button class="btn btn-warning" value="'+row.ID+'" onclick="bringDataObra(this)"> editar</button><button onclick="Eliminar_Obra(this)" class="btn btn-danger" value="'+row.ID+'" name="'+row.name+'">Eliminar</button>'
                              },
                              "targets": 7
                      }
              ]
          };  
    var tabla =$('#obras_table').DataTable();
    tabla.destroy();
    table= $('#obras_table').DataTable(settings)
});

$('#btn-filtrar_obra').click(function(){
    if($("#codeObraFilter").val() ==  '' && $("#nameObraFilter").val() == '' && $("#dateFilterObra").val() ==  '' && $("#typeFilterObra").val()== 0&& $("#statusFilterObra").val()== 0){
          $("#warning_alert").show("slow");
        setTimeout(() => {
            $("#warning_alert").hide("fast")
        }, 4500);
    }else{
    var tabla =$('#obras_table').DataTable();
    tabla.destroy();
  table= $('#obras_table').DataTable(settings);
    }
  });