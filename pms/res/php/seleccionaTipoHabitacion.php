<?php

require '../../../res/php/app_topHotel.php';

$tipo = $_POST['tipo'];
$llega = $_POST['llega'];
$sale = $_POST['sale']; 

$habitaciones = $hotel->getSeleccionaHabitacionesTipo($tipo);

$encasas = $hotel->getEnCasaporTipoHab($tipo, $llega, $sale, 'CA');

$salidas = $hotel->getReservasporTipoHabSalida($tipo, $llega, $sale, 'ES');
$reservas = $hotel->getReservasporTipoHab($tipo, $llega, $sale, 'ES');

$disponibles = [];
$encasaOff = [];
$salidasOff = [];
$reservasOff = [];

foreach ($habitaciones as $habitacion) {
    $disponibles[] = $habitacion['num_habitacion'];
}

foreach ($encasas as $encasa) {
    $encasaOff[] = $encasa['num_habitacion'];
}
foreach ($salidas as $salida) {
    $salidasOff[] = $salida['num_habitacion'];
}

foreach ($resevas as $reserva) {
    $reservasOff[] = $reserva['num_habitacion'];
}


$dispos = array_diff($disponibles,$encasaOff,$salidasOff,$reservasOff);

?>

    <option value="">Seleccione la Habitacion</option>
    <?php

  foreach ($dispos as $dispo) { ?>
      <option value="<?php echo $dispo; ?>"><?php echo $dispo; ?></option>
      <?php
  }
?>
