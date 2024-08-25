<?php

require_once '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$regis = $hotel->estadisticasHuesped($id);

echo $regis;
