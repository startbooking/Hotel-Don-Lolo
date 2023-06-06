<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';
$user = $_POST['usuario'];
$idconsumo = $_POST['idconsumo'];
$idreserva = $_POST['idreserva'];
$idhuesped = $_POST['idhuesped'];
$newreserva = $_POST['newreserva'];
$motivotras = $_POST['motivotras'];
// $folio = $_POST['folio'];

$traslada = $hotel->trasladaCargoHabitacion($idconsumo, $idreserva, $idhuesped, $newreserva, $motivotras, $user);

?>


<div class="alert alert-success"><h4>Cargo Trasladado con Exito</h4></div>
