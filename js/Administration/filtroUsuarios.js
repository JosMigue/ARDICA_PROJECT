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
                  "url":"Administration/getAllUsers", 
                  "type":"POST",
                  "data": function (a) {
                    a.nombre = $('#nameFilter').val();
                    a.nombreUsuario = $('#nameUserFilter').val();
                    a.fecha = $('#dateFilter').val();
                    a.idUsuario = $('#idFilter').val();
                    a.statusUsuario = $("#userStatusFilter").val();
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
                {data: "lastLogin"}
              ], 
              "lengthMenu": [[50,100,200], [50,100,200]],
              "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

                        {"render": function ( data, type, row ) {
                              return '<label class="codigo">'+row.Id+'</label>';
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
                        if(row.status == 1){
                          return '<button class="btn btn-warning" value="'+row.Id_db+'" onclick="bringDataUser(this)"><i class="material-icons">create</i></button>   <button onclick="Eliminar_usurario(this)"class="btn btn-danger" value="'+row.Id_db+'" name="'+row.name+'"><i class="material-icons">clear</i></button>'
                        }else{
                          return '<button class="btn btn-warning" value="'+row.Id_db+'" onclick="bringDataUser(this)"><i class="material-icons">create</i></button>   <button onclick="habilitarUsuario(this)"class="btn btn-success"  value="'+row.Id_db+'" name="'+row.name+'"><i class="material-icons">check</i></button>'
                        }
                              },
                              "targets": 9
                      },
                      {"render": function ( data, type, row ) {
                       if(row.phone == null || row.phone == ''){
                         return 'Sin número';
                       }else{
                         return  row.phone;
                       }
                              },
                              "targets": 5
                      },
                      {"render": function ( data, type, row ) {
                       if(row.email == null || row.email == ''){
                         return 'Sin correo';
                       }else{
                         return  row.email;
                       }
                              },
                              "targets": 6
                      }
              ]
          };  
    var tabla =$('#users_table').DataTable();
    tabla.destroy();
    table= $('#users_table').DataTable(settings)
});



$('#btnfiltrar').click(function(){
    if($("#nameFilter").val() ==  '' && $("#nameUserFilter").val() == '' && $("#dateFilter").val() ==  '' && $("#idFilter").val()== '' && $("#userStatusFilter").val()== 0){
          $("#warning_alert").show("slow");
        setTimeout(() => {
            $("#warning_alert").hide("fast")
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
                  "url":"Administration/getAllUsers", 
                  "type":"POST",
                  "data": function (a) {
                    a.nombre = $('#nameFilter').val();
                    a.nombreUsuario = $('#nameUserFilter').val();
                    a.fecha = $('#dateFilter').val();
                    a.idUsuario = $('#idFilter').val();
                    a.statusUsuario = $("#userStatusFilter").val();
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
                {data: "lastLogin"}
              ], 
              "lengthMenu": [[50,100,200], [50,100,200]],
              "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

                        {"render": function ( data, type, row ) {
                              return '<label class="codigo">'+row.Id+'</label>';
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
                        if(row.status == 1){
                          return '<button class="btn btn-warning" value="'+row.Id_db+'" onclick="bringDataUser(this)"><i class="material-icons">create</i></button>   <button onclick="Eliminar_usurario(this)"class="btn btn-danger" value="'+row.Id_db+'" name="'+row.name+'"><i class="material-icons">clear</i></button>'
                        }else{
                          return '<button class="btn btn-warning" value="'+row.Id_db+'" onclick="bringDataUser(this)"><i class="material-icons">create</i></button>   <button onclick="habilitarUsuario(this)"class="btn btn-success"  value="'+row.Id_db+'" name="'+row.name+'"><i class="material-icons">check</i></button>'
                        }
                              },
                              "targets": 9
                      },
                      {"render": function ( data, type, row ) {
                       if(row.phone == null || row.phone == ''){
                         return 'Sin número';
                       }else{
                         return  row.phone;
                       }
                              },
                              "targets": 5
                      },
                      {"render": function ( data, type, row ) {
                       if(row.email == null || row.email == ''){
                         return 'Sin correo';
                       }else{
                         return  row.email;
                       }
                              },
                              "targets": 6
                      }
              ]
          };  
    var tabla =$('#users_table').DataTable();
    tabla.destroy();
    table= $('#users_table').DataTable(settings);
    setTimeout(() => {
      $("#btn-reset-filtrar").show("slow");
    }, 1500);
    }
  });

  $("#btn-reset-filtrar").click(function(){
    $(".Filter").hide("slow", function(){
      $("#btn-ocultar-filtros").hide("slow");
      $("#btn-filtros").show("slow");
      setTimeout(() => {
        $("#btn-reset-filtrar").hide();
      }, 1000);
    });
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
                "url":"Administration/getAllUsers", 
                "type":"POST",
                "data": function (a) {
/*                   a.nombre = $('#nameFilter').val();
                  a.nombreUsuario = $('#nameUserFilter').val();
                  a.fecha = $('#dateFilter').val();
                  a.idUsuario = $('#idFilter').val();
                  a.statusUsuario = $("#userStatusFilter").val(); */
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
              {data: "lastLogin"}
            ], 
            "lengthMenu": [[50,100,200], [50,100,200]],
            "columnDefs": [{ className: "contador", "targets": [ 1 ] }, 

                      {"render": function ( data, type, row ) {
                            return '<label class="codigo">'+row.Id+'</label>';
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
                      if(row.status == 1){
                        return '<button class="btn btn-warning" value="'+row.Id_db+'" onclick="bringDataUser(this)"><i class="material-icons">create</i></button>   <button onclick="Eliminar_usurario(this)"class="btn btn-danger" value="'+row.Id_db+'" name="'+row.name+'"><i class="material-icons">clear</i></button>'
                      }else{
                        return '<button class="btn btn-warning" value="'+row.Id_db+'" onclick="bringDataUser(this)"><i class="material-icons">create</i></button>   <button onclick="habilitarUsuario(this)"class="btn btn-success"  value="'+row.Id_db+'" name="'+row.name+'"><i class="material-icons">check</i></button>'
                      }
                            },
                            "targets": 9
                    },
                    {"render": function ( data, type, row ) {
                     if(row.phone == null || row.phone == ''){
                       return 'Sin número';
                     }else{
                       return  row.phone;
                     }
                            },
                            "targets": 5
                    },
                    {"render": function ( data, type, row ) {
                     if(row.email == null || row.email == ''){
                       return 'Sin correo';
                     }else{
                       return  row.email;
                     }
                            },
                            "targets": 6
                    }
            ]
        };  
  var tabla =$('#users_table').DataTable();
  tabla.destroy();
  table= $('#users_table').DataTable(settings)
  });



