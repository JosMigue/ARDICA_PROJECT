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
                  "url":"PettyCash/getAllDetailPettyCash", 
                  "type":"POST",
                  "data": function (d) {
                    d.numeroCajaChicaDetail = $('#numberDetailFilter').val();
                  }
          },
          "columns": [
                {data: "Id"},
                {data: "numero"},
                {data: "ubicacion"},
                {data: "equipo"},
                {data: "concepto"},
                {data: "subtotal"},
                {data: "IVA"},
                {data: "total"},
                {data: "deducible"},
                {data: "observacion"},
                {data: "registro"},
              ], 
              "lengthMenu": [[50,100,200], [50,100,200]],
              "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

                        {"render": function ( data, type, row ) {
                              return '<label class="codigo">'+row.Id+'</label>';
                              },
                              "targets": 0
      
                      },
                        {"render": function ( data, type, row ) {
                              return '$'+row.subtotal;
                              },
                              "targets": 5
      
                      },
                        {"render": function ( data, type, row ) {
                              return '$'+row.IVA;
                              },
                              "targets": 6
      
                      },
                        {"render": function ( data, type, row ) {
                              return '$'+row.total;
                              },
                              "targets": 7
      
                      },
                        {"render": function ( data, type, row ) {
                          if(row.deducible == 'Deducible'){
                            return 'Sí';
                          }else{
                            return 'No';
                          }
                              
                              },
                              "targets": 8
      
                      },
                        {"render": function ( data, type, row ) {
                          if(row.observacion == null || row.observacion=='' || row.observacion == ' '){
                            return 'Sin observaciones';
                          }else{
                            return '<div style="width: 500px; overflow: auto">'+row.observacion+'</div>';
                          }
                              
                              },
                              "targets": 9
      
                      },
                      {"render": function ( data, type, row ) {
                          return '<button type="button" class="btn btn-warning" value="'+row.Id+'" onclick="bringDataPettyCash(this)" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="material-icons">create</i></button><button onclick="Delete_DetailPettyCash(this)" class="btn btn-danger" value="'+row.Id+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="material-icons">clear</i></button>';
                              },
                              "targets": 11
                      }
              ]
          };  
    var tabla =$('#petty_Cash_Table-detail').DataTable();
    tabla.destroy();
    table= $('#petty_Cash_Table-detail').DataTable(settings)



    // Get petty cash for select in view "v_Pertty_Cash-Gastos"
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getPettyCash",
        success: function(response)
        {
            $('#numberDetailFilter').html(response).fadeIn();
        }
});
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getLocationTypes",
        success: function(response)
        {
            $('#locationFilterDetail').html(response).fadeIn();
        }
});
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getDeductibleTypes",
        success: function(response)
        {
            $('#deductibleFilterDetail').html(response).fadeIn();
        }
});
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getAllTeams",
        success: function(response)
        {
            $('#teamFilterDetail').html(response).fadeIn();
        }
});
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getLocationTypes",
        success: function(response)
        {
            $('#locationPettyCashEdit').html(response).fadeIn();
        }
});
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getDeductibleTypes",
        success: function(response)
        {
            $('#deductiblePettyCashEdit').html(response).fadeIn();
        }
});
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getAllTeams",
        success: function(response)
        {
            $('#teamPettyCashEdit').html(response).fadeIn();
        }
});
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getConceptTypes",
        success: function(response)
        {
            $('#conceptPettyCashEdit').html(response).fadeIn();
        }
});

});



