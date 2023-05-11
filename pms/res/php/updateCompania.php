<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$id = $_POST['txtIdCiaUpd'];
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
$tipoemp = $_POST['tipoEmpresaUpd'];
$codciiu = $_POST['codigoCiiuUpd'];
$tipoAdqui = $_POST['tipoAdquiriente'];
$tipoRespo = $_POST['tipoResponsabilidad'];
$repoTribu = $_POST['responsabilidadTribu'];

$updateCompania = $hotel->updateCompania($id, $nit, $dv, $tipodoc, $compania, $direccion, $ciudad, $telefono, $celular, $web, $correo, $tarifa, $formapago, $credito, $monto, $diascre, $diacorte, $tipoemp, $codciiu, $tipoAdqui, $tipoRespo, $repoTribu);

echo $updateCompania;
