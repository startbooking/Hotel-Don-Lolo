<?php 
  require '../../../res/php/app_topHotel.php'; 

  $pais     = $_POST['pais']; 
  $ciudades = $hotel->getCiudadesPais($pais);
  foreach ($ciudades as $ciudad) { ?> 
    <option value="<?=$ciudad['id_ciudad']?>"><?=$ciudad['municipio'].' '.$ciudad['depto']?></option><?php 
  }
?>
