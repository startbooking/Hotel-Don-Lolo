<?php 
require_once '../../../res/php/app_topHotel.php'; 

$camareras = $hotel->traeCamareras();

echo json_encode($camareras);


