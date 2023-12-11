<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $tipos = $hotel->getTipoHabitacion(); ?>
  <option value="">Seleccione el Tipo de Habitacion</option>
  <?php 
  foreach ($tipos as $tipo) {?>
    <option value="<?=$tipo['codigo']?>"><?=$tipo['descripcion_habitacion']?></option>
    <?php 
  }
?>