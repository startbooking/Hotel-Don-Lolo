<?php

require '../../../res/php/app_topHotel.php';

$retenciones = $hotel->getRetenciones();

echo json_encode($retenciones);
 