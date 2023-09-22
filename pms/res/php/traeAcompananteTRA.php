<?php 
  require '../../../res/php/app_topHotel.php'; 

  $reserva = $_POST['reserva']; 
  $fecha = $_POST['fecha']; 

  $acompanantes = $hotel->buscaAcompananteTRA($reserva);
  
  echo json_encode($acompanantes);
