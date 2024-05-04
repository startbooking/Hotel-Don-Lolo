<?php

require '../../../res/php/app_topHotel.php';

$reserva = $_POST['reserva'];

$regis = $hotel->regresaCasa($reserva);

echo $regis;
