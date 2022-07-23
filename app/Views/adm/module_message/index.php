<?= $this->extend('adm/main'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Lista de Mensajes</div>
            <div class="card-body">
                <br />
                <table class="table table-hover display nowrap w-100" id="messages-table">
                    <thead>
                        <th>#</th>
                        <th>EMISOR</th>
                        <th>EMAIL</th>
                        <th>ASUNTO</th>
                        <th>MENSAJE</th>
                        <th>FECHA ENVÍO</th>
                        <th>OPCIONES</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->include('adm/module_message/previewMessageModal'); ?>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    var csrfName = $('meta.csrf').attr('name'); //CSRF TOKEN NAME
    var csrfHash = $('meta.csrf').attr('content'); //CSRF HASH

//$(document).ready(function(){
    $('#messages-table').DataTable({
        "processing": false,
        "serverSide": true,
        responsive: true,
        "ajax": "<?= route_to('get.all.messages'); ?>",
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

//});
    

    //PREVIEW RELEASE
    $(document).on('click', '#previewMessageBtn', function() {
        var message_id = $(this).data('id'); //obtiene del atributo del html button "data-id"

        $.post("<?= route_to('get.message.info') ?>", {
            message_id: message_id,
            [csrfName]: csrfHash
        }, function(data) {

            $('#body-msg').html('<p id="detail_post_body"><strong>Emisor: </strong>'+data.results.Message_names+'</p>'+
            '<p><strong>Email: </strong>'+data.results.Message_email+'</p>'+
            '<p><strong>Asunto: </strong>'+data.results.Message_subject+'</p>'+
            '<p><strong>Fecha: </strong>'+data.results.created_at+'</p>'+
            '<p><strong>Mensaje: </strong><br>'+
            '<p>'+data.results.Message_body+'</p>');
           // $("#detail_msg_created").text('Recibido: ' + data.results.created_at);
            $('.previewMessage').modal('show'); 

        }, 'json');
    });


    $(document).on('click', '#deleteMessageBtn', function() {
        var message_id = $(this).data('id'); //equivalente a "data-id" atributo del boton en html
        var url = "<?= route_to('delete.message'); ?>";

        swal.fire({

            title: '¿Estas seguro de esta acción?',
            html: 'Marcar como Atendido',
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, seguro',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#556eeb',
            width: 300,
            allowOutsideClick: false

        }).then(function(result) {
            if (result.value) {

                $.post(url, {
                    [csrfName]: csrfHash,
                    message_id: message_id
                }, function(data) {
                    if (data.code == 1) {
                        $('#messages-table').DataTable().ajax.reload(null, false);
                    } else {
                        alert(data.msg);
                    }
                }, 'json');
            }
        });
    });
</script>

<?= $this->endSection(); ?>