<?php

require_once '../../res/php/titles.php';
require_once '../../res/php/app_topPos.php';

$idamb = $_POST['id'];
$nomamb = $_POST['amb'];
$user = $_POST['user'];
$iduser = $_POST['iduser'];
$impto = $_POST['impto'];
$prop = $_POST['prop'];
$logo = $_POST['logo'];
$fecha = $_POST['fecha'];

$_SESSION['NOMBRE_AMBIENTE'] = $nomamb;
$_SESSION['AMBIENTE_ID'] = $idamb;
$_SESSION['usuario'] = $user;
$_SESSION['usuario_id'] = $iduser;

require_once '../imprimir/imprimeCuentasActivasCajero.php';
