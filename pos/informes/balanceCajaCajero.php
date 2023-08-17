<?php
require_once '../../res/php/app_topPos.php';

$idamb = $_POST['id'];
$nomamb = $_POST['amb'];
$user = $_POST['user'];
$iduser = $_POST['iduser'];
$impto = $_POST['impto'];
$prop = $_POST['prop'];
$logo = $_POST['logo'];
$file = $_POST['file'];
$fecha = $_POST['fecha'];

include '../imprimir/imprimeBalanceCajaCajero.php';

?>
   