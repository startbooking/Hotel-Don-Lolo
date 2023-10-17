<?php

require '../../../res/php/app_topHotel.php';

$tipo = $_POST['tipo'];
$llega = $_POST['llega'];
$sale = $_POST['sale']; 

$llegadas = $hotel->getHabitacionesLlegada($tipo, $llega);
echo 'Fecha Llegada <br>';
echo print_r($llegadas); 

$sales = $hotel->getHabitacionesSalen($tipo,$sale);
echo 'Fecha SAlen  <br>';
echo print_r($sales); 

$rangos = $hotel->getHabitacionesDentro($llega,$sale,$tipo);
echo 'Habitaciones Rango <br>';
echo print_r($rangos); 

$habitaciones = $hotel->getSeleccionaHabitacionesTipo($tipo);
echo 'Fecha Habitaciones TIPO'.'<br>';
echo print_r($habitaciones); 

$mmtoHabi = $hotel->getMmtoHabitaciones($llega, $tipo);
echo 'Mantenimiento Habitaciones <br>';
echo print_r($mmtoHabi);  

$estadohab = $hotel->traeEstadoHabitacionesHotel($tipo, $llega, $sale);
echo 'Estado Habitaciones <br>';
echo print_r($estadohab);

$encasas = $hotel->getEnCasaporTipoHab($tipo, $llega, $sale, 'CA');
echo 'En Casa <br>';
echo print_r($encasas);


$mananas = $hotel->getSaleMananaTipoHab($tipo, $llega, $sale, 'CA');
echo 'Salen Manana <br>';
echo print_r($mananas);

$salidas = $hotel->getReservasporTipoHabSalida($tipo, $llega, $sale, 'CA');
echo 'En Salidas '.'<br>';
echo print_r($salidas);

$reservas = $hotel->getReservasporTipoHab($tipo, $llega, $sale, 'ES');
echo 'En Reserva <br>';
echo print_r($reservas);

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



// $dispos = array_diff($disponibles, $mantenimiento, $estadoOff, $encasaOff, $reservasOff);
$dispos = array_diff($disponibles, $mantenimiento, $llegan, $salen, $dentro);

?>

<option value="">Seleccione la Habitacion</option>
  <?php

  foreach ($dispos as $dispo) { ?>
    <option value="<?php echo $dispo; ?>"><?php echo $dispo; ?></option>
    <?php
  }
?>
