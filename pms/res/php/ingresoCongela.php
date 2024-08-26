<?php

session_start();
require '../../../res/php/app_topHotel.php';

$room = $_POST['room'];
$folio = $_POST['folio'];
$idhues = $_POST['idhues'];
$reserva = $_POST['reserva'];
$idcia = $_POST['idcia'];
// $idcentro = $_POST['idcentro'];
$usuario = $_POST['usuario'];
$idUser = $_POST['usuario_id'];

$canti = 1;

$fecha = FECHA_PMS;

$numcongela = $hotel->getNumeroCongela(); // Numero Actual del Abono

$nuevonumero = $hotel->updateNumeroCongela($numcongela + 1); // Actualiza Consecutivo del Abono

/* Verificar Saldo en la cuenta de esa habitacion */
$salida = $hotel->updateReservaHuespedCongela($reserva, $usuario, $idUser, $fecha, $numcongela);
$habSucia = $hotel->updateEstadoHabitacion($room);

echo $salida;

include_once '../../imprimir/imprimeCongelada.php';
