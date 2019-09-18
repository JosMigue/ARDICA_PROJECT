/* function readURL(input) {
    if (input.files & amp;& amp; input.files[0];) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
} */


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
                    }
                }
            });
        }
    });
});
   