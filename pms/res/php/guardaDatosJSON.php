<?php

require_once '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$arcCurl = '../../json/recibeCurl' . $mes . $anio . '.json';
$envCurl = '../../json/enviaFact' . $mes . $anio . '.json';

file_put_contents($envCurl, $envio . ',',  FILE_APPEND | LOCK_EX);
file_put_contents($arcCurl, $recibe . ',',  FILE_APPEND | LOCK_EX);
