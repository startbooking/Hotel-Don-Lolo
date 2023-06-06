<?php 

  require '../../../res/php/app_topHotel.php'; 
  
  $tipo  =  $_POST['tipo'];
  $llega =  $_POST['llega'];
  $sale  =  $_POST['sale']; 

  echo $tipo;

  $habitaciones = $hotel->getSeleccionaHabitacionesTipo($tipo); 
  $encasa       = $hotel->getReservasporTipoHab($tipo,$llega,$sale,'CA');
  $salidas      = $hotel->getReservasporTipoHabSalida($tipo,$llega,$sale,'ES');
  $reservasact  = $hotel->getReservasporTipoHab($tipo,$llega,$sale,'ES');

  $disponibles = array();
  foreach ($habitaciones as $habitacion) {
    $disponibles[] = $habitacion['num_habitacion'];
  }

  foreach ($encasa as $encas) {
    $habi   = $encas['num_habitacion'];
    $indice = array_search($habi,$disponibles);
    if ($indice) {
      unset($disponibles[$indice]) ; 
    }
  }

  foreach ($reservasact as $reservaact) {
    $habi   = $reservaact['num_habitacion'];
    $indice = array_search($habi,$disponibles);
    if ($indice) {
      unset($disponibles[$indice]) ; 
    }
  }

  foreach ($salidas as $salida) {
    $habi   = $salida['num_habitacion'];
    $indice = array_search($habi,$disponibles);
    if ($indice) {
      unset($disponibles[$indice]) ; 
    }
  }

  ?>

    <option value="">Seleccione la Habitacion</option>
    <?php 
    
    foreach ($disponibles as $disponible) { ?>
      <option value="<?=$disponible?>"><?=$disponible?></option>
      <?php 
    }
    ?>
