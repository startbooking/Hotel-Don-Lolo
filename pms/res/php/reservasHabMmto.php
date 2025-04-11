<?php
  require_once '../../../res/php/titles.php';
  require_once '../../../res/php/app_topHotel.php';

  $nroHab = $_POST['nroHab'];
  $desde = $_POST['desde'];
  $hasta = $_POST['hasta'];


  $query = "SELECT 
  num_reserva, fecha_llegada, fecha_salida, nombre_completo
  FROM
  reservas_pms, huespedes
  WHERE 
  reservas_pms.id_huesped = huespedes.id_huesped AND 
  (num_habitacion = '$nroHab' AND 
  fecha_llegada >= '$desde' AND 
  fecha_salida <= '$hasta') OR 
  reservas_pms.id_huesped = huespedes.id_huesped AND
  (num_habitacion = '$nroHab' AND 
  fecha_llegada <= '$desde' AND 
  fecha_salida >= '$hasta')";

  $habita = $hotel->buscaHabitacionesMmto($query);

  echo json_encode($habita);
   
  // SELECT WHERE num_habitacion = $nroHab';
  
  

  ?>


