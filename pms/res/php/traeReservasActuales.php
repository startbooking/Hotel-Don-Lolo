<?php

require '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$query = "SELECT num_habitacion, fecha_llegada, fecha_salida FROM reservas_pms WHERE tipo_habitacion = '$tipo' AND (estado = 'CA' OR estado = 'ES') ORDER BY num_habitacion";

$reservas = $hotel->creaConsulta($query);
 
 echo json_encode($reservas);
 
?>
  



