<?php 

  require '../../../res/php/app_topHotel.php'; 
  $id  =  $_POST['id'];

  $cias = $hotel->getbuscaCia($id);

  echo json_encode($cias);

?>