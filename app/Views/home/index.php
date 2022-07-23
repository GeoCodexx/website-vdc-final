<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="<?= base_url('img/portada-ws.jpg')?>" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-sm-10 col-lg-8">

                            <h1 class="display-3 text-white animated slideInDown">I.E.I. N° 30011 VIRGEN DEL CARMEN</h1>
                            <p class="fs-5 text-white mb-4 pb-2">Formando futuras promesas del Perú !!</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="<?= base_url('img/portada-ws.jpg')?>" alt="">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-sm-10 col-lg-8">

                        <h1 class="display-3 text-white animated slideInDown">I.E.I. N° 30011 VIRGEN DEL CARMEN</h1>
                            <p class="fs-5 text-white mb-4 pb-2">Formando futuras promesas del Perú !!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-sm-6 col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-child text-primary mb-4"></i>
                        <h5 class="mb-3">Inicial</h5>
                        <p class="text-just">Nos esforzamos por brindar la mejor educación inicial que permite que su niñ@ crezca de manera integral (física, mental y socialmente).</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-book-reader text-primary mb-4"></i>
                        <h5 class="mb-3">Primaria</h5>
                        <p class="text-just">Nosotros estamis para impartir educación nivel básica primaria de calidad, formando talentos para un mejor mañana. <br>&nbsp;</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item text-center pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-user-friends text-primary mb-4"></i>
                        <h5 class="mb-3">Escuela de Padres</h5>
                        <p class="text-just">Asi como se brinda la educación a los estudiantes, los padres de igual manera son la prioridad para complementar la educación de sus hijos.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Service End -->

<!-- Categories Start -->
<div class="container-xxl py-5 category">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">O</h6>
            <h1 class="mb-5">Galería</h1>
        </div>
        <div class="row g-3">
            <div class="col-lg-7 col-md-6">
                <div class="row g-3">
                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="<?= base_url('img/portada-ws.jpg')?>" alt="">
                            
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="<?= base_url('img/1-gallery.jpg')?>" alt="">

                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="<?= base_url('img/4-gallery.jpg')?>" alt="">

                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                <a class="position-relative d-block h-100 overflow-hidden" href="">
                    <img class="img-fluid position-absolute w-100 h-100" src="<?= base_url('img/2-gallery.jpg')?>" alt="" style="object-fit: cover;">
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Categories Start -->

<?= $this->include('adm/module_release/previewReleaseModal'); ?>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    //PREVIEW RELEASE
    $(document).ready(function() {
        $.get("<?= route_to('get.release.last') ?>",
        function(data) {
            //console.log(data.results);
           
            if (data.results!= null) {
                let fa= new Date();//2022-07-09
            let fp= new Date(data.results[0].Release_published_to);
           if (data.results.length>0) {
                
                if (fa <= fp) {
                    $("#contentRelease").html(data.results[0].Release_description);
                    //console.log(data.results.Release_description);
                    if ($(".table-1").length) {
                    // hacer algo aquí si el elemento existe
                        $(".table-1").addClass("table");
                    }
                    $('.previewRelease').modal('show');
                }
            }
            }
           //console.log(data.results[0].Release_description);
            
        }, 'json');
    });
    
</script>

<?= $this->endSection(); ?>