$(document).ready(function(){
  var table;
  var lastRow = true;
  var lastColumn = true;
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
                  "url":"PettyCash/getAllPettyCash", 
                  "type":"POST",
                  "data": function (d) {
                    d.numeroCajaChica = $('#numberFilter').val();
                    d.responsableCajaChica  = $('#selected_responsable').val();
                    d.estadoCajaChica = $('#statusPettyCashFilter').val();
                    d.autorizadaCajaChica = $('#autorizationPettyCashFilter').val();
                    d.fechaIni = $("#dateOne").val();
                    d.fechaFin = $("#dateTwo").val();
                  }
          },
          "columns": [
            {

              "className":      'details-control',
 
              "orderable":      false,
 
              "data":           null,
 
              "defaultContent": ''
 
           },
                {data: "status"},
                {data: "Id"},
                {data: "Id_db"},
                {data: "numero"},
                {data: "fechaInic"},
                {data: "fechaTerm"},
                {data: "encargado"},
                {data: "fechaRegistro"},
              ], 
              "lengthMenu": [[50,100,200], [50,100,200]],
              "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

                        {"render": function ( data, type, row ) {
                              return '<label class="codigo">'+row.Id+'</label>';
                              },
                              "targets": 2
      
                      },
                      {"render": function ( data, type, row ) {
                        if (row.status==1) {
                          return '<img src="img/botonesactivo.png" width="20px" heigth="20px">';
                        }else{
                          return '<img src="img/botonesdesactivo.png" width="20px" heigth="20px">';
                        }
                              },
                              "targets": 1
                      },
                      {"render": function ( data, type, row ) {
                        if(row.status == 1){
                          return '<button onclick="Delete_PettyCash(this)" class="btn btn-danger" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="material-icons">clear</i></button><button class="btn btn-success" onclick="openModal(this)" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Agegar gasto"><i class="material-icons">add_circle</i></button><button class="btn btn-info" id="createReport" value="'+row.Id_db+'" data-toggle="tooltip" data-placement="top" title="Generar pdf" onclick="generateReportDetails(this)"><i class="material-icons">picture_as_pdf</i></button>';
                        }else{
                          return '<button onclick="Enable_PettyCash(this)" class="btn btn-success" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Habilitar"><i class="material-icons">refresh</i></button><button onclick="" class="btn btn-success" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Agregar gasto" disabled><i class="material-icons">add_circle</i></button><button class="btn btn-info" id="createReport" value="'+row.Id_db+'" data-toggle="tooltip" data-placement="top" title="Generar pdf" onclick="generateReportDetails(this)"><i class="material-icons">picture_as_pdf</i></button>';
                        }
                              },
                              "targets": 9
                      },
                      {"render": function ( data, type, row ) {
                        
                              },
                              "targets": 0
                      }
              ]
          };  
    table= $('#petty_Cash_Table').DataTable(settings)
    
    $('#petty_Cash_Table tbody').on('click', 'td.details-control', function () {

      
      var tr = $(this).closest('tr');
      

      var row = table.row(tr);
      
      
      if ( row.child.isShown() ) {
        
        // This row is already open - close it
        
        row.child.hide();
        
        tr.removeClass('shown');
        
      }
      
  else {
    
    // Open this row
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        type: "POST",
        url: "PettyCash/getPettyCashDetail",
        data: {id : row.data().Id_db},
        success: function(response)
        {
          if(lastRow!=true && lastColumn!=true){
            lastRow.child.hide();
            lastColumn.removeClass('shown');
          }
          row.child(response).show();      
          tr.addClass('shown');
          lastRow  = table.row(tr);
          lastColumn = tr;
        },
        error: function(){
        }
      });
      
      
    }
    
  });


  $("#btn_Filtrar_Petty_Cash").click(function(){
    if($("#numberFilter").val()== '' && $("#responsableFilter").val()== '' && $("#statusPettyCashFilter").val()== '' && $("#autorizationPettyCashFilter").val()== '' && $("#dateOne").val()=='' && $("#dateTwo").val()==''){
      $("#warning_alert").show('fast');
      setTimeout(() => {
        $("#warning_alert").hide('fast');
      }, 4500);
    }else{
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
                  "url":"PettyCash/getAllPettyCash", 
                  "type":"POST",
                  "data": function (d) {
                    d.numeroCajaChica = $('#numberFilter').val();
                    d.responsableCajaChica  = $('#selected_responsable').val();
                    d.estadoCajaChica = $('#statusPettyCashFilter').val();
                    d.autorizadaCajaChica = $('#autorizationPettyCashFilter').val();
                    d.fechaIni = $("#dateOne").val();
                    d.fechaFin = $("#dateTwo").val();
                  }
          },
          "columns": [
            {

              "className":      'details-control',
 
              "orderable":      false,
 
              "data":           null,
 
              "defaultContent": ''
 
           },
                {data: "status"},
                {data: "Id"},
                {data: "Id_db"},
                {data: "numero"},
                {data: "fechaInic"},
                {data: "fechaTerm"},
                {data: "encargado"},
                {data: "fechaRegistro"},
              ], 
              "lengthMenu": [[50,100,200], [50,100,200]],
              "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

                        {"render": function ( data, type, row ) {
                              return '<label class="codigo">'+row.Id+'</label>';
                              },
                              "targets": 2
      
                      },
                      {"render": function ( data, type, row ) {
                        if (row.status==1) {
                          return '<img src="img/botonesactivo.png" width="20px" heigth="20px">';
                        }else{
                          return '<img src="img/botonesdesactivo.png" width="20px" heigth="20px">';
                        }
                              },
                              "targets": 1
                      },
                      {"render": function ( data, type, row ) {
                        if(row.status == 1){
                          return '<button onclick="Delete_PettyCash(this)" class="btn btn-danger" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="material-icons">clear</i></button><button class="btn btn-success" onclick="openModal(this)" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Agegar gasto"><i class="material-icons">add_circle</i></button><button class="btn btn-info" id="createReport" value="'+row.Id_db+'" data-toggle="tooltip" data-placement="top" title="Generar pdf" onclick="generateReportDetails(this)"><i class="material-icons">picture_as_pdf</i></button>';
                        }else{
                          return '<button onclick="Enable_PettyCash(this)" class="btn btn-success" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Habilitar"><i class="material-icons">refresh</i></button><button onclick="" class="btn btn-success" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Agregar gasto" disabled><i class="material-icons">add_circle</i></button><button class="btn btn-info" id="createReport" value="'+row.Id_db+'" data-toggle="tooltip" data-placement="top" title="Generar pdf" onclick="generateReportDetails(this)"><i class="material-icons">picture_as_pdf</i></button>';
                        }
                              },
                              "targets": 9
                      },
                      {"render": function ( data, type, row ) {
                        
                              },
                              "targets": 0
                      }
              ]
          };  
  var tabla =$('#petty_Cash_Table').DataTable();
  tabla.destroy();
  table= $('#petty_Cash_Table').DataTable(settings);
  setTimeout(() => {
    $("#btn-reset-filtrar-PettyCash").show('slow');
  
  }, 1500);
  }
  });
  
  
  $("#btn-reset-filtrar-PettyCash").click(function(){
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
                "url":"PettyCash/getAllPettyCash", 
                "type":"POST",
                "data": function (d) {
                  d.numeroCajaChica = $('#numberFilter').val();
                  d.responsableCajaChica  = $('#selected_responsable').val();
                  d.estadoCajaChica = $('#statusPettyCashFilter').val();
                  d.autorizadaCajaChica = $('#autorizationPettyCashFilter').val();
                  d.fechaIni = $("#dateOne").val();
                  d.fechaFin = $("#dateTwo").val();
                }
        },
        "columns": [
          {

            "className":      'details-control',

            "orderable":      false,

            "data":           null,

            "defaultContent": ''

         },
              {data: "status"},
              {data: "Id"},
              {data: "Id_db"},
              {data: "numero"},
              {data: "fechaInic"},
              {data: "fechaTerm"},
              {data: "encargado"},
              {data: "fechaRegistro"},
            ], 
            "lengthMenu": [[50,100,200], [50,100,200]],
            "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

                      {"render": function ( data, type, row ) {
                            return '<label class="codigo">'+row.Id+'</label>';
                            },
                            "targets": 2
    
                    },
                    {"render": function ( data, type, row ) {
                      if (row.status==1) {
                        return '<img src="img/botonesactivo.png" width="20px" heigth="20px">';
                      }else{
                        return '<img src="img/botonesdesactivo.png" width="20px" heigth="20px">';
                      }
                            },
                            "targets": 1
                    },
                    {"render": function ( data, type, row ) {
                      if(row.status == 1){
                        return '<button onclick="Delete_PettyCash(this)" class="btn btn-danger" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="material-icons">clear</i></button><button class="btn btn-success" onclick="openModal(this)" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Agegar gasto"><i class="material-icons">add_circle</i></button><button class="btn btn-info" id="createReport" value="'+row.Id_db+'" data-toggle="tooltip" data-placement="top" title="Generar pdf" onclick="generateReportDetails(this)"><i class="material-icons">picture_as_pdf</i></button>';
                      }else{
                        return '<button onclick="Enable_PettyCash(this)" class="btn btn-success" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Habilitar"><i class="material-icons">refresh</i></button><button onclick="" class="btn btn-success" value="'+row.Id_db+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Agregar gasto" disabled><i class="material-icons">add_circle</i></button><button class="btn btn-info" id="createReport" value="'+row.Id_db+'" data-toggle="tooltip" data-placement="top" title="Generar pdf" onclick="generateReportDetails(this)"><i class="material-icons">picture_as_pdf</i></button>';
                      }
                            },
                            "targets": 9
                    },
                    {"render": function ( data, type, row ) {
                      
                            },
                            "targets": 0
                    }
            ]
        };  
  var tabla =$('#petty_Cash_Table').DataTable();
  tabla.destroy();
  table= $('#petty_Cash_Table').DataTable(settings)
  $(".Filter").hide('slow')
  $("#btn-ocultar-filtros").hide('slow');
  $("#btn-filtros").show('slow');
  $("#btn-reset-filtrar-PettyCash").hide("slow");
  });
  
});

