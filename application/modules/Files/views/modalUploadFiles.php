<div class="modal fade" id="modalSubirArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Subir archivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="resetModalSubir()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
            <div class="alert alert-danger" id="warning-alert-files" role="alert" style="display: none; margin-top:10px;"> <p style="text-align: justify;">Los tipos permitidos en el sistema son imágenes (JPG, PNG, JPEG) y documentos de texto (docx, doc, xlsx, xls, pdf).</p> </div>
                    <form method="post" id="upload_form" enctype="multipart/form-data">
                        <div class="text-center">
                            <img id="blah" src="img/no_image_available.jpg" style="margin-top: 30px;" alt="Previsualización no disponible" /></br></br>
                        </div>
                        <input class="form-control" type="file" name="image_file" multiple="true" id="finput"
                            onchange="readURL(this)"></br></br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="resetModalSubir()" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success">Subir archivo</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>