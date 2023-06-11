<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$iden = strtoupper($_POST['identifica']);
$tipodoc = $_POST['tipodoc'];
$paisExp = $_POST['paisExp'];
$ciudadExp = $_POST['ciudadExp'];
$apellido1 = strtoupper($_POST['apellido1']); 
$apellido2 = strtoupper($_POST['apellido2']);
$nombre1 = strtoupper($_POST['nombre1']);
$nombre2 = strtoupper($_POST['nombre2']);
$sexo = $_POST['sexOption'];
$direccion = strtoupper($_POST['direccion']);
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$correo = strtolower($_POST['correo']);
$fechanace = $_POST['fechanace'];
$tipohues = $_POST['tipohuesped'];
$pais = $_POST['paices'];
$ciudad = $_POST['ciudadHue'];
$tarifa = $_POST['tarifa'];
$formapago = $_POST['formapago'];
$tipoAdqui = $_POST['tipoAdquiriente'];
$tipoRespo = $_POST['tipoResponsabilidad'];
$repoTribu = $_POST['responsabilidadTribu'];
$usuario = $_POST['usuario'];
$idusuario = $_POST['idusuario'];

$regis = $hotel->insertaNuevoHuesped($iden, $tipodoc, $apellido1, $apellido2, $nombre1, $nombre2, $sexo, $direccion, $telefono, $celular, $correo, $fechanace, $tipohues, $tarifa, $pais, $ciudad, $formapago, $paisExp, $ciudadExp, $usuario, $idusuario, $tipoAdqui, $tipoRespo, $repoTribu);

$accion = 'ADICIONA HUESPED';
$id = $idusuario;
$inicial = 'Huesped '.$iden.' '.$apellido1.' '.$apellido2.' '.$nombre1.' '.$nombre2;
$final = '';

$log = $hotel->ingresoLog($regis, $usuario, $pc, $ip, $accion, $inicial, $final, 'HU');

echo $log;
