<?php

require '../../../res/php/app_topHotel.php';

extract($_POST);

$reteIva = 0;
$reteFte = 0;
$reteIca = 0;
$baseRet = 0;

if (isset($_POST['reteIva'])) {
    $reteIva = 1;
}
if (isset($_POST['reteIca'])) {
    $reteIca = 1;
}

if (isset($_POST['retefuente'])) {
    $reteFte = 1;
} 

if (isset($_POST['sinBaseRetencion'])) {
    $baseRet = 1;
}

$updateCompania = $hotel->updateCompania($txtIdCiaUpd, $nitUpd, $dv, $tipodoc, strtoupper($compania), strtoupper($direccion), $ciudad, $telefono, $celular, $web, $correo, $tarifa, $formapago, $creditOption, $montocredito, $diascredito, $diacorte, $tipoEmpresaUpd, $codigoCiiuUpd, $tipoAdquiriente, $tipoResponsabilidad, $responsabilidadTribu, $reteIva, $reteIca, $reteFte, $baseRet);

echo json_encode($updateCompania);
