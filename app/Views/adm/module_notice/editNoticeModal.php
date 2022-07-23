<div class="modal fade editNotice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light w-100 text-center" id="exampleModalLabel">Actualizar Información</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= route_to('update.notice'); ?>" method="post" id="update-notice-form">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="nid">
                    <div class="form-group">
                        <label for="">Título:</label>
                        <input type="text" class="form-control" name="notice_title" placeholder="Ingrense el titulo">
                        <span class="text-danger error-text notice_title_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Descripción:</label>
                        <textarea class="form-control" name="notice_description" rows="5"></textarea>
                        <span class="text-danger error-text notice_description_error"></span>
                    </div>

                    <div class="container mb-2">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-6 text center mb-3" id="imgPreview">

                            </div>
                            <div class="col-sm-12 col-md-6 text-center mb-3">
                                <button id="btnChangeImg" type="button" class="btn btn-secondary">Cambiar imagen</button>
                                <div class="form-group mt-2" id="inpImg" style="display:none;">

                                    <input type="file" id="inptImg" class="form-control" name="notice_image" />
                                    <span class="text-danger error-text notice_image_error"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>