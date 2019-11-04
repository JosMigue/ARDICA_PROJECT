$(document).ready( function(){
    var msg = 'Campo obligatorio';
    $("#form_registro_caja").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
            numberPettyCash: {required: true},
            beginDate: { required: true},
        },
        messages: {
            numberPettyCash: {
                required: msg
            },
            beginDate: {
                required: msg
            },
        },
        submitHandler: function (form) {
            obj = new Object;
            obj.numeroCajaChica = $("#numberPettyCash").val();
            obj.fechaInicio = $('#beginDate').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "PettyCash/savePettyCash",
                    data: { obj: obj },
                    success: function (data) {
                        /* alert(data); */
                        if (data == 'error petty cash') {
                            Swal.fire({
                                type: 'Error',
                                title: 'Oops...',
                                text: 'No se pudo registrar la caja chica, intentelo de nuevo más tarde.',
                              })
                            }else if(data == 'success petty cash'){
                                Swal.fire({
                                    position: 'center',
                                    type: 'success',
                                    title: 'La caja chica ha sido registrada',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                $('#modalAddPettyCash').modal('hide');
                                setTimeout(function () {
                                    location.reload('/pettyCash');
                              }, 1200);
                            }else if(data == 'petty cash exist'){
                                Swal.fire({
                                    title: 'La caja chica que intenta registra ya se encuentra en la base de datos...',
                                    animation: false,
                                    customClass: {
                                      popup: 'animated tada'
                                    }
                                  })
                            }
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
                
                            alert('Fallo al solicitar el JSON.');
                
                          } else if (textStatus === 'timeout') {
                
                            alert('Tiempo agotado.');
                
                          } else if (textStatus === 'abort') {
                
                            alert('Petición Ajax abortada.');
                
                          } else {
                
                            alert('Error desconocido: ' + jqXHR.responseText);
                
                          }
                        /* alert("HA OCURRIDO UN ERROR: "+error); */
                    },
                });
        }
    });
    var numMsg = "Formato de número no válido";
    $("#form_registro_caja_gasto").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
            numberPettyCashSell: {required: true},
            locationPettyCash: {required: true},
            deductiblePettyCash: { required: true},
            conceptPettyCash: { required: true},
            subtotalPettyCash: { required: true, number:true},
            ivaPettyCash: { required: true, number:true},
            totalPettyCash: { required: true, number:true},
            teamPettyCash: { required: true},
            observationPettyCash: { required: false}
        },
        messages: {
            numberPettyCashSell: {
                required: msg
            },
            locationPettyCash: {
                required: msg
            },
            deductiblePettyCash: {
                required: msg
            },
            conceptPettyCash: {
                required: msg
            },
            subtotalPettyCash: {
                required: msg,
                number: numMsg
            },
            ivaPettyCash: {
                required: msg,
                number: numMsg
            },
            totalPettyCash: {
                required: msg,
                number: numMsg
            },
            teamPettyCash: {
                required: msg
            },
        },
        submitHandler: function (form) {
            obj = new Object;
            obj.numeroCajaChica = $("#idPettyCash").val();
            obj.localizacionCajaChica = $('#locationPettyCash').val();
            obj.deducibleCajaChica = $('#deductiblePettyCash').val();
            obj.conceptoCajaChica = $('#conceptPettyCash').val();
            obj.subtotalCajaChica = $('#subtotalPettyCash').val();
            obj.ivaCajaChica= $('#ivaPettyCash').val();
            obj.totalCajaChica = $('#totalPettyCash').val();
            obj.equipoCajachica = $('#teamPettyCash').val();
            obj.observacion = $('#observationPettyCash').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "PettyCash/saveDetailPettyCash",
                    data: { obj: obj },
                    success: function (data) {
                        if (data == 'error detail petty cash') {
                            Swal.fire({
                                type: 'Error',
                                title: 'Oops...',
                                text: 'No se pudo registrar la caja chica, intentelo de nuevo más tarde.',
                              })
                            }else if(data == 'success detail petty cash'){
                                Swal.fire({
                                    position: 'center',
                                    type: 'success',
                                    title: 'La caja chica ha sido registrada',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                                $('#modalAddSellPettyCash').modal('hide');
                                setTimeout(function () {
                                    location.reload('/pettyCash');
                              }, 1200);
                            }
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
                
                            alert('Fallo al solicitar el JSON.');
                
                          } else if (textStatus === 'timeout') {
                
                            alert('Tiempo agotado.');
                
                          } else if (textStatus === 'abort') {
                
                            alert('Petición Ajax abortada.');
                
                          } else {
                
                            alert('Error desconocido: ' + jqXHR.responseText);
                
                          }
                        /* alert("HA OCURRIDO UN ERROR: "+error); */
                    },
                });
        }
    });




    $("#form_registro_editar_caja").validate({
      errorClass: "my-error-class",
      validClass: "my-valid-class",
      rules: {
        locationPettyCashEdit: {required: true},
        deductiblePettyCashEdit: {required: true},
        conceptPettyCashEdit: { required: true},
        teamPettyCashEdit: { required: true},
        subtotalPettyCashEdit: { required: true, number:true},
        IVAPettyCashEdit: { required: true, number:true},
        totalPettyCashEdit: { required: true, number:true}
      },
      messages: {
        locationPettyCashEdit: {
              required: msg
          },
          deductiblePettyCashEdit: {
              required: msg
          },
          conceptPettyCashEdit: {
              required: msg
          },
          teamPettyCashEdit: {
              required: msg
          },
          subtotalPettyCashEdit: {
              required: msg,
              number: numMsg
          },
          IVAPettyCashEdit: {
              required: msg,
              number: numMsg
          },
          totalPettyCashEdit: {
              required: msg,
              number: numMsg
          }
      },
      submitHandler: function (form) {
          obj = new Object;
          obj.ubicacionCajaChicaEdit = $("#locationPettyCashEdit").val();
          obj.deducibleCajaChicaEdit = $('#deductiblePettyCashEdit').val();
          obj.conceptoCajaChicaEdit = $('#conceptPettyCashEdit').val();
          obj.equipoCajaChicaEdit = $('#teamPettyCashEdit').val();
          obj.subtotalCajaChicaEdit = $('#subtotalPettyCashEdit').val();
          obj.ivaCajaChicaEdit= $('#IVAPettyCashEdit').val();
          obj.totalCajaChicaEdit = $('#totalPettyCashEdit').val();
          obj.idDetalle = $('#idDetail').val();
          obj.observacion = $('#observationPettyCashEdit').val();
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type: "POST",
                  url: "PettyCash/updateDetailPettyCash",
                  data: { obj: obj },
                  success: function (data) {
                      if (data == 'error detail petty cash update') {
                          Swal.fire({
                              type: 'Error',
                              title: 'Oops...',
                              text: 'No se pudo actualizar el gasto, intentelo más tarde',
                            })
                          }else if(data == 'success detail petty cash updated'){
                              Swal.fire({
                                  position: 'center',
                                  type: 'success',
                                  title: 'El gasto se ha actualizado exitosamente',
                                  showConfirmButton: false,
                                  timer: 1000
                              });
                              $('#modalAddSellPettyCash').modal('hide');
                              setTimeout(function () {
                                  location.reload('/pettyCash');
                            }, 1200);
                          }else if(data == 'same value detail petty cash update'){
                            Swal.fire({
                              title: 'No se encontraron cambios...',
                              animation: false,
                              customClass: {
                                popup: 'animated tada'
                              }
                            })
                          }
                  },
                  error:function(jqXHR, textStatus, errorThrown){
                      if (jqXHR.status === 0) {

                          alert('Sin conexión internet: Verificar tu conexion.');
              
                        } else if (jqXHR.status == 404) {
              
                          alert('Página o función no encontrada [404]');
              
                        } else if (jqXHR.status == 500) {
                          $.confirm({
                              title: 'Error interno del servidor [500]',
                              content: 'Ocurrió un error, intente más tarde o contacte al administrador del sistema',
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
              
                          alert('Ha ocurrido un error: ' + jqXHR.responseText);
              
                        }
                      /* alert("HA OCURRIDO UN ERROR: "+error); */
                  },
              });
      }
  });

