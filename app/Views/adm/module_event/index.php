<?= $this->extend('adm/main'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Lista de Eventos</div>
            <div class="card-body">
                <br />
                <button class="btn btn-success" id="addNewEventBtn"><i class="fas fa-plus"></i> Nuevo</button>
                <!--<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>-->
                <br />
                <br />
                <table class="table table-hover display nowrap w-100" id="events-table">
                    <thead>
                        <th>#</th>
                        <th>TITULO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>FECHA</th>
                        <th>AUTOR</th>
                        <th>IMAGEN</th>
                        <th>OPCIONES</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->include('adm/module_event/addEventModal'); ?>
<?= $this->include('adm/module_event/editEventModal'); ?>
<?= $this->include('adm/module_event/previewEventModal'); ?>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    var csrfName = $('meta.csrf').attr('name'); //CSRF TOKEN NAME
    var csrfHash = $('meta.csrf').attr('content'); //CSRF HASH

    //OPEN MODAL ADD NEW
    $(document).on('click', '#addNewEventBtn', function() {
        $('.addEvent').modal('show');
    });
    //ADD NEW ajax
    $('#add-event-form').submit(function(e) {
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
                        $('#events-table').DataTable().ajax.reload(null, false);
                        $('.addEvent').modal('hide');
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


    $('#events-table').DataTable({
        "processing": false,
        "serverSide": true,
        responsive: true,
        "ajax": "<?= route_to('get.all.events'); ?>",
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
    $(document).on('click', '#previewEventBtn', function() {
        var event_id = $(this).data('id'); //obtiene del atributo del html button "data-id"

        $.post("<?= route_to('get.event.info') ?>", {
            event_id: event_id,
            [csrfName]: csrfHash
        }, function(data) {

            $("#detail_post_image").attr('src', '<?= base_url('uploads') ?>/' + data.results.Event_image);
            $("#detail_post_title").text(data.results.Event_title);
            //$("#detail_post_category").text(response.message.category);
            $("#detail_post_body").text(data.results.Event_description);
            $("#detail_post_created").text('Publicado: '+data.results.created_at);
            $('.previewEvent').modal('show');//FALTA FORMATEAR EL MODAL DE PREVIEW

        }, 'json');
    });

    //FUNCION PARA ABRIREL MODAL Y PASARLE LOS DATOS
    $(document).on('click', '#updateEventBtn', function() {
        var event_id = $(this).data('id'); //obtiene del atributo del html button "data-id"

        $.post("<?= route_to('get.event.info') ?>", {
            event_id: event_id,
            [csrfName]: csrfHash
        }, function(data) {

            $('.editEvent').find('form').find('input[name="eid"]').val(data.results.EventID);
            $('.editEvent').find('form').find('input[name="event_title"]').val(data.results.Event_title);
            $('.editEvent').find('form').find('textarea[name="event_description"]').val(data.results.Event_description);
            $('#imgPreview').html('<img class="img-fluid" src="' + '<?= base_url('uploads') ?>/' + data.results.Event_image + '" />');
            if($('.editEvent').find('form').find('input[name="event_title"]').length>0){
                
            }
            $('.editEvent').find('form').find('span.error-text').text('');
            $('.editEvent').modal('show');

        }, 'json');
    });

    //FUNCION PARA ENVIAR LOS DATOS YA ACTUALIZADOS
    $('#update-event-form').submit(function(e) {
        e.preventDefault();
        var form = this;
        var frmData = new FormData(form)

        if (form.event_image.files.length==0) {
            frmData.delete('event_image');
        }

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            //data: new FormData(form),
            data: frmData,
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function() {
                $(form).find('span.error-text').text('');
            },
            success: function(data) {

                if ($.isEmptyObject(data.error)) {

                    if (data.code == 1) {
                        $('#events-table').DataTable().ajax.reload(null, false);
                        $('.editEvent').modal('hide');
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


    $(document).on('click', '#deleteEventBtn', function() {
        var event_id = $(this).data('id'); //equivalente a "data-id" atributo del boton en html
        var url = "<?= route_to('delete.event'); ?>";

        swal.fire({

            title: '¿Estas seguro de esta acción?',
            html: 'Eliminar Evento',
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
                    event_id: event_id
                }, function(data) {
                    if (data.code == 1) {
                        $('#events-table').DataTable().ajax.reload(null, false);
                    } else {
                        alert(data.msg);
                    }
                }, 'json');
            }
        });
    });

    //changeImgEvent
    $("#btnChangeImg").click(function(event) {
        $("#inpImg").fadeIn(1200);
        $(this).fadeOut(1000);
    });

    $("#inptImg").change(function() {

        if (this.files && this.files[0]) {

            var reader = new FileReader();

            reader.readAsDataURL(this.files[0]);

            reader.onload = function(e) {

                $('#update-event-form + img').remove();

                //$('.editEvent').after('< img src = "'+e.target.result + '"width = "450" height = "300" / > ');
                $('#imgPreview').html('<img class="img-fluid" src="' + e.target.result + '" />');
            }

        }
    });
</script>

<?= $this->endSection(); ?>