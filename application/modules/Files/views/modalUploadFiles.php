<div class="modal fade" id="modalSubirArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                    <form method="post" id="upload_form" enctype="multipart/form-data">
                        <img id="blah" src="img/no_image_available.jpg" alt="your image" /></br></br>
                        <input class="form-control" type="file" name="image_file" multiple="true" id="finput"
                            onchange=""></br></br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success">Subir archivo</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>