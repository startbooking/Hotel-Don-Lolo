<?php

require '../../../../res/php/app_topPos.php';

$factura = $_POST['factura'];
$salida = $_POST['salida'];
$motivo = strtoupper($_POST['motivo']);
$fecha = $_POST['fecha'];
$pref = $_POST['prefijo'];
$usu = $_POST['user'];
$idamb = $_POST['idamb'];
$inv = $_POST['inv'];

$anu = $pos->anulaFactura($factura, $motivo, $usu, $idamb, $fecha);

if ($inv == 1) {
    $anula = $inven->anulaMovimiento($salida, 2, $usu);
}
echo $anu;
