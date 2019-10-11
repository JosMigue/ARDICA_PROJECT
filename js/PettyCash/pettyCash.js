$(document).ready( function(){
    var msg = 'Campo obligatorio';
    $("#form_registro_caja").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
            numberPettyCash: {required: true},
            locationPettyCash: {required: true},
            beginDate: { required: true},
            finishDate: { required: true },
            deductiblePettyCash: { required: true},
            conceptPettyCash: { required: true},
            responsablePettyCash: { required: true},
            teamPettyCash: { required: true},
        },
        messages: {
            numberPettyCash: {
                required: msg
            },
            locationPettyCash: {
                required: msg
            },
            beginDate: {
                required: msg
            },
            finishDate: {
                required: msg
            },
            deductiblePettyCash: {
                required: msg
            },
            conceptPettyCash: {
                required: msg
            },
            responsablePettyCash: {
                required: msg
            },
            teamPettyCash: {
                required: msg
            },
        },
        submitHandler: function (form) {
            obj = new Object;
            obj.numeroCajaChica = $("#numberPettyCash").val();
            obj.localizacionCajaChica = $('#locationPettyCash').val();
            obj.fechaInicio = $('#beginDate').val();
            obj.fechaTermina = $('#finishDate').val();
            obj.deducibleCajaChica = $('#deductiblePettyCash').val();
            obj.conceptoCajaChica= $('#conceptPettyCash').val();
            obj.responsableCajaChica = $('#responsablePettyCash').val();
            obj.equipoCajachica = $('#teamPettyCash').val();

            // RECUERDA FECHA NO MENOR A INICIAL VERIFICAR
            if(Date.parse($('#finishDate').val()) > Date.parse($('#beginDate').val())){
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
             }else{
                Swal.fire({
                    type: 'Error',
                    title: 'Oops...',
                    text: 'Ha ocurrido un error verifique que la fecha final no sea menor que la inicial.',
                  })
             }
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
