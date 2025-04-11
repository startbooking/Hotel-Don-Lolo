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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <title>SACTel Cloud | Facturacion Electronica</title>

  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/plugins/fontawesome-free/css/all.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_VIE;?>public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo BASE_CSS;?>style.css">
  <link rel="stylesheet" href="<?php echo BASE_FE;?>res/css/fe.css">
  <script src="<?php echo BASE_VIE;?>/public/plugins/jquery/jquery.min.js"></script>

</head>
<body class="hold-transition layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img style="border-radius:50%" class="animation__wobble" src="<?php echo BASE_IMG;?>/logoBarahona.png" alt="SACTelCLoud" height="60" width="60">
  </div>

<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">FACTURACION ELECTRONICA </a>
      </li>
    </ul>
    
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

  <aside class="main-sidebar sidebar-dark-primary">
    <a href="<?php echo BASE_VIE; ?>modulos.php" class="brand-link fw6">
      <img src="<?php echo BASE_IMG; ?>logoBarahona.png" alt="SACTel Cloud" class="brand-image img-circle elevation-3">
      <span class="brand-text">Pagina Principal</span>
    </a>

    <div class="sidebar">     
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <span class="material-symbols-outlined">bubble_chart</span>
              <p> Datos 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="proveedores" class="nav-link">
                <span class="material-symbols-outlined">group</span>
                  <p> Proveedores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="productos" class="nav-link">
                <span class="material-symbols-outlined">filter_9_plus</span>
                  <p> Compras / Servicios</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="facturas" class="nav-link">
            <span class="material-symbols-outlined">payments</span>
              <p> Factura Electronica</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="docSoporte" class="nav-link">
              <span class="material-symbols-outlined">receipt_long</span>
              <p> Documento Soporte</p>
            </a>
          </li>          
          <li class="nav-item">
            <a href="#" class="nav-link">
            <span class="material-symbols-outlined">tune</span>
              <p>Configuracion <i class="fas fa-angle-left right"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Terminos de Pagos</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="formaPagos" class="nav-link">
                  <!-- <i class="far fa-circle nav-icon"></i> -->
                  <span class="material-symbols-outlined">currency_exchange</span>
                  <p>Formas de Pago</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="impuestos" class="nav-link">
                  <span class="material-symbols-outlined">percent</span>
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