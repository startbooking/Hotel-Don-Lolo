<?php

require '../../../res/php/app_topHotel.php';

$eToken = $hotel->datosTokenCia();

echo json_encode($eToken);
