<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="<?php echo BASE_IMG; ?>logoBarahona.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet"> -->
  <!-- https://material.io/resources/icons/?style=outline -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet"> -->
  <!-- https://material.io/resources/icons/?style=round -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet"> -->
  <!-- https://material.io/resources/icons/?style=sharp -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet"> -->
  <!-- https://material.io/resources/icons/?style=twotone -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Two+Tone" rel="stylesheet"> -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <title>SACTel Cloud | Facturacion Electronica</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/plugins/fontawesome-free/css/all.min.css">

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_CSS;?>style.css">

  <link rel="stylesheet" href="<?php echo BASE_FE;?>res/css/fe.css">

  <!-- jQuery -->
  <script src="<?php echo BASE_VIE;?>/public/plugins/jquery/jquery.min.js"></script>

</head>
<body class="hold-transition layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img style="border-radius:50%" class="animation__wobble" src="<?php echo BASE_IMG;?>/logoBarahona.png" alt="SACTelCLoud" height="60" width="60">
  </div>

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">FACTURACION ELECTRONICA </a>
      </li> -->
    </ul>
    
    <!-- Right navbar links --> 
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="<?php echo BASE_VIE; ?>modulos.php" class="brand-link">
      <img src="<?php echo BASE_IMG; ?>logoBarahona.png" alt="SACTel Cloud" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Pagina Principal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex"> -->
        <!-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <!-- <div class="info">
          <a id="nombreUsuario" href="#" class="d-block">USUARIO ACTIVO</a>
        </div> -->
      <!-- </div> -->

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="facturas" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Factura Electronica</p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Ingresos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="notasCredito" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nota Credito FE</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="NotasDebito" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nota Debito FE</p>
                </a>
              </li>
            </ul>
          </li> -->          
          <li class="nav-item">
            <a href="docSoporte" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Documento Soporte</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>Datos 
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="proveedores" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proveedores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="productos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <span class="material-symbols-outlined">tune</span>
              <!-- <i class="nav-icon fas fa-edit"></i> -->
              <p>
                Configuracion
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Terminos de Pagos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Formas de Pago</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/editors.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Impuestos</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="items" class="nav-link">
                <span class="material-symbols-outlined">collections_bookmark</span>
                  <p>Items / Productos</p>
                </a>
              </li> -->
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <span class="material-symbols-outlined">logout</span>
              <p>
                Cerrar Sesion</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>