<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $id  =  $_POST['id'];

  $anula   = $hotel->eliminaAcompanante($id); 

  ?>
  