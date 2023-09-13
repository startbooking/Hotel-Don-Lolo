<?php

require '../../../res/php/app_topHotel.php';
$idcia = $_POST['idcia'];

$reten = $hotel->traeRetencionesCia($idcia);

echo json_encode($reten);
