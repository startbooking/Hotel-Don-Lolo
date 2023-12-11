<?php
  
  require '../../../res/php/app_topInventario.php'; 

  $codigo   = $_POST['codigo'];
  $ciudades = $admin->getCiudadesPais($codigo);

 ?> 
  <option value="">Seleccione La Ciudad</option>
  <?php 
  foreach ($ciudades as $ciudad) { ?>
    <option value="<?=$ciudad['id_ciudad'];?>"><?= $ciudad['municipio'].' - '.$ciudad['depto'];?> </option>
    <?php 
  }

?>