/*================= CATALOGE DEDUCTIBLE - ADD - BEGIN =================*/
$("#btnAddDeductible").click(function(){
    alertify.prompt("Agregar nuevo deducible","Ingrese nombre del tipo a registrar.", "Ingrese el nombre del catálogo",
      function(evt, value ){
        if(value == '' || value == 'Ingrese el nombre del catálogo'){
            alertify.error('Error, el nombre está vacío');
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "PettyCash/saveDeductible",
                data: {deductible : value},
                success: function(data)
                {   
                    var obj = $.parseJSON(data);
                    if(data !=false){
                        document.getElementById("catalogeDeductibleTable").insertRow(-1).innerHTML = '<th scope="row">'+obj["id"]+'</th><td>'+value+'</td><td><button class="btn btn-danger" onclick="deleteDeductible(this)" id="btnDeleteDeducible" value ="'+obj["id"]+'" name="'+obj["nombre"]+'"><i class="material-icons">delete_sweep</i></button></td>';
                        alertify.success('Valor nuevo insertado correctamente');
                    }else{
                        alertify.error('Ha ocurrido un error');
                    }
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
            
                        alert('Fallo al solicitar el JSON.');
            
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
      },
      function(){
        alertify.error('Cancelado');
      });
});
/*================= CATALOGE DEDUCTIBLE - ADD - END =================*/


/*================= CATALOGE DEDUCTIBLE - DELETE - BEGIN =================*/
function deleteDeductible(deducible){
    var id = deducible.value;
    var nombre =  deducible.name;
    var i = deducible.parentNode.parentNode.rowIndex;
    Swal.fire({
        title: '¿Está seguro que desea borrar el tipo deducible "'+nombre+'"?',
        text: "¡Esta acción no se puede corregir!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, ¡Completamente!'
      }).then((result) => {
        if (result.value) {
           $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "PettyCash/deleteDeductible",
                data: {deductible : id},
                success: function(data)
                {   
                    if(data){
                        document.getElementById("catalogeDeductibleTable").deleteRow(i);
                        alertify.success('El registro se ha borrado correctamente');
                    }else{
                        alertify.error('Ha ocurrido un error');
                    }
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
            
                        alert('Fallo al solicitar el JSON.');
            
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
      });
}
/*================= CATALOGE DEDUCTIBLE - DELETE - END =================*/


/*================= CATALOGE CONCEPTS - ADD - BEGIN =================*/
$("#btnAddConcept").click(function(){
    alertify.prompt("Agregar nuevo concepto","Ingrese nombre del concepto a registrar.", "Ingrese el nombre del concepto",
      function(evt, value ){
        if(value == '' || value == 'Ingrese el nombre del concepto'){
            alertify.error('Error, el nombre está vacío');
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "PettyCash/saveConcept",
                data: {concept : value},
                success: function(data)
                {   
                    var obj = $.parseJSON(data);
                    if(data !=false){
                        document.getElementById("catalogeConceptTable").insertRow(-1).innerHTML = '<th scope="row">'+obj["id"]+'</th><td>'+value+'</td><td><button class="btn btn-danger" onclick="deleteConcept(this)" id="btnDeleteDeducible" value ="'+obj["id"]+'" name="'+obj["nombre"]+'"><i class="material-icons">delete_sweep</i></button></td>';
                        alertify.success('Valor nuevo insertado correctamente');
                    }else{
                        alertify.error('Ha ocurrido un error');
                    }
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
            
                        alert('Fallo al solicitar el JSON.');
            
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
      },
      function(){
        alertify.error('Cancelado');
      });
});
/*================= CATALOGE CONCEPTS - ADD - END =================*/


/*================= CATALOGE CONCEPTS - DELETE - BEGIN =================*/
function deleteConcept(concept){
    var id = concept.value;
    var nombre =  concept.name;
    var i = concept.parentNode.parentNode.rowIndex;
    Swal.fire({
        title: '¿Está seguro que desea borrar el concepto "'+nombre+'"?',
        text: "¡Esta acción no se puede corregir!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, ¡Completamente!'
      }).then((result) => {
        if (result.value) {
           $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "PettyCash/deleteConcept",
                data: {concept : id},
                success: function(data)
                {   
                    if(data){
                        document.getElementById("catalogeConceptTable").deleteRow(i);
                        alertify.success('El registro se ha borrado correctamente');
                    }else{
                        alertify.error('Ha ocurrido un error');
                    }
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
            
                        alert('Fallo al solicitar el JSON.');
            
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
      });
}
/*================= CATALOGE CONCEPTS - DELETE - END =================*/


/*================= CATALOGE TEAMS - ADD - BEGIN =================*/
$("#btnAddTeam").click(function(){
    alertify.prompt("Agregar nuevo equipo","Ingrese nombre del equipo a registrar.", "Ingrese el nombre del equipo",
      function(evt, value ){
        if(value == '' || value == 'Ingrese el nombre del equipo'){
            alertify.error('Error, el nombre está vacío');
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "PettyCash/saveTeam",
                data: {team : value},
                success: function(data)
                {   
                    var obj = $.parseJSON(data);
                    if(data !=false){
                        document.getElementById("catalogeTeamTable").insertRow(-1).innerHTML = '<th scope="row">'+obj["id"]+'</th><td>'+value+'</td><td><button class="btn btn-danger" onclick="deleteTeam(this)" id="btnDeleteDeducible" value ="'+obj["id"]+'" name="'+obj["nombre"]+'"><i class="material-icons">delete_sweep</i></button></td>';
                        alertify.success('Valor nuevo insertado correctamente');
                    }else{
                        alertify.error('Ha ocurrido un error');
                    }
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
            
                        alert('Fallo al solicitar el JSON.');
            
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
      },
      function(){
        alertify.error('Cancelado');
      });
});
/*================= CATALOGE TEAMS - ADD - END =================*/

/*================= CATALOGE TEAMS - DELETE - BEGIN =================*/
function deleteTeam(team){
    var id = team.value;
    var nombre =  team.name;
    var i = team.parentNode.parentNode.rowIndex;
    Swal.fire({
        title: '¿Está seguro que desea borrar el equipo "'+nombre+'"?',
        text: "¡Esta acción no se puede corregir!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, ¡Completamente!'
      }).then((result) => {
        if (result.value) {
           $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "PettyCash/deleteTeam",
                data: {team : id},
                success: function(data)
                {   
                    if(data){
                        document.getElementById("catalogeTeamTable").deleteRow(i);
                        alertify.success('El registro se ha borrado correctamente');
                    }else{
                        alertify.error('Ha ocurrido un error');
                    }
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
            
                        alert('Fallo al solicitar el JSON.');
            
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
      });
}
/*================= CATALOGE TEAMS - DELETE - END =================*/

/*================= CATALOGE PETTY CASH TYPES - ADD - BEGIN=================*/
$("#btnAddTypeObra").click(function(){
    alertify.prompt("Agregar nuevo tipo de obra","Ingrese nombre del tipo ha registrar.", "Ingrese el nombre del tipo",
      function(evt, value ){
        if(value == '' || value == 'Ingrese el nombre del tipo'){
            alertify.error('Error, el nombre está vacío');
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "PettyCash/saveObrasType",
                data: {obra_type : value},
                success: function(data)
                {   
                    var obj = $.parseJSON(data);
                    if(data !=false){
                        document.getElementById("catalogeTypesTable").insertRow(-1).innerHTML = '<th scope="row">'+obj["id"]+'</th><td>'+value+'</td><td><button class="btn btn-danger" onclick="deleteObrasType(this)" id="btnDeleteDeducible" value ="'+obj["id"]+'" name="'+obj["nombre"]+'"><i class="material-icons">delete_sweep</i></button></td>';
                        alertify.success('Valor nuevo insertado correctamente');
                    }else{
                        alertify.error('Ha ocurrido un error');
                    }
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
            
                        alert('Fallo al solicitar el JSON.');
            
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
      },
      function(){
        alertify.error('Cancelado');
      });
});

/*================= CATALOGE PETTY CASH TYPES - ADD - END =================*/


/*================= CATALOGE PETTY CASH TYPES - DELETE - BEGIN =================*/

function deleteObrasType(ObraType){
    var id = ObraType.value;
    var nombre =  ObraType.name;
    var i = ObraType.parentNode.parentNode.rowIndex;
    Swal.fire({
        title: '¿Está seguro que desea borrar el equipo "'+nombre+'"?',
        text: "¡Esta acción no se puede corregir!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, ¡Completamente!'
      }).then((result) => {
        if (result.value) {
           $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "PettyCash/deleteObrasType",
                data: {obra_type : id},
                success: function(data)
                {   
                    if(data){
                        document.getElementById("catalogeTypesTable").deleteRow(i);
                        alertify.success('El registro se ha borrado correctamente');
                    }else{
                        alertify.error('Ha ocurrido un error');
                    }
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
            
                        alert('Fallo al solicitar el JSON.');
            
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
      });
}

/*================= CATALOGE PETTY CASH TYPES - DELETE - END =================*/


$(document).ready(function(){
  $("#btnAddConceptOnModal").click(function(){
    $("#sectionAddConceptOnModal").show('slow');
  });

  $("#btnCancelOnModal").click(function(){
    $("#sectionAddConceptOnModal").hide('fast');
  });

  $("#btnAddOnModalConcept").click(function(){
    var concept = $("#inputConceptOnModal").val();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: "PettyCash/addConceptOnModal",
    data: {concept : concept},
    success: function(data){
      if(data!=null){
        var obj = $.parseJSON(data);
        $("#sectionAddConceptOnModal").hide('fast');
        var myselect = document.getElementById('conceptPettyCash');
        var objOption = document.createElement("option");
        objOption.text = concept;
        objOption.value = obj["id"];
        myselect.options.add(objOption);
        alertify.success('Concepto guardado');
      }else{
        alertify.error('No se pudo guardar el concepto');
      }
    },
    error: function(){
      alertify.error('Error interno del servidor');
    }
    });
  
  
  });
});