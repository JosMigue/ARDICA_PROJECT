function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function fileView(boton){
    var nameFile = "uploads/"+boton.value;
    alert(nameFile);
    document.getElementById("viewFile").innerHTML = '<iframe id="viewFile" src="'+nameFile+'" height="200" width="300"></iframe>'
    $("#modalPreviewFile").modal('show');
}


$(document).ready(function () {
    $('#upload_form').on('submit', function (e) {
        e.preventDefault();
        if ($('#image_file').val() == '') {
            alert("Please Select the File");
        }
        else {
            $.ajax({
                url: "Files/fileStore",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (res) {
                    console.log(res.success);
                    if (res.success == true) {
                        $('#blah').attr('src', 'img/no_image_available.jpg');
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: res.msg,
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#modalSubirArchivo').modal('hide');
                    }
                    else if (res.success == false) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'No se pudo guardar el archivo, verifique los tipos permitidos...',
                        })

                        $("#warning-alert-files").show('fast');
                        setTimeout(() => {
                            $("#warning-alert-files").hide('fast');
                        }, 8000);
                        $('#blah').attr('src', 'img/no_image_available.jpg');
                    }
                }
            });
        }
    });
});

function resetModalSubir(){
    setTimeout(() => {
        $("#finput").val('');
        $('#blah').attr('src', 'img/no_image_available.jpg');
    }, 1000);
}
   