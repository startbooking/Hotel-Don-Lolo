<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $tipo         =  $_POST['tipo'];
  $habitaciones = $hotel->getSeleccionaDormitorio($tipo); 

  ?>
  <label for="nrohabitacion" class="col-sm-1 control-label">Hab</label>
  <div class="col-sm-3">
    <select name="" id="nrohabitacion" required>
      <option value="">Seleccione La Habitacion</option>
      <?php 
      foreach ($habitaciones as $habitacion) { ?>
        <option value="<?=$habitacion['numero_hab']?>"><?=$habitacion['numero_hab']?></option>
        <?php 
      }
      ?>
    </select>
  </div>
