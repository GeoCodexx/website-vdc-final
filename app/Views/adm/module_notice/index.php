<?= $this->extend('adm/main'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Lista de Noticias</div>
            <div class="card-body">
                <br />
                <button class="btn btn-success" id="addNewNoticeBtn"><i class="fas fa-plus"></i> Nuevo</button>
                <!--<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>-->
                <br />
                <br />
                <table class="table table-hover display nowrap w-100" id="notices-table">
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
<?= $this->include('adm/module_notice/addNoticeModal'); ?>
<?= $this->include('adm/module_notice/editNoticeModal'); ?>
<?= $this->include('adm/module_notice/previewNoticeModal'); ?>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    var csrfName = $('meta.csrf').attr('name'); //CSRF TOKEN NAME
    var csrfHash = $('meta.csrf').attr('content'); //CSRF HASH

    //OPEN MODAL ADD NEW
    $(document).on('click', '#addNewNoticeBtn', function() {
        $('.addNotice').modal('show');
    });
    //ADD NEW ajax
    $('#add-notice-form').submit(function(e) {
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
                        $('#notices-table').DataTable().ajax.reload(null, false);
                        $('.addNotice').modal('hide');
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Se guardó con éxito!',
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


    $('#notices-table').DataTable({
        "processing": false,
        "serverSide": true,
        responsive: true,
        "ajax": "<?= route_to('get.all.notices'); ?>",
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
    $(document).on('click', '#previewNoticeBtn', function() {
        var notice_id = $(this).data('id'); //obtiene del atributo del html button "data-id"

        $.post("<?= route_to('get.notice.info') ?>", {
            notice_id: notice_id,
            [csrfName]: csrfHash
        }, function(data) {

            $("#detail_post_image").attr('src', '<?= base_url('uploads') ?>/' + data.results.Notice_image);
            $("#detail_post_title").text(data.results.Notice_title);
            //$("#detail_post_category").text(response.message.category);
            $("#detail_post_body").text(data.results.Notice_description);
            $("#detail_post_created").text('Publicado: ' + data.results.created_at);
            $('.previewNotice').modal('show'); //FALTA FORMATEAR EL MODAL DE PREVIEW

        }, 'json');
    });

    //FUNCION PARA ABRIREL MODAL Y PASARLE LOS DATOS
    $(document).on('click', '#updateNoticeBtn', function() {
        var notice_id = $(this).data('id'); //obtiene del atributo del html button "data-id"

        $.post("<?= route_to('get.notice.info') ?>", {
            notice_id: notice_id,
            [csrfName]: csrfHash
        }, function(data) {
            //console.log(data);

            $('.editNotice').find('form').find('input[name="nid"]').val(data.results.NoticeID);
            $('.editNotice').find('form').find('input[name="notice_title"]').val(data.results.Notice_title);
            $('.editNotice').find('form').find('textarea[name="notice_description"]').val(data.results.Notice_description);
            $('#imgPreview').html('<img class="img-fluid" src="' + '<?= base_url('uploads') ?>/' + data.results.Notice_image + '" />');
            $('.editNotice').find('form').find('span.error-text').text('');
            $('.editNotice').modal('show');

        }, 'json');
    });

    //FUNCION PARA ENVIAR LOS DATOS YA ACTUALIZADOS
    $('#update-notice-form').submit(function(e) {
        e.preventDefault();
        var form = this;
        var frmData = new FormData(form)

        if (form.notice_image.files.length==0) {
            frmData.delete('notice_image');
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
                        $('#notices-table').DataTable().ajax.reload(null, false);
                        $('.editNotice').modal('hide');
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

    $(document).on('click', '#deleteNoticeBtn', function() {
        var notice_id = $(this).data('id'); //equivalente a "data-id" atributo del boton en html
        var url = "<?= route_to('delete.notice'); ?>";

        swal.fire({

            title: '¿Estas seguro de esta acción?',
            html: 'Eliminar Noticia',
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
                    notice_id: notice_id
                }, function(data) {
                    if (data.code == 1) {
                        $('#notices-table').DataTable().ajax.reload(null, false);
                    } else {
                        alert(data.msg);
                    }
                }, 'json');
            }
        });
    });

    //changeImgNotice
    $("#btnChangeImg").click(function(event) {
        $("#inpImg").fadeIn(1200);
        $(this).fadeOut(1000);
    });

    $("#inptImg").change(function() {

        if (this.files && this.files[0]) {

            var reader = new FileReader();

            reader.readAsDataURL(this.files[0]);

            reader.onload = function(e) {

                $('#update-notice-form + img').remove();

                //$('.editNotice').after('< img src = "'+e.target.result + '"width = "450" height = "300" / > ');
                $('#imgPreview').html('<img class="img-fluid" src="' + e.target.result + '" />');
            }

        }
    });
</script>

<?= $this->endSection(); ?>