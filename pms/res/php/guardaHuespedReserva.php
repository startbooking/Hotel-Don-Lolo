

<?php
require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

// $idhues = $_POST['idHuesAdi'];

$apellido1 = strtoupper($_POST['apellido1']);
$apellido2 = strtoupper($_POST['apellido2']);
$nombre1 = strtoupper($_POST['nombre1']);
$nombre2 = strtoupper($_POST['nombre2']);
$identificacion = $_POST['identificaHuesRes'];
$tipoiden = $_POST['tipodoc'];
$sexo = $_POST['sexOption'];
$fechanace = $_POST['fechanace'];
$nacion = $_POST['paices'];
$ciudad = $_POST['ciudad'];
$usuario = $_POST['usuario'];
$idusuario = $_POST['idusuario'];

$creaHues = $hotel->creaHuespedAdicional($apellido1, $apellido2, $nombre1, $nombre2, $identificacion, $tipoiden, $sexo, $fechanace, $nacion, $ciudad, $idusuario);

echo $identificacion;

?>
	