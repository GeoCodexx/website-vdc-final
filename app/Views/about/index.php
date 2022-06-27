<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
    
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Nosotros</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Inicio</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Nosotros</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="img/about.jpg" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Nosotros</h6>
                    <h1 class="mb-4">Historia</h1>
                    <p class="mb-4 text-break"> Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <!--<p class="mb-4">Valores que nos respaldan:</p>-->
                    <h4 class="mb-4">Valores que nos respaldan:</h4>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Respeto</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Responsabilidad</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Humildad</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Honestidad</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Solidaridad</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Compañerismo</p>
                        </div>
                    </div>
                    <!--<a class="btn btn-primary py-3 px-5 mt-2" href="">Leer mas...</a>-->
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
        <!-- Service Start -->
        <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                            <h5 class="mb-3">Misión</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5 class="mb-3">Visión</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
    <?= $this->endSection() ?>