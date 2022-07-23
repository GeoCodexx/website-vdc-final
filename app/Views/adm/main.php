<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>" class="csrf">
  <title><?= (isset($title)) ? $title : 'Document'; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css'); ?>">
  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="<?= base_url('plugins/bootstrap5/css/bootstrap.min.css'); ?>">
  <!--  Datatables -->
  <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs5/css/dataTables.bootstrap5.min.css'); ?>">
  <!--  extension responsive  -->
  <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs5/css/responsive.bootstrap5.min.css'); ?>">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

  <link rel="stylesheet" href="<?= base_url('plugins/rich-text/css/richtext.min.css'); ?>">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link">Inicio</a>
        </li>
      </ul>
      <!-- Right navbar links -->

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-info elevation-4">

      <a href="<?= base_url('admin/dashboard'); ?>" class="brand-link logo-switch ms-4">
        <img src="<?= base_url('img/logo_fake.png'); ?>" alt="Logo Large" class="brand-image-xl logo-xl">
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url('dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <span class="d-block"><?= ucfirst($userInfo['User_name']) . " " . ucfirst($userInfo['User_lastname_01']); ?></span>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= site_url('admin/dashboard'); ?>" class="nav-link <?= (current_url() == base_url('admin/dashboard')) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Escritorio

                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('admin/releases'); ?>" class="nav-link <?= (current_url() == base_url('admin/releases')) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>
                  Comunicados

                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('admin/eventos'); ?>" class="nav-link <?= (current_url() == base_url('admin/eventos')) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                  Eventos

                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('admin/noticias'); ?>" class="nav-link <?= (current_url() == base_url('admin/noticias')) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>
                  Noticias

                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('admin/messages'); ?>" class="nav-link <?= (current_url() == base_url('admin/messages')) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-mail-bulk"></i>
                <p>
                  Mensajes
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('admin/signout') ?>" class="nav-link <?= (current_url() == base_url('admin/signout')) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                  Cerrar Sesión
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= (isset($title)) ? $title : 'Document'; ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Inicio</a></li>
                <li class="breadcrumb-item active"><?= (isset($title)) ? $title : 'Document'; ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">

          <?= $this->renderSection('content') ?>

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Ver 1.0
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; <?php echo date('Y'); ?> | I.E.I. N° 30011 - Virgen del Carmen</a>.</strong> Todos los derechos reservados.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="<?= base_url('plugins/jquery/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('plugins/bootstrap5/js/bootstrap.bundle.min.js'); ?>"></script>
  <!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
  <!--   Datatables  -->
  <script src="<?= base_url('plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?= base_url('plugins/datatables-bs5/js/dataTables.bootstrap5.min.js'); ?>"></script>
  <!-- extension responsive -->
  <script src="<?= base_url('plugins/datatables-bs5/js/dataTables.responsive.min.js'); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('dist/js/adminlte.min.js'); ?>"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="<?= base_url('plugins/datepicker/bootstrap-datepicker.es.min.js'); ?>"></script>

  <script src="<?= base_url('plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

  <script src="<?= base_url('plugins/rich-text/js/jquery.richtext.min.js'); ?>"></script>


  <?= $this->renderSection('scripts'); ?>
</body>

</html>