function cleanFiltrosPettyCash(){
    $("#numberFilter").val('');
    $("#locationFilter").val('');
    $("#deductibleFilter").val('');
    $("#responsableFilter").val('');
    $("#teamFilter").val('');
    $("#statusPettyCashFilter").val('');
    $("#autorizationPettyCashFilter").val('');
    $("#dateOne").val('');
    $("#dateTwo").val('');
    $("#selected_location").val('');
    $("#selected_responsable").val('');
    $("#selected_team").val('');
}



$(function() {
  $('input[name="dateFilter"]').daterangepicker({
    "locale": {
      "format": "YYYY-MMM-DD",
      "separator": " - ",
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar",
      "fromLabel": "De",
      "toLabel": "a",
      "customRangeLabel": "Personalizado",
      "daysOfWeek": [
          "Dom",
          "Lun",
          "Mart",
          "Miér",
          "Juev",
          "Vier",
          "Sáb"
      ],
      "monthNames": [
          "Enero",
          "Febrero",
          "Marzo",
          "Abril",
          "Mayo",
          "Junio",
          "Julio",
          "Agosto",
          "Septiembre",
          "Octubre",
          "Noviembre",
          "Diciembre"
      ],
      "firstDay": 0
    },
    opens: 'left'
  }, function(start, end, label) {
    $("#dateOne").val(start.format('YYYY-MM-DD'));
    
    $("#dateTwo").val(end.format('YYYY-MM-DD'));
  });
});

