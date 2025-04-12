<?php

require '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$retencion = $hotel->calculaReteIVAFactura($numero);

echo $retencion;
