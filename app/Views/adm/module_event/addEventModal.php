<div class="modal fade addEvent" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light w-100 text-center" id="staticBackdropLabel">Nuevo Comunicado</h5>
                <button type="button" class="btn-close btn-close-white" id="clsModal" data-bs-dismiss="modal" aria-label="Close"></button>
                <!--<span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= route_to('add.event'); ?>" method="post" id="add-event-form" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="">Título:</label>
                        <input type="text" class="form-control" id="event-title" name="event_title" placeholder="Ingrese el Asunto aquí">
                        <span class="text-danger error-text release_title_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">Descripción:</label>
                        <textarea class="form-control" name="event_description" rows="5"></textarea>

                        <span class="text-danger error-text event_description_error"></span>
                    </div>
                    <div class="form-group">
                      <label for="" class="form-label">Seleccione una Imagen:</label>
                      <input type="file" class="form-control"  name="event_image"/>
                      <span class="text-danger error-text event_image_error"></span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>