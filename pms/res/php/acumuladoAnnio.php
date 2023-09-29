<?php 

require '../../../res/php/app_topHotel.php'; 

$ventasAnio = $hotel->getDatosAnioAuditoria('2023');
echo json_encode($ventasAnio).'<br>';




?>