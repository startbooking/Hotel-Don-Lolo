<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $tipo     =  $_POST['tipo'];
  $anterior =  $_POST['anterior'];
  $numero   =  $_POST['numero'];

  $habitaciones = $hotel->getSeleccionaHabitacionesTipo($tipo); 

  foreach ($habitaciones as $habitacion) { ?>
    <option value="<?=$habitacion['num_habitacion']?>"
      <?php 
        if($habitacion['num_habitacion']==$numero){?>
          selected
          <?php 
        }
      ?>
    ><?=$habitacion['num_habitacion']?></option>
    <?php 
  }
  ?>
