

<?php
  require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$id = $_POST['id'];
$costo = $_POST['costo'];
$room = $_POST['room'];
$idusuario = $_POST['usuario_id'];

$termina = $hotel->terminaMantenimiento($id, $costo, $idusuario);

if ($termina != 0) {
    $actualizaHab = $hotel->actualizaMmtoHabitacion($room, 'SV');
} else {
    $actualizaHab = 0;
}

echo $actualizaHab;

?>