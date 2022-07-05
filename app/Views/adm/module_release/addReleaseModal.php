<div class="modal fade addRelease" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Comunicado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= route_to('add.release'); ?>" method="post" id="add-release-form" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="">Asunto</label>
                        <input type="text" class="form-control" name="release_subject" placeholder="Ingrese el Asunto aquí">
                        <span class="text-danger error-text release_subject_error"></span>
                    </div>
                    <div class="form-group">
                        <!--<label for="">Contenido</label>
                        <input type="text" class="form-control" name="release_description" placeholder="Ingrese el contenido aquí">-->
                        
                          <label for="" class="form-label">Contenido</label>
                          <textarea class="form-control" name="release_description" rows="10"></textarea>
                        
                        <span class="text-danger error-text release_description_error"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>