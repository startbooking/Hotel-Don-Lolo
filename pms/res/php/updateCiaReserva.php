<?php

require '../../../res/php/app_topHotel.php';
$idcia = $_POST['idcia'];
$idcentro = 0;
$idrese = $_POST['idreserva'];

$update = $hotel->updateCiaReserva($idcia, $idcentro, $idrese);

echo $update;
