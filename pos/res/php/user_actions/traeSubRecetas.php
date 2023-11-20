<?php
  require '../../../../res/php/app_topPos.php'; 

  $receta     = $_POST['receta'];

  $subrecetas = $pos->getSubRecetas($receta);
  // $asignadas  = $pos->getSubRecetasAsignada($receta);

  echo json_encode($subrecetas);
?>