$(document).ready(function () {
    setTimeout(() => {
        $.confirm({
            title: 'Atención!',
            content: 'El captcha ha caducado!',
            buttons: {
                Recargar: {
                    text: 'Recargar Página',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function(){
                        location.reload('/');
                    }
                }
            }
        });
    }, 120000);
    
    var cont = 120;
    
    var interval =  setInterval(() => {
        document.getElementById("contadorCaptcha").innerHTML = '<p id="contadorCaptcha">Tiempo disponible de captcha: '+(cont-=1)+' segundos</p>';
            if (cont == 0) {
                clearInterval(interval);
            }
        }, 1000);
    
    
    var msg = 'Campo obligatorio';
    $("#form_Login").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
            nickName: { required: true },
            inputPassword: { required: true },
            captcha: { required: true, number: true }
        },
        messages: {
            captcha: {
                required: msg,
                number: "Solo se aceptan números en este campo"
            },
            nickName: msg,
            inputPassword: msg
        },
        submitHandler: function (form) {
            var usuario = $('#nickName').val();
            var contrasena = $('#inputPassword').val();
            var captcha = $('#captcha').val();
            var obj = new Object();
            obj.user = usuario;
            obj.password = contrasena;
            obj.captcha = captcha;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "General/validaCaptcha",
                data: { obj: obj },
                success: function (data) {
                    /* alert(data); */
                    if (data == 'captcha mal') {
                        alertify.error('La captcha no coincide');
                    } else if (data == 'user OK') {
                        alertify.success('Usuario verificado, Bienvenido');
                        setTimeout(function () {
                            location.href = ''
                        }, 1500);
                    } else if (data == 'wrong password') {
                        alertify.error('Contraseña o usuario incorrectos')
                    }else if(data == 'user not found'){
                        alertify.warning('El usuario no se encuentra en la base de datos')
                    }else if(data == 'default'){
                        location.href('General/Login');
                    }
                },
                erro:function(error){
                    alert("HA OCURRIDO UN ERROR"+error);
                },
            });
        }
    });
});