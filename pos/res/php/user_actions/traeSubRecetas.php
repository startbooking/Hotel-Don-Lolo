<?php
  require '../../../../res/php/app_topPos.php'; 

  $receta     = $_POST['receta'];

  $subrecetas = $pos->getSubRecetas($receta);

  echo json_encode($subrecetas); 

?>