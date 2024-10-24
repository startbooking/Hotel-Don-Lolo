<?php 

  require '../../../res/php/app_topHotel.php'; 
  // $id  =  $_POST['id'];

$query = "SELECT
    fecha_llegada AS fechaentra,
    fecha_salida AS fechasale,
    COUNT(*) OVER (ORDER BY fecha_llegada) AS llegadas,
    COUNT(*) OVER (ORDER BY fecha_salida) AS salidas
FROM
    reservas_pms
WHERE
    estado = 'ES'
GROUP BY
    fecha_llegada		
ORDER BY
    fecha_llegada ASC";

  $ocupacion = $hotel->creaConsulta($query);

  echo print_r($ocupacion);

?>