<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$codigo = $_POST['codigo'];
$textcodigo = $_POST['textcodigo'];
$valor = $_POST['valor'];
$refer = strtoupper($_POST['refer']);
$detalle = strtoupper($_POST['detalle']);
$idhues = $_POST['idhues'];
$numero = $_POST['numero'];
$room = $_POST['room'];
$folio = 1;
$canti = 1;
$usuario = $_POST['usuario'];
$idusuario = $_POST['idusuario'];

$fecha = FECHA_PMS;

$numabono = $hotel->getNumeroAbono(); // Numero Actual del Abono
$nuevo = $numabono + 1;
$nuevonumero = $hotel->updateNumeroAbonos($nuevo); // Actualiza Consecutivo del Abono

$abono = $hotel->insertAbonosCuenta($codigo, $textcodigo, $valor, $refer, $detalle, $numero, $room, $idhues, $folio, $canti, $usuario, $idusuario, $fecha, $numabono);

$_SESSION['abono'] = $numabono;
$numero = $numabono;
$_SESSION['reserva'] = $numero;
$_SESSION['idperfil'] = $idhues;

// / include '../../paginas/imprimeAbono.php';
include '../../imprimir/imprimeAbonoEstadia.php';
