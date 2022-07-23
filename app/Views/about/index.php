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
            <div class="row g-5 shadow">
                <div class="col-sm-12 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="<?= base_url('img/history-about.jpg')?>" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h1 class="mb-4 text-center text-primary">Historia</h1>
                    <p class="mb-4 text-just"> Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-4">
                <div class="col-lg-6 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                            <h5 class="mb-3">Misión</h5>
                            <p class="text-just">Ser una institución educativa pública del nivel inicial y primaria,
                                que brinda una educación integral a niños y niñas del Cerrito de la Libertad,
                                Capaces de liderar y afrontar los problemas demanera eficiente, con un currículo
                                con efoque por competencias, estratégias metodológicas activas y recursos educativos
                                acorde al avance de la ciencia y la tecnología, en un ambiente de sana convivencia libre de violencia.
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <br>
                                &nbsp;<br>
                                &nbsp;
                                <br>
                                &nbsp;
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5 class="mb-3">Visión</h5>
                            <p class="text-just">Al 2022 aspiramos ser una institución educativa con infraestructura moderna e implementada con recursos tecnológicos, reconocida por brindar un servicio de calidad a niños y niñas del Cerrito de la Libertad, con padres de familia involucrados en la educación de sus hijos y docentes actualizados y comprometidos con su práctica pedagógica para la formación integral de los estudiantes basados en el logro de competencias y enfoques transversales del CNEB y de calidad que coadyuven a la construcción de una sociedad democrática, participativa, inclusiva, saludable y con conciencia ambiental.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
    <?= $this->endSection() ?>