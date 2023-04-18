<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$numero = $_POST['numero'];
$motivo = strtoupper($_POST['motivo']);
$reserva = $_POST['reserva'];
$usuario = $_POST['usuario'];
$idusuario = $_POST['idusuario'];

include_once '../../imprimir/imprimeFacturaAnulada.php';

echo 'Inicio';

$cargos = $hotel->actualizaCargosFacturas($numero);
$anula = $hotel->anulaFactura($numero, $motivo, $usuario, $idusuario);
$entra = $hotel->updateEstadoReserva($reserva);

echo $entra;
