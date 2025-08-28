<?php

// require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$reserva = $_POST['reserva'];

$datosReserva = $hotel->getReservasDatos($reserva);
$datosHuesped = $hotel->getbuscaDatosHuesped($datosReserva['id_huesped']);
$datosCompania = $hotel->getSeleccionaCompania($datosReserva['id_compania']);
$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva['tipo_habitacion']);
$folios = $hotel->getCargosReservaModal($reserva);

$_SESSION['reserva'] = $reserva;
include_once '../../imprimir/imprimeEstadoCuentaHuesped.php';
?>

  