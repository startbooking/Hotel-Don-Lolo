<?php

require '../../../res/php/app_topHotel.php';

$tipo = $_POST['tipo'];
$llega = $_POST['llega'];
$sale = $_POST['sale']; 

$habitaciones = $hotel->getSeleccionaHabitacionesTipo($tipo);
echo 'Habitaciones General <br>';
echo print_r($habitaciones); 

$mmtoHabi = $hotel->getMmtoHabitaciones($llega, $tipo);
echo 'Manteni miento Habitaciones <br>';
echo print_r($mmtoHabi); 

$estadohab = $hotel->traeEstadoHabitacionesHotel($tipo, $llega, $sale);
echo print_r($estadohab);
echo 'Estado Habitaciones <br>';

$encasas = $hotel->getEnCasaporTipoHab($tipo, $llega, $sale, 'CA');
echo 'En Casa <br>';
echo print_r($encasas);

$salidas = $hotel->getReservasporTipoHabSalida($tipo, $llega, $sale, 'CA');
echo 'En Salidas '.'<br>';

echo print_r($salidas);
$reservas = $hotel->getReservasporTipoHab($tipo, $llega, $sale, 'CA');
echo 'En Reserva <br>';
echo print_r($reservas);
$mantenimiento = [];
$disponibles = [];
$encasaOff = [];
$salidasOff = []; 
$reservasOff = [];
$estadoOff = [];


echo 'PAso 0' ;

foreach ($habitaciones as $habitacion) {
    $disponibles[] = $habitacion['num_habitacion'];
}
echo 'PAso 1' ;

foreach ($mmtoHabi as $mmtoHab) {
    $mantenimiento[] = $mmtoHab['numero_hab'];
}

echo 'Mantenimineto ';
echo print_r($mantenimiento);
echo 'PAso 1' ;

foreach ($estadohab as $estadoha) {
    $estadoOff[] = $estadoha['num_habitacion'];
}
echo 'PAso 2' ;

foreach ($encasas as $encasa) {
    $encasaOff[] = $encasa['num_habitacion'];
}
echo 'PAso 3' ;

foreach ($salidas as $salida) {
    $salidasOff[] = $salida['num_habitacion'];
}
echo 'PAso 4' ;

foreach ($reservas as $reserva) {
    $reservasOff[] = $reserva['num_habitacion'];
}
echo 'PAso 5' ;
echo print_r($reservasOff);
echo 'PAso 6' ;


$dispos = array_diff($disponibles, $mantenimiento, $estadoOff, $encasaOff, $reservasOff);

/* $dispos = array_diff($disponibles,$encasaOff,$salidasOff,$reservasOff);
$dispos1 = array_diff($dispos,$encasaOff,$salidasOff,$reservasOff);
$dispos2 = array_diff($dispos1,$salidasOff,$reservasOff);
$dispos3 = array_diff($dispos2,$reservasOff); */
echo 'PAso 6' ;


?>

    <option value="">Seleccione la Habitacion</option>
    <?php

  foreach ($dispos as $dispo) { ?>
      <option value="<?php echo $dispo; ?>"><?php echo $dispo; ?></option>
      <?php
  }
?>
