<?php 
  require '../../../res/php/app_topHotel.php'; 

  $reserva = $_POST['reserva']; 
  $usuario = $_POST['usuario_id']; 

  $acompanantes = $hotel->buscaAcompananteTRA($reserva);
  
  echo json_encode($acompanantes);
