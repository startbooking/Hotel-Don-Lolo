<?php

require '../../../res/php/app_topHotel.php';

extract($_POST);

$ciudad = $ciudadHue;

if($tipodoc == 8 || $tipodoc == 9 ){
  $tipoEmpresaAdi = 0 ; 
  $codigoCiiuAdi = 0;
  $tipoAdquiriente = 0 ;
  $tipoResponsabilidad = 0 ;
  $responsabilidadTribu = 0;
}else{
  $depto = ""; 
}

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

$nuevaCompania = $hotel->insertaNuevaCompania($nit, $dv, $tipodoc, strtoupper($compania), strtoupper($direccion), $ciudad, $telefono, $celular, $web, $correo, $tarifa, $formapago, $creditOption, $montocredito, $diascredito, $diacorte, $usuario, $tipoEmpresaAdi, $codigoCiiuAdi, $tipoAdquiriente, $tipoResponsabilidad, $responsabilidadTribu, $reteIva, $reteIca, $reteFte, $baseRet, $paices, strtoupper($depto));

echo json_encode($nuevaCompania);
