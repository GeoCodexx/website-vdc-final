<div class="modal fade editRelease" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Release</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form action="<?= route_to('update.release'); ?>" method="post" id="update-release-form">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="rid">
                           <div class="form-group">
                              <label for="">Asunto</label>
                              <input type="text" class="form-control" name="release_subject" placeholder="Ingrense el asunto">
                              <span class="text-danger error-text country_name_error"></span>
                           </div>
                           <div class="form-group">
                               <label for="">Contenido</label>
                               <input type="text" class="form-control" name="release_description" placeholder="Ingrese el contenido del comunicado"> 
                               <span class="text-danger error-text capital_city_error"></span>
                           </div>
                           <div class="form-group">
                              <button type="submit" class="btn btn-block btn-success">Guardar</button>
                           </div>
                    </form>
            </div>
        </div>
    </div>
</div>