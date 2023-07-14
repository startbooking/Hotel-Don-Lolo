<?php

require '../../../res/php/app_topHotel.php';

$tipo = $_POST['tipo'];
$llega = $_POST['llega'];
$sale = $_POST['sale']; 

$habitaciones = $hotel->getSeleccionaHabitacionesTipo($tipo);
echo print_r($habitaciones);

$estadohab = $hotel->traeEstadoHabitacionesHotel($tipo, $llega, $sale);

echo print_r($estadohab);

$encasas = $hotel->getEnCasaporTipoHab($tipo, $llega, $sale, 'CA');
echo 'En Casa <br>';
echo print_r($encasas);

$salidas = $hotel->getReservasporTipoHabSalida($tipo, $llega, $sale, 'ES');
echo 'En Salidas '.'<br>';

echo print_r($salidas);
$reservas = $hotel->getReservasporTipoHab($tipo, $llega, $sale, 'ES');
echo 'En Reserva <br>';
echo print_r($reservas);
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

foreach ($reservas as $reserva) {
    $reservasOff[] = $reserva['num_habitacion'];
}


$dispos = array_diff($disponibles,$encasaOff,$salidasOff,$reservasOff);
$dispos1 = array_diff($dispos,$encasaOff,$salidasOff,$reservasOff);
$dispos2 = array_diff($dispos1,$salidasOff,$reservasOff);
$dispos3 = array_diff($dispos2,$reservasOff);


?>

    <option value="">Seleccione la Habitacion</option>
    <?php

  foreach ($dispos3 as $dispo) { ?>
      <option value="<?php echo $dispo; ?>"><?php echo $dispo; ?></option>
      <?php
  }
?>
