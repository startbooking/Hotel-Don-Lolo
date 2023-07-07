<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$reserva = $_POST['reserva'];

$datosReserva = $hotel->getReservasDatos($reserva);
$datosHuesped = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
$datosCompania = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
// $datosAgencia   = $hotel->getSeleccionaAgencia($datosReserva[0]['id_agencia']);
$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);
$folios = $hotel->getCargosReservaModal($reserva);

$_SESSION['reserva'] = $reserva;
include_once '../../imprimir/imprimeEstadoCuentaHuesped.php';
?>

  