$("#numberDetailFilter").change(function(){
  if($("#numberFilter").val()== '' && $("#locationFilter").val()== '' && $("#deductibleFilter").val()== '' && $("#responsableFilter").val()== '' && $("#teamFilter").val()== '' && $("#statusPettyCashFilter").val()== '' && $("#autorizationPettyCashFilter").val()== '' && $("#dateOne").val()=='' && $("#dateTwo").val()==''){
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
                  "url":"PettyCash/getAllDetailPettyCash", 
                  "type":"POST",
                  "data": function (d) {
                    d.idCajaChicaDetail = $('#numberDetailFilter').val();
                  }
          },
          "columns": [
                {data: "Id"},
                {data: "numero"},
                {data: "ubicacion"},
                {data: "equipo"},
                {data: "concepto"},
                {data: "subtotal"},
                {data: "IVA"},
                {data: "total"},
                {data: "deducible"},
                {data: "observacion"},
                {data: "registro"},
              ], 
              "lengthMenu": [[50,100,200], [50,100,200]],
              "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

              {"render": function ( data, type, row ) {
                return '<label class="codigo">'+row.Id+'</label>';
                },
                "targets": 0

        },
          {"render": function ( data, type, row ) {
                return '$'+row.subtotal;
                },
                "targets": 5

        },
          {"render": function ( data, type, row ) {
                return '$'+row.IVA;
                },
                "targets": 6

        },
          {"render": function ( data, type, row ) {
                return '$'+row.total;
                },
                "targets": 7

        },
        {"render": function ( data, type, row ) {
          if(row.deducible == 'Deducible'){
            return 'Sí';
          }else{
            return 'No';
          }
              
              },
              "targets": 8

      },
        {"render": function ( data, type, row ) {
          if(row.observacion == null || row.observacion=='' || row.observacion == ' '){
            return 'Sin observaciones';
          }else{
            return '<div style="width: 500px; overflow: auto">'+row.observacion+'</div>';
          }
              
              },
              "targets": 9

      },
        {"render": function ( data, type, row ) {
          return '<button type="button" class="btn btn-warning" value="'+row.Id+'" onclick="bringDataPettyCash(this)" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="material-icons">create</i></button><button onclick="Delete_PettyCash(this)" class="btn btn-danger" value="'+row.Id+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="material-icons">clear</i></button>';
                },
                "targets": 11
        }
              ]
          };  
    var tabla =$('#petty_Cash_Table-detail').DataTable();
    tabla.destroy();
    table= $('#petty_Cash_Table-detail').DataTable(settings)
    
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: "PettyCash/plusPettyCashData",
    data: {pettyCahsnumber : $('#numberDetailFilter').val()},
    success: function(data)
    {
      var obj = $.parseJSON(data);
      document.getElementById('total_table').outerHTML = '<div class="row justify-content-end" id = "total_table"style="display: none;"><div class="alert alert-primary" role="alert" style="overflow: auto; height: 100px; width: 400px !important;">Los detalles de la caja chica '+obj.cajaChica.numero+' tiene un subtotal neto de $'+obj.total.subtotal+' y un total neto de $'+obj.total.total+'</div></div>'
      $("#total_table").show('fast');
    },
    error:function(jqXHR, textStatus, errorThrown){
      if (jqXHR.status === 0) {

        alert('Sin conexión internet: Verificar tu conexion.');

      } else if (jqXHR.status == 404) {

        alert('Página o función no encontrada [404]');

      } else if (jqXHR.status == 500) {
        $.confirm({
            title: 'Error interno del servidor [500]',
            content: 'Algo ocurrió, intente más tarde o contacte al administrador del sistema',
            type: 'red',
            typeAnimated: true,
            buttons: {
                cerrar:{
                    text: 'Cerrar',
                    close: function () {
                    }
                }
            }
        });

      } else if (textStatus === 'parsererror') {

        alert('Fallo al solicitar JSON.');

      } else if (textStatus === 'timeout') {

        alert('Tiempo agotado.');

      } else if (textStatus === 'abort') {

        alert('Petición Ajax abortada.');

      } else {

        alert('Error desconocido: ' + jqXHR.responseText);

      }
    },
    });
setTimeout(() => {
  $("#btn-reset-filtrar-PettyCash").show('slow');

}, 1500);
}
});


