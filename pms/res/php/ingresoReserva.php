<?php

require '../../../res/php/app_topHotel.php';

extract($_POST);

$idCentro = 0;

if ($observaciones != '') {
    $observaciones = strtoupper($observa).' Usuario: '.$usuario.' Fecha Observacion: '.date('Y.m.d H:i:s');
}

foreach ($nrohabitacion as $key => $value) {
    $numero = $hotel->getNumeroReserva(); // Numero Actual de La Reserva
    $nuevonumero = $hotel->updateNumeroReserva($numero + 1); // Actualiza Consecutivo de Reserva
    $nuevaReserva = $hotel->insertNuevaReserva($identifica, $llegada, $salida, $noches, $hombres, $mujeres, $ninos, strtoupper($orden), $tipohabi, $value, $tarifahab, $valortar, $origen, $destino, $motivo, $fuente, $segmento, $idhuesped, $empresaUpd, $idCentro, $numero, $usuario, $estadoocupacion, $observaciones, $formapago, 0, $imptoOption, $idusuario, $tipoocupacion);
}

if ($nuevaReserva == 0) {
    echo '0';
} else {
    echo $numero;
}
