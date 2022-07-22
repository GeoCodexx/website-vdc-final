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
                        <th>ASUNTO</th>
                        <th>FECHA PUBLICACIÓN</th>
                        <th>FECHA CADUCIDAD</th>
                        <th>AUTOR</th>
                        <th>OPCIONES</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->include('adm/module_release/addReleaseModal'); ?>
<?= $this->include('adm/module_release/editReleaseModal'); ?>
<?= $this->include('adm/module_release/previewReleaseModal'); ?>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    var csrfName = $('meta.csrf').attr('name'); //CSRF TOKEN NAME
    var csrfHash = $('meta.csrf').attr('content'); //CSRF HASH

    //OPEN MODAL ADD NEW
    $(document).on('click', '#addNewReleaseBtn', function() {
        $('.addRelease').modal('show');
    });

    $('#editorAdd').richText({
        height: 200,
        translations: {
            'title': 'Título',
            'white': 'Blanco',
            'black': 'Negro',
            'brown': 'Brown',
            'beige': 'Beige',
            'darkBlue': 'Azul Oscuro',
            'blue': 'Azul',
            'lightBlue': 'Azul Claro',
            'darkRed': 'Rojo Oscuro',
            'red': 'Rojo',
            'darkGreen': 'Verde Oscuro',
            'green': 'Verde',
            'purple': 'Morado',
            'darkTurquois': 'Turquesa Oscuro',
            'turquois': 'Turquesa',
            'darkOrange': 'Naranja Oscuro',
            'orange': 'Naranja',
            'yellow': 'Amarillo',
            'imageURL': 'Imagen URL',
            'fileURL': 'Archivo URL',
            'linkText': 'Texto del Link',
            'url': 'URL',
            'size': 'Tamaño',
            'responsive': 'Responsivo',
            'text': 'Texto',
            'openIn': 'Open in',
            'sameTab': 'Same tab',
            'newTab': 'New tab',
            'align': 'Alinear',
            'left': 'Izquierda',
            'center': 'Centro',
            'right': 'Derecha',
            'rows': 'Filas',
            'columns': 'Columnas',
            'add': 'Agregar',
            'pleaseEnterURL': 'Ingresa una URL',
            'videoURLnotSupported': 'Video URL no soportado',
            'pleaseSelectImage': 'Seleccione una imagen',
            'pleaseSelectFile': 'Seleccione un archivo',
            'bold': 'Negrita',
            'italic': 'Italica',
            'underline': 'Subrayado',
            'alignLeft': 'Alinear a la izquierda',
            'alignCenter': 'Alinear al centro',
            'alignRight': 'Alinear a la derecha',
            'addOrderedList': 'Agregar lista ordenada',
            'addUnorderedList': 'Agregar lista desordenada',
            'addHeading': 'Agregar Encabezado/Título',
            'addFont': 'Agregar tipo de letra',
            'addFontColor': 'Agregar color de letra',
            'addFontSize': 'Agregar tamaño de letra',
            'addImage': 'Agregar imagen',
            'addVideo': 'Agregar video',
            'addFile': 'Agregar archivo',
            'addURL': 'Agregar URL',
            'addTable': 'Agregar tabla',
            'removeStyles': 'Quitar estilos',
            'code': 'Mostrar código HTML',
            'undo': 'Deshacer',
            'redo': 'Rehacer',
            'close': 'Cerrar'
        }
    });

    $('#editorUpd').richText({
        //height: 200,
        adaptiveHeight: true
    });


    $(document).on('click', '#clsModal', function() {
        //EDITOR TEXT
        $('#release-subj').val('');
        $('#editorAdd').val('').trigger('change');
        $('#addFrom').datepicker('update', '');
        $('#addTo').datepicker('update', '');

    });


    //DATE PICKER 
    $('#addFrom').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: 'true',
        language: 'es'
    });
    $('#addTo').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: 'true',
        language: 'es'
    });

    $('#updFrom').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: 'true',
        language: 'es'
    });
    $('#updTo').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: 'true',
        language: 'es'
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
                        $(form)[0].reset();
                        $('#editor').unRichText();
                        $('.published').datepicker('update', '');
                        $('#releases-table').DataTable().ajax.reload(null, false);
                        $('.addRelease').modal('hide');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Se ha guardado con éxito!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        alert(data.msg);
                    }
                } else {
                    $.each(data.error, function(prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val);
                    });
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'Por favor rellena todos los campos del formulario.'
                    })
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

    //PREVIEW RELEASE
    $(document).on('click', '#previewReleaseBtn', function() {
        var release_id = $(this).data('id'); //obtiene del atributo del html button "data-id"

        $.post("<?= route_to('get.release.info') ?>", {
            release_id: release_id,
            [csrfName]: csrfHash
        }, function(data) {
            /*
            let date_from = data.results.Release_published_from.substr(0, 10).split(/\-/);
            let f_df = [date_from[2], date_from[1], date_from[0]].join('-');
            let date_to = data.results.Release_published_to.substr(0, 10).split(/\-/);
            let t_dt = [date_to[2], date_to[1], date_to[0]].join('-')*/
            $("#contentRelease").html(data.results.Release_description);
            if ($(".table-1").length) {
                // hacer algo aquí si el elemento existe
                $(".table-1").addClass("table");
            }
            $('.previewRelease').modal('show');

        }, 'json');
    });

    //FUNCION PARA ABRIREL MODAL Y PASARLE LOS DATOS
    $(document).on('click', '#updateReleaseBtn', function() {
        var release_id = $(this).data('id'); //obtiene del atributo del html button "data-id"

        $.post("<?= route_to('get.release.info') ?>", {
            release_id: release_id,
            [csrfName]: csrfHash
        }, function(data) {
            let date_from = data.results.Release_published_from.substr(0, 10).split(/\-/);
            let f_df = [date_from[2], date_from[1], date_from[0]].join('-');
            let date_to = data.results.Release_published_to.substr(0, 10).split(/\-/);
            let t_dt = [date_to[2], date_to[1], date_to[0]].join('-')

            $('.editRelease').find('form').find('input[name="rid"]').val(data.results.ReleaseID);
            $('.editRelease').find('form').find('input[name="release_subject"]').val(data.results.Release_subject);
            $('#updFrom').datepicker('update', f_df);
            $('#updTo').datepicker('update', t_dt);
            $('#editorUpd').val(data.results.Release_description).trigger('change');
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
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Se guardaron los cambios.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        alert(data.msg);
                    }

                } else {
                    $.each(data.error, function(prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val);
                    });

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Por favor rellena todo los campos del formulario'
                    })
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

    //EditorText
    //tinymce.init({selector:'#editor', language: 'es_MX', height : "340"});
    //let myContent = tinymce.get("#editor").getContent();
</script>

<?= $this->endSection(); ?>