$("#btn_Filtrar_Petty_Cash_Detail").click(function(){
  if($("#locationFilterDetail").val()== '' && $("#deductibleFilterDetail").val()== '' && $("#teamFilterDetail").val()== ''){
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
                  "url":"PettyCash/getAllDetailPettyCash", 
                  "type":"POST",
                  "data": function (d) {
                    d.localizacionDetail = $('#locationFilterDetail').val();
                    d.deducibleDetail = $('#deductibleFilterDetail').val();
                    d.equipoDetail = $('#teamFilterDetail').val();
                  }
          },
          "columns": [
                {data: "Id"},
                {data: "numero"},
                {data: "ubicacion"},
                {data: "equipo"},
                {data: "concepto"},
                {data: "subtotal"},
                {data: "IVA"},
                {data: "total"},
                {data: "deducible"},
                {data: "observacion"},
                {data: "registro"},
              ], 
              "lengthMenu": [[50,100,200], [50,100,200]],
              "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

              {"render": function ( data, type, row ) {
                return '<label class="codigo">'+row.Id+'</label>';
                },
                "targets": 0

        },
          {"render": function ( data, type, row ) {
                return '$'+row.subtotal;
                },
                "targets": 5

        },
          {"render": function ( data, type, row ) {
                return '$'+row.IVA;
                },
                "targets": 6

        },
          {"render": function ( data, type, row ) {
                return '$'+row.total;
                },
                "targets": 7

        },
        {"render": function ( data, type, row ) {
          if(row.deducible == 'Deducible'){
            return 'Sí';
          }else{
            return 'No';
          }
              
              },
              "targets": 8

      },
        {"render": function ( data, type, row ) {
          if(row.observacion == null || row.observacion=='' || row.observacion == ' '){
            return 'Sin observaciones';
          }else{
            return '<div style="width: 500px; overflow: auto">'+row.observacion+'</div>';
          }
              
              },
              "targets": 9

      },
        {"render": function ( data, type, row ) {
          return '<button type="button" class="btn btn-warning" value="'+row.Id+'" onclick="bringDataPettyCash(this)" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="material-icons">create</i></button><button onclick="Delete_PettyCash(this)" class="btn btn-danger" value="'+row.Id+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="material-icons">clear</i></button>';
                },
                "targets": 11
        }
              ]
          };  
    var tabla =$('#petty_Cash_Table-detail').DataTable();
    tabla.destroy();
    table= $('#petty_Cash_Table-detail').DataTable(settings);
    $("#btn-reset-filtrar-PettyCash-Detail").show('slow');
}
});

$("#btn-reset-filtrar-PettyCash-Detail").click(function(){
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
                  "url":"PettyCash/getAllDetailPettyCash", 
                  "type":"POST",
                  "data": function (d) {
                  }
          },
          "columns": [
                {data: "Id"},
                {data: "numero"},
                {data: "ubicacion"},
                {data: "equipo"},
                {data: "concepto"},
                {data: "subtotal"},
                {data: "IVA"},
                {data: "total"},
                {data: "deducible"},
                {data: "observacion"},
                {data: "registro"},
              ], 
              "lengthMenu": [[50,100,200], [50,100,200]],
              "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

              {"render": function ( data, type, row ) {
                return '<label class="codigo">'+row.Id+'</label>';
                },
                "targets": 0

        },
          {"render": function ( data, type, row ) {
                return '$'+row.subtotal;
                },
                "targets": 5

        },
          {"render": function ( data, type, row ) {
                return '$'+row.IVA;
                },
                "targets": 6

        },
          {"render": function ( data, type, row ) {
                return '$'+row.total;
                },
                "targets": 7

        },
        {"render": function ( data, type, row ) {
          if(row.deducible == 'Deducible'){
            return 'Sí';
          }else{
            return 'No';
          }
              
              },
              "targets": 8

      },
        {"render": function ( data, type, row ) {
          if(row.observacion == null || row.observacion=='' || row.observacion == ' '){
            return 'Sin observaciones';
          }else{
            return '<div style="width: 500px; overflow: auto">'+row.observacion+'</div>';
          }
              
              },
              "targets": 9

      },
        {"render": function ( data, type, row ) {
          return '<button type="button" class="btn btn-warning" value="'+row.Id+'" onclick="bringDataPettyCash(this)" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="material-icons">create</i></button><button onclick="Delete_PettyCash(this)" class="btn btn-danger" value="'+row.Id+'" name="'+row.numero+'" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="material-icons">clear</i></button>';
                },
                "targets": 11
        }
              ]
          };  
    var tabla =$('#petty_Cash_Table-detail').DataTable();
    tabla.destroy();
    table= $('#petty_Cash_Table-detail').DataTable(settings);
    $(".Filter").hide('slow');
    $("#btn-reset-filtrar-PettyCash-Detail").hide('slow');
    $("#btn-filtros").show('slow');
    $("#btn-ocultar-filtros").hide('slow');
    $('#numberDetailFilter').val('');
    $('#locationFilterDetail').val('');
    $('#deductibleFilterDetail').val('');
    $('#teamFilterDetail').val('');
    $('#total_table').hide();
});



