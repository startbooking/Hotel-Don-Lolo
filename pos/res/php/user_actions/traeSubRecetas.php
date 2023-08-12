<?php
  require '../../../../res/php/app_topPos.php'; 

  $receta     = $_POST['receta'];

  $subrecetas = $pos->getSubRecetas($receta);
  $asignadas  = $pos->getSubRecetasAsignada($receta);

  // echo print_r($subrecetas);
  echo print_r($asignadas);


  // $recetas = array_diff($subrecetas, $asignadas);

  // echo json_encode($recetas); 

?>