// Get locations for select in modal "modal_Registro_Caja"
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getLocationTypes",
        success: function(response)
        {
            $('#locationPettyCash').html(response).fadeIn();
        }
});

// Get deductible types for select in modal "modal_Registro_Caja"
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getDeductibleTypes",
        success: function(response)
        {
            $('#deductiblePettyCash').html(response).fadeIn();
        }
});

// Get concepts for select in modal "modal_Registro_Caja"
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getConceptTypes",
        success: function(response)
        {
            $('#conceptPettyCash').html(response).fadeIn();
        }
});

// Get all users as responsables for select in modal "modal_Registro_Caja"
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getAllResponsable",
        success: function(response)
        {
            $('#responsablePettyCash').html(response).fadeIn();
        }
});

// Get all teams for select in modal "modal_Registro_Caja"
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getAllTeams",
        success: function(response)
        {
            $('#teamPettyCash').html(response).fadeIn();
        }
});



});

$("#btnAddPettyCash").click(function(){
  var fecha = new Date();
  var currentYear = fecha.getFullYear();
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: "PettyCash/getLastNumerOfUser",
    success: function(response)
    {
      var obj = $.parseJSON(response);
      if(obj.contar > 0 ){
        var numero_de_caja = 1+parseInt(obj.contar);
        $("#numberPettyCash").val('0'+(numero_de_caja)+'-'+currentYear);
        $("#modalAddPettyCash").modal('show');
      }else{
        $("#numberPettyCash").val('01-'+currentYear);
        $("#modalAddPettyCash").modal('show');
      }
    }
  });

});

