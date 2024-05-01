<?php

  require '../../../res/php/app_topHotel.php'; 
  
  $regis  = $_POST['regis'];
  $filas  = $_POST['filas'];
  $codigo = strtoupper($_POST['valorBusqueda']);

  $huespedes = $hotel->getBuscaPerfilHuesped($regis,$filas,$codigo);

  echo json_encode($huespedes);

?> 
