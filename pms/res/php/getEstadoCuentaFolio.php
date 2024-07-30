<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$reserva = $_POST['reserva'];

extract($_POST);

include_once '../../imprimir/imprimeEstadoCuentaFolio.php'; 

?>

   