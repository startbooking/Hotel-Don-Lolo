<?php

require '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

/* echo $nroFolio.'/n';
echo $nroReserva.'/n';

echo 'Paso ';  */

$valores = $hotel->traeValorRetenciones($nroReserva, $nroFolio);


/* $retenciones = $hotel->getRetenciones(); */

echo json_encode($valores); 
 