$("#btnAddSpend").click(function(){

  document.getElementById('numberPettyCashSell').outerHTML = '<select  id="numberPettyCashSell" name="numberPettyCashSell" class="form-control"></select>'
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  type: "POST",
  url: "PettyCash/getPettyCashTwo",
  success: function(data)
  {
    $('#numberPettyCashSell').html(data).fadeIn();
    $("#modalAddSellPettyCash").modal('show');
  },
  error:function(jqXHR, textStatus, errorThrown){
    if (jqXHR.status === 0) {

      alert('Sin conexión internet: Verificar tu conexion.');

    } else if (jqXHR.status == 404) {

      alert('Página o función no encontrada [404]');

    } else if (jqXHR.status == 500) {
      $.confirm({
          title: 'Error interno del servidor [500]',
          content: 'Algo ocurrió, intente más tarde o contacte al administrador del sistema',
          type: 'red',
          typeAnimated: true,
          buttons: {
              cerrar:{
                  text: 'Cerrar',
                  close: function () {
                  }
              }
          }
      });

    } else if (textStatus === 'parsererror') {

      alert('Fallo al solicitar JSON.');

    } else if (textStatus === 'timeout') {

      alert('Tiempo agotado.');

    } else if (textStatus === 'abort') {

      alert('Petición Ajax abortada.');

    } else {

      alert('Error desconocido: ' + jqXHR.responseText);

    }
  },
  });
});

function bringDataPettyCash(pettyCash){
  var pettyCash_Id =  pettyCash.value;
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  type: "POST",
  url: "PettyCash/bringPettyCashData",
  data: {id : pettyCash_Id},
  success: function(data)
  {
    $('#modalEditPettyCash').modal("show");
    var obj = $.parseJSON(data);
    $('#locationPettyCashEdit').val(obj["data"]["ubicacion"]);
    $('#deductiblePettyCashEdit').val(obj["data"]["deducible"]);
    $('#conceptPettyCashEdit').val(obj["data"]["concepto"]);
    $('#teamPettyCashEdit').val(obj["data"]["equipo"]);
    $("#subtotalPettyCashEdit").val(obj["data"]["subtotal"])
    $("#IVAPettyCashEdit").val(obj["data"]["IVA"])
    $("#totalPettyCashEdit").val(obj["data"]["total"])
    $("#idDetail").val(obj["data"]["ID"])
    $("#observationPettyCashEdit").val(obj["data"]["observaciones"])
  },
  error: function(jqXHR, textStatus, errorThrown){
      if (jqXHR.status === 0) {

          alert('Sin conexión internet: Verificar tu conexion.');

        } else if (jqXHR.status == 404) {

          alert('Página o función no encontrada [404]');

        } else if (jqXHR.status == 500) {
          $.confirm({
              title: 'Error interno del servidor [500]',
              content: 'Algo ocurrió, intente más tarde o contacte al administrador del sistema',
              type: 'red',
              typeAnimated: true,
              buttons: {
                  cerrar:{
                      text: 'Cerrar',
                      close: function () {
                      }
                  }
              }
          });

        } else if (textStatus === 'parsererror') {

          alert('Fallo al solicitar JSON.');

        } else if (textStatus === 'timeout') {

          alert('Tiempo agotado.');

        } else if (textStatus === 'abort') {

          alert('Petición Ajax abortada.');

        } else {

          alert('Error desconocido: ' + jqXHR.responseText);

        }
  }
  });
}