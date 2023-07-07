<?php

require '../../../res/php/app_topAdmin.php';

$usuario = strtoupper(addslashes($_POST['usuario']));
$clave = strtoupper(addslashes($_POST['clave']));
$apellidos = strtoupper(addslashes($_POST['apellidos']));
$nombres = strtoupper(addslashes($_POST['nombres']));
$identificacion = $_POST['identificacion'];
$correo = strtolower(addslashes($_POST['correo']));
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$tipo = $_POST['tipo'];
$fecha = date('Y-m-d h:i:s');
$idPos = $_POST['Pos'];
$idPMS = $_POST['PMS'];
$idInv = $_POST['Inv'];

$claveIn = sha1(md5($usuario.$clave));

$guardaUsu = $admin->insertUserNew($usuario, $claveIn, $apellidos, $nombres, $identificacion, $correo, $telefono, $celular, $tipo, $fecha, $idPos, $idPMS, $idInv);

echo $guardaUsu;
