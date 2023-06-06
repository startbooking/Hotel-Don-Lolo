<?php

require '../../../res/php/app_topHotel.php';
$cia = $_POST['cia'];

$reten = $hotel->traeRetencionesCia($cia);

echo json_encode($reten);
