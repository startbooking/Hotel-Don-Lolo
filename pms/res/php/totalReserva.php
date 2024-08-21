<?php 

require '../../../res/php/app_topHotel.php'; 

$saldo = $hotel->getSaldoHabitacion('1580');
echo json_encode($saldo).'<br>';

?>