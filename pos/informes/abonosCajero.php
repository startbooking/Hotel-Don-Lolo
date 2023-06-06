<?php

require_once '../../res/php/titles.php';
require_once '../../res/php/app_topPos.php';

$idamb = $_POST['id'];
$nomamb = $_POST['amb'];
$user = $_POST['user'];
$iduser = $_POST['iduser'];
$fecha = $_POST['fecha'];
$logo = $_POST['logo'];

include '../imprimir/imprimeAbonosCajero.php';
