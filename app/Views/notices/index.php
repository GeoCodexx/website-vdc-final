
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Noticias</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Inicio</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Noticias</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <div class="container-xxl py-3 wow fadeInUp" data-wow-delay="1s">
    <div class="container p-5">
        <div class="row">
                <div class="col-12">
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0">
                        <div class="col-md-6">
                        <img src="img/cat-2.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">TITULO</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                            Some quick example text to build on the card title and make up the bulk of the card's content.
                            Some quick example text to build on the card title and make up the bulk of the card's content.
                            Some quick example text to build on the card title and make up the bulk of the card's content.
                            Some quick example text to build on the card title and make up the bulk of the card's content.
                            Some quick example text to build on the card title and make up the bulk of the card's content.
                            Some quick example text to build on the card title and make up the bulk of the card's content.
                            Some quick example text to build on the card title and make up the bulk of the card's content.
                            </p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>  
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 wow fadeInDown" data-wow-delay="0.8s">
            
            <div class="col">
                <a href="#">
                    <div class="card h-100 shadow card-border">
                        <img src="img/course-1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="#">
                    <div class="card h-100 shadow card-border">
                        <img src="img/course-2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="#">
                    <div class="card h-100 shadow card-border">
                        <img src="img/course-3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </a>
            </div>
            
        </div>

        <div class="row mt-4">
            
            <nav aria-label="...">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                    <span class="page-link"><</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                    <span class="page-link">2</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">></a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>    
    
</div>
    
<?= $this->endSection() ?>