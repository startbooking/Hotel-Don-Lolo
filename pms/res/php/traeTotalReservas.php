<?php 
require_once '../../../res/php/app_topHotel.php'; 

$reservas = $hotel->traeReservasTotal();

echo json_encode($reservas);


