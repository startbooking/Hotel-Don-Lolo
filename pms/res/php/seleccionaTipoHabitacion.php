<?php

require '../../../res/php/app_topHotel.php';

$tipo = $_POST['tipo'];
$llega = $_POST['llega'];
$sale = $_POST['sale']; 

$llegadas = $hotel->getHabitacionesLlegada($tipo, $llega);
$sales = $hotel->getHabitacionesSalen($tipo,$llega, $sale);
$rangos = $hotel->getHabitacionesDentro($llega,$sale,$tipo);
$habitaciones = $hotel->getSeleccionaHabitacionesTipo($tipo);
$mmtoHabi = $hotel->getMmtoHabitaciones($llega, $tipo);
$estadohab = $hotel->traeEstadoHabitacionesHotel($tipo, $llega, $sale);
$encasas = $hotel->getEnCasaporTipoHab($tipo, $llega, $sale, 'CA');
$mananas = $hotel->getSaleMananaTipoHab($tipo, $llega, $sale, 'CA');
$salidas = $hotel->getReservasporTipoHabSalida($tipo, $llega, $sale, 'CA');
$reservas = $hotel->getReservasporTipoHab($tipo, $llega, $sale, 'ES');

$mantenimiento = [];
$disponibles = [];
$encasaOff = [];
$salidasOff = []; 
$reservasOff = [];
$estadoOff = [];
$saleManana = [];

$llegan = [];
$salen = [];
$dentro = [];

foreach ($habitaciones as $habitacion) {
    $disponibles[] = $habitacion['num_habitacion'];
}

foreach ($mmtoHabi as $mmtoHab) {
    $mantenimiento[] = $mmtoHab['numero_hab'];
}

foreach ($estadohab as $estadoha) {
    $estadoOff[] = $estadoha['num_habitacion'];
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

foreach ($mananas as $reserva) {
    $saleManana[] = $reserva['num_habitacion'];
}

foreach ($llegadas as $reserva) {
    $llegan[] = $reserva['num_habitacion'];
}

foreach ($sales as $reserva) {
    $salen[] = $reserva['num_habitacion'];
}

foreach ($rangos as $reserva) {
    $dentro[] = $reserva['num_habitacion'];
}

$dispos = array_diff($disponibles, $mantenimiento, $llegan, $salen, $dentro);


?>

<option value="">Seleccione la Habitacion</option>
  <?php

  foreach ($dispos as $dispo) { ?>
    <option value="<?php echo $dispo; ?>"><?php echo $dispo; ?></option>
    <?php
  }
?>
