<div class="modal fade addRelease" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light w-100 text-center" id="staticBackdropLabel">Nuevo Comunicado</h5>
                <button type="button" class="btn-close btn-close-white" id="clsModal" data-bs-dismiss="modal" aria-label="Close"></button>
                <!--<span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= route_to('add.release'); ?>" method="post" id="add-release-form" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="">Asunto:</label>
                        <input type="text" class="form-control" id="release-subj" name="release_subject" placeholder="Ingrese el Asunto aquí">
                        <span class="text-danger error-text release_subject_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Fecha de publicación:</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" id="addFrom" class="form-control datetimepicker-input" name="release_published_from" data-target="#reservationdate" placeholder="dd-mm-aaaa">
                            <div class="input-group-append" data-target="#published_from" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>

                        <span class="text-danger error-text release_published_from_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Fecha de publicación:</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input type="text" id="addTo" class="form-control datetimepicker-input" name="release_published_to" data-target="#reservationdate" placeholder="dd-mm-aaaa">
                            <div class="input-group-append" data-target="#published_to" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <span class="text-danger error-text release_published_to_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">Contenido:</label>
                        <textarea class="form-control" id="editorAdd" name="release_description" rows="4"></textarea>

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