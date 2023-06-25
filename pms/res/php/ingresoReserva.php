<?php

require '../../../res/php/app_topHotel.php';

$idcia = $_POST['empresaUpd'];
$idCentro = 0;

$iden = $_POST['identifica'];
$llegada = $_POST['llegada'];
$salida = $_POST['salida'];
$noches = $_POST['noches'];
$hombres = $_POST['hombres'];
$mujeres = $_POST['mujeres'];
$ninos = $_POST['ninos'];
$tipohabi = $_POST['tipohabi'];
$orden = strtoupper($_POST['orden']);
$nrohabitacion = $_POST['nrohabitacion'];
$tarifahab = $_POST['tarifahab'];
$valortarifa = str_replace('.00', '', $_POST['valortar']);
$valortarifa = str_replace(',', '', $valortarifa);
$valortarifa = round($valortarifa, 0);
$origen = $_POST['origen'];
$destino = $_POST['destino'];
$motivo = $_POST['motivo'];
$fuente = $_POST['fuente'];
$segmento = $_POST['segmento'];
$idhuesp = $_POST['idhuesped'];
$idusuario = $_POST['idusuario'];
$usuario = $_POST['usuario'];
$tipo = $_POST['tipoocupacion'];
$estado = $_POST['estadoocupacion'];
$formapa = $_POST['formapago'];
$impto = $_POST['imptoOption'];
$observa = strtoupper($_POST['observaciones']);

if ($observa != '') {
    $observa = $observa.' Usuario: '.$usuario.' Fecha Observacion: '.date('Y.m.d H:i:s');
}

$numero = $hotel->getNumeroReserva(); // Numero Actual de La Reserva
$nuevonumero = $hotel->updateNumeroReserva($numero + 1); // Actualiza Consecutivo de Reserva

$nuevaReserva = $hotel->insertNuevaReserva($iden, $llegada, $salida, $noches, $hombres, $mujeres, $ninos, $orden, $tipohabi, $nrohabitacion, $tarifahab, $valortarifa, $origen, $destino, $motivo, $fuente, $segmento, $idhuesp, $idcia, $idCentro, $numero, $usuario, $estado, $observa, $formapa, 0, $impto, $idusuario, $tipo);

if ($nuevaReserva == 0) {
    echo '0';
} else {
    echo $numero;
}
