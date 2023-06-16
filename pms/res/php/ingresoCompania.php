<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$nit = strtoupper($_POST['nit']);
$dv = $_POST['dv'];
$tipodoc = $_POST['tipodoc'];
$compania = strtoupper($_POST['compania']);
$direccion = strtoupper($_POST['direccion']);
$ciudad = strtoupper($_POST['ciudad']);
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$web = $_POST['web'];
$correo = strtolower($_POST['correo']);
$tarifa = $_POST['tarifa'];
$formapago = $_POST['formapago'];
$credito = $_POST['creditOption'];
$monto = $_POST['montocredito'];
$diascre = $_POST['diascredito'];
$diacorte = $_POST['diacorte'];
$usuario = $_POST['usuario'];
$idusuario = $_POST['idusuario'];
$tipoemp = $_POST['tipoEmpresaAdi'];
$codciiu = $_POST['codigoCiiuAdi'];
$tipoAdqui = $_POST['tipoAdquiriente'];
$tipoRespo = $_POST['tipoResponsabilidad'];
$repoTribu = $_POST['responsabilidadTribu'];

$reteIva = 0;
$reteFte = 0;
$reteIca = 0;

if (isset($_POST['reteIva'])) {
    $reteIva = 1;
}
if (isset($_POST['reteIca'])) {
    $reteIca = 1;
}

if (isset($_POST['retefuente'])) {
    $reteFte = 1;
}

$nuevaCompania = $hotel->insertaNuevaCompania($nit, $dv, $tipodoc, $compania, $direccion, $ciudad, $telefono, $celular, $web, $correo, $tarifa, $formapago, $credito, $monto, $diascre, $diacorte, $usuario, $tipoemp, $codciiu, $tipoAdqui,
    $tipoRespo, $repoTribu, $reteIva, $reteIca, $reteFte);

echo $nuevaCompania;