function valideDates(){
    var fechaInicial = $("#beginDate").val();
    var fechaFinal = $("#finishDate").val();

    if(Date.parse(fechaFinal) < Date.parse(fechaInicial)){
        //La fecha final es menor que la inicial
        $("#dateMessage").show('fast');
        document.getElementById("submit_petty_cash").outerHTML='<button class="btn btn-success" type="button" id="submit_petty_cash">Registrar</button>'
        setTimeout(() => {
            $("#dateMessage").hide('fast');
        }, 4500);
     }else{
        //La fecha Final es mayor...
        document.getElementById("submit_petty_cash").outerHTML='<button class="btn btn-success" type="submit" id="submit_petty_cash">Registrar</button>'
        /* alert("La fecha Final es mayor"); */
     }
}

function Delete_PettyCash(pettyCash){
    var pettyCash_Numero =  pettyCash.name;
    var pettyCash_Id =  pettyCash.value;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: '¿Está seguro que desea cerrar la caja chica '+pettyCash_Numero+'?',
        text: "Se procederá a cerrar la caja chica!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, completamente!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: false
      }).then((result) => {
        if (result.value) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "PettyCash/disablePettyCash",
                data: {id : pettyCash_Id},
                success: function(data)
                {
                    if(data == 'Petty Cash is disabled'){
                        swalWithBootstrapButtons.fire(
                            'Hecho!',
                            'La caja chica '+pettyCash_Numero+' ha sido cerrada',
                            'success'
                          )
                          setTimeout(() => {
                              location.reload('/pettyCash');
                          }, 1000);
                    }else if(data == 'Petty Cash disabled error'){
                        swalWithBootstrapButtons.fire(
                            'Error!',
                            'La caja no se pudo deshabilitar, intentelo más tarde',
                            'error'
                          )
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

        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelado',
            'La acción ha sido cancelada',
            'error'
          )
        }
      })
}

function Enable_PettyCash(pettyCash){
    var pettyCash_Numero =  pettyCash.name;
    var pettyCash_Id =  pettyCash.value;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: '¿Está seguro que desea habilitar la caja chica '+pettyCash_Numero+'?',
        text: "Se procederá a habilitar la caja chica!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, completamente!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: false
      }).then((result) => {
        if (result.value) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "PettyCash/enablePettyCash",
                data: {id : pettyCash_Id},
                success: function(data)
                {
                    if(data == 'Petty Cash is enabled'){
                        swalWithBootstrapButtons.fire(
                            'Hecho!',
                            'La caja chica '+pettyCash_Numero+' ha sido habilitada',
                            'success'
                          )
                          setTimeout(() => {
                              location.reload('/pettyCash');
                          }, 1000);
                    }else if(data == 'Petty Cash enabled error'){
                        swalWithBootstrapButtons.fire(
                            'Error!',
                            'La caja no se pudo habilitar, intentelo más tarde',
                            'error'
                          )
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

        } else if (
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelado',
            'La acción ha sido cancelada',
            'error'
          )
        }
      })
}

