<?php

  require '../../../res/php/app_topHotel.php'; 
  
  $regis  = $_POST['regis'];
  $filas  = $_POST['filas'];
  $codigo = strtoupper($_POST['valorBusqueda']);

  $companias = $hotel->getBuscaPerfilCompania($regis,$filas,$codigo);

  echo json_encode($companias);

?> 
