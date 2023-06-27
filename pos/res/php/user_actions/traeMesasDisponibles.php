<?php
  require '../../../../res/php/app_topPos.php'; 

  $idamb     = $_POST['idambi'];

  $mesas = $pos->getMesasAmbi($idamb);

  echo json_encode($mesas); 

?>