<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Educación Primaria</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="/">Inicio</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Servicios</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Educación Primaria</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <!-- About Start -->
    <div class="container-xxl py-3">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 300px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="<?= base_url('img/about.jpg'); ?>" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Educación Básica Regular</h6>
                    <h1 class="mb-4">Nivel Primaria</h1>
                    <p class="mb-4">La Educación Primaria constituye el segundo nivel de la Educación Básica Regular y se desarrolla
durante seis grados. Tiene por objetivo el desarrollo de competencias de los estudiantes el cual es
promovido desde la Educación Inicial. La atención de los estudiantes en el nivel considera los ritmos,
estilos y niveles de aprendizaje, así como, la pluralidad lingüística y cultural. En este nivel se
fortalecen las relaciones de cooperación y corresponsabilidad entre la escuela y la familia para
asegurar el desarrollo óptimo de los estudiantes, así como, enriquecer el proceso educativo.</p>
                    <h5 class="mb-4">Nuestras áreas curriculares:</h5>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Área de Personal Social</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Área de Educación Física</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Área de Arte y Cultura</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Área de Comunicación</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Área de Inglés</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Área de Matemática</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Área de Ciencia y Tecnología</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Área de Educación Religiosa</p>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Competencias Transversales</h6>
                <h1 class="mb-5">Nosotros fomentamos...</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="<?= base_url('img/course-1.jpg'); ?>" alt="">
                    
                        </div>
                        <div class="text-center p-4 pb-1">
                            
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                              
                            </div>
                            <h5 class="mb-4">Arte y Cultura</h5>
                        </div>
     
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="<?= base_url('img/course-2.jpg'); ?>" alt="">
                        
                        </div>
                        <div class="text-center p-4 pb-1">
                        
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                         
                            </div>
                            <h5 class="mb-4">Deporte y Salud</h5>
                            
                        </div>
               
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="<?= base_url('img/course-3.jpg'); ?>" alt="">
                       
                        </div>
                        <div class="text-center p-4 pb-1">
                           
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                          
                            </div>
                            <h5 class="mb-4">Innovación Tecnológica</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Courses End -->


<?= $this->endSection() ?>