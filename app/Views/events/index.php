<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<!-- Header Start -->
<div class="container-fluid bg-primary py-3 mb-3 page-header">
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h2 class="display-3 text-white animated slideInDown">Eventos</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Inicio</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Eventos</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<div class="container-xxl py-3">
    <div class="container p-3">
        <div class="row wow fadeInUp" data-wow-delay="0.8s">
            <div class="col-12">
                <div class="card mb-4 border-0 shadow" id="last_event">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 wow fadeInDown" id="show_events" data-wow-delay="1.2s">

        </div>

        <div class="row mt-4">

            <nav aria-label="...">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">2</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>

</div>

<?= $this->endSection() ?>
<?= $this->section('scripts'); ?>
<script>
    //PREVIEW RELEASE
    $(document).ready(function() {

        $.get("<?= route_to('get.event.last') ?>",
        function(data) {
            //console.log(data.message.created_at);

            let date_from = data.message.created_at.substr(0, 10).split(/\-/);
                let p_date = [date_from[2], date_from[1], date_from[0]].join('-');

                $('#last_event').html(
                    '<div class="row g-0"><div class="col-md-6">'+
                    '<img src="<?= base_url('uploads') ?>/' + data.message.Event_image + '" class="img-fluid rounded-start" alt="...">' +
                    '</div><div class="col-md-6"><div class="card-body">' +
                    '<h5 class="card-title">' + data.message.Event_title + '</h5>' +
                    '<p class="card-text" id="detail_event_description">' + data.message.Event_description + '</p>' +
                    '<p class="card-text fst-italic text-end" id="detail_event_created">Publicado: ' + p_date + '</p></div></div></div>'
                ).fadeIn();
                
        });
        
        $.ajax({
            url: '<?= route_to('fetch.events') ?>',
            method: 'get',
            success: function(response) {
                $("#show_events").html(response.message);
            }
        });
    });

    // event detail ajax request
    $(document).delegate('.evnt_link', 'click', function(e) {
        e.preventDefault();
        const id = $(this).attr('id');        
        $.ajax({
            url: '<?= base_url('getEvnt') ?>/' + id,
            method: 'get',
            dataType: 'json',
            success: function(response) {
                let date_from = response.message.created_at.substr(0, 10).split(/\-/);
                let p_date = [date_from[2], date_from[1], date_from[0]].join('-');

                $('html, body').animate({scrollTop: 195}, 10);
                $('#last_event').hide().html(
                    '<div class="row g-0"><div class="col-md-6">'+
                    '<img src="<?= base_url('uploads') ?>/' + response.message.Event_image + '" class="img-fluid rounded-start" alt="...">' +
                    '</div><div class="col-md-6"><div class="card-body">' +
                    '<h5 class="card-title">' + response.message.Event_title + '</h5>' +
                    '<p class="card-text" id="detail_event_description">' + response.message.Event_description + '</p>' +
                    '<p class="card-text fst-italic text-end" id="detail_event_created">Publicado: ' + p_date + '</p></div></div></div>'
                ).fadeIn(1500);
            }

        });
    });
</script>

<?= $this->endSection(); ?>