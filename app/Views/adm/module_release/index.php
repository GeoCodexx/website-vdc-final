<?= $this->extend('adm/main'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Lista de Comunicados</div>
            <div class="card-body">
        <br />
        <button class="btn btn-success" id="addNewReleaseBtn"><i class="fas fa-plus"></i> Nuevo</button>
        <!--<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>-->
        <br />
        <br />  
                <table class="table table-hover display nowrap w-100" id="releases-table">
                    <thead>
                        <th>#</th>
                        <th>Asunto</th> 
                        <th>Contenido</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                        <th>Autor</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->include('adm/module_release/addReleaseModal'); ?>
<?= $this->include('adm/module_release/editReleaseModal'); ?>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    var csrfName = $('meta.csrf').attr('name'); //CSRF TOKEN NAME
    var csrfHash = $('meta.csrf').attr('content'); //CSRF HASH

    //OPEN MODAL ADD NEW
    $(document).on('click', '#addNewReleaseBtn', function() {
        
        $('.addRelease').modal('show');
    });
      
    
    //ADD NEW ajax
    $('#add-release-form').submit(function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function() {
                $(form).find('span.error-text').text('');
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    if (data.code == 1) {
                        //$(form)[0].reset();
                        $('#releases-table').DataTable().ajax.reload(null, false);
                        $('.addRelease').modal('hide');
                    } else {
                        alert(data.msg);
                    }
                } else {
                    $.each(data.error, function(prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val);
                    });
                }
            }
        });
    });


    $('#releases-table').DataTable({
        "processing": false,
        "serverSide": true,
        responsive: true,
        "ajax": "<?= route_to('get.all.releases'); ?>",
        "dom": "lBfrtip",
        stateSave: true,
        info: true,
        "iDisplayLength": 5,
        "pageLength": 5,
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "Todo"]
        ],
        "fnCreatedRow": function(row, data, index) {
            $('td', row).eq(0).html(index + 1);
        },
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros)",
            "search": "Buscar",
            "paginate": {
                "previous": "<",
                "next": ">"
            }
        }
    });

    //FUNCION PARA ABRIREL MODAL Y PASARLE LOS DATOS
    $(document).on('click', '#updateReleaseBtn', function() {
        var release_id = $(this).data('id');

        $.post("<?= route_to('get.release.info') ?>", {
            release_id: release_id,
            [csrfName]: csrfHash
        }, function(data) {

            $('.editRelease').find('form').find('input[name="rid"]').val(data.results.ReleaseID);
            $('.editRelease').find('form').find('input[name="release_subject"]').val(data.results.Release_subject);
            $('.editRelease').find('form').find('input[name="release_description"]').val(data.results.Release_description);
            $('.editRelease').find('form').find('span.error-text').text('');
            $('.editRelease').modal('show');
        }, 'json');
    });

    //FUNCION PARA ENVIAR LOS DATOS YA ACTUALIZADOS
    $('#update-release-form').submit(function(e) {
        e.preventDefault();
        var form = this;

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function() {
                $(form).find('span.error-text').text('');
            },
            success: function(data) {

                if ($.isEmptyObject(data.error)) {

                    if (data.code == 1) {
                        $('#releases-table').DataTable().ajax.reload(null, false);
                        $('.editRelease').modal('hide');
                    } else {
                        alert(data.msg);
                    }

                } else {
                    $.each(data.error, function(prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val);
                    });
                }
            }
        });
    });


    $(document).on('click', '#deleteReleaseBtn', function() {
        var release_id = $(this).data('id'); //equivalente a "data-id" atributo del boton en html
        var url = "<?= route_to('delete.release'); ?>";

        swal.fire({

            title: '¿Estas seguro de esta acción?',
            html: 'Eliminar Comunicado',
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, eliminar',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556eeb',
            width: 300,
            allowOutsideClick: false

        }).then(function(result) {
            if (result.value) {

                $.post(url, {
                    [csrfName]: csrfHash,
                    release_id: release_id
                }, function(data) {
                    if (data.code == 1) {
                        $('#releases-table').DataTable().ajax.reload(null, false);
                    } else {
                        alert(data.msg);
                    }
                }, 'json');
            }
        });
    });
</script>

<?= $this->endSection(); ?>