<?php
require '../../res/php/titles.php';
require '../../res/php/app_topPos.php';

$idamb = $_POST['id'];
$nomamb = $_POST['amb'];
$user = $_POST['user'];
$iduser = $_POST['iduser'];
$impto = $_POST['impto'];
$prop = $_POST['prop'];
$fecha = $_POST['fecha'];
$logo = $_POST['logo'];

include_once '../imprimir/imprimeVentasDia.php'; 

?> 
 