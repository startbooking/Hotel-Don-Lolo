<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $tipo  =  $_POST['tipo'];
  $llega =  $_POST['llega'];
  $sale  =  $_POST['sale'];

  $tarifas = $hotel->getSeleccionaTarifa($tipo,$llega,$sale); 

  ?>
  <?php 
  foreach ($tarifas as $tarifa) { ?>
    <option value="<?=$tarifa['id']?>"><?=$tarifa['descripcion_tarifa']?></option>
    <?php 
  }
  ?>
 