function Delete_DetailPettyCash(detail){
  var id = detail.value;
  var detailName = detail.name;
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })
  
  swalWithBootstrapButtons.fire({
    title: '¿Está seguro que desea eliminar el detalle '+id+' de la caja chica '+detailName+'?',
    text: "Se procederá a eliminar el detalle de la caja chica!, esta acción no se puede corregir",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, completamente!',
    cancelButtonText: 'No, cancelar!',
    reverseButtons: false
  }).then((result) => {
    if (result.value) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "PettyCash/deleteDetailPettyCash",
            data: {id : id},
            success: function(data)
            {
                if(data == 'delete detail is done'){
                    swalWithBootstrapButtons.fire(
                        'Hecho!',
                        'El detalle se ha borrado correctamente',
                        'success'
                      )
                      setTimeout(() => {
                          location.reload('/pettyCash-detail');
                      }, 1000);
                }else if(data == 'delete detail has been failed'){
                    swalWithBootstrapButtons.fire(
                        'Error!',
                        'El detalle no se pudo borrar, intentelo más tarde',
                        'error'
                      )
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

    } else if (
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Cancelado',
        'La acción ha sido cancelada',
        'error'
      )
    }
  })
}

function openModal(PettyCash){
  var number = PettyCash.name;
  var idPetty = PettyCash.value;
  $("#locationPettyCash").val('');
  $("#deductiblePettyCash").val('');
  $("#conceptPettyCash").val('');
  $("#subtotalPettyCash").val('');
  $("#ivaPettyCash").val('');
  $("#totalPettyCash").val('');
  $("#teamPettyCash").val('');
  $("#observationPettyCash").val('');
  document.getElementById('numberPettyCashSell').outerHTML = '<input type="text" class="form-control" id="numberPettyCashSell" name="numberPettyCashSell" readonly>'
  $("#idPettyCash").val(idPetty);
  $("#numberPettyCashSell").val(number);
  $("#modalAddSellPettyCash").modal('show');
}

function iva_sub_total(){
  var option = $("#deductiblePettyCash").val();
  var sub;
  if($("#subtotalPettyCash").val() == ""){sub = 0}else{ sub = parseFloat($("#subtotalPettyCash").val())}
  if(option == 2){
    $("#ivaPettyCash").val('0.00');
    $("#totalPettyCash").val(sub);
  }else{
    var iva = parseFloat($("#ivaPettyCashHide").val());
    $("#ivaPettyCash").val(iva*sub);
    $("#totalPettyCash").val((iva*sub)+sub);
  }

};

function subTotal(){
  var sub;
  var option = $("#deductiblePettyCash").val();
  if($("#subtotalPettyCash").val() == ""){sub = 0}else{ sub = parseFloat($("#subtotalPettyCash").val())}
  if(option == 2){
    $("#ivaPettyCash").val('0.00');
    $("#totalPettyCash").val(sub);
  }else if(option == 1){
    var iva = parseFloat($("#ivaPettyCashHide").val());
    $("#ivaPettyCash").val(iva*sub);
    $("#totalPettyCash").val((iva*sub)+sub);
  }else if(option == ""){
    $("#ivaPettyCash").val('0.00');
    $("#totalPettyCash").val(sub);
  }
}


function iva_sub_total_edit(){
  var option = $("#deductiblePettyCashEdit").val();
  var sub;
  if($("#subtotalPettyCashEdit").val() == ""){sub = 0}else{ sub = parseFloat($("#subtotalPettyCashEdit").val())}
  if(option == 2){
    $("#IVAPettyCashEdit").val('0.00');
    $("#totalPettyCashEdit").val(sub);
  }else{
    var iva = parseFloat($("#ivaEdit").val());
    $("#IVAPettyCashEdit").val(iva*sub);
    $("#totalPettyCashEdit").val((iva*sub)+sub);
  }

};

function subTotal_edit(){
  var sub;
  var option = $("#deductiblePettyCashEdit").val();
  if($("#subtotalPettyCashEdit").val() == ""){sub = 0}else{ sub = parseFloat($("#subtotalPettyCashEdit").val())}
  if(option == 2){
    $("#IVAPettyCashEdit").val('0.00');
    $("#totalPettyCashEdit").val(sub);
  }else if(option == 1){
    var iva = parseFloat($("#ivaEdit").val());
    $("#IVAPettyCashEdit").val(iva*sub);
    $("#totalPettyCashEdit").val((iva*sub)+sub);
  }else if(option == ""){
    $("#IVAPettyCashEdit").val('0.00');
    $("#totalPettyCashEdit").val(sub);
  }
}




