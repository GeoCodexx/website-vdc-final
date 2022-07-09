<div class="modal fade editRelease" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light w-100 text-center" id="exampleModalLabel">Actualizar Información</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= route_to('update.release'); ?>" method="post" id="update-release-form">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="rid">
                    <div class="form-group">
                        <label for="">Asunto:</label>
                        <input type="text" class="form-control" name="release_subject" placeholder="Ingrense el asunto">
                        <span class="text-danger error-text release_subject_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Fecha de publicación:</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" id="updFrom" class="form-control datetimepicker-input" name="release_published_from" data-target="#reservationdate">
                            <div class="input-group-append" data-target="#published_from" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <span class="text-danger error-text release_published_from_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Fecha de publicación:</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" id="updTo" class="form-control datetimepicker-input" name="release_published_to" data-target="#reservationdate">
                            <div class="input-group-append" data-target="#published_to" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <span class="text-danger error-text release_published_to_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Contenido:</label>
                        <textarea class="form-control" id="editorUpd" name="release_description" rows="4"></textarea>
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